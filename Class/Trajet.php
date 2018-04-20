<?php
/**
 * Created by PhpStorm.
 * User: Vince
 * Date: 20/03/2018
 * Time: 09:42
 */

class Trajet extends Depense
{
	private $libelleTrajet;
    private $dureeTrajet;
    private $villeDepart;
    private $villeArrivee;
    private $dateAller;
    private $dateRetour;
    private $distanceKilometres;
    private $idDepense;
    private $codeFrais;

    public function __construct($values)
    {
        parent::__construct($values);

    }
}