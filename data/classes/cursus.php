<?php

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
    public function getEtudiant()
    {
        return $this->etudiant;
    }

    /**
     * @param mixed $etudiant
     */
    public function setEtudiant(etudiant $etudiant)
    {
        $this->etudiant = $etudiant;
    }



}