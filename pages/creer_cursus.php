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
//echo($numEtu);
//var_dump($_POST);
$instance = (count($_POST) - 1) / 8;
//echo($instance);
$idCursus = insertCursus($conn, $numEtu);
for ($i = 1; $i <= $instance; $i++) {
    insertElemCursus($conn, $_POST['numSem' . $i], $_POST['labSem' . $i], $_POST['sigle' . $i], $_POST['catUV' . $i],
        $_POST['affUV' . $i], $_POST['utt' . $i], $_POST['profil' . $i], $_POST['credit' . $i], $_POST['resultatUV' . $i], $idCursus);
}
//$etu = getEtuByNumero(intval($numEtu));

function insertElemCursus($conn, $num_semestre, $label_semestre, $sigle, $categorie, $affectation, $utt, $profil, $credits, $resultat, $idCursus)
{
    
    $insertElemCursusRequest = $conn->prepare("INSERT INTO elementCursus VALUES(:id, :num_semestre, 
:label_semestre, :sigle, :categorie, :affectation, :utt, :profil, :credits, :resultat, :idCursus)");
    $insertElemCursusRequest->bindParam(':num_semestre', $num_semestre);
    $insertElemCursusRequest->bindParam(':label_semestre', $label_semestre);
    $insertElemCursusRequest->bindParam(':sigle', $sigle);
    $insertElemCursusRequest->bindParam(':categorie', $categorie);
    $insertElemCursusRequest->bindParam(':affectation', $affectation);
    $insertElemCursusRequest->bindParam(':utt', $utt);
    $insertElemCursusRequest->bindParam(':profil', $profil);
    $insertElemCursusRequest->bindParam(':credits', $credits);
    $insertElemCursusRequest->bindParam(':resultat', $resultat);
    $insertElemCursusRequest->bindParam(':idCursus', $idCursus);

    $req = "SELECT count(id) FROM elementCursus";
    $result = $conn->query($req);
    $res = $result->fetch(PDO::FETCH_NUM);
    $id = intval($res[0]);
    $idNewElem = $id + 1;
    $insertElemCursusRequest->bindParam('id', $idNewElem);

    $insertElemCursusRequest->execute();
}
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

    return $idNewCursus;

}




//var_dump($_POST);
