<?php

include("../data/sql/db_init.php");

$etu = $_POST['numero'];
$lab = $_POST['label'];

var_dump($lab, $etu);

function visualiser()
{

    global $conn;

    $req = "SELECT * FROM elementcursus e,cursus c WHERE c.id = e.idCursus ";
    $reponse = $conn->query($req);
    $tab_res = $reponse->fetchAll(PDO::FETCH_ASSOC);

    echo "<table>";
    foreach ($tab_res as $un_res) {

        echo "<tr><th>" . implode('</th><th>', array_keys($un_res)) . "</th></tr>";
        $i++; //????

        echo "<tr><td>" . implode('</td><td>', $un_res) . "</td></tr>";
    }
    echo "</table></br>";
    //print_r($etudiant);
}

?>