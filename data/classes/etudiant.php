<?php

/**
 * Created by PhpStorm.
 * User: adam
 * Date: 29/04/17
 * Time: 14:53
 */
class etudiant
{
    private $numero;
    private $nom;
    private $prenom;
    private $admission;
    private $filiere;

    /**
     * etudiant constructor.
     * @param $numero
     * @param $nom
     * @param $prenom
     * @param $admission
     * @param $filiere
     */
    public function __construct($numero, $nom, $prenom, $admission, $filiere)
    {
        $this->setNumero($numero);
        $this->setNom($nom);
        $this->setPrenom($prenom);
        $this->setAdmission($admission);
        $this->setFiliere($filiere);
    }

    /**
     * @return int
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * @param numero etudiant
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
    }

    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getAdmission()
    {
        return $this->admission;
    }

    /**
     * @param string "TC" or "BR"
     */
    public function setAdmission($admission)
    {
        if(strcasecmp($admission, "TC") == 0)
            $this->admission = "TC";
        elseif(strcasecmp($admission, "BR") == 0)
            $this->admission = "BR";
        else {
            $this->admission = null;
            echo("Erreur setAdmission");
        }
    }

    /**
     * @return mixed
     */
    public function getFiliere()
    {
        return $this->filiere;
    }

    /**
     * @param mixed $filiere
     */
    public function setFiliere($filiere)
    {
        if(strcasecmp($filiere, "?") == 0)
            $this->filiere = "?";
        elseif(strcasecmp($filiere, "MPL") == 0)
            $this->filiere = "MPL";
        elseif(strcasecmp($filiere, "MSI") == 0)
            $this->filiere = "MSI";
        elseif(strcasecmp($filiere, "MRI") == 0)
            $this->filiere = "MRI";
        elseif(strcasecmp($filiere, "LIB") == 0)
            $this->filiere = "LIB";
        else {
            $this->filiere = null;
            echo("La valeur du champ Filiere n'a pas été reconnu");

        }
    }

    function __toString()
    {
        $stringEtu = $this->getNom()." ".$this->getPrenom()." - ".$this->getNumero()." - ".$this->getFiliere();
        return  $stringEtu;
    }


}