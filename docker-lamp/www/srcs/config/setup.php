<?php
include "database.php";

$bdd = Connexion_DB();

$base = $bdd->prepare("CREATE DATABASE IF NOT EXISTS camagru_db CHARACTER SET  'utf8' COLLATE = utf8_general_ci");
$base->execute();

$table = "CREATE TABLE IF NOT EXISTS membres (
    id TINYINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(30) NOT NULL,
    prenom VARCHAR(30) NOT NULL,
    pseudo VARCHAR(30) NOT NULL,
    mail VARCHAR(255) NOT NULL,
    motdepasse VARCHAR(255) NOT NULL,
    confirmkey VARCHAR (255) NOT NULL,
    confirme BOOLEAN DEFAULT '1')
    ENGINE=INNODB ";
$table = $bdd->prepare($table);
$table->execute();
?>