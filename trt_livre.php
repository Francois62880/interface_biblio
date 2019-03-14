<?php 
// On commence par récupérer les champs 
if(isset($_POST['titre'])) {    $titre=$_POST['titre'];} 
else     { $titre="";} ;

if(isset($_POST['annee']))    { $annee=$_POST['annee'];} 
else    {  $annee="";} 

if(isset($_POST['edition']))  {    $edition=$_POST['edition'];} 
else   {   $edition="";} 

if(isset($_POST['langue']))   {   $langue=$_POST['langue'];} 
else  {    $langue="";} 

if(isset($_POST['categorie']))   {   $categorie=$_POST['categorie'];} 
else  {    $categorie="";} 

if(isset($_POST['archivage']))   {   $archivage=$_POST['archivage'];} 
else  {    $archivage="";} 


// On vérifie si les champs sont vides 
if(empty($titre) OR empty($annee) OR empty($edition) OR empty($langue) OR empty($categorie))
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
    $test = 'SELECT titre FROM livre WHERE titre="'.$titre.'"'; 
    $req = $db->query($test); 
    $row = $req->fetch_array();
    
    if($row!= 0)  // l'langue existe déjà, on affiche un message d'erreur 
    { 
        include ('header.php');
        include ('form_livre.php');
    echo '<div class="offset-lg-1" ><font color="red">Désolé, mais ce titre : '.$titre.' existe déjà.<br></font></div>'; 
    } 

    else  // L'langue n'existe pas, on insère les données dans la table form 
    {
    $test2 = 'SELECT id_cat FROM cat WHERE categorie="'.$categorie.'"'; 
    $req2 = $db->query($test2); 
    $row2 = $req2->fetch_array();

    // $test3 = 'SELECT id_cat FROM cat WHERE categorie="'.$categorie.'"'; 
    // $req3 = $db->query($test3); 
    // $row3 = $req3->fetch_array();


    // on écrit la requête sql 
    $sql = 'INSERT INTO livre (titre, annee, edition, langue, numcat, archivage) VALUES ("'.$titre.'","'.$annee.'","'.$edition.'","'.$langue.'",'.$row2['id_cat'].',"'.$archivage.'")'; 
    // on insère les informations du formulaire dans la table 
    $resultat = $db->query($sql);

    // on affiche le résultat pour le visiteur 
    if ($resultat === true){
				}
			else{
                echo 'Vous n\'avez pas rempli correctement le formulaire.<br>';}
                 
    if(@$db->close()){
        include ('header.php');
        include ('form_livre.php');
        echo '<div class="offset-lg-1" >Le mot livre '.$titre.' a été ajouté.</div><br>';
    }else {
        echo 'erreur lors de la deconnexion...';
    }
}
}
}