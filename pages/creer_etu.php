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

function insertEtu($conn, etudiant $etu){
    $insertEtuRequest = $conn->prepare("INSERT INTO etudiant VALUES (:nom, :prenom, :numero, 
                                                                          :filiere, :admission)");

    $nomNewEtu = $etu->getNom();
    $prenomNewEtu = $etu->getPrenom();
    $numeroNewEtu = $etu->getNumero();
    $filiereNewEtu = $etu->getFiliere();
    $admissionNewEtu = $etu->getAdmission();

    $insertEtuRequest->bindParam(':nom', $nomNewEtu);
    $insertEtuRequest->bindParam(':prenom', $prenomNewEtu);
    $insertEtuRequest->bindParam(':numero', $numeroNewEtu);
    $insertEtuRequest->bindParam(':filiere', $filiereNewEtu);
    $insertEtuRequest->bindParam(':admission', $admissionNewEtu);

    $insertEtuRequest->execute();
}

insertEtu($conn, $newEtu);
header('location:choix_etu.php');
//echo("Votre profil étudiant a été créé, vous allez etre redirigé");
exit();
?>

