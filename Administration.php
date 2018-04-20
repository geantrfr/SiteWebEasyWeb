<?php

	session_start();

	require_once 'Autoload/autoload.php';
	include "Functions/VerificationConnexion.php";

	$nomPage = basename(__FILE__, ".php"); //récup du nom de la page
	$nomPage = strtoupper($nomPage); // Mise en Majuscule.

?>

<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <title></title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet"
          type="text/css">
    <link href="CSS/StyleMenuLeft.css" rel="stylesheet" type="text/css">
    <link href="CSS/StyleGeneral.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="container-fluid reset_margin">
	<?php echo $banniere; ?>
</div>
<section class="container_global">
	<?php echo $menuLeft; ?>

    <div class="container_right">
        <a href="GestionnaireNDF.php"><h1>Gestionnaire Notes de Frais</h1></a>
    </div>
</section>

</body>
</html>
