<?php

$routeAboslute=dirname(__DIR__, 2) ;
$path = $routeAboslute. '/database/conection/Database.php';
echo "Intentando cargar archivo desde: " . $path . "<br>";
echo "Ruta absoluta (realpath): " . realpath($path) . "<br>";

if (file_exists($path)) {
    require_once $path;
    echo "Archivo cargado correctamente.";
} else {
    echo "El archivo no existe en la ruta especificada.";
}

?>