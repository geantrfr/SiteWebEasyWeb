<?php
	
	session_start();
	
	require_once 'Autoload/autoload.php';
	include "Functions/VerificationConnexion.php";
	
	$nomPage = basename(__FILE__, ".php"); //récup du nom de la page
	$nomPage = strtoupper($nomPage); // Mise en Majuscule.
	
	$noteFraisManager = new NoteDeFraisManager();
	
	$listing = "";
	$modification = "";
	
	$utilisateur = $utilisateurManager->readUtilisateur($utilisateur->getIdUtilisateur());
	$modeleHTML = file_get_contents('Template/listemesnotefrais.html');
	
	foreach ($utilisateur->getCollNoteDeFrais() as $value) {
		
		$id = $value->getCodeFrais();
		
		// modif pour les testes ---------------------------------- //
		$statut = $value->getEtat();
		
		if ($statut == 'Validé') {
			$statut = 'table-success';
		}
		if ($statut == 'Refusé') {
			$statut = 'table-danger';
		}
		
		if ($statut == 'En Cours') {
			$action = "<a href='NoteFrais.php?modif=$id'>Modifier</a> <br> <a href='NoteFrais.php?suppr=$id'>Supprimer</a>";
		} else {
			$action = '';
		}
		
		$arrValues = [
			'{{etat}}' => $statut, // Ajouter pour la couleur de la ligne.
			'{{idndf}}' => $value->getCodeFrais(),
			'{{libelle}}' => $value->getLibelleNote(),
			'{{date}}' => $value->getDateFrais(),
			'{{datesoumission}}' => $value->getDateSoumission(),
			'{{ville}}' => $value->getVilleFrais(),
			'{{commentaire}}' => $value->getCommentaireFrais(),
			'{{statut}}' => $value->getEtat(),
			'{{action}}' => $action
		];
		$listing .= strtr($modeleHTML, $arrValues);
	}
	
	if (isset($_GET['suppr'])) {
		$idNDF = $_GET['suppr'];
		$noteFraisManager->deleteNoteFrais($idNDF, $utilisateur->getIdUtilisateur());
		
	}
	
	if (isset($_GET['modif'])) {
		$idNDF = $_GET['modif'];
		$noteByID = $noteFraisManager->readNoteFrais($idNDF);
		
		var_dump($noteByID);
		
		if ($noteByID->getEtat() == "En Cours") {
			
			$formulaireModif = new Formulaire("post", "");
			$formulaireModif->inputText("Libelle", "text", "", $noteByID->getLibelleNote(), "", "Libellé");
			$formulaireModif->inputText("Date", 'date', "", $noteByID->getDateFrais(), "", "Date Frais");
			$formulaireModif->inputText("Ville", "text", "", $noteByID->getVilleFrais(), "", "Ville");
			$formulaireModif->inputText("Commentaire", "text", "", $noteByID->getCommentaireFrais(), "", "Commentaire");
			$formulaireModif->submit("Valider", "Valider", "");
			$modification = $formulaireModif->renderLoginPage();
			
			if (isset($_POST['Libelle']) && isset($_POST['Date']) && isset($_POST['Ville']) && isset($_POST['Commentaire'])) {
				$libelle = $_POST['Libelle'];
				$date = $_POST['Date'];
				$ville = $_POST['Ville'];
				$commentaire = $_POST['Commentaire'];
				
				$noteFraisManager->updateNoteFrais($idNDF, $libelle, $date, $ville, $commentaire);
				header("location: NoteFrais.php");
			}
		} else {
			$modification = "";
		}
	}

?>

<!DOCTYPE html>

<html>
	<head>
		<meta charset="UTF-8">
		<title>EEw NoteDeFrais</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet"
		      type="text/css">
		<link href="CSS/StyleMenuLeft.css" rel="stylesheet" type="text/css">
		<link href="CSS/StyleGeneral.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div class="container-fluid reset_margin">
			<?php echo $banniere; ?>
		</div>
		
		<section class="container-fluid reset_margin">
			<div class="row">
				<div class="col-sm-3">
					<?php echo $menuLeft; ?>
				</div>
				<div class="col-sm-9 table-striped margin_formulaire">
					<h1>Notes de Frais en cours</h1>
					
					<table class="table table-responsive-md">
						<thead>
						<tr>
							<th>Libellé</th>
							<th>Date</th>
							<th>Soumit le</th>
							<th>Ville</th>
							<th>Commentaire</th>
							<th>Statut</th>
							<th>Action</th>
							<th>Détails</th>
						</tr>
						</thead>
						<tbody>
						<?php echo $listing; ?>
						</tbody>
					</table>
				</div>
			</div>
		</section>
	</body>
</html>
