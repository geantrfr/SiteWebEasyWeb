<?php
/**
 * Created by PhpStorm.
 * User: Vince
 * Date: 20/03/2018
 * Time: 10:00
 */

class FraisManager extends DepenseManager
{
    public function __construct()
    {
        parent::__construct();
        $this->table = "Frais";
    }
    
    public function selectDepenseFrais($id) {
    }
    
    public function deleteFrais($idNDF) {
        $sql = "DELETE FROM " . $this->table . " WHERE codeFrais = :id";
        $req = $this->db->prepare($sql);
        $req->bindValue("id",$idNDF,PDO::PARAM_INT);
        $req->execute();
    }
}