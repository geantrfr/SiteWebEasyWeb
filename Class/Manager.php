<?php
/**
 * Created by PhpStorm.
 * User: Vince
 * Date: 20/03/2018
 * Time: 09:53
 */

abstract class Manager
{
    protected $db;
    protected $table;
    protected $champs = [];
    protected $object;

    public function __construct($mode = 'dev')
    {

        if ($mode == 'dev') {
            /*$this->db = new PDO('mysql:host=e91099-mysql.services.easyname.eu;dbname=u143944db1;charset=utf8', 'u143944db1', '12345678*',
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));*/
			$this->db = new PDO('mysql:host=localhost;dbname=projetcommun;charset=utf8', 'root', '',
				array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } else {
            $this->db = new PDO('mysql:host=e91099-mysql.services.easyname.eu;dbname=u143944db1;charset=utf8', 'u143944db1', '12345678*');
        }
    }

    public function read($id){
		$sql = "SELECT * FROM " . $this->table . " WHERE idUtilisateur = :id";
		$req = $this->db->prepare($sql);
		$req->bindValue('id', $id, PDO::PARAM_INT);
		$req->execute();
		$result = $req->fetch();

		return $result;
	}

    public function getAll()
    {
        $sql = "SELECT * FROM " . $this->table;
        $req = $this->db->query($sql);
        $resultats = $req->fetchAll();
        return $resultats;
    }

    public function delete($object)
    {
        $sql = "DELETE FROM " . $this->table . " WHERE idUtilisateur = :id";
        $req = $this->db->prepare($sql);
        $req->bindValue('id', $object->getId(), PDO::PARAM_INT);
        $req->execute();
    }
}