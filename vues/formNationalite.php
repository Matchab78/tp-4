<div class="container mt-5">
        <h2 class="pt-3 text-center"> <?php echo $mode; ?> une nationalitée</h2>
    <form action="index.php?uc=nationalites&action=valideForm" method ="post" class="col-md-6 offset-md-3 border border-dark p-3 rounded">
        <div class="form-group">
            <label for="libelle">Libellé</label>
            <input type="text" class='form-control' id='libelle' placeholder='Saisir le libellé' name='libelle' value="<?php if($mode == "Modifier"){echo $nationalite->getLibelle();} ?>">
        </div>

        <select name="continent" class="form-control">
            <?php
            echo"<option value='Tous'> Tous les continents </option>";
            foreach($lesContinents  as $continent){   
                $selection=$continent->getNum() == $laNationalite -> numContinent ? 'selected' : '';
                echo"<option value='".$continent->getNum()."' $selection>".$continent->getLibelle()."</option>";

            }
            ?>
        </select>
        
        <input type="hidden" id="num" name="num" value="<?php if($mode == "Modifier"){ echo $nationalite->getNum();} ?>">

        <input type="hidden" id="num" name="num" value="
        <?php 
        if($mode == "Modifier"){ 
                echo $nationalite->getNumContinent()->getNum();
        } ?>
        ">
        <div class="row">
            <div class="col"><a href="index.php?uc=nationalites&action=list" class='btn btn-dark btn-block'>Revenir à la liste</a></div>
            <div class="col"><button type='submit' class='btn btn-dark btn-block'> <?php echo $mode ?> Ajouter </button></div>
        </div>
    </form>
    </div>
