<?php 
// On commence par récupérer les champs 
if(isset($_POST['categorie'])) {    $categorie=$_POST['categorie'];} 
else     { $categorie="";} ;

// On vérifie si les champs sont vides 
if(empty($categorie))
    { 
    echo '<div class="offset-lg-1" ><font color="red">Vous n\'avez pas rempli le champ</font></div>'; 
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
        include ('header.php');
        include ('form_precategorie.php');
    echo '<div class="offset-lg-1" ><font color="red">Désolé, mais cette age mail existe déjà.<br></font></div>'; 
    } 

    else  // L'langue n'existe pas, on insère les données dans la table form 
    {
    // on écrit la requête sql 
    $sql = 'INSERT INTO cat (categorie) VALUES ("'.$categorie.'")'; 
     
    // on insère les informations du formulaire dans la table 
    $resultat = $db->query($sql);

    // on affiche le résultat pour le visiteur 
    if ($resultat === true){
				echo 'Le contact a été ajouté.<br>';}
			else{
                echo 'Vous n\'avez pas rempli correctement le formulaire.<br>';}
                 
    if(@$db->close()){
        echo 'Le categorie '.$categorie.' a été ajouté.<br>';
    }else {
        echo 'erreur lors de la deconnexion...';
    }
}
}
}