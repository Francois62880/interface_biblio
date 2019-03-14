<div class="offset-lg-1 col-lg-6" id="blockAdherent">
    <div class="section noprint">
        <form method="post" action="trt_rayon.php" class="well form-horizontal">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="inputName" class="ct2">Nom du livre</label>
                        <input type="text" name="livre" class="form-control" id="inputName" placeholder="Nom du livre">
                    </div>
                    <div class="form-group col-md-12">
                    <label for="exampleFormControlSelect1">type de livre</label>
                    <select class="form-control" name="clef1" id="exampleFormControlSelect1">
                        <?php 
                        require_once ('connexion.php');
                        $option = 'SELECT categorie FROM cat'; 
                        $req = $db->query($option); 
                        while ($row = $req->fetch_array()) { 
                        echo '<option>'.$row['categorie'].'</option>';
                    } ?>
                    </select>
                </div>
                    <button class="btn btn-primary" type="submit" value="insérer" name="envoyer" id="button">Sign in</button>
                </div>
    </div>
    </form>
</div>