<?php

if ($_SESSION['isAdmin']) {
    $src_path = BASE_PATH . "src/admin/";
    $root_path = BASE_PATH . "views/admin/";
    //devuelve true si el la pagina se encontro
   
    if (getTemplate("admin", $root_path, $src_path)) {
    } else {
        include BASE_PATH . "views/admin/home.php"; // Página por defecto
    }

} else {
    $root_path = BASE_PATH . "views/user/";
    $src_path = BASE_PATH . "src/user/";
    //devuelve true si el la pagina se encontro
    if (getTemplate("page", $root_path, $src_path)) {
    } else {
        include BASE_PATH . "views/user/home.php"; // Página por defecto
    }
}
