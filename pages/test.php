<?php
/**
 * Created by PhpStorm.
 * User: adam
 * Date: 02/05/17
 * Time: 19:04
 */
include("../data/sql/db_init.php");
include("../data/classes/etudiant.php");

$etu= new etudiant(1, "Benjelloun", "Rayan", "TC", "?");
$test=getEtuByNumero(2);
var_dump($test);
/*
$test=getEtudiants();
print_r($test[0]);
*/
