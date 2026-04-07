<?php

$id_huesped = 0; // Declaración global

function prueba_parametro($pas)
{
    global $id_huesped; // Acceso a la variable global
    $id_huesped = $pas;
}

$huesped_reservas = [
  [
    "Numero Identificacion" => "8-998-546",
    "Nombre" => "Juan ",
    "Apellido" => "Pérez",
    "Edad" => 25,
    "Correo Electronico" => "juan@example.com",
    "Reserva Asociada" => 1004,
    'Id Usuario' => 2,
  ],
  [
    "Numero Identificacion" => "8-979-534",
    "Nombre" => "María",
    "Apellido" => "Rodríguez",
    "Edad" => 35,
    "Correo Electronico" => "maria@example.com",
    "Reserva Asociada" => 1004,
    'Id Usuario' => 1,
  ],
];

?>

<div class="modal fade" id="infoUserReservas" tabindex="-1" aria-labelledby="infoUserReservasLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="infoUserReservasLabel">Huesped</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?php
        foreach ($huesped_reservas as $huesped) {
          if ($huesped['Id Usuario'] == $id_huesped) {
            echo "
                Numero Identificacion => {$huesped['Numero Identificacion']}
                 <br>
                Nombre => {$huesped['Nombre']}
                 <br>
                Apellido => {$huesped['Apellido']}
                 <br>
                Edad => {$huesped['Edad']}
                 <br>
                Correo Electronico => {$huesped['Correo Electronico']}
                 <br>
                Reserva Asociada => {$huesped['Reserva Asociada']}
            <br>
            ";
          }
        }
        ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>