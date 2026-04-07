<?php
require_once "./src/user/reservas.php";
require_once "./components/user/addReservaUser.php";
?>

<div class="container-fluid body container-reservas" id="reservas">
    <div class="container shadow rounded">
        <div class="">
            <form class="row form " action="" method="POST" enctype="multipart/form-data" id="reservas_home_form_user">
                <div class="col-md-6">
                    <div class="p-3 mb-5">

                        <h2 class="text-center">Reserva tu Habitación</h2>

                        <!-- Fechas de Check-In y Check-Out -->
                        <div class="mb-3">
                            <label for="checkin" class="form-label">Fecha de Entrada</label>
                            <input type="date" class="form-control" id="checkin" name="checkin" value="" required>
                        </div>

                        <div class="mb-3">
                            <label for="checkout" class="form-label">Fecha de Salida</label>
                            <input type="date" class="form-control" id="checkout" name="checkout" value="" required>
                        </div>

                        <!-- Edit button that opens the modal and passes the user ID -->
                        <span data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="AddReserva">
                            <buttom class=" btn btn-secondary " data-user-id=""
                                data-bs-target="#add_reserva_user"
                                id="btn_add_reserva_user"
                                data-bs-toggle="modal">
                                Agregar Habitacion
                            </buttom>
                        </span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="shadow p-3 mb-5 bg-body-tertiary rounded">
                        <div class="d-flex header-resumen-reservas">
                            <h2 class="mb-4 text-center">Resumen de Reserva</h2>
                            <span class="btnUpdateReserva" id="updateResumenReserva">
                                <i class="fa-solid fa-rotate-right"></i>
                            </span>

                        </div>
                        <table class="table table-light table-reserva">
                            <thead>
                                <tr>
                                    <th scope="col">Tipo de Habitación</th>
                                    <th scope="col">Costo de Habitación</th>
                                    <th scope="col">Costo por Noche</th>
                                    <th scope="col">Cantidad de Huéspedes</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($_SESSION['resumenReserva'] as $value): ?>
                                    <tr>
                                        <td scope="row"><?php echo $value['descHabtiacion'] ?></td>
                                        <td><?php echo '$ ' . $value['precio'] ?></td>
                                        <td><?php echo '$ ' . $value['costoPorNoche'] ?></td>
                                        <td><?php echo $value['cantidad_huéspedes'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-end">Impuesto (7%)</td>
                                    <td>$ <?php echo $_SESSION['impuesto']; ?></td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-end">Subtotal</td>
                                    <td>$ <?php echo $_SESSION['subtotal']; ?></td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-end">Total</td>
                                    <td>$ <?php echo $_SESSION['total']; ?></td>
                                </tr>
                            </tfoot>
                        </table>
                        <button type="submit" class="btn btn-primary btn-block">Reservar Habitación</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('updateResumenReserva').addEventListener('click', function(event) {
        //event.preventDefault(); // Evita el envío tradicional del formulario

        const formData = new FormData();
        formData.append("action", "actualizarResumenReservas");

        // Enviar los datos usando fetch
        fetch('./src/user/reservas.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                window.location.reload();
                console.log('Respuesta:', data); // Procesa la respuesta si es necesario
            })
            .catch(error => console.error('Error:', error));
    });

    document.getElementById('reservas_home_form_user').addEventListener('submit', function(event) {
        event.preventDefault(); // Evita el envío tradicional del formulario

        const formData = new FormData(this);
        formData.append("action", "realizarReserva");

        // Enviar los datos usando fetch
        fetch('./src/user/reservas.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                console.log('Respuesta:', data); // Procesa la respuesta si es necesario
            })
            .catch(error => console.error('Error:', error));
    });
</script>

<!-- Galería
<a href="https://picsum.photos/1200/800" class="glightbox" data-gallery="gallery1">
    <img src="https://picsum.photos/300/200" alt="Example 1" />
</a>
<a href="https://picsum.photos/1200/800?2" class="glightbox d-none" data-gallery="gallery1">
    <img src="https://picsum.photos/300/200?2" alt="Example 2" />
</a>
<a href="https://picsum.photos/1200/800?2" class="glightbox d-none" data-gallery="gallery1">
    <img src="https://picsum.photos/300/200?3" alt="Example 2" />
</a> -->