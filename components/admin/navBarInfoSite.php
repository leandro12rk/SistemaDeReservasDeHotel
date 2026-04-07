<?php
$array_info_nav = [
    "habitacionesG" => "Data Info Habitaciones",
];

$pages_array = [
    "usuarios" => "Usuarios",
    "reservas" => "Reservas",
    "correos" => "Correos",
];


?>
<div class="accordion" id="accordionNavAdmin">
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Consultas Site
            </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionNavAdmin">
            <div class="accordion-body">
                <?php navbarItem($pages_array, "admin"); ?>
            </div>
        </div>
    </div>
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                Info de Site
            </button>
        </h2>
        <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionNavAdmin">
            <div class="accordion-body">
                <?php navbarItem($array_info_nav, "admin"); ?>
            </div>
        </div>
    </div>
</div>