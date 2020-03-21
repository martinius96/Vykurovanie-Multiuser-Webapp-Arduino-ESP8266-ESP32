# Multiuser webová aplikácia pre riadenie vykurovania
**Podpora projektu:**
* https://www.paypal.me/chlebovec
**Podporovaný otvorený hardvér**
* **Arduino + Ethernet W5100** - **HTTP** protokol
* **Arduino + Ethernet W5500** - **HTTP** protokol
* **ESP8266** (NodeMCU, Wemos D1 Mini) - **HTTPS** protokol
* **ESP32** (DevKit) - **HTTPS protokol**
* - všetky platformy využívajú 6 teplotných senzorov Dallas DS18B20 na jednej OneWire zbernici
#
**Webaplikácia umožňuje**
* Registráciu a prihlásenie používateľov so zvolením riadiaceho mikrokontroléru
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

# Povinosti prevádzkovateľa projektu
* Stiahnutím a využívaním projektu sa prevádzkovateľ zaväzuje k dodržiavaniu MIT licencie. 
* Autor projektu si vyhradzuje právo k ponechaniu lišty v spodnej časti stránky
* Prevádzkovateľ si uvedomuje právne riziká spojené s porušením licencie projektu

# Inštalácia projektu
* Priečinok **vykurovanie_online** nakopírujeme do root priečinka webservera
* Otvoríme súbor connect.php v priečinku vykurovanie_online/system nastavíme údaje do MySQL databázy
* zo zložky sql importujeme .sql súbor --> štruktúru tabuliek do MySQL databázy
* projekt je pripravený pre použitie

# Platená verzia projektu
**Ponúka:**
* Možnosť modifikovať počet OneWire zberníc, možnosť využitia iných teplotných senzorov
* Multijazyková podpora (Slovenčina, Čeština, Angličtina, Nemčina, Ruština)
* Možnosť prezerať všetky namerané dáta
* Grafická reprezentácia za 24 hodín, 7 dní, 30 dní
* Archivovať dáta po neobmedzenú dobu pre každého používateľa
* Admin nástroje pre možnosť zablokovania používateľa, mazanie chatu, pridávanie oznamov na stránku
* Chat pre každú národnosť (jazykovú) zvlášť
* Možnosť nutnosti overiť e-mailom registráciu, v opačnom prípade sa používateľ nepripojí
* Možnosť zmeniť prihlasovacie údaje
* Možnosť termostatu v dňoch, časoch, časové riadenie
* Štatistické nástroje, výpisy, exporty do .xls, .xml, .csv
* Pri záujme: martinius96@gmail.com
