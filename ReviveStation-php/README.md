REVIVESTATION

ReviveStation är en webbapplikation för hantering av säljare och produkter.

Detta är en uppgift jag fick i att bygga en första prototyp av en secondhandbutik där man lämnar in ett plagg som butiken sen säljer vidare. här är det case jag fick "En secondhandbutik NAMN behöver en webbtjänst för att hålla koll på sina plagg och vem som lämnat in dem. Detta är en sådan butik där en person (vi kallar dem säljare) kan lämna in kläder och butiken säljer dem, tar en viss del av försäljningen och en viss del går tillbaka till den som lämnar in kläderna (säljaren)."

Funktioner

Lägg till säljare: Lägg till nya säljare i systemet. Visa säljarlista: Visa en lista över alla säljare. Visa säljarinformation: Visa detaljerad information om en specifik säljare. Lägg till produkt: Lägg till nya produkter för varje säljare.

Installation

Följ stegen nedan för att installera och konfigurera ReviveStation:

Klona projektet från GitHub-repositoriet: git clone https://github.com/din-anvandarnamn/revivestation.git. Navigera till projektmappen: cd revivestation. Skapa en databas med namnet revivestation i MySQL. Importera databasstrukturen från filen database.sql. Konfigurera databasanslutningsinställningarna i filen partials/connect.php. Starta en webbserver och öppna applikationen i webbläsaren.

Användning

Följ stegen nedan för att använda ReviveStation:

Lägg till säljare: Gå till "Lägg till säljare"-sidan och fyll i namnet på den nya säljaren.
Klicka på "Lägg till" för att spara säljaren i systemet. 
Visa säljarlista: Gå till "Säljarlista"-sidan för att visa en lista över alla tillgängliga säljare. 
Visa säljarinformation: Klicka på "Info" bredvid en säljares namn i säljarlistan för att visa detaljerad information om säljaren, inklusive antal mottagna produkter, antal sålda produkter och total försäljningssumma. 
Lägg till produkt: Gå till "Lägg till produkt"-sidan och fyll i formuläret med produktens namn, säljare och pris. Klicka på "Lägg till" för att spara produkten för den valda säljaren.