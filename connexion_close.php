<?php

if(@$db->close()){
    ;
}else {
    echo 'erreur lors de la deconnexion...';
}