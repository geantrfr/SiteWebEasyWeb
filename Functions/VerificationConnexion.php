<?php
    
    $utilisateurManager = new UtilisateurManager();
    $utilisateur = $utilisateurManager->readUtilisateur($_SESSION['idUtilisateur']);
    
    if (!isset($_SESSION['idUtilisateur']) && !isset($_SESSION['password'])) {
        header("location: Login.php");
    } else {
        
        $gestionnaire = '';
        
        $statut = $utilisateur->getTypeCompte();
        
        if ($statut == "Comptable") {
            $gestionnaire = "<li><a href='Administration.php'>Administration</a></li>";
        }
        
        $modeleHTML = file_get_contents("Template/leftmenu.html");
        
        $identifiant = $utilisateur->getPrenomUtilisateur() . " " . $utilisateur->getNomUtilisateur();
        
        $arrValues = ['{{name}}' => $identifiant, '{{id}}' => $utilisateur->getIdUtilisateur(), '{{gestionnaire}}' => $gestionnaire];
        
        $menuLeft = strtr($modeleHTML, $arrValues);
    }