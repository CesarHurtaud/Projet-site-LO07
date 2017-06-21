<?php

include '../data/db_connexion.php';
include '../data/etudiant.php';

$et = $_POST['hidden1'];

$cur = $_POST['listCursus'];

$export = array();

function getElem($conn,$cur) {
    
    $id = explode(" - ", $cur);
    $del = "SELECT distinct num_semestre,label_semestre,sigle,categorie,affectation,utt,profil,credit,resultat FROM elementcursus where idcursus =". $id[1];
    $return = array();

    foreach ($conn->query($del) as $row) {
        
        $elem = array();
        
        for ($i=0;$i<9;$i++) {
            array_push($elem,$row[$i]);
        }
        
        array_push($return, $elem);    
    }
    return $return;
}
$elems = getElem($conn, $cur);
//var_dump($elems);
array_push($export, $elems);

function getEtudiant($conn,$et) {
    
    $etu = explode(" - ", $et);
    $sql = 'SELECT * FROM etudiant where numero='.$etu[1];
    
    $etudiant = array();
    
    foreach ($conn->query($sql) as $row) {
        $numero=$row['numero'];
        $nom=$row['nom'];
        $prenom=$row['prenom'];
        $admission=$row['admission'];
        $filiere=$row['filiere'];
        $fetched=new etudiant($numero, $nom, $prenom, $admission, $filiere);
        array_push($etudiant, $fetched);
    }
    return $etudiant;
}

$etudiant = getEtudiant($conn,$et);
$array = $etudiant[0]->afficher();
//var_dump($array);






function exporter($export, $cur, $array) {
    
    $name = explode(" - ", $cur);

    $fichier = $name[0] . ".csv";
    $delimiteur = ";";

    $fichier_csv = fopen($fichier, 'w+');
    fprintf($fichier_csv, chr(0xEF) . chr(0xBB) . chr(0xBF));

    $id = array("ID", $array['numero'], "", "", "", "", "", "", "", "");
    fputcsv($fichier_csv, $id, $delimiteur);
    $nom = array("NO", $array['nom'], "", "", "", "", "", "", "", "");
    fputcsv($fichier_csv, $nom, $delimiteur);
    $prenom = array("PR", $array['prenom'], "", "", "", "", "", "", "", "");
    fputcsv($fichier_csv, $prenom, $delimiteur);
    $admi = array("AD", $array['admission'], "", "", "", "", "", "", "", "");
    fputcsv($fichier_csv, $admi, $delimiteur);
    $filiere = array("FI", $array['filiere'], "", "", "", "", "", "", "", "");
    fputcsv($fichier_csv, $filiere, $delimiteur);

    //print_r($export[1]);

    $titre_elems = array("==", "s_seq", "s_label", "sigle", "categorie", "affectation", "utt", "profile", "credit", "resultat");
    fputcsv($fichier_csv, $titre_elems, $delimiteur);


    $elements = $export[0];

    foreach ($elements as $ligne) {
        array_unshift($ligne, "EL");
        fputcsv($fichier_csv, $ligne, $delimiteur);
    }

    $end = array("END", "", "", "", "", "", "", "", "", "");
    fputcsv($fichier_csv, $end, $delimiteur);

    fclose($fichier_csv);
    
    ?>
    <html>
        <head>
            <meta charset="UTF-8">
            <title>Exporter un cursus</title>
            <link href="../include/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        </head>
        <body>
            <h2> Votre cursus a bien été exporté au format CSV</h2>
        </n>
        <a href="index.html" >Retour à l'acceuil</a>
        </body>
    </html>
<?php
}

exporter($export, $cur, $array);

