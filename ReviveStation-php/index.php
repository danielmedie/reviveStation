<?php

// Ladda in klasserna
require_once 'Seller.php';
require_once 'Item.php';

// Skapa en ny säljare
$seller = new Seller();
$seller->setName("Daniel Grek");
$seller->create();

// Hämta en säljare baserat på ID
$seller = new Seller();
$seller->setId(1);
$seller->read();
echo $seller->getName();

// Uppdatera en säljares information
$seller = new Seller();
$seller->setId(1);
$seller->read();
$seller->setName("Daniel Ek");
$seller->update();

// Ta bort en säljare
$seller = new Seller();
$seller->setId(1);
$seller->delete();

// Skapa en ny vara
$item = new Item();
$item->setName("T-shirt");
$item->create();

// Hämta en vara baserat på ID
$item = new Item();
$item->setId(1);
$item->read();
echo $item->getName();

// Uppdatera en varas information
$item = new Item();
$item->setId(1);
$item->read();
$item->setName("Jeans");
$item->update();

// Ta bort en vara
$item = new Item();
$item->setId(1);
$item->delete();

?>
