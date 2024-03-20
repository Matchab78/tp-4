<div class="container mt-5">
<div class="row pt-3">
    <div class="col-9"><h2>Liste des auteurs</h2></div>
    <div class="col-3"><a href="index.php?uc=auteurs&action=add" class='btn btn-success'><i class="fa-solid fa-plus"></i>  Créer un auteur</a></div>
</div>

<table class="table table-hover table-striped">
  <thead>
    <tr class="d-flex">
      <th scope="col" class="col-md-2 ">Numéro</th>
      <th scope="col" class="col-md-3">Nom</th>
      <th scope="col" class="col-md-3">Prénom</th>
      <th scope="col" class="col-md-3">Nationalitée</th>
      <th scope="col" class="col-md-2">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    foreach($lesAuteurs as $auteur) { 
        echo "<tr class='d-flex'>";
        echo "<td class='col-md-2'>".$auteur->num."</td>";
        echo "<td class='col-md-3'>".$auteur->nom."</td>";
        echo "<td class='col-md-3'>".$auteur->prenom."</td>";
        echo "<td class='col-md-3'>".$auteur->libelle."</td>";
        echo "<td class='col-md-2'>
           <a href='index.php?uc=auteurs&action=update&num=".$auteur->num."' class='btn btn-dark'><i class='fa-solid fa-pen'></i></a>
           <a href='#modalSupp' data-toggle='modal' data-message='Suppression de l\'auteur ?'data-suppression='index.php?uc=auteurs&action=delete&num=".$auteur->num."' class='btn btn-danger'><i class='fa-solid fa-trash-alt'></i></a>
        </td>";
        echo "</tr>";
    }
    //supprimerNationalite.php?num=$nationalite->num
    ?>
  </tbody>
</table>
