<?php
function stringToBool($string)
{
    return in_array(strtolower($string), ['true', '1', 'yes'], true);
}


function calcularNumNoches($checkin, $checkout)
{
    // Crear objetos DateTime a partir de las fechas
    $fechaCheckin = new DateTime($checkin);
    $fechaCheckout = new DateTime($checkout);

    // Calcular la diferencia
    $diferencia = $fechaCheckin->diff($fechaCheckout);

    // Obtener el número de noches
    return $diferencia->days; // La propiedad 'days' contiene el número total de días

}


function generarTokenAleatorio($longitud = 50)
{
    // Conjunto de caracteres permitidos
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $token = '';
    $maxIndex = strlen($caracteres) - 1;

    // Generar un token aleatorio de la longitud solicitada
    for ($i = 0; $i < $longitud; $i++) {
        $token .= $caracteres[random_int(0, $maxIndex)];
    }

    return $token;
}

function getDayToday()
{
    return date("d/m/Y");
}

function getTodayTime()
{
    return date("h:i:sa");
}


function configurationPaginationTable($array, $pageVar, $itemsPorPagina = 6)
{
    // Configuración de la paginación
    //$itemsPorPagina = 8;
    $totalItems = count($array);
    $totalPaginas = ceil($totalItems / $itemsPorPagina);

    // Obtener el número de página actual desde la URL
    $paginaActual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    $paginaActual = max(1, min($totalPaginas, $paginaActual));

    // Obtener el subconjunto de datos para la página actual
    $inicio = ($paginaActual - 1) * $itemsPorPagina;
    $arrayDatosPorPagina = array_slice($array, $inicio, $itemsPorPagina);


    $returnArray = [
        'array' => $arrayDatosPorPagina,
        'pageVar' => $pageVar,
        'paginaActual' => $paginaActual,
        'totalPaginas' => $totalPaginas
    ];
    return $returnArray;
}

function getRoomInformation()
{
    $rooms = [
        [
            "tipo" => "Habitación Individual",
            "descripcion" => "Ideal para viajeros solitarios, esta habitación ofrece un espacio privado y cómodo.",
            "caracteristicas" => [
                "Cama individual (120 cm)",
                "Conexión Wi-Fi gratuita",
                "Televisión LCD",
                "Baño privado con ducha",
                "Escritorio y espacio de almacenamiento",
                "Superficie: 8 a 12 m²"
            ],
            "img" => "https://i.pinimg.com/736x/5e/ba/b1/5ebab151614e768e7ab94cedb4a0e0dd.jpg",
            "precio" => "72$",

        ],
        [
            "tipo" => "Habitación Doble Estándar (Cama Doble)",
            "descripcion" => "Perfecta para parejas o viajeros que prefieren compartir una cama.",
            "caracteristicas" => [
                "Cama doble (140 cm)",
                "Conexión Wi-Fi gratuita",
                "Televisión LCD",
                "Baño privado con bañera",
                "Superficie: 10 a 11 m²"
            ],
            "img" => "https://i.pinimg.com/564x/60/05/bb/6005bbfc4f858db801090275b3e2e7c5.jpg",
            "precio" => "107$",

        ],
        [
            "tipo" => "Habitación Doble Estándar (Dos Camas Separadas)",
            "descripcion" => "Ideal para amigos o compañeros de trabajo que prefieren camas separadas.",
            "caracteristicas" => [
                "Dos camas individuales (90 cm)",
                "Conexión Wi-Fi gratuita",
                "Televisión LCD",
                "Baño privado con ducha",
                "Superficie: 10 a 11 m²"
            ],
            "img" => "https://i.pinimg.com/564x/fe/3c/da/fe3cda5c1ff52dc1ad87ab2fb0959025.jpg",
            "precio" => "107$",

        ],
        [
            "tipo" => "Habitación Doble Deluxe",
            "descripcion" => "Una opción más espaciosa y lujosa, perfecta para una estancia especial.",
            "caracteristicas" => [
                "Cama doble (160 cm)",
                "Balcón privado",
                "Conexión Wi-Fi gratuita",
                "Televisión LCD",
                "Baño privado con bañera y amenities de lujo",
                "Superficie: 15 a 20 m²"
            ],
            "img" => "https://i.pinimg.com/564x/ed/3d/06/ed3d06d62a07bb9160c62166fa1f4ea0.jpg",
            "precio" => "150$",

        ],
        [
            "tipo" => "Estudio o Apartamento",
            "descripcion" => "Espacio amplio y versátil, ideal para estancias prolongadas o para quienes necesitan un ambiente de trabajo completo.",
            "caracteristicas" => [
                "Cama doble (140 cm) y sofá cama",
                "Cocina equipada",
                "Conexión Wi-Fi gratuita",
                "Televisión LCD",
                "Baño privado con ducha",
                "Superficie: 25 a 30 m²"
            ],
            "img" => "https://i.pinimg.com/736x/8b/ee/d1/8beed1c977801ab622b2c68b177464ff.jpg",
            "precio" => "200$",
        ]
    ];

    return $rooms;
}


//Crea los items del navBar
function navbarItem($array, $url_var)
{
    // Verifica la pagina actual 
    if (isset($_GET[$url_var])) {
        $page_actual = $_GET[$url_var];
        $page_actual = preg_replace('/[^a-zA-Z0-9]/', '', $page_actual);
    } else {
        $page_actual = "home";
    }
    //Crea los nav links del nav Bar 
    foreach ($array as $page => $title) {
        $active_class = "";
        if ($page_actual === $page) {
            $active_class = "active";
        }
        if ($url_var == 'admin') {
            echo "  <a class='nav-link $active_class' aria-current='page' href='index.php?$url_var=$page&pagina=1'>$title</a>";
        } else {

            echo "  <a class='nav-link $active_class' aria-current='page' href='index.php?$url_var=$page'>$title</a>";
        }
    }
}

//Devuelve los template de las paginas encontradas
function getTemplate($url_var, $root_path, $src_path)
{
    if (isset($_GET[$url_var])) { // Verificar si se ha pasado una página por URL
        $page = $_GET[$url_var];
        // Filtrar el nombre de la página para evitar inyección
        $page = preg_replace('/[^a-zA-Z0-9]/', '', $page);
        // Ruta del archivo a incluir
        $file = $root_path . $page . '.php';
        $file_src = $src_path . $page . '.php';
        // Verificar si el archivo existe y luego incluirlo
        if (file_exists($file)) {
            include_once $file;
            if (file_exists($file_src)) {
                //die($file_src);
                require_once $file_src;
            }
        } else {
            include BASE_PATH . 'views/error_page_404.php';
        }
        return true;
    }
    return false;
}
