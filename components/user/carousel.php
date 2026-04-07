<?php

$array_img = array();

$array_img = [
    [
        'img' => "https://www.ultraimagehub.com/wallpapers/tr:flp-false,gx-0.2,gy-0.6,q-75,rh-3264,rw-5824,th-1080,tw-1920/1243204670218960906.jpeg",
        'alt' => ''
    ],
    [
        'img' => "https://eraseunhotel.com/wp-content/uploads/2017/12/6-grande.jpg",
        'alt' => ''
    ],
    [
        'img' => "https://ofistim.com.tr/wp-content/uploads/2022/04/Disenos-de-Habitaciones-de-Hotel.jpeg",
        'alt' => ''
    ],
];
?>
<div id="carouselHome" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <?php

        foreach ($array_img as $index => $array) {
            $extra =   ($index == 0) ?  "class='active' aria-current='true'" : "";
            echo "<button data-bs-target='#carouselHome'
            data-bs-slide-to=$index $extra aria-label='slide $index'> </button>";
        }
        ?>

    </div>
    <div class="carousel-inner">

        <?php
        foreach ($array_img as $index => $array) {
            $active_class =   ($index == 0) ?  "active" : "";
            echo  " 
            <div class='carousel-item $active_class'>
                <span class='container-img'>
                    <img src='{$array['img']}' class='d-block img-fluid' alt='{$array['alt']}'>
                </span>
            </div>
            ";
        }
        ?>

    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#carouselHome" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>

    <button class="carousel-control-next" type="button" data-bs-target="#carouselHome" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>