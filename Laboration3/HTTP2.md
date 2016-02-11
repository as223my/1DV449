#HTTP/2
För att förhindra att det blir blockeringar när “för många” http förfrågningar görs började man arbeta fram det som nu kallas HTTP/2. 
HTTP/2 stödjer fortfarande samma metoder, headers, statuskoder etc som HTTP 1.1 vilket gör att applikationer med HTTP 1.1 fortfarande kommer fungera som vanligt. 
Det som bland annat gör att HTTP/2 blir snabbare att använda är att det inte blir någon blockering av för många förfrågningar detta tack vare att transporten mellan klient och server delas upp i små namngivna delar, så kallade frames som sedan sätts ihop igen vid ankomst. Detta kallas multiplexing, andra fördelar är också att headers kan komprimeras och att filer kan skickas till webbläsaren innan en förfrågan skickas. 
