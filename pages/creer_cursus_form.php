<?php
include("../data/sql/db_init.php");
include("../data/classes/etudiant.php");
//ini_set('display_errors', 1);
/**
 * Created by PhpStorm.
 * User: ganstrich
 * Date: 08/06/17
 * Time: 11:00
 */
$etuForm = $_POST['listEtu'];
$num = strtok($etuForm, '-');
$etu = getEtuByNumero(intval($num));
?>

<html>
<head>
    <title>Ajouter un cursus</title>
    <!-- Bootstrap -->
    <link href="../include/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Javascript -->
    <script type="text/javascript">
        var nbElem=1;
        function addElem(){
            //alert("WAAAAEEEAAAZZAAAAAA");
            var container = document.getElementById("container");
            clone = container.cloneNode(true);
            nbElem++;
            clone.id="elem"+nbElem;
            document.body.appendChild(clone);
        }

    </script>
</head>
<body>
<form method="post" action="creer_cursus.php" id="formAddCursus" name="formAddCursus">
    <div>
        <button type="button" class="btn btn-default btn-sm" onclick="addElem()">
            <span class="glyphicon glyphicon-plus"></span> Ajouter des elements de cursus
            <!--        <input type="image" src="plus.gif" alt="" onclick="addField()"/>-->
    </div>
    <div id="container">
        <div>
            <label for="numSem">UV suivie pendant le semestre</label>
            <input id="numSem" name="numSem" type="number" placeholder="Le numéro de semestre pendant lequel vous avez suivi cette UV"> <br>

            <label for="labSem">Label du semestre</label>
            <input id="labSem" name="labSem" type="text" placeholder="Le label du semestre. Ex:TC1, ISI8"><br>


            <label for="sigleUV">Le sigle de l'UV ou le label du stage</label>
            <input id="sigleUV" name="sigleUV" type="text" placeholder="Le sigle de l'UV, le label du stage"><br>


            <label for="categories">Catégorie de l'UV</label>
            <input list="categories" id="catUV" name="catUV">
            <datalist id="categories">
                <option value="CS">
                <option value="TM">
                <option value="EC">
                <option value="HT">
                <option value="ST">
                <option value="SE">
                <option value="HP">
                <option value="NPML">
            </datalist><br>

            <label for="affectation">Vous avez suivi l'UV en:</label>
            <input type="radio" name="affectation" value="TC">TC
            <input type="radio" name="affectation" value="TCBR">TCBR
            <input type="radio" name="affectation" value="FCBR">FCBR<br>

            <label for="utt?">Avez-vous suivi l'UV à l'UTT ?</label>
            <input type="radio" name="utt?" value="Y">Oui
            <input type="radio" name="utt?" value="N">Non<br>

            <label for="profil">Cette UV fait-elle partie de votre profil de branche ou de filière ?</label>
            <input type="radio" name="profil" value="Y">Oui
            <input type="radio" name="profil" value="N">Non<br>

            <label for="credit">Le nombre de crédits que vous a rapporté cette UV</label>
            <input type="number" name="credit" id="credit"><br>

            <label for="resultat">Quel résultat avez-vous eu ?</label>
            <input list="resultat" id="resUV" name="resUV">
            <datalist id="resultat">
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
                <option value="E">E</option>
                <option value="F">F</option>
                <option value="ABS">ABS</option>
                <option value="ADM">ADM</option>
            </datalist>
        </div>
    </div>

</form>

</body>

</html>
