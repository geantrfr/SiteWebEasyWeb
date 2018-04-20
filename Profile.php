<?php

	session_start();

	require_once "Autoload/autoload.php";
	include "Functions/VerificationConnexion.php";

	$nomPage = basename(__FILE__, ".php"); //récup du nom de la page
	$nomPage = strtoupper($nomPage); // Mise en Majuscule.

	$informationutilisateur = "";

	if (isset($_GET['modif'])) {
		if ($_GET['modif'] == "true") {
			$formulaireModif = new Formulaire("post", "");
			$formulaireModif->inputText("Adresse", "text", "", $utilisateur->getAdresseUtilisateur(), "", "Adresse");
			$formulaireModif->inputText("Ville", "text", "", $utilisateur->getVilleUtilisateur(), "", "Ville");
			$formulaireModif->inputText("CodePostal", "text", "", $utilisateur->getCodePostalUtilisateur(), "", "Code Postal");
			$formulaireModif->inputText("Telephone", "text", "", $utilisateur->getTelUtilisateur(), "", "Telephone");
			$formulaireModif->submit("Valider", "Valider", "");
			$infoUser = $formulaireModif->renderLoginPage();

			if (isset($_POST["Adresse"]) && isset($_POST["Ville"]) && isset($_POST["CodePostal"]) && isset($_POST["Telephone"])) {
				$mail = $_POST["Email"];
				$adresse = $_POST["Adresse"];
				$ville = $_POST["Ville"];
				$codePostal = $_POST["CodePostal"];
				$telephone = $_POST["Telephone"];

				$utilisateurManager->updateUtilisateur($adresse, $ville, $codePostal, $telephone, $utilisateur->getIdUtilisateur());
				header("location: Profile.php");
			}
		}
	} else {
		$modelProfil = file_get_contents("Template/informationutilisateur.html");

		$arrvalues = ['{{prenom}}' => $utilisateur->getPrenomUtilisateur(), '{{nom}}' => $utilisateur->getNomUtilisateur(), '{{mail}}' => $utilisateur->getMailUtilisateur(), '{{adresse1}}' => $utilisateur->getAdresseUtilisateur(), '{{adresse2}}' => $utilisateur->getCodePostalUtilisateur() . " " . $utilisateur->getVilleUtilisateur(), '{{telephone}}' => $utilisateur->getTelUtilisateur()];

		$infoUser = strtr($modelProfil, $arrvalues);
	}

?>

<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <title>EEw Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet"
          type="text/css">
    <link href="CSS/StyleGeneral.css" rel="stylesheet" type="text/css">
    <link href="CSS/StyleMenuLeft.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="container-fluid reset_margin">
	<?php echo $banniere; ?>

    <section class="container reset_margin">
        <div class="row">
            <div class="col-md-4">
				<?php echo $menuLeft; ?>
            </div>

            <div class="row">
                <div class="col-md-6 container_right">
                    <div class="profile_information_container">
						<?php echo $infoUser; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</body>
</html>
