- Laravel version: 11
- Php version: 8.4

# how to setup
- git clone git@github.com:AttilaSzendi/flexinform.git
- cp .env.example .env
- composer install
- sail up (or you can you homestead, or anything you want as local development environment)
- sail npm install
- sail npm run dev
- enjoy

Volt a feladatleírásban néhány furcsaság. Például a cars táblában a car_id. 
Azt kihagytam mert nem tudtam hova tenni. Nekem a szűrés is furcsa így, hogy csak 1 darabot adhat vissza.
Eredetileg Client index action volt a megvalósítás, de végül mivel 1db client van, így módosítottam
client show action-re. Több mező nevével sem voltam kibékülve pl. registered. Tipikus hiba
ugyanis ez így inkább bool mező, meg ha már a created_at és deleted_at gyári mezőket látjuk, akkor
a konzisztnia azt mondja, hogy legyen registered_at. A legfurcsább azonban a services táblában
a client_id. Miért nem elég a car_id? Az már hordozza magával a client_id-t. A log_number mező elnevezése is szörnyű,
ráadásul redundáns. A created_at alapján sorrendbe lehet tenni a service-eket.

Mindenesetre igyekeztem tiszta maradni, külön szervízosztályokat nem használtam, annyira
rövid a két controller így is. Teszteket pedig a Test mappában találjátok.
