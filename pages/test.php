<?php
/**
 * Created by PhpStorm.
 * User: adam
 * Date: 02/05/17
 * Time: 19:04
 */
//ini_set('display_errors', 1);

include("../data/sql/db_init.php");
include_once("../data/classes/etudiant.php");
include_once("../data/classes/cursus.php");
//include("../data/classes/cursus.php");
//echo("WAAZAAA");

$etu = new etudiant(5, "Benjelloun", "Rayan", "TC", "?");
/*insertEtu($etu);
$test=getEtuByNumero(5);*/
//var_dump($etu);
$cursus = new cursus(32, $etu);
var_dump($cursus);
//$cursus->exportToCSV();

/*
$test=getEtudiants();
print_r($test[0]);
*/
