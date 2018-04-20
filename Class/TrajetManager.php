<?php
/**
 * Created by PhpStorm.
 * User: Vince
 * Date: 20/03/2018
 * Time: 09:59
 */

class TrajetManager extends DepenseManager
{
    public function __construct(){
        parent::__construct();
        $this->table = "Trajet";
    }
	
	public function deleteTrajet($idNDF) {
		$sql = "DELETE FROM " . $this->table . " WHERE codeFrais = :id";
		$req = $this->db->prepare($sql);
		$req->bindValue("id",$idNDF,PDO::PARAM_INT);
		$req->execute();
	}
}