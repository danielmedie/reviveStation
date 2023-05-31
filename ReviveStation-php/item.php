<?php


class Item {
    private $id;
    private $name;
    // andra attribut och konstruktor
  
    // Getter och setter-metoder
  
    // CRUD-operationer
    public function create() {
        // Anslut till databasen
        $pdo = new PDO("mysql:host=localhost;dbname=ReviveStation", "root", "abc123");

        // Förbered SQL-frågan för att infoga en ny produkt
        $statement = $pdo->prepare("INSERT INTO items (name) VALUES (:name)");

        // Sätt värden för parametrarna i SQL-frågan
        $statement->bindParam(":name", $this->name);

        // Utför SQL-frågan
        $statement->execute();
    }
  
    public function read() {
      // Kod för att hämta en vara från databasen baserat på ID
    }
  
    public function update() {
      // Kod för att uppdatera en varas information i databasen
    }
  
    public function delete() {
      // Kod för att ta bort en vara från databasen baserat på ID
    }
  }