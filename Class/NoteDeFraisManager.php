<?php
	/**
	 * Created by PhpStorm.
	 * User: Vince
	 * Date: 20/03/2018
	 * Time: 09:58
	 */
	
	class NoteDeFraisManager extends Manager {
		
		public function __construct() {
			parent::__construct();
			$this->table = "NoteDeFrais";
		}
		
		public function readUtilisateurNDF(Utilisateur $utilisateur) {
			$sql = "SELECT * FROM " . $this->table . " WHERE idUtilisateur = :iduser";
			$req = $this->db->prepare($sql);
			
			$req->bindValue('iduser', $utilisateur->getIdUtilisateur(), PDO::PARAM_INT);
			$req->execute();
			$result = $req->fetchAll();
			
			$colNDF = [];
			
			foreach ($result as $value) {
				$colNDF[] = new NoteDeFrais($value);
			}
			
			return $colNDF;
		}
		
		public function readUtilisateurNdfDate(Utilisateur $utilisateur,$dates) {
			$sql = "SELECT * FROM " . $this->table . " WHERE idUtilisateur = :iduser AND dateSoumission = :dates ORDER BY dateSoumission";
			$req = $this->db->prepare($sql);
			
			$req->bindValue('iduser', $utilisateur->getIdUtilisateur(), PDO::PARAM_INT);
			$req->bindValue('dates', $dates, PDO::PARAM_STR);
			$req->execute();
			$result = $req->fetchAll();
			
			$colNDF = [];
			
			foreach ($result as $value) {
				$colNDF[] = new NoteDeFrais($value);
			}
			
			return $colNDF;
		}
		
		public function readAllNoteFrais() {
			$sql = "SELECT * FROM " . $this->table;
			$req = $this->db->query($sql);
			
			$result = $req->fetchAll();
			
			return $result;
		}
		
		public function readNoteFrais($id) {
			$sql = "SELECT * FROM " . $this->table . " WHERE codeFrais = $id";
			$req = $this->db->query($sql);
			
			$result = $req->fetch();
			
			return new NoteDeFrais($result);
		}
		
		public function validateNoteFrais($id) {
			
			$sql = "UPDATE " . $this->table . " SET etat = 'Validé' WHERE codeFrais = :id";
			
			$req = $this->db->prepare($sql);
			
			$req->bindValue("id", $id, PDO::PARAM_INT);
			
			$req->execute();
		}
		
		public function refuseNoteFrais($id) {
			$sql = "UPDATE " . $this->table . " SET etat = 'Refusé' WHERE codeFrais = :id";
			
			$req = $this->db->prepare($sql);
			
			$req->bindValue("id", $id, PDO::PARAM_INT);
			
			$req->execute();
		}
		
		public function deleteNoteFrais($codeFrais, $idUtilisateur) {
			
			$depenseManager = new DepenseManager();
			$depenseManager->deleteDepense($codeFrais);
			
			$sql = "DELETE FROM " . $this->table . " WHERE codeFrais = :codefrais AND idUtilisateur = :iduser";
			$req = $this->db->prepare($sql);
			$req->bindValue('codefrais', $codeFrais, PDO::PARAM_INT);
			$req->bindValue('iduser', $idUtilisateur, PDO::PARAM_INT);
			$req->execute();
			header("location: NoteFrais.php");
		}
		
		public function updateNoteFrais($id, $libelle, $date, $ville, $commentaire) {
			$sql = "UPDATE " . $this->table . " SET libelleNote = :libelle , dateFrais = :date , villeFrais = :ville , commentaireFrais = :commentaire WHERE codeFrais = :id";
			
			$req = $this->db->prepare($sql);
			
			$req->bindValue("id", $id, PDO::PARAM_INT);
			$req->bindValue("libelle", $libelle, PDO::PARAM_STR);
			$req->bindValue("date", $date, PDO::PARAM_STR);
			$req->bindValue("ville", $ville, PDO::PARAM_STR);
			$req->bindValue("commentaire", $commentaire, PDO::PARAM_STR);
			
			$req->execute();
			header("location NoteFrais.php");
		}
	}