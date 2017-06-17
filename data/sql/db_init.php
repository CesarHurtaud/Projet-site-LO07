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
$getCursusRequest = $conn->prepare("SELECT c.* FROM cursus c WHERE c.numeroEtu=?");
$getElementsCursusRequest = $conn->prepare("SELECT el.* FROM elementCursus el WHERE el.idCursus=?");
function insertEtu(etudiant $etu)
{
    global $insertEtuRequest;
    $insertEtuRequest->bindParam(':nom', $etu->getNom());
    $insertEtuRequest->bindParam(':prenom', $etu->getPrenom());
    $insertEtuRequest->bindParam(':numero', $etu->getNumero());
    $insertEtuRequest->bindParam(':filiere', $etu->getFiliere());
    $insertEtuRequest->bindParam(':admission', $etu->getAdmission());

    $insertEtuRequest->execute();
}

function getEtuByNumero($numero){
    global $selectEtuRequestByNumero;
    $selectEtuRequestByNumero->execute(array($numero));
    $fetched = $selectEtuRequestByNumero->fetch(PDO::FETCH_ASSOC);
    $result = new etudiant($fetched['numero'], $fetched['nom'], $fetched['prenom'], $fetched['admission'],
        $fetched['filiere']);
    return $result;
}

function getEtuByObject(etudiant $etu)
{
    global $selectEtuRequestByNumero;
    $selectEtuRequestByNumero->execute(array($etu->getNumero()));
    $fetched = $selectEtuRequestByNumero->fetch(PDO::FETCH_ASSOC);
    $result = new etudiant($fetched['numero'], $fetched['nom'], $fetched['prenom'], $fetched['admission'],
        $fetched['filiere']);
    return $result;

}

function getEtudiants(){
    global $selectEtuRequest;
    $selectEtuRequest->execute();
    $result = $selectEtuRequest->fetchAll(PDO::FETCH_ASSOC);
    $etudiants = array();
    foreach ($result as $etu) {
        array_push($etudiants, new etudiant($etu['numero'], $etu['nom'], $etu['prenom'], $etu['admission'], $etu['filiere']));
    }
    return $etudiants;
}


/*

function getCursusFromDb(etudiant $etu){
    global $getCursusRequest;
    $getCursusRequest->execute(array($etu->getNumero()));
    $fetched = $getCursusRequest->fetch(PDO::FETCH_ASSOC);
    var_dump($fetched);
    //TODO : Test et retourner objet cursus
}

function getElementsCursusFromDb(cursus $cursus){
    global $getElementsCursusRequest;
    $getElementsCursusRequest->execute(array($cursus->getId()));
    $fetched = $getElementsCursusRequest->fetchAll(PDO::FETCH_ASSOC);
    var_dump($fetched);
    //TODO : Test et retourner array objets Element cursus

}
*/
?>