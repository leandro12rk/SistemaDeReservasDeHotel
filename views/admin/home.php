<?php
require_once './src/admin/home.php';
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

<div class="body container-fluid mt-3" id="home_admin">
    <div class="row info-admin justify-content-center">
        <?php foreach ($array_info_admin as $info): ?>
            <div class='col-xl-2 col-sm-6 mb-xl-0 mb-6'>
                <div class='card shadow'>
                    <div class='card-header p-3 pt-2'>
                        <div class='icon'>
                            <?php echo $info['icono'] ?>
                        </div>
                        <div class='text-end pt-1 text'>
                            <p class='text-sm mb-0 text-capitalize'><?php echo $info['titulo'] ?></p>
                            <h4 class='mb-0'><?php echo $info['info'] ?></h4>
                        </div>
                    </div>
                    <hr class='dark horizontal my-0'>
                    <div class='card-footer p-3'>
                        <p class='mb-0'>
                            <span class='text-success text-sm font-weight-bolder'>
                                <span class='material-symbols-outlined'>event</span>
                                <?php echo $info['template'] ?>
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        <?php endforeach ?>

    </div>
    <div class="charts">
        <div class="row">
            <div class=" col-xl-8 col-sm-6 mb-xl-0 shadow p-3 mb-5 bg-body-tertiary rounded mt-3 table-container">
                <h3 class="text-center">Proximas Reservas</h3>
                <div class="overflow-x-auto">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Id Reserva</th>
                                <th scope="col">Habitación</th>
                                <th scope="col">Fecha de Resv.</th>
                                <th scope="col">Check In</th>
                                <th scope="col">Ckeck Out</th>
                                <th scope="col">Nombre Completo </th>
                                <th scope="col">Tipo de Habitación</th>
                            </tr>
                        </thead>
                        <?php

                        ?>
                        <tbody>
                            <?php foreach ($proxima_reservas  as $reserva): ?>
                                <tr> 
                                    <td scope='row'> <?php echo $reserva['re_id_Reserva']?></td>
                                    <td><?php echo  $reserva['ha_id_habitacion'] ?></td>
                                    <td><?php echo  $reserva['re_fecha_reserva'] ?></td>
                                    <td scope='row'> <?php echo $reserva['re_fecha_checkin']?></td>
                                    <td><?php echo  $reserva['re_fecha_checkout'] ?></td>
                                    <td><?php echo  $reserva['us_nombre']. ' ' .  $reserva['us_apellido']?></td>
                                    <td><?php echo  $reserva['th_esc_habitacion'] ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class=" col-xl-5 col-sm-6 mb-xl-0 shadow p-3 mb-5 bg-body-tertiary rounded mt-3">
                <canvas id="estado_habitaciones" style="width:100%;max-width:700px"></canvas>
                <span>
                    <h3 class="text-center">Estado de Habitaciones</h3>
                </span>
            </div>
            <div class=" col-xl-5 col-sm-6 mb-xl-0 shadow p-3 mb-5 bg-body-tertiary rounded mt-3">
                <canvas id="estados_huespedes" style="width:100%;max-width:700px"></canvas>
                <span>
                    <h3 class="text-center">Cantidad de Huespedes Hospedados</h3>
                </span>
            </div>

        </div>

    </div>
</div>

<script>
    //Estados habitaciones 
    var xValues = ["Disponibles", "Reservados", "ocupados"];

    var yValues = [
        <?php echo (int) $info_habitaciones_disponibles ?>,
        <?php echo (int) $info_habitaciones_reservados ?>,
        <?php echo (int) $info_habitaciones_totales ?>
    ];
    new Chart("estado_habitaciones", {
        type: "pie",
        data: {
            labels: xValues,
            datasets: [{
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)'
                ],
                data: yValues,
                hoverOffset: 4
            }]
        }
    });
    // estado Huespedes
    var xValues = ["Niños", "Adultos", "Adolescentes"];
    var yValues = [55, 49, 30];
    new Chart("estados_huespedes", {
        type: "pie",
        data: {
            labels: xValues,
            datasets: [{
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)'
                ],
                data: yValues,
                hoverOffset: 4
            }]
        }
    });
</script>