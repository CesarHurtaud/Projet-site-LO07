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

session_start();

$_SESSION['numEtudiant'] = $num;
?>

<html>
<head>
    <title>TEST</title>

    <!-- Bootstrap -->
    <link href="../include/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Javascript -->
    <script type="text/javascript">
        var formAddCursus = document.createElement("form");
        var instance = 0;
        var submitDiv = document.createElement("div");
        var submit = document.createElement("input");
        var labelCursus = document.createElement('input');
        var lLabelCursus = document.createElement('label');

        function addForm() {
            formAddCursus.setAttribute('method', 'post');
            formAddCursus.setAttribute('action', 'creer_cursus.php');
            labelCursus.setAttribute('type', 'text');
            labelCursus.setAttribute('id', 'labelCursus');
            labelCursus.setAttribute('name', 'labelCursus');
            lLabelCursus.setAttribute('for', 'labelCursus');
            lLabelCursus.innerHTML = "Entrez un nom pour ce cursus : ";
            formAddCursus.appendChild(lLabelCursus);
            formAddCursus.appendChild(labelCursus);
            formAddCursus.appendChild(document.createElement('BR'));
            submit.setAttribute("type", "submit");
            submit.setAttribute('id', 'submitbutton');
            submit.setAttribute("value", "Ajouter ces éléments à mon cursus");
            submitDiv.appendChild(submit);
            addElem();
            document.getElementsByTagName('body')[0].appendChild(formAddCursus);
        }

        function addSubmit() {
            if (document.contains(document.getElementById('submitbutton'))) {
                submitDiv.removeChild(submit);
                addSubmit();
            }
            else {
                submitDiv.appendChild(submit);
                formAddCursus.appendChild(submitDiv);
            }

        }
        function addElem() {
            instance++;
            addNumSem();
            addLabSem();
            addSigle();
            addCatUV();
            addAffUV();
            addUvUTT();
            addProfil();
            addCredits();
            addResultat();
            addSubmit();

        }

        function addNumSem() {
            var nSem = document.createElement("input");
            nSem.setAttribute('type', 'number');
            nSem.setAttribute('placeholder', "Le numéro de semestre pendant lequel vous avez suivi cette UV");
            nSem.setAttribute('id', 'numSem' + instance);
            nSem.setAttribute('name', 'numSem' + instance);
            var nSemLabel = document.createElement("Label");
            nSemLabel.setAttribute("for", 'numSem' + instance);
            nSemLabel.innerHTML = "UV suivie pendant le semestre :";
            formAddCursus.appendChild(nSemLabel);
            formAddCursus.appendChild(nSem);
            formAddCursus.appendChild(document.createElement('BR'));
        }
        function addSigle() {
            var sigleUV = document.createElement('input');
            sigleUV.setAttribute('type', 'text');
            sigleUV.setAttribute('id', 'sigle' + instance);
            sigleUV.setAttribute('name', 'sigle' + instance);
            var sigleUVlabel = document.createElement('label');
            sigleUVlabel.setAttribute('for', 'sigle' + instance);
            sigleUVlabel.innerHTML = "Le sigle de l'UV :";
            formAddCursus.appendChild(sigleUVlabel);
            formAddCursus.appendChild(sigleUV);
            formAddCursus.appendChild(document.createElement('BR'));

        }
        function addLabSem() {
            var lSem = document.createElement('input');
            lSem.setAttribute('type', 'text');
            lSem.setAttribute('placeholder', 'Le label du semestre. Ex:TC1, ISI8');
            lSem.setAttribute('id', 'labSem' + instance);
            lSem.setAttribute('name', 'labSem' + instance);
            var lSemLabel = document.createElement('Label');
            lSemLabel.setAttribute('for', 'labSem' + instance);
            lSemLabel.innerHTML = "Label du semestre : ";
            formAddCursus.appendChild(lSemLabel);
            formAddCursus.appendChild(lSem);
            formAddCursus.appendChild(document.createElement('BR'));
        }
        function addCatUV() {
            var catUV = document.createElement('input');
            catUV.setAttribute('list', 'categories');
            catUV.setAttribute('id', 'catUV' + instance);
            catUV.setAttribute('name', 'catUV' + instance);
            var DLCatUV = document.createElement('datalist')
            DLCatUV.setAttribute('id', 'categories');
            var CsCat = document.createElement('option');
            CsCat.setAttribute("value", "CS");
            DLCatUV.appendChild(CsCat);
            var TmCat = document.createElement('option');
            TmCat.setAttribute("value", "TM");
            DLCatUV.appendChild(TmCat);
            var EcCat = document.createElement('option');
            EcCat.setAttribute("value", "EC");
            DLCatUV.appendChild(EcCat);
            var HtCat = document.createElement('option');
            HtCat.setAttribute("value", "HT");
            DLCatUV.appendChild(HtCat);
            var StCat = document.createElement('option');
            StCat.setAttribute("value", "ST");
            DLCatUV.appendChild(StCat);
            var SeCat = document.createElement('option');
            SeCat.setAttribute("value", "SE");
            DLCatUV.appendChild(SeCat);
            var HpCat = document.createElement('option');
            HpCat.setAttribute("value", "HP");
            DLCatUV.appendChild(HpCat);
            var NpmlCat = document.createElement('option');
            NpmlCat.setAttribute("value", "NPML");
            DLCatUV.appendChild(NpmlCat);

            var lCatUV = document.createElement('label');
            lCatUV.setAttribute('for', "categories");
            lCatUV.innerHTML = "Catégorie de l'UV: ";
            formAddCursus.appendChild(lCatUV);
            formAddCursus.appendChild(catUV);
            formAddCursus.appendChild(DLCatUV);
            formAddCursus.appendChild(document.createElement('BR'));

        }
        function addAffUV() {
            var affUV = document.createElement('input');
            affUV.setAttribute('list', 'affectation');
            affUV.setAttribute('id', 'affUV' + instance);
            affUV.setAttribute('name', 'affUV' + instance);

            var DLAffUV = document.createElement('datalist');
            DLAffUV.setAttribute('id', 'affectation');

            var TCAff = document.createElement('option');
            TCAff.setAttribute('value', "TC");
            DLAffUV.appendChild(TCAff);

            var TCBRAff = document.createElement('option');
            TCBRAff.setAttribute('value', "TCBR");
            DLAffUV.appendChild(TCBRAff);

            var FCBRAff = document.createElement('option');
            FCBRAff.setAttribute('value', "FCBR");
            DLAffUV.appendChild(FCBRAff);

            var lAffUV = document.createElement('label');
            lAffUV.setAttribute('for', 'affectation');
            lAffUV.innerHTML = "Vous avez suivi l'UV en: ";

            formAddCursus.appendChild(lAffUV);
            formAddCursus.appendChild(affUV);
            formAddCursus.appendChild(DLAffUV);
            formAddCursus.appendChild(document.createElement('BR'));
        }
        function addUvUTT() {
            var uvUTT = document.createElement('input');
            uvUTT.setAttribute('list', 'uvUTT');
            uvUTT.setAttribute('id', 'utt' + instance);
            uvUTT.setAttribute('name', 'utt' + instance);
            var DLuvUTT = document.createElement('datalist');
            DLuvUTT.setAttribute('id', 'uvUTT');
            var Yutt = document.createElement('option');
            Yutt.setAttribute('value', "Y");
            DLuvUTT.appendChild(Yutt);

            var Nutt = document.createElement('option');
            Nutt.setAttribute('value', "N");
            DLuvUTT.appendChild(Nutt);

            var luvUTT = document.createElement('label');
            luvUTT.setAttribute('for', 'uvUTT');
            luvUTT.innerHTML = "Avez-vous suivi l'UV à l'UTT ?"
            formAddCursus.appendChild(luvUTT);
            formAddCursus.appendChild(uvUTT);
            formAddCursus.appendChild(DLuvUTT);
            formAddCursus.appendChild(document.createElement('BR'));
        }
        function addProfil() {
            var profil = document.createElement('input');
            profil.setAttribute('list', 'profil');
            profil.setAttribute('id', 'profil' + instance);
            profil.setAttribute('name', 'profil' + instance);
            var DLprofil = document.createElement('datalist');
            DLprofil.setAttribute('id', 'profil');
            var Yprofil = document.createElement('option');
            Yprofil.setAttribute('value', "Y");
            DLprofil.appendChild(Yprofil);

            var Nprofil = document.createElement('option');
            Nprofil.setAttribute('value', "N");
            DLprofil.appendChild(Nprofil);

            var lprofil = document.createElement('label');
            lprofil.setAttribute('for', 'profil');
            lprofil.innerHTML = "L'UV fait-elle partie de votre profil ?"
            formAddCursus.appendChild(lprofil);
            formAddCursus.appendChild(profil);
            formAddCursus.appendChild(DLprofil);
            formAddCursus.appendChild(document.createElement('BR'));
        }
        function addCredits() {
            var cred = document.createElement('input');
            cred.setAttribute('type', 'number');
            cred.setAttribute('id', 'credit' + instance);
            cred.setAttribute('name', 'credit' + instance);

            var lCred = document.createElement('label');
            lCred.setAttribute('for', 'credit' + instance);
            lCred.innerHTML = "Combien de crédits vous a rapporté l'UV ?";

            formAddCursus.appendChild(lCred);
            formAddCursus.appendChild(cred);
            formAddCursus.appendChild(document.createElement('BR'));

        }
        function addResultat() {
            var resultat = document.createElement('input');
            resultat.setAttribute('list', 'resultats');
            resultat.setAttribute('id', 'resultatUV' + instance);
            resultat.setAttribute('name', 'resultatUV' + instance);
            var DLResultat = document.createElement('datalist');
            DLResultat.setAttribute('id', 'resultats');
            var A = document.createElement('option');
            A.setAttribute('value', 'A');
            DLResultat.appendChild(A);
            var B = document.createElement('option');
            B.setAttribute('value', 'B');
            DLResultat.appendChild(B);
            var C = document.createElement('option');
            C.setAttribute('value', 'C');
            DLResultat.appendChild(C);
            var D = document.createElement('option');
            D.setAttribute('value', 'D');
            DLResultat.appendChild(D);
            var E = document.createElement('option');
            E.setAttribute('value', 'E');
            DLResultat.appendChild(E);
            var F = document.createElement('option');
            F.setAttribute('value', 'F');
            DLResultat.appendChild(F);
            var ABS = document.createElement('option');
            ABS.setAttribute('value', 'ABS');
            DLResultat.appendChild(ABS);
            var ADM = document.createElement('option');
            ADM.setAttribute('value', 'ADM');
            DLResultat.appendChild(ADM);

            var lResultat = document.createElement('label');
            lResultat.setAttribute('for', 'resultats');
            lResultat.innerHTML = "Résultats";

            formAddCursus.appendChild(lResultat);
            formAddCursus.appendChild(resultat);
            formAddCursus.appendChild(DLResultat);
            formAddCursus.appendChild(document.createElement('BR'));
        }

    </script>

</head>
<body onload="addForm()">
<button type="button" class="btn btn-default btn-sm" onclick="addElem()">
    <span class="glyphicon glyphicon-plus"></span> Ajouter des elements de cursus

</body>
</html>
