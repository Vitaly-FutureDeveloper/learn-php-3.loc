<meta http-equiv="refresh" content="3">
<?php

interface ISuperUser {
    function getInfo();
}

function __autoload ($name) {
    require "classes/$name.class.php";
}


$user1 = new User("vint", "drezak", "12345");
$user2 = new User("v", "drek", "12345");
$user3 = new User("asd", "tgregrg", "12345");

$user1->showInfo();
$user2->showInfo();
$user3->showInfo();

$user1->userCounter ();


$Suser1 = new SuperUser("Voron", "Drezerak", "12345", "admin");
$Suser2 = new SuperUser(str_shuffle("Voron"), str_shuffle("Drezerak"), "12345", "moder");
$Suser1->showInfo();
$Suser1->getInfo();
$Suser2->showInfo();
$Suser2->getInfo();

$Suser2->userCounter ();

echo get_class($Suser1);