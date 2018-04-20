<?php
	
	session_start();
	
	require_once 'Autoload/autoload.php';
	include 'Functions/Function.php';
	
	$nomPage = basename(__FILE__, ".php"); //récup du nom de la page
	$nomPage = strtoupper($nomPage); // Mise en Majuscule.
	
	if (!isset($_SESSION['mail']) && !isset($_SESSION['password']) OR !isset($_COOKIE['Mail_Login_EasyWeb']) && !isset($_COOKIE['Password_Login_EasyWeb'])) {
		
		if (isset($_COOKIE['Mail_Login_EasyWeb']) && isset($_COOKIE['Password_Login_EasyWeb'])) {
			$mail = $_COOKIE['Mail_Login_EasyWeb'];
			$password = $_COOKIE['Password_Login_EasyWeb'];
		} else {
			$mail = "";
			$password = "";
		}
		
		$formulaireLogin = new Formulaire("post", "container_login_ask");
		$formulaireLogin->inputText("Email", "mail", "field_login", $mail, "Email", "");
		$formulaireLogin->inputText("Password", "Password", "field_login", $password, "Password", "");
		$formulaireLogin->submit("Valider", "Valider", "bottum_validation_login");
		$formulaireLogin->checkBox("Savelog", "savelog", "Se souvenir de moi", "container_valid_log");
		
		$login = $formulaireLogin->renderLoginPage();
		
		if (isset($_POST['Email']) && isset($_POST['Password'])) {
			if (isset($_POST['Savelog'])) {
				setcookie('Mail_Login_EasyWeb', $_POST['Email'], time() + 365 * 24 * 3600, null, null, false, true);
				setcookie('Password_Login_EasyWeb', $_POST['Password'], time() + 365 * 24 * 3600, null, null, false, true);
			}
			$mail = $_POST['Email'];
			$password = $_POST['Password'];
			connexion($mail, $password);
		}
	} else {
		header("location: Accueil.php");
	}

?>

<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <title>EEW-Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet"
          type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="CSS/StyleGeneral.css" rel="stylesheet" type="text/css">
    <link href="CSS/StyleFormulaire.css" rel="stylesheet" type="text/css"/>

</head>
<body>
<div class="container-fluid reset_margin">

	<?php
		include 'Template/banniere.html';
		echo $login;
	?>

</div>
</body>
</html>