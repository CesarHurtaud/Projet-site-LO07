<?php

include('../sql/db_init.php');
<<<<<<< HEAD
/**
 * Created by PhpStorm.
 * User: adam
 * Date: 02/05/17
 * Time: 17:18
 */
class cursus
{
    private $etudiant;
    private $elements;

    /**
     * cursus constructor.
     * @param $etudiant
     * @param $elements
     */
    public function __construct($etudiant)
    {
        $this->setEtudiant($etudiant);
        $this->elements = array();
    }

    /**
     * @return mixed
     */
=======
include 'db_connexion.php';

class cursus {



    private $id;
    private $etudiant;
    private $elements;
    
    public function __construct($id, $etudiant) {

        function addElements() {
            
            global $conn,$dsn;
            
            $req = "select e.* from elementcursus e,cursus c where c.id = e.idCursus ";
            $reponse = $conn->query($req);
            $tab_res = $reponse->fetchAll(PDO::FETCH_ASSOC);
            //print_r($tab_res);
            return $tab_res;    
        }
          
        $this->setId($id);
        $this->setEtudiant($etudiant);
        $this->elements = addElements();
    }

    
    public function getId()
    {
        return $this->id;
    }
    
    public function setId($id)
    {
        $this->id = $id;
    }
    
>>>>>>> 08549aeec121edf062e22039d13cc87cb161fa94
    public function getEtudiant()
    {
        return $this->etudiant;
    }
   
    public function setEtudiant($etudiant)
    {
        global $conn,$dsn;
            
            $req = "select e.* from etudiant e,cursus c where c.numeroEtu = e.numero ";
            $reponse = $conn->query($req);
            $tab_res = $reponse->fetchAll(PDO::FETCH_ASSOC);
            //print_r($tab_res); 
        $this->etudiant = $tab_res;
    }
    
    public function visualiser() {
        
        global $conn, $dsn;

        $req = "select * from elementcursus e,cursus c where c.id = e.idCursus ";
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
    }

    /*public function importCSV($csv) {
        $test = fopen($csv, "r");
        print_r($expression);
    }
     * */
  
}

$cursus1 = new cursus(1, 38182);
var_dump($cursus1);
//$cursus1->visualiser();
