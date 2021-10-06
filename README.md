# bankjesServer

Een project om vanuit de BankjesServer met alleen een API interface ook een Vue applicatie toe te voegen die hetzelfde is als de Wandelbankjes-app.

## 5-9-2021
- Vanuit Github bankjesServer gedownload
- Aangevuld met Laravel 
- Aangevuld met Vue3
- Mitt en Leaflet toegevoegd
## 6-9-2021
- Kaart is zichtbaar
- Markers worden goed geplaatst
- Kaart wordt ververst bij scroll en pan

## 8-9-2021
- Menu werkt
- Font awesome is werkend

## 9-9-2021
- I-modal werkt
- menuknoppen hebben hoover-effect

## 10-9-2021
- addBankje en deleteBankje werken
- in MapApp een constante toegevoegd voor de API Base URL
  
## 11-9-2021
- Flash messages van add en delete menus ondergebracht in aparte component Flash.vue

## Versie 1.0.0
Project op nieuwe branch "withVue" gezet van "bankjesServer"

## Versie 1.1.0
- Hele project 1 niveau naar boven gebracht naar evenuitrusten.nl
- symbolic link van public_html naar public

## Versie 1.1.1
- Link toegevoegd aan maps.blade.php met icon voor Apple homescreen
- meta-tags toegevoegd
- user location een pulsating dot gemaakt
- bug in delete bankje gefixed. Als er nu meer dan 1 bankje in zoekgebied zitten wordt de eerste gedelete. Voorheen werd niets gedelete.

## 3-10-2021
- Modal is nu scrollable op mobile (door height toe te voegen aan modal container)

## 5-10-2021
- Locatie user beweegt mee. Icon wordt alleen hertekent als de verplaatsing boven een bepaalde grens ligt


## 6-10-2021
- z-value van de pulsating dot verhoogd
- threshold voor hertekening omlaag gebracht van 30 naar 10 meter
- kleur van picnicbankjes meer onderscheidend gemaakt

