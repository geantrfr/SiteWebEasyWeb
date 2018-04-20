<?php
	/**
	 * Created by PhpStorm.
	 * User: Vince
	 * Date: 20/03/2018
	 * Time: 09:56
	 */
	
	class DepenseManager extends Manager {
		public function __construct() {
			parent::__construct();
			$this->table = "Depense";
		}
		
		public function readIdDepense($idNDF) {
			$sql = "SELECT idDepense FROM " . $this->table . " WHERE codeFrais = $idNDF";
			$req = $this->db->query($sql);
			
			$result = $req->fetch();
			
			return $result;
		}
		
		public function deleteDepense($idNDF) {
			
			$fraisManager = new FraisManager();
			$fraisManager->deleteFrais($idNDF);
			
			$trajetManager = new TrajetManager();
			$trajetManager->deleteTrajet($idNDF);
			
			$justificatifManager = new JustificatifManager();
			$justificatifManager->deleteJustificatif($idNDF);
			
			$sql = "DELETE FROM " . $this->table . " WHERE codeFrais = :codefrais";
			$req = $this->db->prepare($sql);
			$req->bindValue('codefrais',$idNDF, PDO::PARAM_INT);
			$req->execute();
		}
	}