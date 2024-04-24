<div class="container mt-5">
        <div class="row pt-3"> 
            <div class="col-9"><h2>Liste des livres</h2></div>
            <div class="col-3"><a href='index.php?uc=livre&action=add' class='btn btn-success'><i class='fa-solid fa-plus'></i>Créer un livre </a></div>


            </div>


<form action="" method="post" class="border border-primary rounded p-3 mt-3 mb-3" >
    <div class="row">
      <div class="col">
      <input type='text' name='titre' id='titre' class='form-control' placehoder='Saisir le titre' value='<?php if ($titre != ""){echo $titre;} ?>'>
       <!-- ($libelle != "")-->
      </div>
      <div class="col">
      <select name="auteur" class='form-control'> 
              <?php 
              echo "<option value='Tous'>Tous les auteurs</option>";
              foreach($LesAuteurs as $auteur){
                $auteurSel="";
                $selection=$auteur->getNum() == $auteurSel ? 'selected' : '';
                echo "<option value='".$auteur->getNum()."' $selection >".$auteur->getNom()."</option>";
              }
              ?>
              
            </select>

      </div>
      <div>
      <select name="genre" class='form-control'> 
              <?php 
              echo "<option value='Tous'>Tous les genres</option>";
              foreach($LesGenres as $genre){
                $genreSel="";
                $selection=$genre->getNum() == $genreSel ? 'selected' : '';
                echo "<option value='".$genre->getNum()."' $selection >".$genre->getLibelle()."</option>";
                
              }
              ?>
              
            </select>
      </div>
      <div class="col">
        <button type="submit" class="btn btn-warning btn-block">Rechercher </button>
      </div>
    </div>
</form>

            
        <table class="table table-hover table-striped table-dark">
        <thead>
                <tr class='d-flex'>
                <th scope="col" class="col-md-1">ISBN</th>
                <th scope="col" class="col-md-2">Titre</th>
                <th scope="col" class="col-md-1">Prix</th>
                <th scope="col" class="col-md-1">Editeur</th>
                <th scope="col" class="col-md-1">Année</th>
                <th scope="col" class="col-md-1">Langue</th>
                <th scope="col" class="col-md-2">Auteur</th>
                <th scope="col" class="col-md-1">Genre</th>
                <th scope="col" class="col-md-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($LesLivres as $livre) {
                    echo "<tr class='d-flex'>";
                    echo "<td class='col-md-1'>".$livre->getIsbn().  "</td>";
                    echo "<td class='col-md-2'>" .$livre->gettitre(). "</td>";
                    echo "<td class='col-md-1'>" .$livre->getPrix(). "</td>";
                    echo "<td class='col-md-1'>" .$livre->getEditeur(). "</td>";
                    echo "<td class='col-md-1'>" .$livre->getAnnee(). "</td>";
                    echo "<td class='col-md-1'>" .$livre->getLangue(). "</td>";
                    echo "<td class='col-md-2'>" .$livre->NomAuteur. "</td>";
                    echo "<td class='col-md-1'>" .$livre->GenreLibelle. "</td>";
                    echo "<td class='col-md-2'>
                    <a href='index.php?uc=livre&action=update&num=".$livre->getNum()."' class='btn btn-primary'><i class='fa-solid fa-pen'></i>Modifier le livre </a>
                    <a href='#supprNat' data-toggle='modal' data-msg='Voulez vous vraiment supprimer cette nationalité ?' data-suppr='index.php?uc=livre&action=delete&num=" .$livre->getNum()."' class='btn btn-danger'><i class='fa-solid fa-trash'></i>Supprimer la nationalité </a>
                    </td>";
                    echo "</tr>" ;
                }
                ?>
                

            </tbody>
            </table>
    </div>