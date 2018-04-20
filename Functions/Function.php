<?php
	global $db;

	try {
		$db = new PDO('mysql:host=localhost;dbname=projetcommun;charset=utf8', 'root', '');
	} catch (PDOException $e) {

	}

	function connexion($mail, $password) {
		global $db;

		$sql = "SELECT * FROM utilisateur WHERE mailUtilisateur = :mail";

		$resultats = $db->prepare($sql);

		$resultats->bindValue("mail", $mail, PDO::PARAM_STR);

		$resultats->execute();

		$info = $resultats->fetch();

		if ($info['mdpUtilisateur'] == $password) {

			$_SESSION['password'] = $info['mdpUtilisateur'];
			$_SESSION['idUtilisateur'] = $info['idUtilisateur'];
			header('location: Accueil.php');
		} else if ($info['mdpUtilisateur'] != $password) {
			echo '<h1>password ou pseudo incorrect</h1>';
		}

	}