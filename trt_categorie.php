<?php 
// On commence par récupérer les champs 
if(isset($_POST['categorie'])) {    $categorie=$_POST['categorie'];} 
else     { $categorie="";} ;

// On vérifie si les champs sont vides 
if(empty($categorie))
    { 
    echo '<div class="offset-lg-1" ><font color="red">Vous n\'avez pas rempli le champ.</font></div>'; 
    } 
// Aucun champ n'est vide, on peut enregistrer dans la table 
else      
    { 
       // connexion à la base
$db = @new mysqli('localhost', 'root','root', 'bibliotheque')  or die('Erreur de connexion '.$db->connect_error);
     
if($db->connect_error){
    echo 'erreur de connexion : '.$db->connect_error.'<br>';
} else {
    // echo 'connexion reussi <br>';
    // vérification de la base de donnée pour éviter les doublons
    $test = 'SELECT categorie FROM cat WHERE categorie="'.$categorie.'"'; 
    $req = $db->query($test); 
    $row = $req->fetch_array();
    
    if($row!= 0)  // l'langue existe déjà, on affiche un message d'erreur 
    { 
    echo '<meta http-equiv="refresh" content="2;URL=http://localhost/exercice_12_03_2019/index.php?page=form_categorie.php">';
    echo '<div class="offset-lg-1" ><font color="red">Désolé, mais cette categorie existe déjà.<br></font></div>'; 
    } 

    else  // L' n'existe pas, on insère les données dans la table categorie
    {
    // on écrit la requête sql 
    $sql = 'INSERT INTO cat (categorie) VALUES ("'.$categorie.'")'; 
     
    // on insère les informations du formulaire dans la table 
    $resultat = $db->query($sql);

    // on affiche le résultat pour le visiteur 
    if ($resultat === true){
         include ('header.php');
         echo '<meta http-equiv="refresh" content="2;URL=http://localhost/exercice_12_03_2019/index.php?page=form_categorie.php">';
                echo '<div class="row"><div class="offset-lg-1 col-lg-6" >La categorie '.$categorie.' a été ajouté.<br></div></div>';
               }
			else{
    //si vous vous êtes trompé dans les champs à remplir
    echo '<meta http-equiv="refresh" content="2;URL=http://localhost/exercice_12_03_2019/index.php?page=form_categorie.php">';
                echo '<div class="row"><div class="offset-lg-1 col-lg-6" >Vous n\'avez pas rempli correctement le formulaire.<br></div></div>';}
    // on ferme la connexion
    if(@$db->close()){
        ;
    }else {
        echo 'erreur lors de la deconnexion...';
    }
}
}
}