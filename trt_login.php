<?php 
// On commence par récupérer les champs 
if (isset($_POST['pseudo'])) {
    $pseudo = $_POST['pseudo'];
} else {
    $pseudo = "";
};

if (isset($_POST['login'])) {
    $password = $_POST['login'];
} else {
    $password = "";
}

// On vérifie si les champs sont vides 
if (empty($pseudo) && empty($password)) {

    } elseif (strlen($password) < 5) {
    echo '<meta http-equiv="refresh" content="2;URL=http://localhost/exercice_12_03_2019/index.php?page=login.php">';
    echo '<font color="red">Mot de passe trop court !<br></font>';
}
// Aucun champ n'est vide, on peut enregistrer dans la table 
else {
    // connexion à la base
    $db = @new mysqli('localhost', 'root', 'root', 'bibliotheque')  or die('Erreur de connexion ' . $db->connect_error);

    if ($db->connect_error) {
        echo 'erreur de connexion : ' . $db->connect_error . '<br>';
    } else { // echo 'connexion reussi <br>';
        // récupération du pseudo et du login base de donnée pour éviter les doublons
        $test1 = 'SELECT pseudo,login FROM adherent WHERE pseudo="' . $pseudo . '" and login="' . $password . '"';
        $req = $db->query($test1);
        $row = $req->fetch_array();
        
        var_dump($row);

        // on vérifie les informations du formulaire, à savoir si le pseudo saisi est bien un pseudo autorisé, de même pour le mot de passe
        if ($row !=0 ) {
            // dans ce cas, tout est ok, on peut démarrer notre session

            // on la démarre :)
            session_start();
            // on enregistre les paramètres de notre visiteur comme variables de session ($login et $pwd) (notez bien que l'on utilise pas le $ pour enregistrer ces variables)
            $_SESSION['login'] = $_POST['login'];
            $_SESSION['pwd'] = $_POST['pwd'];

            // on redirige notre visiteur vers une page de notre section membre
            header('location: ./membre.php');
            $expire = 365*24*3600; // on définit la durée du cookie, 1 an
            setcookie($pseudo,$password,time()+$expire);  // on l'envoi
        } else {
            // Le visiteur n'a pas été reconnu comme étant membre de notre site. On utilise alors un petit javascript lui signalant ce fait
            echo '<body onLoad="alert(\'Membre non reconnu...\')">';
            // puis on le redirige vers la page d'accueil
            echo '<meta http-equiv="refresh" content="0;URL=index.php">';
        }
    }
    if (@$db->close()) { } else {
        echo 'erreur lors de la deconnexion...';
    }
}
