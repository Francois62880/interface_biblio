<?php 
// On commence par récupérer les champs 
if(isset($_POST['search'])) {    $search=$_POST['search'];} 
else     { $search="";} ;


// On vérifie si les champs sont vides 
if(empty($search))
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
} else {
    // echo 'connexion reussi <br>';
    // vérification de la base de donnée pour éviter les doublons
    
    // on écrit la requête sql 
    $sql = 'SELECT titre, from livre where titre="'.$search.'" or auteur="'.$search.'" or mot="'.$search.'"'; 
     
    // on insère les informations du formulaire dans la table 
    $result = $db->query($sql);
    $rec = $result->fetch_array();
    // on affiche le résultat pour le visiteur 

    var_dump($rec);
    if ($result == true){
        include ('header.php');
        include ('form_clef.php');
        echo '<div class="offset-lg-1" >Le livre que vous cherchez est :'.$rec['titre'].' a été trouvé.</div><br>';
    }
			else{
                echo 'Vous n\'avez pas rempli correctement le formulaire.<br>';}
                 
    if(@$db->close()){
        
    }else {
        echo 'erreur lors de la deconnexion...';
    }
}
}
