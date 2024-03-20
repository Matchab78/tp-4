<div class="container mt-5">
        <h2 class="pt-3 text-center"> <?php echo $mode; ?> un auteur</h2>
    <form action="index.php?uc=auteurs&action=valideForm" method ="post" class="col-md-6 offset-md-3 border border-dark p-3 rounded">
        <div class="form-group">
            <label for="libelle">Libellé</label>
            <input type="text" class='form-control' id='libelle' placeholder='Saisir le libellé' name='libelle' value="<?php if($mode == "Modifier"){echo $auteurs->getLibelle();} ?>">
        </div>
        
        <input type="hidden" id="num" name="num" value="<?php if($mode == "Modifier"){ echo $auteurs->getNum();} ?>">
        <div class="row">
            <div class="col"><a href="index.php?uc=auteurs&action=list" class='btn btn-dark btn-block'>Revenir à la liste</a></div>
            <div class="col"><button type='submit' class='btn btn-dark btn-block'> <?php echo $mode ?> Ajouter </button></div>
        </div>
    </form>
    </div>