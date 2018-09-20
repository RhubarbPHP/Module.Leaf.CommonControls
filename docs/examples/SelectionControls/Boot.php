<?php

use Rhubarb\Leaf\Controls\Common\Examples\SelectionControls\ExampleContact;

include_once __DIR__.'/ExampleContact.php';

function makeContact($firstName, $surname, $city){
    $contact = new ExampleContact();
    $contact->FirstName = $firstName;
    $contact->Surname = $surname;
    $contact->city = $city;
    $contact->save();
}

makeContact("John", "Smith", "Berlin");
makeContact("Ahmed", "Tamsen", "Paris");
makeContact("Jules", "Verne", "London");
makeContact("Jenny", "Bristow", "Belfast");
makeContact("Richard", "King", "Bristol");
makeContact("Norma", "Williams", "New York");