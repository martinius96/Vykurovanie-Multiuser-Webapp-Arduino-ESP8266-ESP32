<?php
//error_reporting(0);
session_start();
include ("connect.php");
if(isset($_SESSION['uid'])){ 
?>
<!doctype html>
<html lang="sk">
	<?php

?>
<head>
<title>Prehľad nameraných údajov</title>
<?php 
include ("meta.php");    
?>	
</head>
<?php $stranka = "Kod";?>
 <body onload="myFunction()">
<?php 
include ("menu.php");
$vsetko_get = mysqli_query($con,"SELECT * FROM `user_vykurovanie` WHERE `id`='".$_SESSION['uid']."'") or die(mysqli_error($con));
 $vsetko = mysqli_fetch_assoc($vsetko_get);
 $username = $vsetko['username'];
 $mikrokontroler = $vsetko['mikrokontroler'];
 $hardver = $vsetko['hardver'];
 $kodik = $vsetko['code'];
?>	
  <div class="container">
      <div class="row">
        <div class="col-lg-12">									
<h2>Zdrojový kód pre:</h2>
								<?php echo '<li><b>Používateľ:</b> '.$username.'</li>'; ?>
								<?php echo '<li><b>Mikrokontróler:</b> '.$mikrokontroler.'</li>'; ?>
								<?php echo '<li><b>Teplotné senzory:</b> '.$hardver.'</li>'; ?>
								<?php echo '<li><b>Váš token:</b> '.$kodik.'</li>'; ?>
<?php 
if(($mikrokontroler=="W5100")AND($hardver=="DS18B20")){
?>
<h2>Zapojenie Arduina a senzorov na OneWire zbernicii</h2>
<center><img src="https://i.imgur.com/geGdzcE.png" style="display: block; max-width: 100%; height: auto;"></center>
<pre>
<b>Zapojenie pre senzory DS18B20:</b>  
VCC --> 3.3V/5V  (pri 5V napájaní sa senzory jemne ohrievajú, znepresňuje meranie)
DATA --> D6
GND --> GND
</pre>
<h2><font color="#2ECC71">Zdrojový kód pre HTTP spojenie</font></h2>
<pre style="background: #2ECC71;">
#include &lt;avr\wdt.h&gt;
#include &lt;SPI.h&gt;
#include &lt;Ethernet.h&gt;
#include &lt;OneWire.h&gt;
#include &lt;DallasTemperature.h&gt;
#define ONE_WIRE_BUS 6
OneWire oneWire(ONE_WIRE_BUS);
DallasTemperature sensors(&oneWire);
char server[] = "<?php echo "www.".$_SERVER['SERVER_NAME']; ?>";


byte mac[] = { 0xDC, 0x0E, 0xB1, 0x81, 0x7B, 0x4A };
IPAddress dnServer(192, 168, 1, 1);
IPAddress gateway(192, 168, 1, 1);
IPAddress subnet(255, 255, 255, 0);
IPAddress ip(192, 168, 1, 254);


EthernetClient client;
String token = "<?php echo $kodik;  ?>";
String username = "<?php echo $username;  ?>";
const int rele = 5;
void setup() {
  Serial.begin(115200);
  sensors.begin();
  pinMode(rele, OUTPUT);
  if (Ethernet.begin(mac) == 0) {
    Serial.println("Nastavujem MAC, IP...");
    Ethernet.begin(mac, ip, dnServer, gateway, subnet);
  }
  wdt_enable(WDTO_8S);
}

void odosli_data() {
  sensors.requestTemperatures();
  delay(2000);
  String teplota1 = String(sensors.getTempCByIndex(0));
  String teplota2 = String(sensors.getTempCByIndex(1));
  String teplota3 = String(sensors.getTempCByIndex(2));
  String teplota4 = String(sensors.getTempCByIndex(3));
  String teplota5 = String(sensors.getTempCByIndex(4));
  String teplota6 = String(sensors.getTempCByIndex(5));
  if (client.connect(server, 80)) {
    client.print("GET /vykurovanie-online/system/api/data.php?teplota1=");
    client.print(teplota1);
    client.print("&teplota2=");
    client.print(teplota2);
    client.print("&teplota3=");
    client.print(teplota3);
    client.print("&teplota4=");
    client.print(teplota4);
    client.print("&teplota5=");
    client.print(teplota5);
    client.print("&teplota6=");
    client.print(teplota6);
    client.print("&token=");
    client.print(token);
    client.print("&username=");
    client.print(username);
    client.println(" HTTP/1.0");
    client.println("Host: www.arduino.php5.sk");
    client.println("Connection: close");
    client.println();
    Serial.println("Teploty na web uspesne odoslane:");
    Serial.println("Teplota1:");
    Serial.println(teplota1);
    Serial.println("Teplota2:");
    Serial.println(teplota2);
    Serial.println("Teplota3:");
    Serial.println(teplota3);
    Serial.println("Teplota4:");
    Serial.println(teplota4);
    Serial.println("Teplota5:");
    Serial.println(teplota5);
    Serial.println("Teplota6:");
    Serial.println(teplota6);
  } else {
    Serial.println("Teploty neboli odoslane");
  }
  client.stop();
}

void stav_rele() {
  if (client.connect(server, 80)) {
    client.print("GET /vykurovanie-online/system/api/stav.php?token=");
    client.print(token);
    client.print("&username=");
    client.print(username);
    client.println(" HTTP/1.0");
    client.println("Host: www.arduino.php5.sk");
    client.println("Connection: close");
    client.println();
    while (client.connected()) {
      String hlavicka = client.readStringUntil('\n');
      if (hlavicka == "\r") {
        break;
      }
    }
    String premenna = client.readStringUntil('\n');
    if (premenna == "ZAP") {
      Serial.println("Zapinam rele");
      digitalWrite(rele, LOW);
    } else if (premenna == "VYP") {
      Serial.println("Vypinam rele");
      digitalWrite(rele, HIGH);
    }
  } else {
    Serial.println("Neuspesne pripojenie pre stav rele");
  }
  client.stop();
}

void loop() {
  if (Ethernet.begin(mac) == 0) {
    Serial.println("Nastavujem MAC");
    Ethernet.begin(mac, ip, dnServer, gateway, subnet);
    wdt_reset();
  }
  odosli_data();
  wdt_reset();
  stav_rele();
  for (int i = 0; i &lt;= 60; i++) {
    wdt_reset();
    delay(1000);
    Serial.println("Cakacia slucka...");
  }
}
</pre>
<?php
}else if(($mikrokontroler=="W5500")AND($hardver=="DS18B20")){
?>
<h2>Zapojenie Arduina a senzorov na OneWire zbernicii</h2>
<center><img src="https://i.imgur.com/geGdzcE.png" style="display: block; max-width: 100%; height: auto;"></center>
<pre>
<b>Zapojenie pre senzory DS18B20:</b>
VCC --> 3.3V/5V
DATA --> D6
GND --> GND
</pre>
<h2><font color="#9B59B6">Zdrojový kód pre HTTP spojenie (HTTPS nie je podporované!)</font></h2>
<pre style="background: #9B59B6;">
#include &lt;avr\wdt.h&gt;
#include &lt;SPI.h&gt;
#include &lt;Ethernet2.h&gt;
#include &lt;OneWire.h&gt;
#include &lt;DallasTemperature.h&gt;
#define ONE_WIRE_BUS 6
OneWire oneWire(ONE_WIRE_BUS);
DallasTemperature sensors(&oneWire);
char server[] = "<?php echo "www.".$_SERVER['SERVER_NAME']; ?>";

byte mac[] = { 0xDC, 0xFE, 0xA1, 0x81, 0x7B, 0x4A };
IPAddress dnServer(192, 168, 1, 1);
IPAddress gateway(192, 168, 1, 1);
IPAddress subnet(255, 255, 255, 0);
IPAddress ip(192, 168, 1, 254);

EthernetClient client;
String token = "<?php echo $kodik;  ?>";
String username = "<?php echo $username;  ?>";
const int rele = 5;
void setup() {
  Serial.begin(115200);
  sensors.begin();
  pinMode(rele, OUTPUT);
  if (Ethernet.begin(mac) == 0) {
    Serial.println("Nastavujem MAC, IP...");
    Ethernet.begin(mac, ip, dnServer, gateway, subnet);
  }
  wdt_enable(WDTO_8S);
}

void odosli_data() {
  sensors.requestTemperatures();
  delay(2000);
  String teplota1 = String(sensors.getTempCByIndex(0));
  String teplota2 = String(sensors.getTempCByIndex(1));
  String teplota3 = String(sensors.getTempCByIndex(2));
  String teplota4 = String(sensors.getTempCByIndex(3));
  String teplota5 = String(sensors.getTempCByIndex(4));
  String teplota6 = String(sensors.getTempCByIndex(5));
  if (client.connect(server, 80)) {
    client.print("GET /vykurovanie-online/system/api/data.php?teplota1=");
    client.print(teplota1);
    client.print("&teplota2=");
    client.print(teplota2);
    client.print("&teplota3=");
    client.print(teplota3);
    client.print("&teplota4=");
    client.print(teplota4);
    client.print("&teplota5=");
    client.print(teplota5);
    client.print("&teplota6=");
    client.print(teplota6);
    client.print("&token=");
    client.print(token);
    client.print("&username=");
    client.print(username);
    client.println(" HTTP/1.0");
    client.println("Host: www.arduino.php5.sk");
    client.println("Connection: close");
    client.println();
    Serial.println("Teploty na web uspesne odoslane:");
    Serial.println("Teplota1:");
    Serial.println(teplota1);
    Serial.println("Teplota2:");
    Serial.println(teplota2);
    Serial.println("Teplota3:");
    Serial.println(teplota3);
    Serial.println("Teplota4:");
    Serial.println(teplota4);
    Serial.println("Teplota5:");
    Serial.println(teplota5);
    Serial.println("Teplota6:");
    Serial.println(teplota6);
  } else {
    Serial.println("Teploty neboli odoslane");
  }
  client.stop();
}

void stav_rele() {
  if (client.connect(server, 80)) {
    client.print("GET /vykurovanie-online/system/api/stav.php?token=");
    client.print(token);
    client.print("&username=");
    client.print(username);
    client.println(" HTTP/1.0");
    client.println("Host: www.arduino.php5.sk");
    client.println("Connection: close");
    client.println();
    while (client.connected()) {
      String hlavicka = client.readStringUntil('\n');
      if (hlavicka == "\r") {
        break;
      }
    }
    String premenna = client.readStringUntil('\n');
    if (premenna == "ZAP") {
      Serial.println("Zapinam rele");
      digitalWrite(rele, LOW);
    } else if (premenna == "VYP") {
      Serial.println("Vypinam rele");
      digitalWrite(rele, HIGH);
    }
  } else {
    Serial.println("Neuspesne pripojenie pre stav rele");
  }
  client.stop();
}

void loop() {
  if (Ethernet.begin(mac) == 0) {
    Serial.println("Nastavujem MAC");
    Ethernet.begin(mac, ip, dnServer, gateway, subnet);
    wdt_reset();
  }
  odosli_data();
  wdt_reset();
  stav_rele();
  for (int i = 0; i &lt;= 60; i++) {
    wdt_reset();
    delay(1000);
    Serial.println("Cakacia slucka...");
  }
}
</pre>

<?php
}else if(($mikrokontroler=="ESP8266")AND($hardver=="DS18B20")){
?>
<div class="alert alert-info">
  <strong>Opravený zdrojový kód pre ESP8266, oprava fingerprintu. Funkčné, testované pod Core 2.5.2 pre NodeMCU.</strong>
</div>              
<h2>Zapojenie senzorov na OneWire zbernicii a ESP8266</h2>
<center><img src="https://i.imgur.com/nPfCvIX.png" style="display: block; max-width: 100%; height: auto;"></center>
<pre>
<b>Zapojenie pre senzory DS18B20:</b>
VCC --> 3.3V
DATA --> D1 (GPIO5)
GND --> GND
</pre>
<h2><font color="#A93226">Zdrojový kód pre HTTPS spojenie</font></h2>
<pre style="background: #A93226;">
//CORE 2.5.0+
//CORE 2.3.0 nie je naďalej podporovane a HTTPS nefunguje.
//Nutne updatovať Arduino core na min verziu 2.5.0
#include &lt;ESP8266WiFi.h&gt;
#include &lt;WiFiClientSecure.h&gt;
#include &lt;DallasTemperature.h&gt;
#include &lt;OneWire.h&gt;
#define ONE_WIRE_BUS 5 //GPIO 5 = D1 (NodeMCU pinout)
const int rele = 4; //GPIO 4 = D2 (NodeMCU pinout)
OneWire oneWire(ONE_WIRE_BUS);
DallasTemperature sensors(&oneWire);

const char* ssid = "MENO_WIFI";
const char* password = "HESLO_WIFI";
const char* host = "<?php echo $_SERVER['SERVER_NAME']; ?>";
const int httpsPort = 443;

const char fingerprint[] PROGMEM = "b0 6d 7f 8c 98 78 8e 6e 0a 57 a8 2f 7e d1 40 2a 1e 3f 48 f7";
String token = "<?php echo $kodik;  ?>";
String username = "<?php echo $username;  ?>";
void setup() {
  sensors.begin();
  Serial.begin(115200);
  pinMode(rele, OUTPUT);
  Serial.println();
  Serial.println("pripajam na ");
  Serial.println(ssid);
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.println(".");
  }
  Serial.println("");
  Serial.println("WiFi pripojene");
  Serial.println("IP adresa: ");
  Serial.println(WiFi.localIP());
}

void odosli_data() {
  sensors.requestTemperatures();
  delay(2000); //cakanie na data z cidiel
  WiFiClientSecure client;
  client.setFingerprint(fingerprint);
  if (client.connect(host, httpsPort)) {
    String teplota1 = String(sensors.getTempCByIndex(0));
    String teplota2 = String(sensors.getTempCByIndex(1));
    String teplota3 = String(sensors.getTempCByIndex(2));
    String teplota4 = String(sensors.getTempCByIndex(3));
    String teplota5 = String(sensors.getTempCByIndex(4));
    String teplota6 = String(sensors.getTempCByIndex(5));
    String url = "/vykurovanie-online/system/api/data.php?teplota1=" + teplota1 + "&teplota2=" + teplota2 + "&teplota3=" + teplota3 + "&teplota4=" + teplota4 + "&teplota5=" + teplota5 + "&teplota6=" + teplota6 + "&token=" + token + "&username=" + username;
    client.print(String("GET ") + url + " HTTP/1.0\r\n" + "Host: " + host + "\r\n" + "User-Agent: NodeMCU\r\n" + "Connection: close\r\n\r\n");
    Serial.println("Teploty uspesne odoslane na server");
  } else if (!client.connect(host, httpsPort)) {
    Serial.println("Neuspesne pripojenie pre odoslanie teplot");
  }
  client.stop(); //ukonc spojenia

}
void stav_rele() {
  Serial.print("Pripajam sa na: ");
  Serial.println(host);
  WiFiClientSecure client;
  client.setFingerprint(fingerprint);
  if (client.connect(host, httpsPort)) {
    Serial.println("Pripojenie pre stav rele uspesne");
    String url = "/vykurovanie-online/system/api/stav.php?token=" + token + "&username=" + username;
    client.print(String("GET ") + url + " HTTP/1.0\r\n" + "Host: " + host + "\r\n" + "User-Agent: NodeMCU\r\n" + "Connection: close\r\n\r\n");
    while (client.connected()) {
      String hlavicka = client.readStringUntil('\n');
      Serial.println(hlavicka);
      if (hlavicka == "\r") {
        break;
      }
    }
    String premenna = client.readStringUntil('\n');
    Serial.println(premenna);
    if (premenna == "ZAP") {
      Serial.println("ZAPINAM RELE");
      digitalWrite(rele, LOW);
    } else if (premenna == "VYP") {
      Serial.println("VYPINAM RELE");
      digitalWrite(rele, HIGH);
    }
  } else {
    Serial.println("Nepodarilo sa nacitat stav rele");
  }
  client.stop(); //ukonc spojenia
}

void loop() {
  if (WiFi.status() != WL_CONNECTED) {
    WiFi.begin(ssid, password);
  }
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.println(".");
  }
  odosli_data();
  stav_rele();
  delay(60000);
}

          
</pre>
<?php
}else if(($mikrokontroler=="ESP32")AND($hardver=="DS18B20")){
?>
<div class="alert alert-info">
<strong>Zdrojové kódy testované pod Arduino Core 1.0.1 pre ESP32!</strong>
</div>
<h2>Zapojenie ESP32 a senzorov na OneWire zbernici</h2>
<center><img src="https://i.imgur.com/iV5sUg3.png" style="display: block; max-width: 100%; height: auto;"></center>
<pre>
<b>Zapojenie pre senzory DS18B20:</b>
VCC --> 3.3V
DATA --> D23
GND --> GND
</pre>
<h2><font color="#3498DB">Zdrojový kód pre HTTPS spojenie - WPA/WPA2 - PSK siete</font></h2>
<pre style="background: #3498DB;">
#include &lt;WiFi.h&gt; //Wifi library
#include &lt;WiFiClientSecure.h&gt;
#include &lt;OneWire.h&gt;
#include &lt;DallasTemperature.h&gt;
#include "esp_system.h"
const int wdtTimeout = 40000;  //time in ms to trigger the watchdog
hw_timer_t *timer = NULL;
#define ONE_WIRE_BUS 23
OneWire oneWire(ONE_WIRE_BUS);
DallasTemperature sensors(&oneWire);

const char* ssid = "WIFI_MENO";
const char* pass = "WIFI_HESLO";

const char* host = "<?php echo $_SERVER['SERVER_NAME']; ?>";
int pocitadlo = 0;
const int rele = 18;
String token = "<?php echo $kodik;  ?>";
String username = "<?php echo $username;  ?>";
const char* test_root_ca = \
                           "-----BEGIN CERTIFICATE-----\n" \
                           "MIIEsTCCA5mgAwIBAgIQCKWiRs1LXIyD1wK0u6tTSTANBgkqhkiG9w0BAQsFADBh\n" \
                           "MQswCQYDVQQGEwJVUzEVMBMGA1UEChMMRGlnaUNlcnQgSW5jMRkwFwYDVQQLExB3\n" \
                           "d3cuZGlnaWNlcnQuY29tMSAwHgYDVQQDExdEaWdpQ2VydCBHbG9iYWwgUm9vdCBD\n" \
                           "QTAeFw0xNzExMDYxMjIzMzNaFw0yNzExMDYxMjIzMzNaMF4xCzAJBgNVBAYTAlVT\n" \
                           "MRUwEwYDVQQKEwxEaWdpQ2VydCBJbmMxGTAXBgNVBAsTEHd3dy5kaWdpY2VydC5j\n" \
                           "b20xHTAbBgNVBAMTFFJhcGlkU1NMIFJTQSBDQSAyMDE4MIIBIjANBgkqhkiG9w0B\n" \
                           "AQEFAAOCAQ8AMIIBCgKCAQEA5S2oihEo9nnpezoziDtx4WWLLCll/e0t1EYemE5n\n" \
                           "+MgP5viaHLy+VpHP+ndX5D18INIuuAV8wFq26KF5U0WNIZiQp6mLtIWjUeWDPA28\n" \
                           "OeyhTlj9TLk2beytbtFU6ypbpWUltmvY5V8ngspC7nFRNCjpfnDED2kRyJzO8yoK\n" \
                           "MFz4J4JE8N7NA1uJwUEFMUvHLs0scLoPZkKcewIRm1RV2AxmFQxJkdf7YN9Pckki\n" \
                           "f2Xgm3b48BZn0zf0qXsSeGu84ua9gwzjzI7tbTBjayTpT+/XpWuBVv6fvarI6bik\n" \
                           "KB859OSGQuw73XXgeuFwEPHTIRoUtkzu3/EQ+LtwznkkdQIDAQABo4IBZjCCAWIw\n" \
                           "HQYDVR0OBBYEFFPKF1n8a8ADIS8aruSqqByCVtp1MB8GA1UdIwQYMBaAFAPeUDVW\n" \
                           "0Uy7ZvCj4hsbw5eyPdFVMA4GA1UdDwEB/wQEAwIBhjAdBgNVHSUEFjAUBggrBgEF\n" \
                           "BQcDAQYIKwYBBQUHAwIwEgYDVR0TAQH/BAgwBgEB/wIBADA0BggrBgEFBQcBAQQo\n" \
                           "MCYwJAYIKwYBBQUHMAGGGGh0dHA6Ly9vY3NwLmRpZ2ljZXJ0LmNvbTBCBgNVHR8E\n" \
                           "OzA5MDegNaAzhjFodHRwOi8vY3JsMy5kaWdpY2VydC5jb20vRGlnaUNlcnRHbG9i\n" \
                           "YWxSb290Q0EuY3JsMGMGA1UdIARcMFowNwYJYIZIAYb9bAECMCowKAYIKwYBBQUH\n" \
                           "AgEWHGh0dHBzOi8vd3d3LmRpZ2ljZXJ0LmNvbS9DUFMwCwYJYIZIAYb9bAEBMAgG\n" \
                           "BmeBDAECATAIBgZngQwBAgIwDQYJKoZIhvcNAQELBQADggEBAH4jx/LKNW5ZklFc\n" \
                           "YWs8Ejbm0nyzKeZC2KOVYR7P8gevKyslWm4Xo4BSzKr235FsJ4aFt6yAiv1eY0tZ\n" \
                           "/ZN18bOGSGStoEc/JE4ocIzr8P5Mg11kRYHbmgYnr1Rxeki5mSeb39DGxTpJD4kG\n" \
                           "hs5lXNoo4conUiiJwKaqH7vh2baryd8pMISag83JUqyVGc2tWPpO0329/CWq2kry\n" \
                           "qv66OSMjwulUz0dXf4OHQasR7CNfIr+4KScc6ABlQ5RDF86PGeE6kdwSQkFiB/cQ\n" \
                           "ysNyq0jEDQTkfa2pjmuWtMCNbBnhFXBYejfubIhaUbEv2FOQB3dCav+FPg5eEveX\n" \
                           "TVyMnGo=\n" \
                           "-----END CERTIFICATE-----\n";
WiFiClientSecure client;

void IRAM_ATTR resetModule() {
  ets_printf("reboot\n");
  esp_restart();
}

void setup() {
  Serial.begin(115200);
  delay(10);
  timer = timerBegin(0, 80, true);                  //timer 0, div 80
  timerAttachInterrupt(timer, &resetModule, true);  //attach callback
  timerAlarmWrite(timer, wdtTimeout * 1000, false); //set time in us
  timerAlarmEnable(timer);                          //enable interrupt
  sensors.begin();
  pinMode(rele, OUTPUT);
  Serial.println();
  Serial.print("Pripajam sa na wifi siet: ");
  Serial.println(ssid);
  WiFi.disconnect(true);
  WiFi.mode(WIFI_STA);
  WiFi.begin(ssid, pass);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
    pocitadlo++;
    if (pocitadlo >= 60) {
      ESP.restart();
    }
  }
  client.setCACert(test_root_ca);
  Serial.println("");
  Serial.println("WiFi pripojene");
  Serial.println("IP addresa nastavena: ");
  Serial.println(WiFi.localIP());
}

