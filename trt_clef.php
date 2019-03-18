<?php 
// On commence par récupérer les champs 
if(isset($_POST['mot1'])) {    $mot1=$_POST['mot1'];} 
else     { $mot1="";} ;


// On vérifie si les champs sont vides 
if(empty($mot1))
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
    $test = 'SELECT mot FROM clef WHERE mot="'.$mot1.'"'; 
    $req = $db->query($test); 
    $row = $req->fetch_array();
    
    if($row!= 0)  // le mot existe déjà, on affiche un message d'erreur 
    { 
        echo '<meta http-equiv="refresh" content="2;URL=http://localhost/exercice_12_03_2019/index.php?page=form_clef.php">';
        echo '<div class="offset-lg-1" ><font color="red">Désolé, mais le mot clef:  '.$mot1.' existe déjà.<br></font></div>'; 

    } 

    else  // Le mot n'existe pas, on insère les données dans la table clef
    {
    // on écrit la requête sql 
    $sql = 'INSERT INTO clef (mot) VALUES ("'.$mot1.'")'; 
     
    // on insère les informations du formulaire dans la table 
    $resultat = $db->query($sql);

    // on affiche le résultat pour le visiteur 
    if ($resultat === true){
        echo '<meta http-equiv="refresh" content="2;URL=http://localhost/exercice_12_03_2019/index.php?page=form_clef.php">';
        echo '<div class="offset-lg-1" >Le mot clef '.$mot1.' a été ajouté.</div><br>';
        
    }
    //si vous vous êtes trompé dans le champs a remplir
			else{
                echo '<meta http-equiv="refresh" content="2;URL=http://localhost/exercice_12_03_2019/index.php?page=form_clef.php">';
                echo 'Vous n\'avez pas rempli correctement le champ de mot clef.<br>';}
                 
    // on ferme la connexion
    if(@$db->close()){
        
    }else {
        echo 'erreur lors de la deconnexion...';
    }
}
}
}