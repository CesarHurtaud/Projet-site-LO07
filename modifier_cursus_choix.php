<?php


include('../data/etudiant.php');
include('../data/cursus.php');

if ( !isset($_POST['listEtu'])) {

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
        $fetched=new etudiant($numero, $nom, $prenom, $admission, $filiere);
        array_push($return, $fetched);
    }
    return $return;
}
$etudiants = getEtudiants($conn);
//var_dump($etudiants);

/*function returnEtudiants($conn)
{
    $sql = 'SELECT * FROM `etudiant`';
    $return = array();
    foreach ($conn->query($sql) as $row) {
        $numero=$row['numero'];
        $nom=$row['nom'];
        $prenom=$row['prenom'];
        $admission=$row['admission'];
        $filiere=$row['filiere'];
        $fetched=new etudiant($numero, $nom, $prenom, $admission, $filiere);
        array_push($return, $fetched);
    }
    return $return;
}

function getCursus($conn,$etudiant) {
    
    $sql = 'SELECT * FROM `cursus`';
    $return = array();
    foreach ($conn->query($sql) as $row) {
        $id=$row['id'];
        $label=$row['label'];
        $numeroEtu=$row['numeroEtu'];
        $fetched=new cursus($id,$etudiant);
        array_push($return, $fetched);
    }
    return $return;
}
//$cursus = getCursus($conn, $etudiant);
 * 
 */

?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Modifier un cursus 1</title>
        <link href="../include/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <form method="post" action="modifier_cursus_choix.php">
            <fieldset>
                <div id='champs'>
                    <label for="listEtu">Choisir un étudiant</label>
                    <input list="etudiants" name="listEtu" id="listEtu">
                    <datalist id="etudiants">
                        <?php
                        foreach ($etudiants as $etudiant) {
                            ?>
                            <option value="<?php echo($etudiant); ?>">
                            <?php } ?>
                    </datalist>
                    </br>
                    <!-- <button type="button" onclick="add()" >Choisir le cursus</button><br> -->
                </div>
                <div id="listecursus">
                </div>

            </fieldset>
            <!--
            <script type="text/javascript" >
                
                        
                    function add() {
                        
                      var input = listecursus.innerHTML;
                      listecursus.innerHTML = input + '<label for="listCursus">Choisir un cursus</label><input list="cursus" name="listCursus" id="listCursus"><?php echo("yo")?><br />\n';
                    }
                   
             
            </script>

        <!-- <div>
            <label for="listCursus">Choisir un cursus</label>
            <input list="cursus" name="listCursus" id="listCursus">
            <datalist id="cursus">
        <?php
        foreach ($cursus as $cur) {
            ?>
                    <option value="<?php echo($cur); ?>">
        <?php } ?>
            </datalist>
        </div>
        -->
        <div>
            <input type="submit" value="Choisir un cursus" />
        </div>
    </form>
</body>
</html>

<?php
}

else {
    
$et = $_POST['listEtu'];


function getCursus($conn,$et) {
    
    $info = explode(" - ",$et);
    $sql = 'SELECT distinct c.label,c.id FROM cursus c, etudiant e where c.numeroEtu ='. $info[1];
    $return = array();
 
    foreach ($conn->query($sql) as $row) {

        $id=$row['id'];
        $label=$row['label'];
        $test = array();
        array_push($test, $label);
        array_push($test, $id);
        $res = implode(" - ", $test);
        //$fetched=new cursus($id,$et,$label); pas la sol car $et est un string
        array_push($return, $res);
         
    }
    return $return;
}
$cursus = getCursus($conn, $et);

?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Modifier un cursus 2</title>
        <link href="../include/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <form method="post" action="../data/modifier_cursus.php">
            <fieldset>
                <div id='champs'>
                    <label for="listCursus">Choisir un cursus à modifier</label>
                    <input list="cursus" name="listCursus" id="listCursus">
                    <datalist id="cursus">
                        <?php
                        foreach ($cursus as $cur) {
                            ?>
                            <option value="<?php echo($cur); ?>">
                            <?php } ?>
                    </datalist>
                    </br>
                </div>

            </fieldset>
        <div>
            <input type="submit" value="Visualiser ce cursus" />
        </div>
    </form>
</body>
</html>

<?php

}