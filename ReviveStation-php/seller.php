<?php

class Seller {
  private $id;
  private $name;

  public function __construct($id = null, $name = null) {
    $this->id = $id;
    $this->name = $name;
  }

  // Getter och setter-metoder

  public function getId() {
    return $this->id;
  }

  public function getName() {
    return $this->name;
  }

  public function setName($name) {
    $this->name = $name;
  }

  public function setId($id) {
    $this->id = $id;
  }

  // CRUD-operationer
  public function create() {
    // Kod för att skapa en ny säljare i databasen
  }

  public function read() {
    // Kod för att hämta en säljare från databasen baserat på ID
  }

  public function update() {
    // Kod för att uppdatera en säljares information i databasen
  }

  public function delete() {
    // Kod för att ta bort en säljare från databasen baserat på ID
  }
}
