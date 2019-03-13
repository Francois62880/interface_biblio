<?php 
// On commence par récupérer les champs 
if(isset($_POST['nom'])) {    $nom=$_POST['nom'];} 
else     { $nom="";} ;

if(isset($_POST['prenom']))   {  $prenom=$_POST['prenom'];} 
else   {   $prenom="";} 

if(isset($_POST['adresse']))    { $adresse=$_POST['adresse'];} 
else    {  $adresse="";} 

if(isset($_POST['ville']))  {    $ville=$_POST['ville'];} 
else   {   $ville="";} 

if(isset($_POST['email']))   {   $email=$_POST['email'];} 
else  {    $email="";} 

if(isset($_POST['telephone']))    { $telephone=$_POST['telephone'];} 
else    {  $telephone="";} 

if(isset($_POST['portable']))    { $portable=$_POST['portable'];} 
else    {  $portable="";} 

if(isset($_POST['pseudo']))    { $pseudo=$_POST['pseudo'];} 
else    {  $pseudo="";} 

if(isset($_POST['login']))  {    $login=$_POST['login'];} 
else   {   $login="";} 


// On vérifie si les champs sont vides 
if(empty($nom) OR empty($prenom) OR empty($adresse) OR empty($ville) OR empty($email) OR empty($telephone) OR empty($portable) OR empty($pseudo) OR empty($login))
    { 
    echo '<div class="offset-lg-1" ><font color="red">Vous n\'avez pas rempli le formulaire</font></div>'; 
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
    $test = 'SELECT email,pseudo FROM adherent WHERE email="'.$email.'" or pseudo="'.$pseudo.'"'; 
    $req = $db->query($test); 
    $row = $req->fetch_array();
    
    if($row!= 0)  // l'email existe déjà, on affiche un messpseudo d'erreur 
    { 
        include ('header.php');
        include ('form_listing.php');
    echo '<div class="offset-lg-1" ><font color="red">Désolé, mais l\'adresse mail ou le pseudo existent déjà.<br></font></div>';
    } 

    else  // L'email n'existe pas, on insère les données dans la table form 
    {
    // on écrit la requête sql 
    $sql = 'INSERT INTO adherent (nom, prenom, adresse, ville, email, telephone, portable, pseudo, login) VALUES ("'.$nom.'","'.$prenom.'","'.$adresse.'","'.$ville.'","'.$email.'","'.$telephone.'", "'.$portable.'","'.$pseudo.'", "'.$login.'")'; 
     
    // on insère les informations du formulaire dans la table 
    $resultat = $db->query($sql);

    // on affiche le résultat pour le visiteur 
    if ($resultat === true){
				}
			else{
                echo '<div class="offset-lg-1" >Vous n\'avez pas rempli correctement le formulaire.</div><br>';}
                 
    if(@$db->close()){
        include ('header.php');
        include ('form_listing.php');
        echo '<div class="offset-lg-1" >L\'adhérent '.$nom.' '.$prenom.' a été ajouté.</div><br>';
    }else {
        echo 'erreur lors de la deconnexion...';
    }
}
}
}