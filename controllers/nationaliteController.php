<?php
$action=$_GET['action'];
switch($action){
    case 'list' :
        $lesNationalites=Nationalite::findAll();
        include('vues/listeNationalite.php');
    break;

    case 'add' :
        $mode="Ajouter";
        include('vues/formNationalite.php');
    break;

    case 'update' :
        $mode="Modifier";
        $continent=Nationalite::findById($_GET['num']);
        include('vues/formNationalite.php');
    break;

    case 'delete' :
        $nationalite=Nationalite::findById($_GET['num']);
        $nb=Nationalite::delete($nationalite);
        if($nb==1){
            $_SESSION['message']=['success'=>'la nationalitée a bien été supprimé'];
        }else{
            $_SESSION['message']=['danger'=>"la nationalitee n'a pas été supprimé"];
        }
        header('location: index.php?uc=nationalites&action=list');
        exit();
    break;

    case 'valideForm' :
        $nationalite= new Nationalite();
        if(empty($_POST['num'])){ //cas création
            $nationalite->setLibelle($_POST['libelle']);
            $nb=Nationalite::add($nationalite);
            $message = "ajouté";
        }else{ //cas modif
            $nationalite->getNum($_POST['num']);
            $nationalite->getLibelle($_POST['libelle']);
            $nb=Nationalite::update($nationalite);
            $message = "modifié";
        }
        if($nb==1){
            $_SESSION['message']=['success'=>"la nationalitée a bien été $message"];
        }else{
            $_SESSION['message']=['danger'=>"la nationalitée a bien été $message"];
        }
        header('location: index.php?uc=nationalites&action=list');
        exit();
    break;

}

?>