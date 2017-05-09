<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class regle {
    
    //private $id;
    private $label;
    private $agregat;
    private $cible;
    private $affectation;
    private $seuil;
    

    /*function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }
    */
    function getLabel() {
        return $this->label;
    }

    function getAgregat() {
        return $this->agregat;
    }

    function getCible() {
        return $this->cible;
    }

    function getAffectation() {
        return $this->affectation;
    }

    function getSeuil() {
        return $this->seuil;
    }

    function setLabel($label) {
        $this->label = $label;
    }

    function setAgregat($agregat) {
        $this->agregat = $agregat;
    }

    function setCible($cible) {
        $this->cible = $cible;
    }

    function setAffectation($affectation) {
        $this->affectation = $affectation;
    }

    function setSeuil($seuil) {
        $this->seuil = $seuil;
    }
    
    public function transformArgsIntoArray() {
        return get_object_vars($this);
    }
    
    function __construct($label,$agregat,$cible,$affectation,$seuil) {
        //echo "règle construite : $label " </br>\n";
        $this->setLabel($label);
        $this->setAgregat($agregat);
        $this->setcible($cible);
        $this->setAffectation($affectation);
        $this->setSeuil($seuil);
            
    }
    
    function __destruct() {
        
    }
    
    function __tostring() {
        return  ">> Règle : ($this->label,$this->agregat,$this->cible,$this->affectation,$this->seuil)";
    }

}

?>