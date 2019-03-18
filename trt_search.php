<?php 
// On commence par récupérer les champs 
if (isset($_POST['search'])) {
    $search = $_POST['search'];
} else {
    $search = "";
};


// On vérifie si les champs sont vides 
if (empty($search)) {
    
        echo '<div class="offset-lg-1" ><font color="red">Vous n\'avez pas rempli le champ du mot clef</font></div>';
    }
// Aucun champ n'est vide, on peut enregistrer dans la table 
else {
        // connexion à la base
        $db = @new mysqli('localhost', 'root', 'root', 'bibliotheque')  or die('Erreur de connexion ' . $db->connect_error);

        if ($db->connect_error) {
            echo 'erreur de connexion : ' . $db->connect_error . '<br>';
        } else {
            // on écrit la requête sql pour rechercher les livres par mot clef
            $sql = 'SELECT titre,auteur.nom,auteur.prenom, cat.categorie, clef.mot

            FROM  livre 
            
            JOIN cat ON livre.numcat = cat.id_cat
            
            JOIN ecrit ON  livre.id_livre = ecrit.numlivre
            
            JOIN auteur ON ecrit.numauteur = auteur.id_auteur
            
            JOIN reference  ON livre.id_livre = reference.numlivre
            
            JOIN clef  ON reference.numclef = clef.id_clef
            
            where titre ="' . $search . '"
            
            group by titre';

            // on insère les informations du formulaire dans la table 
            $result = $db->query($sql);
            $rec = $result->fetch_array();
            // on affiche le résultat pour le visiteur 

            if (!empty($result)) {
               
                // on écrit la requête sql pour afficher les livres par mot clef
                $sql2 = 'SELECT titre,auteur.nom, auteur.prenom, cat.categorie
FROM  livre 
JOIN cat ON livre.numcat = cat.id_cat
JOIN ecrit ON  livre.id_livre = ecrit.numlivre
JOIN auteur ON ecrit.numauteur = auteur.id_auteur
JOIN reference  ON livre.id_livre = reference.numlivre
JOIN clef  ON reference.numclef = clef.id_clef
';
                // on insère les informations du formulaire dans la table 
                $resultat = $db->query($sql2);

               
                echo '<div class="offset-lg-1" >Voila le résultat de votre recherche:</div> <br>';
                while ($rec2 = $resultat->fetch_array()){
                    echo '<meta http-equiv="refresh" content="10;URL=http://localhost/exercice_12_03_2019/index.php?page=form_search.php">';
                    echo '<div class="offset-lg-1" >Le livre est : '.$rec['titre']. '. Il est ecris par : '.$rec['nom']. ' '.$rec['prenom']. '. Vous le trouverez dans le rayon : '.$rec['categorie']. '</div> <br>';
                }
        }
            //si vous vous êtes trompé dans les champs à remplir
            else {
                echo '<meta http-equiv="refresh" content="2;URL=http://localhost/exercice_12_03_2019/index.php?page=form_search.php">';
                include ('index.php');
                echo '<div class="offset-lg-1" >Votre recherche n\'a rien donnée.</div><br>';
            }
            // on ferme la connexion             
            if (@$db->close()) { } else {
                echo 'erreur lors de la deconnexion...';
            }
        }
    }
