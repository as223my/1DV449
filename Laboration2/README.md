#Laboration 2 - säkerhet & prestanda

##Säkerhetsproblem

###Lösenord sparas i klartext
Vad jag kan se i koden så hashas inte lösenorden alls. 
Detta är en mycket stor säkerhetsrisk då om någon obehörig skulle komma över lösenorden kan komma åt andra vanliga konton som personer brukar ha så som tex google och facebook.

Det är därför väldigt viktigt att som privat person aldrig använda samma lösenord på viktiga webbsidor. En lösenordshanterare kan med fördel användas för att hålla iordning på alla sina lösenord [1]. 

För att skydda lösenorden är det viktigt att lösenorden saltas och hashas innan det sparas i databasen. Ett lösenord som är hashat ska aldrig gå att få tillbaks till klartext igen efteråt [1]. 

###SQL injection

Applikationen är sårbar för sql injection attacker i login.js då variablerna username och password inte separeras från sql frågan. Vilket gör det möjligt att skicka in skadlig kod, tex kan det vara möjligt att komma åt innehåll från användarkonto genom att skicka in id parameter  ' or '1'='1 [2, s.7]. 

För att förhindra detta kan man tex använda sig av prepared statements [3]. 
Ett annat alternativ är att använda sig av ett säkert API [2, s.7], som hanterar inloggningen tex, google oauth.  

###XSS (Cross-Site Scripting) 

Applikationen är sårbar för xss attacker. Brist på validering av indata i MessageBoard.js gör att en hackare kan få en ett script på sidan som tex läser av användarens session cookie [2, s.9].
XSS attacker kan förebyggas med hjälp av ordentlig validering av indata, man ser till så att ingen html/javascript/css tags kan skickas med helt enkelt.

Man kan också ta hjälp av en så kallad “whitelist” där man listar alla godkända tecken som får skickas in i applikationen [2, s.9]. 

###CSRF (Cross-Site Request Forgery)

Applikationen verkar även vara sårbar för CSRF attacker. 
En CSRF attack tvingar en inloggad användares webbläsare att skicka förfalskade HTTP förfrågningar som innehåller användarens session cookie. 

Dessa förfrågningar tas då som helt legitima då man har tillgång till användarens sessions nyckel. 
Förfrågningarna görs ifrån en annan sida som innehåller scriptet. 
Sidan kan dock inte tolka svaren som skickas tillbaka, utan bara skicka förfalskade HTTP förfrågningar [4]. 
För att undvika CSRF attacker skicka med ett unikt token i ett gömt fält [2, s.14].  

###Åtkomst till /message

Även som utloggad ur applikationen kommer man åt /message. Man kan dock inte skriva några meddelande men har åtkomst till innehållet. Detta leder till att vem som helst har tillgång till de skrivna meddelandena och dessa inte alls är något privat mellan de inloggade användarna. För att åtgärda detta krävs “authorization” kontroll av sidans användare, så att de som inte ska ha tillträde till konversationen utestängs [2, s.13]. 

##Prestandaproblem

###Placering av javascript i koden

I applikationen så laddas många av scripten in i headern.
Detta medför att allt innehåll som befinner sig under scriptet på webbsidan inte kommer att laddas innan det aktuella scriptet är färdigläst [5, s.49].  

För att undvika detta så är det därför viktigt att placera scripten i botten av koden för att slippa att få blanka, eller delvis blanka sidor innan de aktuella scripten laddats klart [5, s.50].

###Inline kod

Det finns fördelar med att placera javascript och css inline i koden, då sidan går snabbare att ladda på grund av att mindre http förfrågningar krävs [5, s.55]. 
Men i verkligheten leder ofta denna placering av kod till motsatsen, dvs långsammare webbsidor. Det är därför bättre att placera javascript och css koden i externa filer då dessa cachas av webbläsaren [5, s.56]. 

###Förminskning av javascript och css filer 

För att öka prestandan för applikationen så kan javascript och css filerna förminskas (minifying). När man förminskar en javascript fil så tas alla kommentarer och onödiga blanksteg bort. Detta leder till att filens storlek blir mindre och går snabbare att läsa in i koden [5, s.69]. 

Det är ofta inte lika viktigt för prestandan att förminska css filerna som javascript filerna. Detta beror på att css koden generellt brukar innehålla färre kommentarer och blanksteg än javascript koden. Det man kan tänka på med css koden är att använda så få tecken så möjligt, tex istället för att skriva “0px” så kan man bara skriva “0” då detta tolkas på samma sätt [5, s.75]. 

###Användning av CDN (Content Delivery Network)

För att förbättra prestandan kan man använda CDN stöd för bootstrap i applikationen. 
CDN är en samling av webbservrar placerade på flera olika platser vilket gör att innehållet snabbare kan levereras till klienten, då den server med snabbast svarstid kan användas [5, s.19]. 

###Cache (Expiration header) 

I applikationen är expiration header satt till -1. Detta gör att inget innehåll cachas, utan varje gång webbsidan laddas om hämtas alla komponenter på nytt, vilket medför att prestandan blir sämre. 

Istället för att använda sig av expiration header som går efter ett specifikt datum, kan man i stället använda sig av av något som heter cache-control. I cache-controllen anger man istället en max-age som bestämmer hur länge komponenter ska cachas [5, s.22-23].   
						
##Reflektion

Denna laboration var väldigt nyttig för mig att genomföra, även om jag har fått kämpa då jag tyckte det var väldigt klurigt att veta vart jag skulle börja nysta i koden/applikationen och litteraturen. Jag har verkligen fått upp ögonen för hur lätt det är att missa viktiga detaljer som har med säkerheten i webbapplikationer att göra. 
Då jag aldrig förut har kikat på en node.js applikation var detta också nytt och lite förvirrande men jag hoppas att jag inte har missat allt för mycket i min observation gällande prestanda och säkerhet.

Övriga tankar om själva applikationen är att man kanske kunde slå ihop lite css och javascript filer då det i nuläget blir ganska många http förfrågningar. 
Jag var lite osäker på om jag skulle skriva med https i säkerhetsproblem i denna applikation. 
Man vill ha https för att inte all information mellan klient och server ska skickas okrypterad.

##Referenser

[1] John Häggerud, "Peer instruction 3" Linnéuniversitetet, November 2015 [Online] Tillgänglig:https://coursepress.lnu.se/kurs/webbteknik-ii/peer-instruction-3/ [Hämtad: 22 december, 2015]

[2] "The Ten Most Critical Web Application Security Risks" Open Web Application Security Project, Juni 2013 [Online] Tillgänglig: https://www.owasp.org/index.php/Top10#OWASP_Top_10_for_2013 [Hämtad: 22 december, 2015]

[3] "SQL Injection Prevention Cheat Sheet" Open Web Application Security Project, November 2015 [Online] Tillgänglig: https://www.owasp.org/index.php/SQL_Injection_Prevention_Cheat_Sheet  [Hämtad: 22 december, 2015]

[4] Johan Leitet, "Webbteknik 2 - HT - 13 - Webbsäkerhet" Linnéuniversitetet, November 2013 [Online] Tillgänglig:https://www.youtube.com/watch?v=Gc_pc9TMEIk  [Hämtad: 23 december, 2015]

[5] S. Sounders, High Performance Web Sites. O’Reilly Media, 2007. [PDF]   

###Av: Annie Sahlberg, as223my. 
