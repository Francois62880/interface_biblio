<?php 
// On commence par récupérer les champs 
if(isset($_POST['livre'])) {    $livre=$_POST['livre'];} 
else     { $livre="";} ;

if(isset($_POST['categorie'])) {    $categorie=$_POST['categorie'];} 
else     { $categorie="";} ;


// On vérifie si les champs sont vides 
if(empty($livre) OR empty($categorie))
    { 
     echo '<div class="offset-lg-1" ><font color="red">Vous n\'avez pas rempli le champ du mot clef</font></div>'; 
    } 
// Aucun champ n'est vide, on peut enregistrer dans la table 
else      
    { 
       // connexion à la base
$db = @new mysqli('localhost', 'root','root', 'bibliotheque')  or die('Erreur de connexion '.$db->connect_error);
     
if($db->connect_error){
    echo 'erreur de connexion : '.$db->connect_error.'<br>';
} 
 else {
    // echo 'connexion reussi <br>';
    // vérification de la base de donnée pour éviter les doublons
    $test = 'SELECT id_livre FROM livre WHERE titre="'.$livre.'"'; 
    $req = $db->query($test); 
    $row = $req->fetch_array();

    $test2 = 'SELECT id_cat FROM cat WHERE categorie="'.$categorie.'"'; 
    $req2 = $db->query($test2); 
    $row2 = $req2->fetch_array();
    
    
    // on écrit la requête sql 
    $sql = 'INSERT INTO rayon (numlivre, numcategorie) VALUES ('.$row['id_livre'].','.$row2['id_cat'].')'; 
     
    // on insère les informations du formulaire dans la table 
    $resultat = $db->query($sql);

    // on affiche le résultat pour le visiteur 
    if ($resultat === true){
        include ('header.php');
        include ('form_rayon.php');
        echo '<div class="offset-lg-1" >Le mot clef '.$categorie.' a été ajouté.</div><br>';
    }
			else{
                echo 'Vous n\'avez pas rempli correctement le formulaire.<br>';}
                 
    if(@$db->close()){
        
    }else {
        echo 'erreur lors de la deconnexion...';
    }
}
}

