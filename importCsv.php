<?php

include 'db_connexion.php';

$fichier = $_FILES['fichier']['tmp_name'];
//var_dump($fichier);
$row = 1;
if (($handle = fopen($fichier, "r")) !== FALSE) {

    $csv = file_get_contents($fichier);
    $csv_lines = preg_split('/\\r\\n|\\r|\\n/', $csv);
    //print_r($csv_lines);

    $etu = array();
    for ($i = 0; $i < 5; $i++) {

        $data = $csv_lines[$i];
        $info = preg_split("/[\s;]+/", $data);
        //print_r($info);
        $etu[] = $info[1];
    }
    
    $elemCursus = array();
    foreach ($csv_lines as $key => $value) {
        $data = preg_split("/[\s;]+/", $value);
        
        if ( strcasecmp($data[0], "EL") == 0) {
            $elemCursus[] = $data;
        }   
    }
    
    function insertElemCursus($conn, $elemCursus) {
        
        
        foreach ($elemCursus as $value) {
            $insertElemCursus = $conn->prepare("INSERT INTO elementcursus VALUES (:id, :num_semestre, :label_semestre, :sigle, :categorie, :affectation, :utt, :profil, :credit, :resultat, :idCursus)");

            $req = "select count(id) from elementcursus";
            $result = $conn->query($req);
            $res = $result->fetch(PDO::FETCH_NUM);
            $id = intval($res[0]);
            //var_dump ($int);

            $idNewElem = $id+1;
            //echo "$idNewElem</br>";
            $numSemNewElem = $value[1];
            $semLabelNewElem = $value[2];
            $sigleNewElem = $value[3];
            $catNewElem = $value[4];
            $affectNewElem = $value[5];
            $uttNewElem = $value[6];
            $profilNewElem = $value[7];
            $creditNewElem = $value[8];
            $resultNewElem = $value[9];
            $idCursusNewElem = 2;

            $insertElemCursus->bindParam(':id', $idNewElem);
            $insertElemCursus->bindParam(':num_semestre', $numSemNewElem);
            $insertElemCursus->bindParam(':label_semestre', $semLabelNewElem);
            $insertElemCursus->bindParam(':sigle', $sigleNewElem);
            $insertElemCursus->bindParam(':categorie', $catNewElem);
            $insertElemCursus->bindParam(':affectation', $affectNewElem);
            $insertElemCursus->bindParam(':utt', $uttNewElem);
            $insertElemCursus->bindParam(':profil', $profilNewElem);
            $insertElemCursus->bindParam(':credit', $creditNewElem);
            $insertElemCursus->bindParam(':resultat', $resultNewElem);
            $insertElemCursus->bindParam(':idCursus', $idCursusNewElem);

            $insertElemCursus->execute();
        }
    }
     
    

    function insertEtuBis($conn, $etu) {
  
        $insertEtuRequest = $conn->prepare("INSERT INTO etudiant VALUES (:nom, :prenom, :numero, :filiere, :admission)");

        $nomNewEtu = $etu[1];
        $prenomNewEtu = $etu[2];
        $numeroNewEtu = $etu[0];
        $filiereNewEtu = $etu[4];
        $admissionNewEtu = $etu[3];

        $insertEtuRequest->bindParam(':nom', $nomNewEtu);
        $insertEtuRequest->bindParam(':prenom', $prenomNewEtu);
        $insertEtuRequest->bindParam(':numero', $numeroNewEtu);
        $insertEtuRequest->bindParam(':filiere', $filiereNewEtu);
        $insertEtuRequest->bindParam(':admission', $admissionNewEtu);
        
        $insertEtuRequest->execute();
    }
    
    function insertCursus($conn, $etu) {

        $insertCursusRequest = $conn->prepare("INSERT INTO cursus VALUES (:id, :label, :numeroEtu)");

        $req = "select count(id) from cursus";
        $result = $conn->query($req);
        $res = $result->fetch(PDO::FETCH_NUM);
        $id = intval($res[0]);

        $idNewCursus = $id + 1;
        $labelNewCursus = "cursus" . ($id + 1);
        $numEtuNewCursus = $etu[0];
        
        $insertCursusRequest->bindParam(':id', $idNewCursus);
        $insertCursusRequest->bindParam(':label', $labelNewCursus);
        $insertCursusRequest->bindParam(':numeroEtu', $numEtuNewCursus);
        
        $insertCursusRequest->execute();
    }

}
insertEtuBis($conn, $etu);
insertElemCursus($conn, $elemCursus);
insertCursus($conn, $etu);
fclose($handle);
?>


<html>
    <head>
        <meta charset="UTF-8">
        <title>Importer un cursus</title>
        <link href="../include/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <h2> Votre cursus a bien été importé !</h2>
    </n>
    <div>
        <a class="btn btn-default" href="../pages/index.html" role="button">Retour à l'acceuil</a>
    </div>
</body>
</html>