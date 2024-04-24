<div class='container mt-5'>
    <h2 class='pt-3 text-center'> <?php echo $mode ?> un livre</h2>
    <form action='index.php?uc=livre&action=valideForm<?php echo $mode ?>' method='post' class='col-6 offset-3 border border-secondary p-3 rounded'>
<div class="row pt-3">    
    <div class="col-4">
        <div class='form-group'>
            <label for='titre'>ISBN</label>
            <input type='isbn' name='isbn' id='isbn' class='form-control' placeholder='Saisir le isbn' value='<?php if($mode == "Modifier") { echo $livre->getIsbn(); } ?>'>
        </div>
    </div>
    <div class="col-8">
        <div class='form-group'>
            <label for='titre'>Titre</label>
            <input type='text' name='titre' id='titre' class='form-control' placeholder='Saisir le titre' value='<?php if($mode == "Modifier") { echo $livre->getTitre(); } ?>'>
        </div>
    </div>
</div>
<div class="row pt-3">
    <div class="col-3">
        <div class='form-group'>
            <label for='prix'>Prix</label>
            <input type='number' name='prix' id='prix' class='form-control' placeholder='Saisir le prix' value='<?php if($mode == "Modifier") { echo $livre->getPrix(); } ?>'>
        </div>
    </div>
    <div class="col-3">
        <div class='form-group'>
            <label for='editeur'>Editeur</label>
            <input type='text' name='editeur' id='editeur' class='form-control' placeholder="Saisir l'editeur" value='<?php if($mode == "Modifier") { echo $livre->getEditeur(); } ?>'>
        </div>
    </div>
    <div class="col-3">
        <div class='form-group'>
            <label for='annee'>Annee</label>
            <input type='number' name='annee' id='annee' class='form-control' placeholder="Saisir l'annee" value='<?php if($mode == "Modifier") { echo $livre->getAnnee(); } ?>'>
        </div>
    </div>
    <div class="col-3">
        <div class='form-group'>
            <label for='langue'>Langue</label>
            <input type='text' name='langue' id='langue' class='form-control' placeholder='Saisir la langue' value='<?php if($mode == "Modifier") { echo $livre->getLangue(); } ?>'>
        </div>
    </div>
</div>
<div class="row pt-3">
    <div class="col-6">
        <?php
            $selectedAuteurId = ($mode == "Modifier" && $livre->getNumAuteur()) ? $livre->getNumAuteur() : '';
        ?>
        <div class='form-group'>
            <label for='auteur'>Auteur</label>
            <select name="auteur" class='form-control'>
                <?php 
                foreach($LesAuteurs as $auteur) {
                    $selected = ($auteur->getNum() == $selectedAuteurId) ? 'selected' : '';
                    echo "<option value='".$auteur->getNum()."' $selected>".$auteur->getNom()."</option>";
                }
                ?>
            </select> 
        </div>
    </div>

    <div class="col-6">
        <?php
            $selectedGenreId = ($mode == "Modifier" && $livre->getNumGenre()) ? $livre->getNumGenre() : '';
        ?>
        <div class='form-group'>
            <label for='genre'>Genre</label>
            <select name="genre" class='form-control'>
                <?php 
                foreach($LesGenres as $genre) {
                    $selected = ($genre->getNum() == $selectedGenreId) ? 'selected' : '';
                    echo "<option value='".$genre->getNum()."' $selected>".$genre->getLibelle()."</option>";
                }
                ?>
            </select> 
        </div>
    </div>
</div>
        

        <input type='hidden' id='num' name='num' value='<?php if($mode == "Modifier") { echo $livre->getNum(); } ?>'>
        <div class='row'>
            <div class='col'> <a href='index.php?uc=livre&action=list' class='btn btn-warning btn-block'>Revenir à la liste</a></div>
            <div class='col'> <button type='submit' class='btn btn-success btn-block'> <?php echo $mode ?> </button></div>
        </div>
    </form>
</div>"
<?php include "footer.php";?>