<?php

include_once("../db.inc.php");

$db = new PDO($db_name, $user, $pass);

$_GET['searchText'] .= '%';

$sql = $db->prepare("SELECT nom FROM pokedex WHERE nom LIKE ?");

$sql->execute([$_GET['searchText']]);

foreach ($sql as $ligne){
    echo $ligne['nom'];
}