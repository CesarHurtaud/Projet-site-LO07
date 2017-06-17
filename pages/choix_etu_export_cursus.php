<?php
include('../data/sql/db_init.php');
include('../data/classes/etudiant.php');

$etudiants = getEtudiants();

//TODO : Supprimer historique  de la liste des étudiants possibles.
?>

<html>
<head>
    <title>Exporter un cursus</title>
    <link href="../include/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<form method="post" action="exporter_cursus.php" id="formChoixEtu" name="formChoixEtu">
    <div>
        <label for="listEtu">Choisir un étudiant</label>
        <input list="etudiants" name="listEtu" id="listEtu">
        <datalist id="etudiants">
            <?php
            foreach ($etudiants as $etudiant){
            ?>
            <option value="<?php echo($etudiant); ?>">
                <?php } ?>
        </datalist>
    </div>
    <div>
        <input type="submit" value="Valider">
    </div>
</form>
</body>
</html>