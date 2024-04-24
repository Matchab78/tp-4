<?php 
require_once 'modeles/Livre.php';
$action=$_GET['action'];
switch ($action) {
    case 'list':
        $titre = "";
        $LesAuteurs=Auteur::findAll();
        $LesLivres = Livre::findAll(); 
        $LesGenres=Genre::findAll();
        include('vues/listeLivre.php');
        break;
    case 'add':
        $LesAuteurs=Auteur::findAll();
        $LesGenres=Genre::findAll();
        $mode = "Ajouter";
        include('vues/formLivre.php');
        break;
    case 'update':
        $LesAuteurs=Auteur::findAll();
        $LesGenres=Genre::findAll();
        $mode = "Modifier";
        $livre = Livre::findById($_GET['num']); 
        include('vues/formLivre.php');
        break;
    case 'delete':
        $livre = Livre::findById($_GET['num']); 
        $nb = Livre::delete($livre);
        if ($nb == 1) {
            $_SESSION['message'] = ["success" => "Le livre a bien été $message"];
        } else {
            $_SESSION['message'] = ["danger" => "Le livre n'a pas bien été $message"];
        }
        header('location: index.php?uc=livre&action=list');
        exit();
        break;
    case 'valideForm':
        $livre = new Livre();
        if (empty($_POST['num'])) 
        {
            $livre->setTitre($_POST['titre']);
            $nb = Livre::add($livre);
            $message = "ajouté";
        } else { 
            $livre->setNum($_POST['num']);
            $livre->setTitre($_POST['titre']);
            $nb = Livre::update($livre);
            $message = "modifié";
        }
        if ($nb == 1) {
            $_SESSION['message'] = ["success" => "Le livre a bien été $message"];
        } else {
            $_SESSION['message'] = ["danger" => "Le livre n'a pas été $message"];
        }
        header('location: index.php?uc=livre&action=list');
        break;
}
?>