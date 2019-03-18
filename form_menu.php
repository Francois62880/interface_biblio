<?php
function menu(){
$menu = array("adherent" => "?page=form_listing.php",
"emprunt" => "?page=form_emprunt.php",
"livre" => "?page=form_livre.php",
"auteur" => "?page=form_auteur.php",
"ecrit" => "?page=form_ecrit.php",
"categorie" => "?page=form_categorie.php",
"mot clef" => "?page=form_clef.php",
"reference" => "?page=form_reference.php",
);


foreach($menu as $k => $v){
        echo '<li class="nav-item">';
        echo '<a class="nav-link" href="'.$v.'">'.$k.'<span class="sr-only">(current)</span></a>';
        echo '</li>';
}
}
?>

<nav class="navbar navbar-expand-lg navbar-light">
<a class="navbar-brand" id="nav1">Bibliothèque</a>
<button class="navbar-toggler bg-light" id="button" type="button" data-toggle="collapse"
    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
    aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav" id="nav">
        <?php  menu() ?>
            </ul>
</div>
<div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav" id="nav">
        <li class="nav-item">
        <a class="nav-link" href="./logout.php">Déconnexion</a>
        </li>
            </ul>
</div>
</nav>