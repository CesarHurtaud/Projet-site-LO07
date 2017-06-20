<?php

include('../data/etudiant.php');
include('../data/cursus.php');

if (isset($_POST['listElem']) != 0) {

    $el = $_POST['listElem'];
    $expl = explode(" - ", $el);
    $id = $expl[0];
    //var_dump($el);

    function delete($conn, $id) {
        $reqDel = "delete from elementcursus where id= :Id";
        $stmt = $conn->prepare($reqDel);
        $stmt->bindParam(':Id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
    delete($conn, $id);

}

function recup() {
    if ( isset($_POST['listCursus'])) {
        return $_POST['listCursus'];
    }
    else {
        return $_POST['hidden'];
    }
}

$info = recup();
$id = explode(" - ", $info);

$req = "SELECT DISTINCT e.* FROM elementcursus e,cursus c WHERE e.idCursus =".$id[1];
$ue = array();
foreach ($conn->query($req) as $row) {
    array_push($ue, $row);
}
//var_dump($ue);

function getElem($conn,$info) {
    
    $id = explode(" - ", $info);
    $del = "SELECT distinct id,sigle,resultat FROM elementcursus where idcursus =". $id[1];
    $return = array();

    foreach ($conn->query($del) as $row) {

        $id=$row['id'];
        $sigle=$row['sigle'];
        $resultat=$row['resultat'];
        $test = array();
        array_push($test, $id);
        array_push($test, $sigle);
        array_push($test, $resultat);
        $res = implode(" - ", $test);
        //$fetched=new cursus($id,$et,$label); pas la sol car $et est un string
        array_push($return, $res);
         
    }
    return $return;
}
$elems = getElem($conn, $info);
?>
    
<html>
    <head>
        <meta charset="UTF-8">
        <title>Modifier un cursus</title>
        <link href="../include/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    </head>
    <body>
        
        <script type="text/javascript" src="modifier.js"> ></script>
        <h1>Modifier le cursus suivant : <?php echo $id[0] ?> </h1>
        <div>
            <table id="tableId">
                <thead>
                    <tr id="init">
                        <td>Id</td> <td>Numéro de semestre</td> <td>Label du semestre</td> <td>Sigle</td> <td>Catégorie</td> <td>Affectation</td> <td>Utt</td> <td>Profil</td> <td>Crédit</td> <td>Résultat</td>
                    </tr>
                </thead>
                <?php foreach ($ue as $value) { ?>
                    <tr id='<?php echo $value[0] ?>'>
                        <?php for ($i = 0; $i < 10; $i++) { ?>
                            <td> <?php echo "$value[$i]" ?> </td>

                        <?php } ?>
    <!-- <td><a onclick="supprimer(<?php echo $value[0] ?>)">supprimer</a></td> -->
                        <?php
                        echo "</tr>";
                    }
                    ?>
            </table>
        </div>
        <div id="listeElem">
            <form id="elemForm" method="post" action="modifier_cursus.php" >
                
                <label for="listElem">Supprimer un élément :</label>
                <input list="element" name="listElem" id="listCursus">
                <datalist id="element">
                        <?php
                        foreach ($elems as $element) {
                            ?>
                            <option value="<?php echo($element); ?>">
                            <?php } ?>
                    </datalist>
                <!-- <button type="button" onclick="add()" >supprimer un autre élément</button><br> -->
                
                <input type="hidden" id="hidden" name="hidden" value="<?php echo $info ?>" />
                
                <input type="submit" value="effectuer" />
            </form>
        </div>
        
        <script type="text/javascript" >
                
                        
                    function add() {
                        
                      var input = elemForm.innerHTML;
                      elemForm.innerHTML = input + '<label for="listCursus">Supprimer un élément :</label><input list="element" name="listElem" id="listCursus"><button type="button" onclick="add()" >supprimer un autre élément</button></br>';
                    }
        </script>
        <div>
            <a class="btn btn-default" href="index.html" role="button">Retour à l'acceuil</a>
        </div>
    </body>
</html>