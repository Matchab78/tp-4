<?php
$action=$_GET['action'];
switch($action){
    case 'list' :
        $lesContinents=Continent::findAll();
        $lesNationalites=Nationalite::findAll();
        include('vues/listeNationalite.php');
    break;

    case 'add' :
        $mode="Ajouter";
        $lesContinents=Continent::findAll();
        include('vues/formNationalite.php');
    break;

    case 'update' :
        $mode="Modifier";
        $nationalite=Nationalite::findById($_GET['num']);
        $lesContinents=Continent::findAll();
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
            $cont=Continent::findById(intval($_POST['continent']));
            $nationalite->setNumContinent($cont);
            $nb=Nationalite::add($nationalite);
            $message = "ajouté";
        }else{ //cas modif
            $nationalite->setNum($_POST['num']);
            $nationalite->setLibelle($_POST['libelle']);
            $cont=Continent::findById(intval($_POST['continent']));
            $nationalite->setNumContinent($cont);
            $nb=Nationalite::update($nationalite);
            $message = "modifié";
        }
        if($nb==1){
            $_SESSION['message']=['success'=>"la nationalitée a bien été $message"];
        }else{
            $_SESSION['message']=['danger'=>"la nationalitée a bien été $message"];
        }
        die;
        header('location: index.php?uc=nationalites&action=list');
        exit();
    break;

}

?>