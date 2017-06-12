<?php
include("../data/sql/db_init.php");
include("../data/classes/etudiant.php");
/**
 * Created by PhpStorm.
 * User: ganstrich
 * Date: 08/06/17
 * Time: 11:05
 */
$newEtu = new etudiant($_POST['numero'], $_POST['nom'], $_POST['prenom'],
                        $_POST['admission'], $_POST['filiere']);

insertEtu($conn, $newEtu);
header('location:choix_etu.php');
//echo("Votre profil étudiant a été créé, vous allez etre redirigé");
exit();
?>

