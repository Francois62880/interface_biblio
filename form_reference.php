<div class="offset-lg-1 col-lg-6" id="blockAdherent">
    <div class="section noprint">
        <form method="post" action="trt_reference.php" class="well form-horizontal">
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="exampleFormControlInput1">livre</label>
                    <input type="text" name="livre" class="form-control" id="exampleFormControlInput1" placeholder="Titre du livre">
                </div>
                <div class="form-group col-md-12">
                    <label for="exampleFormControlSelect1">Mot clef (ctrl + click gauche)</label>
                    <select multiple class="form-control" name="clef1" id="exampleFormControlSelect1">
                        <?php 
                        require_once ('connexion.php');
                        $option = 'SELECT mot FROM clef'; 
                        $req = $db->query($option); 
                        while ($row = $req->fetch_array()) { 
                        echo '<option>'.$row['mot'].'</option>';
                    } ?>
                    </select>
                </div>
        </form>
        <button class="btn btn-primary" type="submit" value="insérer" name="envoyer" id="button">Sign in</button>
    </div>
</div>
</form>
</div> 