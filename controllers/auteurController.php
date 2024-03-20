<?php
$action=$_GET['action'];
switch($action){
    case 'list' :
        $lesAuteurs=Auteur::findAll();
        include('vues/listeAuteur.php');
    break;

    case 'add' :
        $mode="Ajouter";
        include('vues/formAuteur.php');
    break;

    case 'update' :
        $mode="Modifier";
        $auteur=Auteur::findById($_GET['num']);
        include('vues/formAuteur.php');
    break;

    case 'delete' :
        $auteur=Auteur::findById($_GET['num']);
        $nb=Auteur::delete($auteur);
        if($nb==1){
            $_SESSION['message']=['success'=>'l\'auteur a bien été supprimé'];
        }else{
            $_SESSION['message']=['danger'=>"l\'auteur n'a pas été supprimé"];
        }
        header('location: index.php?uc=auteurs&action=list');
        exit();
    break;

    case 'valideForm' :
        $auteur= new Auteur();
        if(empty($_POST['num'])){ //cas création
            $auteur->getLibelle($_POST['libelle']);
            $nb=Auteur::add($auteur);
            $message = "ajouté";
        }else{ //cas modif
            $auteur->getNum($_POST['num']);
            $auteur->getLibelle($_POST['libelle']);
            $nb=Auteur::update($auteur);
            $message = "modifié";
        }
        if($nb==1){
            $_SESSION['message']=['success'=>"l\'auteur a bien été $message"];
        }else{
            $_SESSION['message']=['danger'=>"l\'auteur a bien été $message"];
        }
        header('location: index.php?uc=auteurs&action=list');
        exit();
    break;

}

?>