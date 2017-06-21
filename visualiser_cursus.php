<?php

include '../data/db_connexion.php';

$info = $_POST['listCursus'];
$id = explode(" - ", $info);

$req = "SELECT DISTINCT e.* FROM elementcursus e,cursus c WHERE e.idCursus =".$id[1];
$ue = array();
foreach ($conn->query($req) as $row) {
    array_push($ue, $row);
}
//var_dump($ue);
$CS = array();
$TM = array();
$ME = array();
$HP= array();
$CT = array();
$EC = array();
$ST = array();
$NPML = array();
$SE = array();


foreach ($ue as $elem) {
    
    if (strcasecmp($elem[4], "CS") == 0) {         
        array_push($CS, $elem);
    }
    if (strcasecmp($elem[4], "TM") == 0) {
            array_push($TM, $elem);
    }
    if (strcasecmp($elem[4], "ME") == 0) {
            array_push($ME, $elem);
    }
    if (strcasecmp($elem[4], "CT") == 0) {
            array_push($CT, $elem);
    }
    if (strcasecmp($elem[4], "HP") == 0) {
            array_push($HP, $elem);
    }
    if (strcasecmp($elem[4], "EC") == 0) {
            array_push($EC, $elem);
    }
    if (strcasecmp($elem[4], "ST") == 0) {
            array_push($ST, $elem);
    }
    if (strcasecmp($elem[4], "SE") == 0) {
            array_push($SE, $elem);
    }
    if (strcasecmp($elem[4], "NPML") == 0) {
            array_push($NPML, $elem);
    }
    if (strcasecmp($elem[4], "NPML") == 0) {
            array_push($NPML, $elem);
    }
}

function getCredit($categorie) {
    $total = 0;
    foreach ($categorie as $value) {
        $total += $value['credit'];
    }
    return $total;
}

function getCreditTotal($ue) {
    $total = 0;
    foreach ($ue as $value) {
        $total += $value['credit'];
    }
    return $total;
}
$restot = getCreditTotal($ue);

$cat = array("CS" => $CS, "TM" =>$TM, "ME" =>$ME, "HP" =>$HP, "CT" =>$CT, "EC" =>$EC);

?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Visualiser un cursus</title>
        <link href="../include/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <h1>Présentation du cursus suivant : <?php echo $id[0]?> </h1>
        <?php foreach ($cat as $key => $value) {?>
        <div>
            <h4><?php echo $key?> suivies :</h4>
            <ol>
            <?php foreach ($value as $obj) { ?>
                 <li><?php echo ($obj['sigle']." suivi en ".$obj['label_semestre']." et obtenu avec ".$obj[9]) ?> </li>
            <?php } ?>    
            </ol>
        </div>
        <?php } ?>
        <?php
          if(count($SE) != 0) {
              echo ("<div>Le semestre d'étude à l'étranger est validé</div>");
          } else { echo ("<div>Le semestre d'étude à l'étranger est a effectué</div>"); }
          
           if(count($NPML) != 0) {
              echo ("<div>Le Bulats a été obtenu</div>");
          } else { echo ("<div>Il faut obtenir le bulats</div>"); }
          
          foreach ($ST as $stage) {
            echo "<div>";
              if (strcasecmp($stage['sigle'], "TN09") == 0){
                   echo "Stage TN09 validé</br>";
              }
              
              if (strcasecmp($stage['sigle'], "TN10") == 0){
                   echo "Stage TN10 validé</br>";
              }
              
              if (strcasecmp($stage['sigle'], "TN05") == 0){
                   echo "Stage TN05 validé</br>";
              }
            echo "</div>";    
          }
          
          echo "<div>";
          
          echo "<h4>Nombres de crédits validés :</h4><ul>";
          
          foreach ($cat as $key => $value) {
              $res = getCredit($value);
              echo ("<li>".$res." crédits ".$key."</li>");
    
          }
          
          echo "</ul><h5> => Total des crédits validés :".$restot."</h5></div>";
          
        ?>
        <div>
            <a class="btn btn-default" href="../pages/index.html" role="button">Retour à l'acceuil</a>
        </div>
    </body>
</html>