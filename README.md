# Multiuser webová aplikácia pre riadenie vykurovania
**Podporovaný otvorený hardvér**
* Arduino + Ethernet W5100 - HTTP protokol
* Arduino + Ethernet W5500 - HTTP protokol
* ESP8266 (NodeMCU, Wemos D1 Mini) - HTTPS protokol
* ESP32 - HTTPS protokol
* - všetky platformy využívajú 6 teplotných senzorov Dallas DS18B20 na OneWire zbernici
#
**Webaplikácia umožňuje**
* Registráciu a prihlásenie používateľov so zvolením riadiaceho mikrokontroléru
* Prehľad 6 teplôt v reálnom čase (každý používateľ vidí iba svoje dáta)
* Historicky prehľad posledných 1000 nahratých záznamov
* Grafická reprezentácia záznamov za 24 hodín
* **Automatický režim** Spustenie termostatu s voliteľnou hysterézou 0-5°C s 0.25°C krokom, referenčnou teplotou 5-30°C
* **Manuálny režim** Spustenie výstupu na neobmedzenú dobu (používateľ upovedomený na webe)
