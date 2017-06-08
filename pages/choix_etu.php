<?php
include('../data/sql/db_init.php');
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
        $fetched=new etudiant($numero, $nom, $prenom, $admission, $filiere);
        array_push($return, $fetched);
    }
    return $return;
}
$etudiants = getEtudiants($conn);
?>

<html>
<head>
    <title>Créer un cursus</title>
    <link href="../include/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<form method="post" action="creer_cursus.php" id="formChoixEtu" name="formChoixEtu">
    <div>
        <label for="listEtu">Choisir un étudiant</label>
        <input list="etudiants" name="listEtu" id="listEtu">
        <datalist id="etudiants">
            <?php
            foreach ($etudiants as $etudiant){
            ?>
            <option value="<?php echo($etudiant);?>">
                <?php }?>
        </datalist>
    </div>
    <div>
        <input type="submit" value="Valider">
    </div>
</form>
<a class="btn btn-default" href="creer_etu_form.html" role="button">Créer un nouveau profil étudiant</a>
</body>
</html>