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
    <title>EEw Statistiques</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet"
          type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="CSS/StyleGeneral.css" rel="stylesheet" type="text/css">
    <link href="CSS/StyleMenuLeft.css" rel="stylesheet" type="text/css">

</head>
<body>
<div class="container-fluid reset_margin">
	<?php echo $banniere; ?>
</div>

<section class="container reset_margin">
    <div class="row">
        <div
        = class="col-md-4">
		<?php echo $menuLeft; ?>
    </div>
</section>
</body>
</html>