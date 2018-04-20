<?php
    
    session_start();
    
    require_once 'Autoload/autoload.php';
    include "Functions/VerificationConnexion.php";

	$nomPage = basename(__FILE__, ".php"); //récup du nom de la page
	$nomPage = strtoupper($nomPage); // Mise en Majuscule.
    
    $noteFraisManager = new NoteDeFraisManager();
    $noteFrais = $noteFraisManager->readAllNoteFrais();
    
    $listing = "";
    $action = "";
    
    $infouser = file_get_contents("Template/listenotefrais.html");
    $allNDF = "";
    
    foreach ($noteFrais as $key => $value) {
    
        $id = $value['codeFrais'];
        $user = $utilisateurManager->readUtilisateur($value['idUtilisateur']);
        
        if ($value['etat'] == "En Cours") {
            $action = "<a href='GestionnaireNDF?validate=$id'>Valider</a> || <a href='GestionnaireNDF?refuse=$id'>Refuser</a>";
        } else {
            $action = "";
        }
        
        $arrValues = ['{{libelle}}' => $value['libelleNote'],
            '{{date}}' => $value['dateFrais'],
            '{{datesoumission}}' => $value['dateSoumission'],
            '{{ville}}' => $value['villeFrais'],
            '{{commentaire}}' => $value['commentaireFrais'],
            '{{statut}}' => $value['etat'],
            '{{commercial}}' => $user->getNomUtilisateur() . " " . $user->getPrenomUtilisateur(),
            '{{action}}' => $action];
        
        $listing .= strtr($infouser, $arrValues);
    }
    
    if (isset($_GET['validate'])) {
        $id = $_GET['validate'];
        $noteFraisManager->validateNoteFrais($id);
        header("location: GestionnaireNDF.php");
    }
    
    if (isset($_GET['refuse'])) {
        $id = $_GET['refuse'];
        $noteFraisManager->refuseNoteFrais($id);
        header("location: GestionnaireNDF.php");
    }
    
    if (isset($_GET['details'])) {
        $id = $_GET['details'];
        
    }

?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset = "UTF-8">
        <title></title>
        <link href = "https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel = "stylesheet"
              type = "text/css">
        <link href = "CSS/StyleMenuLeft.css" rel = "stylesheet" type = "text/css">
        <link href = "CSS/StyleGeneral.css" rel = "stylesheet" type = "text/css">
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
                    <h1>Gestion des Notes de Frais</h1>

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