<?php
include("../sql/db_init.php");

class cursus
{

    private $id;
    private $numEtudiant;
    private $label;
    private $elements;

    public function __construct($id, $label, $numeroEtu)
    {
        $this->setId($id);
        $this->setEtudiant($numeroEtu);
        $this->setLabel($label);
        $this->elements = array();
        //$this->elements = $this->addElements();
    }

    public function addElements()
    {

        global $conn, $dsn;

        $req = "SELECT e.* FROM elementcursus e,cursus c WHERE c.id = e.idCursus ";
        $reponse = $conn->query($req);
        $tab_res = $reponse->fetchAll(PDO::FETCH_ASSOC);
        //print_r($tab_res);
        return $tab_res;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getEtudiant()
    {
        return $this->numEtudiant;
    }
    //TODO : Aucun objet etudiant n'est créé.
    /*public function setEtudiant(etudiant $etudiant)
    {
        global $conn;

        $req = "SELECT e.* FROM etudiant e,cursus c WHERE c.numeroEtu = e.numero ";
        $reponse = $conn->query($req);
        $tab_res = $reponse->fetchAll(PDO::FETCH_ASSOC);
        //print_r($tab_res);
        $this->etudiant = $tab_res;
    }*/

    public function setEtudiant($numEtudiant)
    {
        $this->numEtudiant = $numEtudiant;
    }

    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param mixed $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    function __toString()
    {
        $stringCursus = $this->getId() . " - " . $this->getLabel() . " - Etudiant n°: " . $this->getEtudiant();
        return $stringCursus;
    }


    /* public function visualiser()
     {

         global $conn;

         $req = "SELECT * FROM elementcursus e,cursus c WHERE c.id = e.idCursus ";
         $reponse = $conn->query($req);
         $tab_res = $reponse->fetchAll(PDO::FETCH_ASSOC);

         echo "<table>";
         foreach ($tab_res as $un_res) {

             echo "<tr><th>" . implode('</th><th>', array_keys($un_res)) . "</th></tr>";
             $i++;

             echo "<tr><td>" . implode('</td><td>', $un_res) . "</td></tr>";
         }
         echo "</table></br>";
         print_r($etudiant);
     }*/
    public function exportToCSV()
    {
        // $cursEtu = $this->getEtudiant();
        //$test = get_object_vars($cursEtu);
        //echo($test);
        //var_dump($test);

    }
    /*public function importCSV($csv) {
        $test = fopen($csv, "r");
        print_r($expression);
    }
     * */

}

/*
$cursus1 = new cursus(1, 38182);
var_dump($cursus1);*/
//$cursus1->visualiser();
