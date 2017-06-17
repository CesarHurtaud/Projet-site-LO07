<?php

include("../data/sql/db_init.php");
include("../data/classes/etudiant.php");
ini_set('display_errors', 1);
/**
 * Created by PhpStorm.
 * User: ganstrich
 * Date: 15/06/17
 * Time: 10:29
 */

session_start();
$numEtu = $_SESSION['numEtudiant'];
echo($numEtu);
$etu = getEtuByNumero(intval($numEtu));

function insertCursus($conn, $numEtu)
{
    $insertCursusRequest = $conn->prepare("INSERT INTO cursus VALUES (:id, :label, :numeroEtu)");


    $req = "SELECT count(id) FROM cursus";
    $result = $conn->query($req);
    $res = $result->fetch(PDO::FETCH_NUM);
    $id = intval($res[0]);

    $idNewCursus = $id + 1;

    $insertCursusRequest->bindParam(':id', $idNewCursus);
    $insertCursusRequest->bindParam(':label', $_POST['labelCursus']);
    $insertCursusRequest->bindParam(':numeroEtu', $numEtu);
    $insertCursusRequest->execute();

}

insertCursus($conn, $numEtu);


//var_dump($_POST);
