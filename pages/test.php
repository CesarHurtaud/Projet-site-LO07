<?php
/**
 * Created by PhpStorm.
 * User: adam
 * Date: 02/05/17
 * Time: 19:04
 */
include("../data/sql/db_init.php");
include("../data/classes/etudiant.php");

$etu= new etudiant(5, "Benjelloun", "Rayan", "TC", "?");
insertEtu($etu);
$test=getEtuByNumero(5);
var_dump($test);

/*
$test=getEtudiants();
print_r($test[0]);
*/
