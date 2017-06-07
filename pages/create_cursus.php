<?php
include('../data/sql/db_connexion.php');
include('../data/classes/etudiant.php');
/**
 * Created by PhpStorm.
 * User: ganstrich
 * Date: 05/06/17
 * Time: 17:12
 */

function getEtudiants($conn)
{
    $sql = 'SELECT * FROM `etudiant`';
    $return = array();
    foreach ($conn->query($sql) as $row) {
        $numero=$row['numero'];
        $nom=$row['nom'];
        $prenom=$row['prenom'];
        $admission=$row['admission'];
        $filiere=$row['filiere'];
        //echo($filiere);
        array_push($return, new etudiant($numero, $nom, $prenom, $admission,$filiere));
    }
    return $return;
}
    $etudiants = getEtudiants($conn);
    $etudiants[0];
    var_dump($etudiants);



