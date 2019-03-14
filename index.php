<?php

include ('header.php');

include ('menu.php');

include 'trt_menu.php';

$x=$_GET['page'];

function contenu($x){
    if($x=== 'form_listing.php'){
          return 'adherent.php';
    }elseif($x === 'form_emprunt.php'){
        return "form_emprunt.php";
        }elseif($x === 'form_livre.php'){
            return  'form_livre.php';
    }elseif($x === 'form_auteur.php'){
                return "form_auteur.php";
    }elseif($x === 'form_ecrit.php'){
        return "form_ecrit.php";
    }elseif($x === 'form_categorie.php'){
        return "form_categorie.php";
    }elseif($x === 'form_rayon.php'){
        return "form_rayon.php";
    }elseif($x === 'form_clef.php'){
        return "form_clef.php";
    }elseif($x === 'form_reference.php'){
        return "form_reference.php";
    }else{
        return "Erreur 404";
    }
};

include contenu($x);

// include ('trt_livre.php');

// include ('trt_categorie.php');

// include ('trt_auteur.php');

// include ('trt_clef.php');

// include ('trt_rayon.php');

// include ('trt_ecrit.php');

// include ('trt_reference.php');

// include ('trt_emprunt.php');

// include ('trt_search.php');


?>

</body>
</html>