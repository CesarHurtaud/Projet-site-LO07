<?php

include '../data/db_connexion.php';
include('../data/etudiant.php');
include('../data/cursus.php');

if (isset($_POST['listEtu'])) {

    $et = $_POST['listEtu'];

//var_dump($et);

    function getCursus($conn, $et) {

        $info = explode(" - ", $et);
        $sql = 'SELECT distinct c.label,c.id FROM cursus c, etudiant e where c.numeroEtu =' . $info[1];
        $return = array();

        foreach ($conn->query($sql) as $row) {

            $id = $row['id'];
            $label = $row['label'];
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
        <title>Choisir un cursus à exporter</title>
        <link href="../include/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <form method="post" action="exportCsv.php">
            
            <input type="hidden" id="yolo" name="hidden1" value="<?php echo ($et) ?>" />
            
            <fieldset>
                <div id='champs'>
                    <label for="listCursus">Choisir un cursus à exporter</label>
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
            
            <input type="submit" value="Exporter ce cursus" />
        </div>
    </form>
</body>
</html>

<?php 
}
 else {


    function getEtudiants($conn) {
        $sql = 'SELECT * FROM `etudiant`';
        $return = array();
        foreach ($conn->query($sql) as $row) {
            $numero = $row['numero'];
            $nom = $row['nom'];
            $prenom = $row['prenom'];
            $admission = $row['admission'];
            $filiere = $row['filiere'];
            $fetched = new etudiant($numero, $nom, $prenom, $admission, $filiere);
            array_push($return, $fetched);
        }
        return $return;
    }

    $etudiants = getEtudiants($conn);
//var_dump($etudiants);
    ?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Exporter un cursus</title>
        <link href="../include/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <form method="post" action="exportCsv_choix.php">
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
                </div>
                <div id="listecursus">
                </div>

            </fieldset>
        <div>
            <input type="submit" value="Choisir un cursus" />
        </div>
    </form>
</body>
</html>
<?php 
}
                        