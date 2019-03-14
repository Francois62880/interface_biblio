<?php

if(isset($_GET['page'])) {    $x=$_GET['page'];} 
else     { $x="";} ;


function contenu($x){
    if (empty($x)){
          return 'adherent.php';
    }else {
        if($x === 'form_adherent.php'){
            return "adherent.php";}
    elseif($x === 'form_emprunt.php'){
        return "emprunt.php";
        }elseif($x === 'form_livre.php'){
            return  'livre.php';
    }elseif($x === 'form_auteur.php'){
                return "auteur.php";
    }elseif($x === 'form_ecrit.php'){
        return "ecrit.php";
    }elseif($x === 'form_categorie.php'){
        return "categorie.php";
    }elseif($x === 'form_rayon.php'){
        return "rayon.php";
    }elseif($x === 'form_clef.php'){
        return "clef.php";
    }elseif($x === 'form_reference.php'){
        return "reference.php";
    }else{
        return 'adherent.php';
    }
}
};
