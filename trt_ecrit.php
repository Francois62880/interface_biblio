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
     echo '<div class="offset-lg-1" ><font color="red">Vous n\'avez pas rempli correctement tous les champs.</font></div>'; 
    } 
// Aucun champ n'est vide, on peut enregistrer dans la table ecrit
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
     
    // on insère les informations du formulaire dans la table ecrit
    $resultat = $db->query($sql);

    // on affiche le résultat pour le visiteur 
    if ($resultat === true){
        echo '<meta http-equiv="refresh" content="2;URL=http://localhost/exercice_12_03_2019/index.php?page=form_ecrit.php">';
        echo '<div class="row"><div class="offset-lg-1" >L\'insertion a réussi</div></div><br>';
        
    }
     //si vous vous êtes trompé dans les champs à remplir
			else{
                echo '<meta http-equiv="refresh" content="2;URL=http://localhost/exercice_12_03_2019/index.php?page=form_ecrit.php">';
                echo '<div class="row"><div class="offset-lg-1 col-lg-6" >Vous n\'avez pas rempli correctement le formulaire.</div></div><br>';}
    // on ferme la connexion      
    if(@$db->close()){
        
    }else {
        echo 'erreur lors de la deconnexion...';
    }
}
}

