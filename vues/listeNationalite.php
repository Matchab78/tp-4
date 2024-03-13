<div class="container mt-5">
<div class="row pt-3">
    <div class="col-9"><h2>Liste des nationalités</h2></div>
    <div class="col-3"><a href="index.php?uc=nationalites&action=add" class='btn btn-success'><i class="fa-solid fa-plus"></i>  Créer une nationalitée</a></div>
</div>

<table class="table table-hover table-striped">
  <thead>
    <tr class="d-flex">
      <th scope="col" class="col-md-2">Numéro</th>
      <th scope="col" class="col-md-4">Libellé</th>
      <th scope="col" class="col-md-4">Continent</th>
      <th scope="col" class="col-md-2">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach($lesNationalites as $nationalite){
        echo "<tr class='d-flex'>";
        echo "<td class='col-md-2'>".$nationalite->numero."</td>";
        echo "<td class='col-md-4'>".$nationalite->libNation."</td>";
        echo "<td class='col-md-4'>".$nationalite->libContinent."</td>";
        echo "<td class='col-md-2'>
            <a href='index.php?uc=nationalites&action=update&num=".$nationalite->numero."' class='btn btn-dark'><i class='fa-solid fa-pen'></i></a>
            <a href='#modalSupp' data-toggle='modal' data-message='Suppression du continent ?'data-suppression='index.php?uc=nationalites&action=delete&num=".$nationalite->numero."' class='btn btn-danger'><i class='fa-solid fa-trash-alt'></i></a>
        </td>";
        echo "</tr>";
    }
    //supprimerNationalite.php?num=$nationalite->num
    ?>
  </tbody>
</table>
