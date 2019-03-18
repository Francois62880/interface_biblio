<?php 
// On commence par récupérer les champs 
if(isset($_POST['livre'])) {    $livre=$_POST['livre'];} 
else     { $livre="";} ;

if(isset($_POST['nom'])) {    $nom=$_POST['nom'];} 
else     { $nom="";} ;

if(isset($_POST['prenom'])) {    $prenom=$_POST['prenom'];} 
else     { $prenom="";} ;

if(isset($_POST['dateDebut'])) {    $dateDebut=$_POST['dateDebut'];} 
else     { $dateDebut="";} ;

if(isset($_POST['dateFin'])) {    $dateFin=$_POST['dateFin'];} 
else     { $dateFin="";} ;


// On vérifie si les champs sont vides 
if(empty($livre) OR empty($nom) OR empty($prenom) OR empty($dateDebut) OR empty($dateFin))
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
    $test4 = 'SELECT id_livre FROM livre JOIN  emprunt ON livre.id_livre = emprunt.numlivre  WHERE titre="'.$livre.'"'; 
    $req4 = $db->query($test4); 
    $row4 = $req4->fetch_array();
    
    if($row4!= 0)  // le livre existe déjà, on affiche un message d'erreur 
    { 
        echo '<meta http-equiv="refresh" content="2;URL=http://localhost/exercice_12_03_2019/index.php?page=form_emprunt.php">';
    echo '<div class="offset-lg-1" ><font color="red">Désolé, mais ce livre : '.$livre.' est déjà emprunté.<br></font></div>'; 
    } 
    else  // Le livre n'a pas encore été emprunté, on insère les données dans la table emprunt
    {

    $test = 'SELECT id_livre FROM livre WHERE titre="'.$livre.'"'; 
    $req = $db->query($test); 
    $row = $req->fetch_array();

    $test2 = 'SELECT id_adherent FROM adherent WHERE nom="'.$nom.'"'; 
    $req2 = $db->query($test2); 
    $row2 = $req2->fetch_array();

    
    $test3 = 'SELECT id_adherent FROM adherent WHERE prenom="'.$prenom.'"'; 
    $req3 = $db->query($test3); 
    $row3 = $req3->fetch_array();

    
    // on écrit la requête sql 
    $sql = 'INSERT INTO emprunt (numlivre, numadherent, numprenom, datedebut, datefin) VALUES ('.$row['id_livre'].','.$row2['id_adherent'].','.$row3['id_adherent'].',"'.$dateDebut.'","'.$dateFin.'")'; 
     
    // on insère les informations du formulaire dans la table emprunt
    $resultat = $db->query($sql);

    // on affiche le résultat pour le visiteur 
    if ($resultat === true){
        echo '<meta http-equiv="refresh" content="2;URL=http://localhost/exercice_12_03_2019/index.php?page=form_emprunt.php">';
    echo '<div class="row"><div class="offset-lg-1" Le livre a bien été emrpunté.</div></div><br>';
                    }
    //si vous vous êtes trompé dans les champs à remplir
			else{
                echo '<meta http-equiv="refresh" content="2;URL=http://localhost/exercice_12_03_2019/index.php?page=form_emprunt.php">';
                echo 'Vous n\'avez pas rempli correctement le formulaire.<br>';}
     // on ferme la connexion                  
    if(@$db->close()){
        
    }else {
        echo 'erreur lors de la deconnexion...';
    }
}
}
}