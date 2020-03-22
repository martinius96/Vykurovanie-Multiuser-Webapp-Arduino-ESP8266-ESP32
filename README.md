# Multiuser webová aplikácia pre riadenie vykurovania
* Webaplikácia je voľne dostupná, okresaná - free verzia plného projektu Vykurovania Multiuser webovej aplikácie
#
**Podpora projektu:**
* https://www.paypal.me/chlebovec
#
**Podporovaný otvorený hardvér**
* **Arduino + Ethernet W5100** - **HTTP** protokol
* **Arduino + Ethernet W5500** - **HTTP** protokol
* **ESP8266** (NodeMCU, Wemos D1 Mini) - **HTTPS** protokol
* **ESP32** (DevKit) - **HTTPS protokol**
* - všetky platformy využívajú 6 teplotných senzorov Dallas DS18B20 na jednej OneWire zbernici
#
**Webaplikácia umožňuje**
* Registráciu a prihlásenie používateľov so zvolením riadiaceho mikrokontroléru
* Každému používateľovi je priradený token (Api kľúč), ktorým mikrokontróler zapisuje a číta z webového portálu
* Prehľad 6 teplôt v reálnom čase (každý používateľ vidí iba svoje dáta)
* Historicky prehľad posledných 1000 nahratých záznamov
* Grafická reprezentácia záznamov za 24 hodín
* **Automatický režim** Spustenie termostatu s voliteľnou hysterézou 0-5°C s 0.25°C krokom, referenčnou teplotou 5-30°C
* **Manuálny režim** Spustenie výstupu na neobmedzenú dobu (používateľ upovedomený na webe)
* **Výstup je možné využiť pre kontakt na relé kotla, solenoidu radiátora**
* Prehľad profilu, nastavenie riadiaceho teplomera pre termostat, modifikácia názvov teplomerov/miestností, možnosť zvoliť iný mikrokontróler
* Chat webaplikácia pre komunikáciu medzi celou komunitou v reálnom čase
* Prehľad zdrojových kódov, možnosť stiahnuť knižnice pre prostredie Arduino IDE

# Webserver - NUTNÉ VEDIEŤ
* Webaplikácia používala webserver, ktorý umožňuje pristupovať po HTTP a HTTPS protokole
* pre HTTP používal prefix www
* pre HTTPS nepoužíval prefix
* Vo výsledku existuje pre webserver adresa www.host.sk pre port 80 (HTTP) a host.sk pre port 443 (HTTPS) --> **počíta s tým aj generátor zdrojových kódov projektu**
* Generátor zdrojových kódov počíta s umiestnením projektu do priečinka vykurovanie_online vzhľadom na root priečinok.
* **Projekt sa musí nachádzať v: host.sk/vykurovanie_online**
* Zdrojový kód pre ESP8266 využíva HTTPS fingerprint zo stránky php5.sk, ESP32 využíva Root CA certifikát pre CA stránky php5.sk

# Povinosti prevádzkovateľa projektu
* **Stiahnutím a využívaním projektu sa prevádzkovateľ zaväzuje k dodržiavaniu MIT licencie.**
* **Autor projektu si vyhradzuje právo k ponechaniu lišty v spodnej časti stránky**
* **Prevádzkovateľ si uvedomuje právne riziká spojené s porušením licencie projektu**

# Inštalácia projektu
* Priečinok **vykurovanie_online** nakopírujeme do root priečinka webservera
* Otvoríme súbor connect.php v priečinku vykurovanie_online/system nastavíme údaje do MySQL databázy
* zo zložky sql importujeme .sql súbor --> štruktúru tabuliek do MySQL databázy
* projekt je pripravený pre použitie
* **kompatibilné pre PHP 5.6 a 7.1**

# Platená verzia projektu
**Ponúka:**
* Možnosť modifikovať počet OneWire zberníc, možnosť využitia iných teplotných senzorov (napr. PT100)
* POST metóda predávania dát webserveru
* API pre JSON výstup pre mikrokontróler (interakcia do ďalších systémov)
* Dynamická zmena zdrojových kódov na základe vyklikaných požiadaviek
* Multijazyková podpora (Slovenčina, Čeština, Angličtina, Nemčina, Ruština)
* Možnosť prezerať všetky namerané dáta
* Možnosť limitovať zápis používateľa, intenzitu zápisov
* Grafická reprezentácia za 24 hodín, 7 dní, 30 dní
* Archivovať dáta po neobmedzenú dobu pre každého používateľa
* Admin nástroje pre možnosť zablokovania používateľa, mazanie chatu, pridávanie oznamov na stránku
* Chat pre každú národnosť (jazykovú) zvlášť
* Možnosť nutnosti overiť e-mailom registráciu, v opačnom prípade sa používateľ nepripojí
* Možnosť zmeniť prihlasovacie údaje
* Možnosť termostatu v dňoch, časoch, časové riadenie
* Štatistické nástroje, výpisy, exporty do .xls, .xml, .csv
* Emotikony v chate, ovládanie hlasom v slovenčine a ďalších jazykoch
* Podpora
* Pri záujme: martinius96@gmail.com

# Screenshoty
![Prehľad teplôt v reálnom čase zo senzorov DS18B20](https://i.imgur.com/ABBGfCK.png)
![Informácie o režime vykurovania - kotla](https://i.imgur.com/HOFA4sy.png)
![Nastavenie termostatu](https://i.imgur.com/T2jjkw2.png)
![Nastavenie názvov miestností - teplomerov](https://i.imgur.com/jZKUvUX.png)
![Zdrojový kód pre ESP8266 (Arduino) a schéma zapojenia](https://i.imgur.com/jIPyRL6.png)
