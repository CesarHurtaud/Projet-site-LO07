<?php
/**
 * Created by PhpStorm.
 * User: ganstrich
 * Date: 05/06/17
 * Time: 16:40
 */
/* Using mysqli
define('DB_USER', 'root');
define('DB_PASSWORD', 'Poulet1995');
define('DB_HOST', 'localhost');
define('DB_NAME', 'Projet');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully"; */

$dsn = 'mysql:dbname=Projet;host=localhost';
define('DB_USER', 'root');
define('DB_PASSWORD', 'Poulet1995');

try{
    $conn = new PDO($dsn, DB_USER, DB_PASSWORD);
} catch(PDOException $e){
    echo'Connexion echouée : '.$e->getMessage();
}

?>