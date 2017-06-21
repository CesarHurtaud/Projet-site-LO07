<?php

include("../data/sql/db_init.php");
/**
 * Created by PhpStorm.
 * User: ganstrich
 * Date: 19/06/17
 * Time: 16:24
 */
function dupliquerElemCursus($conn, $idCursus, $newLabel)
{
    //$sql = "SELECT * FROM `elementCursus` WHERE idCursus=?";
    $selectCursusRequest = $conn->prepare("SELECT * FROM `cursus` WHERE id=?");
    $selectElemCursusRequest = $conn->prepare("SELECT * FROM `elementCursus` WHERE idCursus=?");

    $selectCursusRequest->execute(array($idCursus));
    $Cursus = $selectCursusRequest->fetchAll(PDO::FETCH_ASSOC);

    $selectElemCursusRequest->execute(array($idCursus));
    $elemCursus = $selectElemCursusRequest->fetchAll(PDO::FETCH_ASSOC);

    $insertCursusRequest = $conn->prepare("INSERT INTO `cursus` VALUES (:id, :label, :numeroEtu)");
    $req = "SELECT count(id) FROM cursus";
    $result = $conn->query($req);
    $res = $result->fetch(PDO::FETCH_NUM);
    $id = intval($res[0]);
    $cursusNewID = $id + 1;
    $cursusNumeroEtu = intval($Cursus[0]['numeroEtu']);

    $insertCursusRequest->bindParam(':id', $cursusNewID);
    $insertCursusRequest->bindParam(':label', $newLabel);
    $insertCursusRequest->bindParam(':numeroEtu', $cursusNumeroEtu);
    $insertCursusRequest->execute();

    $insertElemCursusRequest = $conn->prepare("INSERT INTO `elementCursus` VALUES (:id, :num_semestre, :label_semestre, :sigle, :categorie,
  :affectation, :utt, :profil, :credit, :resultat, :idCursus)");
    $count = count($elemCursus);
    for ($i = 0; $i < $count; $i++) {

        $req2 = "SELECT count(id) FROM elementCursus";
        $result = $conn->query($req2);
        $res2 = $result->fetch(PDO::FETCH_NUM);
        $id2 = intval($res2[0]);
        $newID = $id2 + 1;
        $newCred = intval($elemCursus[$i]['credit']);
        //var_dump($elemCursus[$i]);
        $insertElemCursusRequest->bindParam(':id', $newID);
        $insertElemCursusRequest->bindParam(':num_semestre', $elemCursus[$i]['num_semestre']);
        $insertElemCursusRequest->bindParam(':label_semestre', $elemCursus[$i]['label_semestre']);
        $insertElemCursusRequest->bindParam(':sigle', $elemCursus[$i]['sigle']);
        $insertElemCursusRequest->bindParam(':categorie', $elemCursus[$i]['categorie']);
        $insertElemCursusRequest->bindParam(':affectation', $elemCursus[$i]['affectation']);
        $insertElemCursusRequest->bindParam(':utt', $elemCursus[$i]['utt']);
        $insertElemCursusRequest->bindParam(':profil', $elemCursus[$i]['profil']);
        $insertElemCursusRequest->bindParam(':credit', $newCred);
        $insertElemCursusRequest->bindParam(':resultat', $elemCursus[$i]['resultat']);
        $insertElemCursusRequest->bindParam(':idCursus', $cursusNewID);
        $insertElemCursusRequest->execute();

    }
}

//var_dump($_POST);
$cursus = $_POST['listCursus'];
$idCursus = strtok($cursus, "-");
//echo($idCursus);
dupliquerElemCursus($conn, $idCursus, $_POST['labelNewCursus']);
header('location:index.html');
