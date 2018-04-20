<?php
/**
 * Created by PhpStorm.
 * User: Vince
 * Date: 20/03/2018
 * Time: 09:57
 */

class JustificatifManager extends Manager
{
    public function __construct()
    {
        parent::__construct();
        $this->table = "Justificatif";
    }
	
	public function deleteJustificatif($idDepense) {
		$sql = "DELETE FROM " . $this->table . " WHERE codeFrais = :id";
		$req = $this->db->prepare($sql);
		$req->bindValue("id",$idDepense,PDO::PARAM_INT);
		$req->execute();
	}
}