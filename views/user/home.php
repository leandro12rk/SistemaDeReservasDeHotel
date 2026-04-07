<?php
require_once './src/user/home.php';
?>

<div id="home" class="">

    <?php
    include "components/user/carousel.php";
    ?>

    <div class="container-description">
        <span class="description">
            ¡Descubre DevHub Retreat! Un refugio seguro y creativo para programadores y profesionales de la tecnología. Ubicado en un entorno inspirador, nuestro hotel fomenta la innovación y la colaboración.
        </span>
    </div>
    <div class="container-card-hotel-features">
        <h2>Ofrecemos</h2>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3  row-cols-xl-4 features-card-home">

            <?php foreach ($caracteristicas_hoteles as $info): ?>
                <div class='col'>
                    <div class='card w-100'>
                        <img src='./public/img/<?php echo $info['img'] ?>' class='card-img-top' alt='<?php echo $info['title'] ?>'>
                        <div class='card-body'>
                            <h5 class='card-title'><?php echo $info['title'] ?></h5>
                            <p class='card-text'><?php echo $info['description'] ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <!-- Slider main container -->
    <div class="swiper-container container-fluid">
        <h2>Habitaciones</h2>
        <div class="swiper">
            <div class="swiper-wrapper">
                <?php foreach (getRoomInformation() as $index => $array) : ?>
                    <div class="swiper-slide">
                        <div class='card w-100'>
                            <span class="img-container">
                                <img src=<?php echo $array['img'] ?> class='img-fluid' alt=<?php echo $array['tipo'] ?>>
                            </span>
                            <div class='card-body justify-content-center'>
                                <h5 class='card-title'> <?php echo $array['tipo'] ?></h5>
                                <p class='card-text'>
                                    <?php echo $array['descripcion'] ?>
                                </p>
                                <?php
                                if (isset($_SESSION['userRegistrado']) &&  $_SESSION['userRegistrado']):
                                ?>
                                    <a href="<?php echo BASE_URL; ?>index.php?page=reservas">
                                        <button class="btn-primary btn"> Reservar </button>
                                    </a>
                                <?php endif; ?>

                                <span class="btn btn-detalles" id="btn-detalles">
                                    ver más detalles
                                </span>
                            </div>
                            <div class="card-body card-detalles justify-content-center  text-center p-4" id="card_detalles">
                                <span>
                                    <?php
                                    foreach ($array['caracteristicas'] as $caracteristica) {
                                        echo "<p class='m-2 p-2 bg-primary text-white rounded d-flex align-items-space-betewen justify-content-center' style='transition: background-color 0.3s;'> 
                                        <i class='fa fa-check-circle me-2'></i>$caracteristica
                                         </p>";
                                    }
                                    ?>
                                </span>
                            </div>

                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="reserva-desc">
        <span>
            Para realizar una reserva, visita nuestro sitio web o contacta
            a nuestro equipo de atención al cliente. Estamos aquí para
            ayudarte a encontrar el espacio perfecto para tu estancia en
            DevHub Retreat. ¡Esperamos darte la bienvenida pronto!
        </span>
    </div>
</div>

<script>
    const btn_detalles = document.querySelectorAll('.btn-detalles');

    btn_detalles.forEach(element => {
        element.addEventListener('click', () => {
            // Encuentra el contenedor más cercano con la clase 'card'
            const card = element.closest('.card');

            // Encuentra el elemento con la clase 'card-detalles' dentro de la misma tarjeta
            const cardDetalles = card.querySelector('.card-detalles');

            if (cardDetalles) {
                // Alterna la visibilidad del elemento
                cardDetalles.classList.toggle('visible');

                // Cambia el texto del botón según la visibilidad
                if (cardDetalles.classList.contains('visible')) {
                    element.textContent = 'ver menos detalles';
                } else {
                    element.textContent = 'ver más detalles';
                }
            }
        });
    });

    document.addEventListener("DOMContentLoaded", function() {

        const swiper = new Swiper('.swiper', {
            loop: true,
            slidesPerView: 1,
            spaceBetween: 2,
            speed: 500,
            autoplay: {
                delay: 5000,
            },
            breakpoints: {
                320: {
                    slidesPerView: 1,
                    spaceBetween: 20
                },
                480: {
                    slidesPerView: 3,
                    spaceBetween: 30
                },
                1400: {
                    slidesPerView: 4,
                    spaceBetween: 30
                }
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    });
</script>