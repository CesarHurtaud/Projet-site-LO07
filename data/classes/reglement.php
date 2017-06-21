<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'regle.php';

class reglement {
    
    private $label;
    private $id;
    private $regles; // liste de l'ensemble des règles
    
    function getRegles() {
        $tab = array();
        foreach ($this->regles as $key => $value) {
            $tab[] = $value->transformArgsIntoArray();
        }
        return $tab;
    }

    function setRegles($regles) {
        $this->regles = $regles;
    }
    
    function getLabel() {
        return $this->label;
    }

    function getId() {
        return $this->id;
    }

    function setLabel($label) {
        $this->label = $label;
    }

    function setId($id) {
        $this->id = $id;
    }

    function __construct($id, $label)
    {
        //echo "règle construite : $label " </br>\n";
        $this->setLabel($label);
        $this->setId($id);
        //   $this->setRegles($regles);
    }

    function __toString()
    {
        $str = $this->getId() . " - " . $this->getLabel();

        return $str;
    }


    function __destruct() {
        // détruit l'objet
    }
    
    
    function show() {
        
        //$this->getRegles() à factoriser
        $tab = array();
        foreach ($this->regles as $key => $value) {
            $tab[] = $value->transformArgsIntoArray();
        }
   
        echo "<table>";
        echo "<tr> <td>label</td> <td>agrégat</td> <td>cible de l'agrégat</td> <td>étape du parcours</td> <td>seuil</td> </tr>";
        foreach ($tab as $key1=> $element) {
            echo "<tr>";
            foreach ($element as $key => $value) {
                echo "<td>$value</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }
    
    function modify() {
        
    }

}
/*
$regle1 = new Regle("R01","SUM","CS+TM","TCBR",54);
$regle2 = new Regle("R02","SUM","CS","TCBR",32);
$regle3 = new Regle("R03","SUM","CS+TM","BR",24);

$regles = array ( $regle1, $regle2, $regle3);

$reglement1 = new reglement("règlement actuel", 1, $regles);  
$reglement1->show();
*/
    
?>