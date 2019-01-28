<?php

$DB_DSN = 'mysql:dbname=myDb;host=db';
$DB_USER = 'user';
$DB_PASSWORD = 'test';
$DB_OPTION = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

function Connexion_DB()
{
   global $DB_DSN, $DB_USER, $DB_PASSWORD, $DB_OPTION;
   try
   {
       $bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $DB_OPTION);
       echo "Connexion a la BD OK \r<br/>";
   }
   catch (PDOException $ex)
   {
       echo "EXCEPTION MSG: <br/>", $ex->getMessage(), "\r <br/>";
   }
   return $bdd;
}
?>
