<?php 
// On commence par récupérer les champs 
if(isset($_POST['livre'])) {    $livre=$_POST['livre'];} 
else     { $livre="";} ;

if(isset($_POST['nom'])) {    $nom=$_POST['nom'];} 
else     { $nom="";} ;

if(isset($_POST['prenom'])) {    $prenom=$_POST['prenom'];} 
else     { $prenom="";} ;


// On vérifie si les champs sont vides 
if(empty($livre) OR empty($nom) OR empty($prenom) )
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
    // recherche des id correspondant au livre et a l'auteur
    $test = 'SELECT id_livre FROM livre WHERE titre="'.$livre.'"'; 
    $req = $db->query($test); 
    $row = $req->fetch_array();

    $test2 = 'SELECT id_auteur FROM auteur WHERE nom="'.$nom.'" and prenom= "'.$prenom.'"'; 
    $req2 = $db->query($test2); 
    $row2 = $req2->fetch_array();
    
    
    // on écrit la requête sql 
    $sql = 'INSERT INTO ecrit (numlivre, numauteur) VALUES ('.$row['id_livre'].','.$row2['id_auteur'].')'; 
     
    // on insère les informations du formulaire dans la table 
    $resultat = $db->query($sql);

    // on affiche le résultat pour le visiteur 
    if ($resultat === true){
        include ('header.php');
        include ('form_ecrit.php');
        echo '<div class="offset-lg-1" >L\'insertion a réussi</div><br>';
    }
			else{
                echo 'Vous n\'avez pas rempli correctement le formulaire.<br>';}
                 
    if(@$db->close()){
        
    }else {
        echo 'erreur lors de la deconnexion...';
    }
}
}

