#Prestandaproblem

##Placering av javascript i koden
I applikationen så laddas många av scripten in i headern.
Detta medför att allt innehåll som befinner sig under scriptet på webbsidan inte kommer att laddas innan det aktuella scriptet är färdigläst [1, s.49].  
För att undvika detta så är det därför viktigt att placera scripten i botten av koden för att slippa att få blanka, eller delvis blanka sidor innan de aktuella scripten laddats klart [1, s.50].

##Inline kod
Det finns fördelar med att placera javascript och css inline i koden, då sidan går snabbare att ladda på grund av att mindre http förfrågningar krävs [1, s.55]. 

Men i verkligheten leder ofta denna placering av kod till motsatsen, dvs långsammare webbsidor. Det är därför bättre att placera javascript och css koden i externa filer då dessa cachas av webbläsaren [1, s.56]. 

##Förminskning av javascript och css filer 
För att öka prestandan för applikationen så kan javascript och css filerna förminskas (minifying). När man förminskar en javascript fil så tas alla kommentarer och onödiga blanksteg bort. Detta leder till att filens storlek blir mindre och går snabbare att läsa in i koden [1, s.69]. 

Det är ofta inte lika viktigt för prestandan att förminska css filerna som javascript filerna. Detta beror på att css koden generellt brukar innehålla färre kommentarer och blanksteg än javascript koden. Det man kan tänka på med css koden är att använda så få tecken så möjligt, tex istället för att skriva “0px” så kan man bara skriva “0” då detta tolkas på samma sätt [1, s.75]. 

##Användning av CDN (Content Delivery Network)
För att förbättra prestandan kan man använda CDN stöd för bootstrap i applikationen. 

CDN är en samling av webbservrar placerade på flera olika platser vilket gör att innehållet snabbare kan levereras till klienten, då den server med snabbast svarstid kan användas [1, s.19]. 

##Cache (Expiration header) 
I applikationen är expiration header satt till -1. Detta gör att inget innehåll cachas, utan varje gång webbsidan laddas om hämtas alla komponenter på nytt, vilket medför att prestandan blir sämre. 

Istället för att använda sig av expiration header som går efter ett specifikt datum, kan man i stället använda sig av av något som heter cache-control. I cache-controllen anger man istället en max-age som bestämmer hur länge komponenter ska cachas [1, s.22-23].    
