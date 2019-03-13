<div class="offset-lg-1 col-lg-6" id="blockAdherent">
    <div class="section noprint">
        <form method="post" action="trt_reference.php" class="well form-horizontal">
            <div class="form-row">
                <div class="form-group col-md-12">
                <label for="exampleFormControlSelect1">Tire du livre :</label>
                <select class="form-control" name="clef1" id="exampleFormControlSelect1">
                        <?php 
                        require_once('connexion.php');
                        $option = 'SELECT titre FROM livre';
                        $req = $db->query($option);
                        var_dump($req);
                        while ($row = $req->fetch_array()) {
                            echo '<option>' . $row['titre'] . '</option>';
                        } ?>
                    </select>
                </div>
                <div class="form-group col-md-12">
                    <label for="exampleFormControlSelect1">Nom de l'emprunter: </label>
                    <select class="form-control" name="clef1" id="exampleFormControlSelect1">
                        <?php 
                        require_once('connexion.php');
                        $option = 'SELECT nom FROM adherent';
                        $req = $db->query($option);
                        var_dump($req);
                        while ($row = $req->fetch_array()) {
                            echo '<option>' . $row['nom'] . '</option>';
                        } ?>
                    </select>
                </div>
                <div class="form-group col-md-12">
                    <label for="exampleFormControlSelect1">Prenom de l'emprunter: </label>
                    <select class="form-control" name="clef1" id="exampleFormControlSelect1">
                        <?php 
                        require_once('connexion.php');
                        $option = 'SELECT prenom FROM adherent';
                        $req = $db->query($option);
                        var_dump($req);
                        while ($row = $req->fetch_array()) {
                            echo '<option>' . $row['prenom'] . '</option>';
                        } ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="example-date-input" class="col-12 col-form-label">Date de début d'emprunt :</label>
                        <input class="form-control" type="date" value="" id="example-date-input">
                </div>
                <div class="form-group col-md-6">
                    <label for="example-date-input" class="col-12 col-form-label">Date de fin d'emprunt :</label>
                        <input class="form-control" type="date" value="" id="example-date-input">
                </div>
        </form>
        <button class="btn btn-primary" type="submit" value="insérer" name="envoyer" id="button">Sign in</button>
    </div>
</div>
</form>
</div> 