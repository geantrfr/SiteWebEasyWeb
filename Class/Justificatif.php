<?php
/**
 * Created by PhpStorm.
 * User: Vince
 * Date: 20/03/2018
 * Time: 09:34
 */

class Justificatif extends Entity
{
    private $idJustificatif;
    private $titreJustificatif;
    private $urlJustificatif;
    private $idDepense;
    private $codeFrais;

    public function __construct($values)
    {
        parent::__construct($values);
    }


}