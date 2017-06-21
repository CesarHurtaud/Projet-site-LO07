<?php

include("../data/sql/db_init.php");
include("../data/classes/cursus.php");
ini_set('display_errors', 1);
//
///**
// * Created by PhpStorm.
// * User: ganstrich
// * Date: 19/06/17
// * Time: 16:20
// */
//
function getCursus($conn)
{
    $sql = "SELECT * FROM `cursus`";
    $return = array();
    foreach ($conn->query($sql) as $row) {
        $id = $row['id'];
        $label = $row['label'];
        $numeroEtu = $row['numeroEtu'];
        $fetched = new cursus($id, $label, $numeroEtu);
        array_push($return, $fetched);
    }
    return $return;
}

$cursus = getCursus($conn);
?>

<html>
<head>
    <title>Dupliquer un cursus</title>
    <link href="../include/bootstrap/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
<form method="post" action="dupliquer_cursus.php" id="formChoixCursus" name="formChoixCursus">
    <div>
        <label for="listCursus">Choisir un cursus</label>
        <input list="cursus" name="listCursus" id="listCursus">
        <datalist id="cursus">
            <?php
            foreach ($cursus as $c){
            ?>
            <option value="<?php echo($c); ?>"> <?php
                }
                ?>
        </datalist>
    </div>
    <div>
        <label for="labelNewCursus">Entrez le nom du nouveau cursus</label>
        <input type="text" id="labelNewCursus" name="labelNewCursus">
    </div>
    <div>
        <input type="submit" value="Valider">
    </div>
</form>
</body>
</html>
