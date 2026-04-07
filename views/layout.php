<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="./public/assets/css/Style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />
    <title><?php echo 'Hotel' ?></title>
</head>



<body>

    <?php
    session_start();
    // Inicializa 'isAdmin' si no existe en la sesión
    if (!isset($_SESSION['isAdmin'])) {
        $_SESSION['isAdmin'] = FALSE;
    }

    if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']) {

        echo "<div class='container-admin'>";
        include BASE_PATH . "components/admin/header.php";
        include BASE_PATH . "views/body.php";
        echo "</div>";
    } else {

        include BASE_PATH . "components/user/header.php";
        include BASE_PATH . "views/body.php";
        include BASE_PATH . "components/footer.php";
    }
    ?>



    <script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
         
        /* Date Picker */

        /* inicializaciones de boostrap */
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

        const toastTrigger = document.querySelectorAll('[data-bs-toggle="toastTrigger"]')
        const toastLiveExample = document.getElementById('liveToast')

        toastTrigger.forEach(element => {

            if (element) {
                const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
                element.addEventListener('click', () => {
                    toastBootstrap.show()
                })
            }
        });

        /* Galerias de imagenes  */
        const lightbox = GLightbox({
            selector: ".glightbox",
            touchNavigation: true,
            loop: true,
            openEffect: "zoom",
            closeEffect: "fade",
            cssEfects: {
                // This are some of the animations included, no need to overwrite
                fade: {
                    in: "fadeIn",
                    out: "fadeOut",
                },
                zoom: {
                    in: "zoomIn",
                    out: "zoomOut",
                },
            },
        });
    </script>

</body>

</html>