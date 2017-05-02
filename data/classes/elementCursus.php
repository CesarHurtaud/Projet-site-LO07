<?php

/**
 * Created by PhpStorm.
 * User: adam
 * Date: 02/05/17
 * Time: 16:50
 */
class elementCursus
{
    private $sem_seq;
    private $sem_label;
    private $sigle;
    private $categorie;
    private $affectation;
    private $utt;
    private $profil;
    private $credit;
    private $resultat;

    /**
     * elementCursus constructor.
     * @param $sem_seq
     * @param $sem_label
     * @param $sigle
     * @param $categorie
     * @param $affectation
     * @param $utt
     * @param $profil
     * @param $credit
     */
    public function __construct($sem_seq, $sem_label, $sigle, $categorie, $affectation, $utt, $profil, $credit)
    {
        $this->setSemSeq($sem_seq);
        $this->setSemLabel($sem_label);
        $this->setSigle($sigle);
        $this->setCategorie($categorie);
        $this->setAffectation($affectation);
        $this->setUtt($utt);
        $this->setProfil($profil);
        $this->setCredit($credit);
    }

    /**
     * @return mixed
     */
    public function getSemSeq()
    {
        return $this->sem_seq;
    }

    /**
     * @param mixed $sem_seq
     */
    public function setSemSeq($sem_seq)
    {
        if(gettype($sem_seq) == "integer")
            $this->sem_seq = $sem_seq;
        else{
            $this->sem_seq = null;
        }
    }

    /**
     * @return mixed
     */
    public function getSemLabel()
    {
        return $this->sem_label;
    }

    /**
     * @param mixed $sem_label
     */
    public function setSemLabel($sem_label)
    {
        $this->sem_label = $sem_label;
    }

    /**
     * @return mixed
     */
    public function getSigle()
    {
        return $this->sigle;
    }

    /**
     * @param mixed $sigle
     */
    public function setSigle($sigle)
    {
        $this->sigle = $sigle;
    }

    /**
     * @return mixed
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * @param mixed $categorie
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    }

    /**
     * @return mixed
     */
    public function getAffectation()
    {
        return $this->affectation;
    }

    /**
     * @param mixed $affectation
     */
    public function setAffectation($affectation)
    {
        $this->affectation = $affectation;
    }

    /**
     * @return mixed
     */
    public function getUtt()
    {
        return $this->utt;
    }

    /**
     * @param mixed $utt
     */
    public function setUtt($utt)
    {
        if(strcasecmp($utt, "Y") == 0)
            $this->utt = "Y";
        elseif(strcasecmp($utt, "N") == 0)
            $this->utt = "N";
        else $this->utt = null;
    }

    /**
     * @return mixed
     */
    public function getProfil()
    {
        return $this->profil;
    }

    /**
     * @param mixed $profil
     */
    public function setProfil($profil)
    {
        if(strcasecmp($profil, "Y") == 0)
            $this->profil = "Y";
        elseif(strcasecmp($profil, "N") == 0)
            $this->profil = "N";
        else $this->profil = null;
    }

    /**
     * @return mixed
     */
    public function getCredit()
    {
        return $this->credit;
    }

    /**
     * @param mixed $credit
     */
    public function setCredit($credit)
    {
        $this->credit = $credit;
    }

    /**
     * @return mixed
     */
    public function getResultat()
    {
        return $this->resultat;
    }

    /**
     * @param mixed $resultat
     */
    public function setResultat($resultat)
    {
        $this->resultat = $resultat;
    }


}