void odosli_data() {
  sensors.requestTemperatures();
  delay(2000); //cakanie na data z cidiel
  String teplota1 = String(sensors.getTempCByIndex(0));
  String teplota2 = String(sensors.getTempCByIndex(1));
  String teplota3 = String(sensors.getTempCByIndex(2));
  String teplota4 = String(sensors.getTempCByIndex(3));
  String teplota5 = String(sensors.getTempCByIndex(4));
  String teplota6 = String(sensors.getTempCByIndex(5));
  if (client.connect(host, 443)) {
    Serial.println("Teploty uspesne odoslane");
    String url = "/vykurovanie-online/system/api/data.php?teplota1=" + teplota1 + "&teplota2=" + teplota2 + "&teplota3=" + teplota3 + "&teplota4=" + teplota4 + "&teplota5=" + teplota5 + "&teplota6=" + teplota6 + "&token=" + token + "&username=" + username;
    client.print(String("GET ") + url + " HTTP/1.1\r\n" + "Host: " + host + "\r\n" + "User-Agent: ESP32\r\n" + "Connection: close\r\n\r\n");
  } else {
    Serial.println("Nepodarilo sa odoslat teploty");
  }
  client.stop();
}

void stav_rele() {
  if (client.connect(host, 443)) {
    Serial.println("Pripojenie pre stav rele uspesne");
    String url = "/vykurovanie-online/system/api/stav.php?token=" + token + "&username=" + username;
    client.print(String("GET ") + url + " HTTP/1.0\r\n" + "Host: " + host + "\r\n" + "User-Agent: ESP32\r\n" + "Connection: close\r\n\r\n");
    while (client.connected()) {
      String hlavicka = client.readStringUntil('\n');
      Serial.println(hlavicka);
      if (hlavicka == "\r") {
        break;
      }
    }
    String premenna = client.readStringUntil('\n');
    Serial.println(premenna);
    if (premenna == "ZAP") {
      Serial.println("ZAPINAM RELE");
      digitalWrite(rele, LOW);
    } else if (premenna == "VYP") {
      Serial.println("VYPINAM RELE");
      digitalWrite(rele, HIGH);
    }
  } else {
    Serial.println("Nepodarilo sa nacitat stav rele");
  }
  client.stop();
}

