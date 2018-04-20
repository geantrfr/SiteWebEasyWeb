<?php
    /**
     * Created by PhpStorm.
     * User: Vince
     * Date: 20/03/2018
     * Time: 09:54
     */
    
    class UtilisateurManager extends Manager {
        public function __construct() {
            parent::__construct();
            $this->table = "Utilisateur";
            $this->object = 'Utilisateur $utilisateur';
        }
        
        public function readUtilisateur($id) {
            $result = parent::read($id);
            return new Utilisateur($result);
        }
        
        public function updateUtilisateur($adresse, $ville, $codepostal, $telephone, $id) {
            $sql = "UPDATE utilisateur SET adresseUtilisateur = :adresse,villeUtilisateur = :ville,codePostalUtilisateur = :codepostal,telUtilisateur = :telephone WHERE idUtilisateur = :id";
            $req = $this->db->prepare($sql);
            
            $req->bindValue('adresse', $adresse, PDO::PARAM_STR);
            $req->bindValue('ville', $ville, PDO::PARAM_STR);
            $req->bindValue('codepostal', $codepostal, PDO::PARAM_STR);
            $req->bindValue('telephone', $telephone, PDO::PARAM_STR);
            $req->bindValue('id', $id, PDO::PARAM_INT);
            
            $req->execute();
        }
    }