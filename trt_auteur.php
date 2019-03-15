<?php 
// On commence par récupérer les champs 
if(isset($_POST['nom'])) {    $nom=$_POST['nom'];} 
else     { $nom="";} ;

if(isset($_POST['prenom']))   {  $prenom=$_POST['prenom'];} 
else   {   $prenom="";} 

if(isset($_POST['age']))    { $age=$_POST['age'];} 
else    {  $age="";} 

if(isset($_POST['nationalite']))  {    $nationalite=$_POST['nationalite'];} 
else   {   $nationalite="";} 


// On vérifie si les champs sont vides 
if(empty($nom) OR empty($prenom) OR empty($age) OR empty($nationalite))
    { 
    echo '<div class="offset-lg-1" ><font color="red">Vous n\'avez pas rempli le formulaire</font></div>'; 
    } 

// Aucun champ n'est vide, on peut enregistrer dans la table auteur
else      
    { 
       // connexion à la base
$db = @new mysqli('localhost', 'root','root', 'bibliotheque')  or die('Erreur de connexion '.$db->connect_error);
     
if($db->connect_error){
    echo 'erreur de connexion : '.$db->connect_error.'<br>';
} else {
    // echo 'connexion reussi <br>';
    // vérification de la base de donnée pour éviter les doublons
    $test = 'SELECT nom,prenom FROM auteur WHERE nom="'.$nom.'" and prenom="'.$prenom.'"'; 
    $req = $db->query($test); 
    $row = $req->fetch_array();
    
    if($row!= 0)  // le nom et le prenom existent déjà, on affiche un message d'erreur 
    { 
        include ('header.php');
        include ('form_auteur.php');
    echo '<div class="offset-lg-1" ><font color="red">Désolé, mais cet auteur existe déjà.<br></font></div>'; 
    } 

    else  // Le nom et le prenom n'existent pas, on insère les données dans la table auteur
    {
    // on écrit la requête sql 
    $sql = 'INSERT INTO auteur (nom, prenom, age, nationalite) VALUES ("'.$nom.'","'.$prenom.'","'.$age.'","'.$nationalite.'")'; 
     
    // on insère les informations du formulaire dans la table auteur
    $resultat = $db->query($sql);

    // on affiche le résultat pour le visiteur 
    if ($resultat === true){
        include ('header.php');
                echo '<div class="offset-lg-1" >L\'auteur '.$nom.' '.$prenom.' a été ajouté.<br></div>';
                include ('btn.php');}
			else{
        include ('header.php');
        include ('menu.php');
                echo 'Vous n\'avez pas rempli correctement le formulaire.<br>';}
                 
    if(@$db->close()){
    }else {
        echo 'erreur lors de la deconnexion...';
    }
}
}
}