void loop() {
  timerWrite(timer, 0);
  if (WiFi.status() == WL_CONNECTED) {
    pocitadlo = 0;
    Serial.println("Wifi je stale pripojene s IP: ");
    Serial.println(WiFi.localIP());
  } else if (WiFi.status() != WL_CONNECTED) {
    Serial.println("Spojenie stratene - Pripajanie k wifi...");
    WiFi.begin(ssid, pass);
  }
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
    pocitadlo++;
    if (pocitadlo >= 60) {
      ESP.restart();
    }
  }
  odosli_data();
  timerWrite(timer, 0);
  stav_rele();
  for (int i = 0; i &lt;= 60; i++) {
    delay(1000);
    timerWrite(timer, 0);
    Serial.println("Cakacia slucka");
 
</pre>   
<hr>
<h2><font color="#E67E22">Zdrojový kód pre ESP32 - WPA/WPA2 Enterprise</h2>
<li>Použitie na podnikových a univerzitných sieťach (eduroam a pod)</li>
<hr>
<pre style="background: #E67E22;">
#include &lt;WiFi.h&gt; //Wifi library
#include "esp_wpa2.h" //wpa2 library for connections to Enterprise networks

#define EAP_ANONYMOUS_IDENTITY "anonymous@example.com"
#define EAP_IDENTITY "id@example.com"
#define EAP_PASSWORD "mypass"

#include &lt;WiFiClientSecure.h&gt;
#include &lt;OneWire.h&gt;
#include &lt;DallasTemperature.h&gt;
#include "esp_system.h"
const int wdtTimeout = 40000;  //time in ms to trigger the watchdog
hw_timer_t *timer = NULL;
#define ONE_WIRE_BUS 23
OneWire oneWire(ONE_WIRE_BUS);
DallasTemperature sensors(&oneWire);
const char* ssid = "eduroam";
const char* host = "<?php echo $_SERVER['SERVER_NAME']; ?>";
int pocitadlo = 0;
const int rele = 18;
String token = "<?php echo $kodik;  ?>";
String username = "<?php echo $username;  ?>";
const char* test_root_ca = \
                           "-----BEGIN CERTIFICATE-----\n" \
                           "MIIEsTCCA5mgAwIBAgIQCKWiRs1LXIyD1wK0u6tTSTANBgkqhkiG9w0BAQsFADBh\n" \
                           "MQswCQYDVQQGEwJVUzEVMBMGA1UEChMMRGlnaUNlcnQgSW5jMRkwFwYDVQQLExB3\n" \
                           "d3cuZGlnaWNlcnQuY29tMSAwHgYDVQQDExdEaWdpQ2VydCBHbG9iYWwgUm9vdCBD\n" \
                           "QTAeFw0xNzExMDYxMjIzMzNaFw0yNzExMDYxMjIzMzNaMF4xCzAJBgNVBAYTAlVT\n" \
                           "MRUwEwYDVQQKEwxEaWdpQ2VydCBJbmMxGTAXBgNVBAsTEHd3dy5kaWdpY2VydC5j\n" \
                           "b20xHTAbBgNVBAMTFFJhcGlkU1NMIFJTQSBDQSAyMDE4MIIBIjANBgkqhkiG9w0B\n" \
                           "AQEFAAOCAQ8AMIIBCgKCAQEA5S2oihEo9nnpezoziDtx4WWLLCll/e0t1EYemE5n\n" \
                           "+MgP5viaHLy+VpHP+ndX5D18INIuuAV8wFq26KF5U0WNIZiQp6mLtIWjUeWDPA28\n" \
                           "OeyhTlj9TLk2beytbtFU6ypbpWUltmvY5V8ngspC7nFRNCjpfnDED2kRyJzO8yoK\n" \
                           "MFz4J4JE8N7NA1uJwUEFMUvHLs0scLoPZkKcewIRm1RV2AxmFQxJkdf7YN9Pckki\n" \
                           "f2Xgm3b48BZn0zf0qXsSeGu84ua9gwzjzI7tbTBjayTpT+/XpWuBVv6fvarI6bik\n" \
                           "KB859OSGQuw73XXgeuFwEPHTIRoUtkzu3/EQ+LtwznkkdQIDAQABo4IBZjCCAWIw\n" \
                           "HQYDVR0OBBYEFFPKF1n8a8ADIS8aruSqqByCVtp1MB8GA1UdIwQYMBaAFAPeUDVW\n" \
                           "0Uy7ZvCj4hsbw5eyPdFVMA4GA1UdDwEB/wQEAwIBhjAdBgNVHSUEFjAUBggrBgEF\n" \
                           "BQcDAQYIKwYBBQUHAwIwEgYDVR0TAQH/BAgwBgEB/wIBADA0BggrBgEFBQcBAQQo\n" \
                           "MCYwJAYIKwYBBQUHMAGGGGh0dHA6Ly9vY3NwLmRpZ2ljZXJ0LmNvbTBCBgNVHR8E\n" \
                           "OzA5MDegNaAzhjFodHRwOi8vY3JsMy5kaWdpY2VydC5jb20vRGlnaUNlcnRHbG9i\n" \
                           "YWxSb290Q0EuY3JsMGMGA1UdIARcMFowNwYJYIZIAYb9bAECMCowKAYIKwYBBQUH\n" \
                           "AgEWHGh0dHBzOi8vd3d3LmRpZ2ljZXJ0LmNvbS9DUFMwCwYJYIZIAYb9bAEBMAgG\n" \
                           "BmeBDAECATAIBgZngQwBAgIwDQYJKoZIhvcNAQELBQADggEBAH4jx/LKNW5ZklFc\n" \
                           "YWs8Ejbm0nyzKeZC2KOVYR7P8gevKyslWm4Xo4BSzKr235FsJ4aFt6yAiv1eY0tZ\n" \
                           "/ZN18bOGSGStoEc/JE4ocIzr8P5Mg11kRYHbmgYnr1Rxeki5mSeb39DGxTpJD4kG\n" \
                           "hs5lXNoo4conUiiJwKaqH7vh2baryd8pMISag83JUqyVGc2tWPpO0329/CWq2kry\n" \
                           "qv66OSMjwulUz0dXf4OHQasR7CNfIr+4KScc6ABlQ5RDF86PGeE6kdwSQkFiB/cQ\n" \
                           "ysNyq0jEDQTkfa2pjmuWtMCNbBnhFXBYejfubIhaUbEv2FOQB3dCav+FPg5eEveX\n" \
                           "TVyMnGo=\n" \
                           "-----END CERTIFICATE-----\n";
WiFiClientSecure client;

void IRAM_ATTR resetModule() {
  ets_printf("reboot\n");
  esp_restart();
}

void setup() {
  Serial.begin(115200);
  delay(10);
  timer = timerBegin(0, 80, true);                  //timer 0, div 80
  timerAttachInterrupt(timer, &resetModule, true);  //attach callback
  timerAlarmWrite(timer, wdtTimeout * 1000, false); //set time in us
  timerAlarmEnable(timer);                          //enable interrupt
  sensors.begin();
  pinMode(rele, OUTPUT);
  Serial.println();
  Serial.print("Pripajam sa na wifi siet: ");
  Serial.println(ssid);
  WiFi.disconnect(true);
  WiFi.mode(WIFI_STA);
  esp_wifi_sta_wpa2_ent_set_identity((uint8_t *)EAP_ANONYMOUS_IDENTITY, strlen(EAP_ANONYMOUS_IDENTITY));
  esp_wifi_sta_wpa2_ent_set_username((uint8_t *)EAP_IDENTITY, strlen(EAP_IDENTITY));
  esp_wifi_sta_wpa2_ent_set_password((uint8_t *)EAP_PASSWORD, strlen(EAP_PASSWORD));
  esp_wpa2_config_t config = WPA2_CONFIG_INIT_DEFAULT(); //set config settings to default
  esp_wifi_sta_wpa2_ent_enable(&config); //set config settings to enable function
  WiFi.begin(ssid);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
    pocitadlo++;
    if (pocitadlo >= 60) {
      ESP.restart();
    }
  }
  client.setCACert(test_root_ca);
  Serial.println("");
  Serial.println("WiFi pripojene");
  Serial.println("IP addresa nastavena: ");
  Serial.println(WiFi.localIP());
}

