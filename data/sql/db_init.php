<?php

include("../classes/etudiant.php");
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

$insertEtuRequest = $conn->prepare("INSERT INTO etudiant VALUES (:nom, :prenom, :numero,
                                                                       :filiere, :admission)");
$selectEtuRequestByNumero = $conn->prepare("SELECT * FROM `etudiant` WHERE numero=?");
$selectEtuRequest = $conn->prepare("SELECT * FROM `etudiant`");
function insertEtu(etudiant $etu)
{
    /*$nomNewEtu = $etu->getNom();
    $prenomNewEtu = $etu->getPrenom();
    $numeroNewEtu = $etu->getNumero();
    $filiereNewEtu = $etu->getFiliere();
    $admissionNewEtu = $etu->getAdmission();*/
    global $insertEtuRequest;
    $insertEtuRequest->bindParam(':nom', $etu->getNom());
    $insertEtuRequest->bindParam(':prenom', $etu->getPrenom());
    $insertEtuRequest->bindParam(':numero', $etu->getNumero());
    $insertEtuRequest->bindParam(':filiere', $etu->getFiliere());
    $insertEtuRequest->bindParam(':admission', $etu->getAdmission());

    $insertEtuRequest->execute();
}
//TODO TEST this !!
function getEtuByNumero($numero){
    global $selectEtuRequestByNumero;
    $selectEtuRequestByNumero->execute(array($numero));
    $fetched = $selectEtuRequestByNumero->fetch(PDO::FETCH_ASSOC);
    $result = new etudiant($fetched['numero'], $fetched['nom'], $fetched['prenom'], $fetched['admission'],
        $fetched['filiere']);
    return $result;
}

function getEtudiants(){
    global $selectEtuRequest;
    $selectEtuRequest->execute();
    $result = $selectEtuRequest->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}


?>