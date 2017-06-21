<?php
include("../data/sql/db_init.php");
/**
 * Created by PhpStorm.
 * User: ganstrich
 * Date: 21/06/17
 * Time: 01:31
 */
function analyserCursus($conn, $idCursus, $idReglement)
{

    $selectCursusRequest = $conn->prepare("SELECT * FROM `cursus` WHERE id=?");
    $selectElemCursusRequest = $conn->prepare("SELECT * FROM `elementCursus` WHERE idCursus=?");
    $selectReglementRequest = $conn->prepare("SELECT * FROM `reglement` WHERE id=?");
    $selectReglesRequest = $conn->prepare("SELECT * FROM `regle` WHERE idReglement=?");

    $selectCursusRequest->execute(array($idCursus));
    $Cursus = $selectCursusRequest->fetchAll(PDO::FETCH_ASSOC);

    $selectElemCursusRequest->execute(array($idCursus));
    $elemCursus = $selectElemCursusRequest->fetchAll(PDO::FETCH_ASSOC);

    /* $selectReglementRequest->execute(array($idReglement));
     $Reglement=$selectReglementRequest->fetchAll(PDO::FETCH_ASSOC);

     $selectReglesRequest->execute(array($idReglement));
     $regles=$selectReglesRequest->fetchAll(PDO::FETCH_ASSOC);

     for($i=0;$i<count($regles);$i++){
         if(strcmp($regles[$i]['agregat'], "SUM") == 0){
             $cibles=explode("+", $regles[$i]['cible']);

         }
         elseif(strcmp($regles[$i]['agregat'], "EXIST") == 0){

         }
     }*/

    $credits = array(
        'CS' => array(
            'TC' => 0,
            'TCBR' => 0,
            'FCBR' => 0,
            'total' => 0,
        ),
        'TM' => array(
            'TC' => 0,
            'TCBR' => 0,
            'FCBR' => 0,
            'total' => 0,
        ),
        'ST' => array(
            'TC' => 0,
            'TCBR' => 0,
            'FCBR' => 0,
            'total' => 0,
        ),
        'EC' => array(
            'TC' => 0,
            'TCBR' => 0,
            'FCBR' => 0,
            'total' => 0,
        ),
        'CT' => array(
            'TC' => 0,
            'TCBR' => 0,
            'FCBR' => 0,
            'total' => 0,
        ),
        'ME' => array(
            'TC' => 0,
            'TCBR' => 0,
            'FCBR' => 0,
            'total' => 0,
        )
    );
    $creditsTot = 0;
    $ExistSE = 0;
    $ExistNPML = 0;


    for ($i = 0; $i < count($elemCursus); $i++) {
        $credits[$elemCursus[$i]['categorie']][$elemCursus[$i]['affectation']] += intval($elemCursus[$i]['credit']);
        $credits[$elemCursus[$i]['categorie']]['total'] += intval($elemCursus[$i]['credit']);
        $creditsTot += intval($elemCursus[$i]['credit']);
        if (strcmp($elemCursus[$i]['categorie'], "SE") == 0) {
            $ExistSE = 1;
        }
        if (strcmp($elemCursus[$i]['categorie'], "NPML") == 0) {
            $ExistNPML = 1;
        }
    }


    if (($credits['CS']['TC'] + $credits['TM']['TC']) < 54) {
        $manque = 54 - ($credits['CS']['TC'] + $credits['TM']['TC']);
        echo("Il vous manque " . $manque . " crédits de CS et TM en TC ");
        echo('</br>');
    }
    if (($credits['CS']['FCBR'] + $credits['TM']['FCBR']) < 30) {
        $manque = 30 - ($credits['CS']['FCBR'] + $credits['TM']['FCBR']);
        echo("Il vous manque " . $manque . " crédits de CS et TM en FCBR");
        echo('</br>');
    }
    if (($credits['CS']['FCBR'] + $credits['CS']['TCBR']) < 30) {
        $manque = 30 - ($credits['CS']['FCBR'] + $credits['CS']['TCBR']);
        echo("Il vous manque " . $manque . " crédits de CS en BR");
        echo('</br>');
    }
    if (($credits['TM']['TCBR'] + $credits['TM']['FCBR']) < 30) {
        $manque = 30 - ($credits['TM']['TCBR'] + $credits['TM']['FCBR']);
        echo("Il vous manque " . $manque . " crédits de TM en BR");
        echo('</br>');
    }
    if (($credits['ST']['TCBR']) < 30) {
        $manque = 30 - ($credits['ST']['TCBR']);
        echo("Il vous manque " . $manque . " crédits de ST en TCBR");
        echo('</br>');
    }
    if (($credits['ST']['FCBR']) < 30) {
        $manque = 30 - ($credits['ST']['TCBR']);
        echo("Il vous manque " . $manque . " crédits de ST en FCBR");
        echo('</br>');
    }
    if (($credits['EC']['TCBR'] + $credits['EC']['FCBR']) < 12) {
        $manque = 12 - ($credits['EC']['TCBR'] + $credits['EC']['FCBR']);
        echo("Il vous manque " . $manque . " crédits de EC en BR");
        echo('</br>');
    }
    if (($credits['ME']['TCBR'] + $credits['ME']['FCBR']) < 4) {
        $manque = 4 - ($credits['ME']['TCBR'] + $credits['ME']['FCBR']);
        echo("Il vous manque " . $manque . " crédits de ME en BR");
        echo('</br>');
    }
    if (($credits['CT']['TCBR'] + $credits['CT']['FCBR']) < 4) {
        $manque = 4 - ($credits['ME']['TCBR'] + $credits['ME']['FCBR']);
        echo("Il vous manque " . $manque . " crédits de CT en BR");
        echo('</br>');
    }
    if (($credits['ME']['TCBR'] + $credits['ME']['FCBR'] + $credits['CT']['TCBR'] + $credits['CT']['FCBR']) < 16) {
        $manque = 16 - ($credits['ME']['TCBR'] + $credits['ME']['FCBR'] + $credits['CT']['TCBR'] + $credits['CT']['FCBR']);
        echo("Il vous manque " . $manque . " crédits de ME et CT en BR");
        echo('</br>');
    }
    if ($ExistSE != 1) {
        echo("Vous devez effectuer un semestre à l'étranger");
        echo('</br>');
    }
    if ($ExistNPML != 1) {
        echo("Vous devez obtenir votre NPML");
        echo('</br>');
    }
    if ($creditsTot < 180) {
        $manque = 180 - $creditsTot;
        echo("Il vous manque " . $manque . " crédits au total.");
        echo('</br>');
    }


    //var_dump($credits);

}

$cursus = $_POST['listCursus'];
$idCursus = strtok($cursus, "-");
$idCursus = intval($idCursus);
$reglement = $_POST['listRegle'];
$idReglement = strtok($reglement, "-");
$idReglement = intval($idReglement);


analyserCursus($conn, $idCursus, $idReglement);