void odosli_data() {
  sensors.requestTemperatures();
  delay(2000); //cakanie na data z cidiel
  String teplota1 = String(sensors.getTempCByIndex(0));
  String teplota2 = String(sensors.getTempCByIndex(1));
  String teplota3 = String(sensors.getTempCByIndex(2));
  String teplota4 = String(sensors.getTempCByIndex(3));
  String teplota5 = String(sensors.getTempCByIndex(4));
  String teplota6 = String(sensors.getTempCByIndex(5));
  if (client.connect(host, 443)) {
    Serial.println("Teploty uspesne odoslane");
    String url = "/vykurovanie-online/system/api/data.php?teplota1=" + teplota1 + "&teplota2=" + teplota2 + "&teplota3=" + teplota3 + "&teplota4=" + teplota4 + "&teplota5=" + teplota5 + "&teplota6=" + teplota6 + "&token=" + token + "&username=" + username;
    client.print(String("GET ") + url + " HTTP/1.1\r\n" + "Host: " + host + "\r\n" + "User-Agent: ESP32\r\n" + "Connection: close\r\n\r\n");
  } else {
    Serial.println("Nepodarilo sa odoslat teploty");
  }
  client.stop();
}

void stav_rele() {
  if (client.connect(host, 443)) {
    Serial.println("Pripojenie pre stav rele uspesne");
    String url = "/vykurovanie-online/system/api/stav.php?token=" + token + "&username=" + username;
    client.print(String("GET ") + url + " HTTP/1.0\r\n" + "Host: " + host + "\r\n" + "User-Agent: ESP32\r\n" + "Connection: close\r\n\r\n");
    while (client.connected()) {
      String hlavicka = client.readStringUntil('\n');
      Serial.println(hlavicka);
      if (hlavicka == "\r") {
        break;
      }
    }
    String premenna = client.readStringUntil('\n');
    Serial.println(premenna);
    if (premenna == "ZAP") {
      Serial.println("ZAPINAM RELE");
      digitalWrite(rele, LOW);
    } else if (premenna == "VYP") {
      Serial.println("VYPINAM RELE");
      digitalWrite(rele, HIGH);
    }
  } else {
    Serial.println("Nepodarilo sa nacitat stav rele");
  }
  client.stop();
}

void loop() {
  timerWrite(timer, 0);
  if (WiFi.status() == WL_CONNECTED) {
    pocitadlo = 0;
    Serial.println("Wifi je stale pripojene s IP: ");
    Serial.println(WiFi.localIP());
  } else if (WiFi.status() != WL_CONNECTED) {
    Serial.println("Spojenie stratene - Pripajanie k wifi...");
    WiFi.begin(ssid);
  }
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
    pocitadlo++;
    if (pocitadlo >= 60) {
      ESP.restart();
    }
  }
  odosli_data();
  stav_rele();
  for (int i = 0; i &lt;= 60; i++) {
    delay(1000);
    timerWrite(timer, 0);
    Serial.println("Cakacia slucka");
  }
}

</pre>

<?php 
}
?>
	         
<hr>
<?php
 include("footer.php");
?>   </div>    
	
	<!-- END WRAPPER -->
	<!-- Javascript -->	
</html>
<?php }else{
	header("Location: ../index.php");	
} ?>