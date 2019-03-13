<?php

if(@$db->close()){
    echo 'connexion fermée';
}else {
    echo 'erreur lors de la deconnexion...';
}