<?php 
// On commence par récupérer les champs 
if(isset($_POST['livre'])) {    $livre=$_POST['livre'];} 
else     { $livre="";} ;

if(isset($_POST['clef1'])) {    $clef1=$_POST['clef1'];} 
else     { $clef1="";} ;


// On vérifie si les champs sont vides 
if(empty($livre) OR empty($clef1))
    { 
        

     echo '<div class="offset-lg-1" ><font color="red">Vous n\'avez pas rempli le champ du mot clef</font></div>'; 
    } 
// Aucun champ n'est vide, on peut enregistrer dans la table reference
else      
     {
       // connexion à la base
       $db = @new mysqli('localhost', 'root','root', 'bibliotheque')  or die('Erreur de connexion '.$db->connect_error);
     
       if($db->connect_error){
           echo 'erreur de connexion : '.$db->connect_error.'<br>';
       }
        else {
    // echo 'connexion reussi <br>';
    // recherche des id correspondant au livre et les mots clefs
    $test = 'SELECT id_livre FROM livre WHERE titre="'.$livre.'"'; 
    $req = $db->query($test); 
    $row = $req->fetch_array();

    $bcl = array();
    $test2 = 'SELECT id_clef FROM clef WHERE mot="'.$clef1.'"'; 
    $req2 = $db->query($test2); 
    while($row2 = $req2->fetch_array()){
      $bcl[] = $row2['id_clef'];
    }

    // on écrit la requête sql 
    $sql = 'INSERT INTO reference (numlivre, numclef1, numclef2, numclef3) VALUES ('.$row['id_livre'].','.$row2['id_clef'].')'; 
     
    // on insère les informations du formulaire dans la table référence
    $resultat = $db->query($sql);

    // on affiche le résultat pour le visiteur 
    if ($resultat === true){
        echo '<meta http-equiv="refresh" content="2;URL=http://localhost/exercice_12_03_2019/index.php?page=form_reference.php">';
        echo '<div class="offset-lg-1" >L\'insertion a réussi</div><br>';
        
    }
    //si vous vous êtes trompé dans les champs à remplir
			else{
                echo '<meta http-equiv="refresh" content="2;URL=http://localhost/exercice_12_03_2019/index.php?page=form_reference.php">';
                echo 'Vous n\'avez pas rempli correctement le formulaire.<br>';}
    // on ferme la connexion              
    if(@$db->close()){
        
    }else {
        echo 'erreur lors de la deconnexion...';
    }
}
}
