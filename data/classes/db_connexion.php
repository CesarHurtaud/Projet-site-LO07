<?php

$dsn = 'mysql:dbname=projet_lo07;host=localhost';
define('DB_USER', 'root');
define('DB_PASSWORD', '');
try{
    $conn = new PDO($dsn, DB_USER, DB_PASSWORD);
} catch(PDOException $e){
    echo'Connexion echouée : '.$e->getMessage();
}


?>