<div class="container-accordion">
    <h2>Habitaciones</h2>
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <?php foreach (getRoomInformation() as $index => $array) : ?>
                <div class="swiper-slide">
                    <div class='card'>
                        <img src='' class='card-img-top' alt=''>
                        <div class='card-body'>
                            <h5 class='card-title'> <?php $array['tipo'] ?></h5>
                            <p class='card-text'><?php $array['descripcion'] ?>
                                <?php
                                foreach ($array['caracteristicas'] as $caracteristica) {
                                    echo "<p>$caracteristica</p>";
                                }
                                ?>
                            </p>
                        </div>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-prev"></div>

        <div class="swiper-button-next"></div>
    </div>

    <script>
        const swiper = new Swiper('.swiper-container', {
            loop: true,
            slidesPerView: 4,
            spaceBetween: 4,
            // Responsive breakpoints
            breakpoints: {
                // when window width is >= 320px
                320: {
                    slidesPerView: 2,
                    spaceBetween: 20
                },
                // when window width is >= 480px
                480: {
                    slidesPerView: 3,
                    spaceBetween: 30
                },
                // when window width is >= 640px
                640: {
                    slidesPerView: 4,
                    spaceBetween: 40
                }
            },
            // If we need pagination
            pagination: {
                el: '.swiper-pagination',
            },

            // Navigation arrows
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },

        });
    </script>
</div>

<div class="container-habitacines">
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="true">
            <div class="carousel-indicators">
                <?php foreach (getRoomInformation() as $index => $array) : ?>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?php echo ($index + 1) ?>" class="<?php echo ($index == 0) ? '' : 'active' ?>" aria-current="true" aria-label="Slide <?php echo ($index + 1) ?>"></button>
                <?php endforeach; ?>
            </div>
            <div class="carousel-inner">
                <?php foreach (getRoomInformation() as $index => $array) : ?>
                    <div class="carousel-item <?php echo ($index == 0) ? '' : 'active' ?>">
                        <img src=<?php echo $array['img'] ?> class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5><?php echo $array['tipo'] ?></h5>
                            <p><?php echo $array['descripcion'] ?></p>
                            <p><?php echo $array['precio'] ?></p>
                            <button class="btn btn-primary">Reservar</button>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
