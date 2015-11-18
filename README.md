#Laboration 1 - Reflektion

[Webbskrapa](http://anniesahlberg.se/Laboration1/)

###Finns det några etiska aspekter vid webbskrapning. Kan du hitta något rättsfall?
Kolla alltid i terms of use innan du skrapar från en sida! Om informationen inte står där fråga ägaren till sidan om det är okej att skrapa. Tänk på att servern kan segas ner hos ägaren om för mkt skrapning sker från olika håll (oändliga while loopar etc).

Ett av de första stora rättsfallen (2003) som involverar webb skrapning var American airlines som stämde företaget FareChase.
FareChase använde sig av American Airlines webbsida för att skrapa information om dess priser för att använda vidare i sin tjänst som de sedan sålde för att jämföra olika priser på flygningar. FareChase överklagade domen (beslutet) och de båda företagen gjorde upp, och överklagningen lades därefter ner.

Facebook vann även 2009 ett rättsfall om upphovsrätt mot en känd webb skrapa, Power.com.

Närmare i tiden så stämde qvc (tv-nätverk), resultly som var en nystartad shopping app för överdrivet skrapande.
Resultly hade även gjort det svårt att blocka deras webbskrapor vilket resulterade i att qvcs servrar blev överbelastade.
Rätten dömde dock att qvcs motiv inte var att göra uppsiktlig skada. 

###Finns det några riktlinjer för utvecklare att tänka på om man vill vara "en god skrapare" mot serverägarna?

Att identifiera sig vid skrapningen, så att serverägaren kan kommma i kontakt eller blocka skrapningen om detta skulle behövas. Att inte skrapa mer än nödvändigt dvs mer än en gång per sida. 
Givetvis ska man även kolla upp om det är okej att skrapa från webbsidan eller inte innan (terms of use, robots.txt etc). 

###Begränsningar i din lösning- vad är generellt och vad är inte generellt i din kod?

Jag har försökt att skriva min kod så generellt som möjligt. Start adressen är inte på något sätt statisk utan den läses av när den skickats in. Jag har också gjort så att min kod klarar av om det är mer än en dag som alla personer är lediga på eller om det inte finns någon alls. 
Detta tog en stund att lista ut hur jag skulle ändra i min kod, då jag från början bara hade räknat med att det fanns en dag som passade alla. Det går också lätt att byta ut både dagar och filmernas namn i koden.

Dock så är min lösning beroende av att antal filmer, personer och olika tider på filmerna är tre stycken. 
Så om detta skulle ändras behöver även koden uppdateras. Detta gäller även om länkarnas påbyggnads adress skulle ändras.


###Vad kan robots.txt spela för roll?

I robots.txt talar du om för sökrobotar som besöker din sida, vart de är välkommna eller inte.
Om du inte har en robots.txt fil tillgänglig är risken stor att det då anses som rätt fram att skrapa allt. 

