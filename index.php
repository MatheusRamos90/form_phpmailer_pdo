<?php

$pagina = explode('/',$_SERVER['REQUEST_URI']);

/* Verifica qual a pagina a ser incluida */

//print_r($pagina);

if($pagina[2] == '')/*|| !$pagina[2]*/

    include_once('views/formContato.php');

else
    include_once('404.php');

?>