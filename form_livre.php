<div class="offset-lg-1 col-lg-6" id="blockLivre">
    <div class="section noprint">
        <h2 class="section-title ct1">Inscrivez-vous</h2>

        <form method="post" action="trt_livre.php" class="well form-horizontal">
            <fieldset>
                <legend>
                    <h4 class="ct1"> Veuillez remplir le formulaire d'inscription en remplisant tous les champs :</h4>
                </legend>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputName" class="ct2">Titre</label>
                        <input type="text" name="titre" class="form-control" id="inputName" placeholder="titre">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputName" class="ct2">Année</label>
                        <input type="text" name="annee" class="form-control" id="inputName" placeholder="Année">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputEmail" class="ct2">Edition</label>
                        <input type="text" name="edition" class="form-control" id="inputEmail" placeholder="edition">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputSujet" class="ct2">Langue</label>
                        <input type="text" name="langue" class="form-control" id="inputSujet" placeholder="Langue">
                    </div>
                    <div class="form-group col-md-12">
                    <label for="exampleFormControlSelect1">type de livre</label>
                    <select class="form-control" name="clef1" id="exampleFormControlSelect1">
                        <?php 
                        require_once ('connexion.php');
                        $option = 'SELECT categorie FROM cat'; 
                        $req = $db->query($option); 
                        var_dump($req);
                        while ($row = $req->fetch_array()) { 
                        echo '<option>'.$row['categorie'].'</option>';
                    } ?>
                    </select>
                </div>
                    <button class="btn btn-primary" type="submit" value="insérer" name="envoyer" id="button">Sign in</button>
                </div>
    </div>

    </fieldset>
    </form>
</div> 