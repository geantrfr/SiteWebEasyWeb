<?php
/**
 * Created by PhpStorm.
 * User: Vince
 * Date: 20/03/2018
 * Time: 09:38
 */

class NoteDeFrais extends Entity
{
    private $codeFrais;
    private $libelleNote;
    private $dateFrais;
    private $villeFrais;
    private $dateSoumission;
    private $commentaireFrais;
    private $etat;
    private $idUtilisateur;
    private $idClient;

    public function __construct($values)
    {
        parent::__construct($values);
    }
    
    /**
     * @return mixed
     */
    public function getEtat() {
        return $this->etat;
    }
    
    /**
     * @param mixed $etat
     */
    public function setEtat($etat) {
        $this->etat = $etat;
    }



    /**
     * @param mixed $libelleNote
     */
    public function setLibelleNote($libelleNote)
    {
        $this->libelleNote = $libelleNote;
    }

    /**
     * @param mixed $codeFrais
     */
    public function setCodeFrais($codeFrais)
    {
        $this->codeFrais = $codeFrais;
    }

    /**
     * @param mixed $dateFrais
     */
    public function setDateFrais($dateFrais)
    {
        $this->dateFrais = $dateFrais;
    }

    /**
     * @param mixed $villeFrais
     */
    public function setVilleFrais($villeFrais)
    {
        $this->villeFrais = $villeFrais;
    }

    /**
     * @param mixed $dateSoumission
     */
    public function setDateSoumission($dateSoumission)
    {
        $this->dateSoumission = $dateSoumission;
    }

    /**
     * @param mixed $commentaireFrais
     */
    public function setCommentaireFrais($commentaireFrais)
    {
        $this->commentaireFrais = $commentaireFrais;
    }

    /**
     * @param mixed $idUtilisateur
     */
    public function setIdUtilisateur($idUtilisateur)
    {
        $this->idUtilisateur = $idUtilisateur;
    }

    /**
     * @param mixed $idClient
     */
    public function setIdClient($idClient)
    {
        $this->idClient = $idClient;
    }


    /**
     * @return mixed
     */
    public function getCodeFrais()
    {
        return $this->codeFrais;
    }

    /**
     * @return mixed
     */
    public function getLibelleNote()
    {
        return $this->libelleNote;
    }

    /**
     * @return mixed
     */
    public function getDateFrais()
    {
        return $this->dateFrais;
    }

    /**
     * @return mixed
     */
    public function getVilleFrais()
    {
        return $this->villeFrais;
    }

    /**
     * @return mixed
     */
    public function getDateSoumission()
    {
        return $this->dateSoumission;
    }

    /**
     * @return mixed
     */
    public function getCommentaireFrais()
    {
        return $this->commentaireFrais;
    }

    /**
     * @return mixed
     */
    public function getIdUtilisateur()
    {
        return $this->idUtilisateur;
    }

    /**
     * @return mixed
     */
    public function getIdClient()
    {
        return $this->idClient;
    }




}