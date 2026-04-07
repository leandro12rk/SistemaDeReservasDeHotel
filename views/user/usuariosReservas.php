<?php
require_once BASE_PATH . "/src/user/usuariosReservas.php";
?>


<div class=" body container-fluid justify-content-center " id="container-user-reservas">
    <div class="header container-fluid">
        <h2> Historial de Reservas </h2>
    </div>

    <div class="container-fluid mb-3">

        <div class="row justify-content-center gap-3">
            <?php foreach ($arrayDatosPorPagina as $data => $data_reservas): ?>
                <div class="col-sm-5 mb-3 mb-sm-0 ">
                    <div class="card">

                        <div class="card-header bg-primary-subtle bg-gradient">
                            <h6>
                                Codigo de Reserva :
                                <?php echo  $data_reservas['Id Reservas'] ?>
                                <span class="badge  text-bg-info"><?php echo  $data_reservas['Estado'] ?></span>

                            </h6>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">
                            </h5>
                            <p class="card-text row">
                                <span class="">
                                    <span>
                                        Entrada :
                                        <?php echo  $data_reservas['Check In'] ?>
                                    </span>
                                    <span>
                                        Salida :
                                        <?php echo  $data_reservas['Check Out'] ?>
                                    </span>
                                </span>
                                <span class="">
                                    Numero de Noches :
                                    <?php echo  $data_reservas['Numero de Noches'] ?>
                                </span>
                                <span class="">
                                    Tipo de Habitacion :
                                    <?php echo  $data_reservas['Tipo de Habitación'] ?>
                                </span>
                            </p>
                            <span class="container-button row">
                                <?php if ($data_reservas['Estado'] == 'Pendiente'): ?>
                                    <button class="btn btn-info bg-gradient  col-lg-5 btn_confirmar_reserva_usuario"
                                        data-id-reserva-user=<?php echo $data_reservas['Id Reservas'] ?> id="btn_confirmar_reserva_usuario">
                                        <i class="fa-solid fa-check"></i> Confirmar Reserva</button>
                                    <?php if ($data_reservas['Estado'] != 'Cancelado'): ?>
                                        <button class="btn btn-danger bg-gradient col-lg-5 btn_cancelar_reserva_usuario"
                                            data-id-reserva-user=<?php echo $data_reservas['Id Reservas'] ?> id="btn_cancelar_reserva_usuario">
                                            <i class="fa-solid fa-ban"></i> Cancelar Reserva</button>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <?php if ($data_reservas['Estado'] != 'Pendiente' || $data_reservas['Estado'] != 'Cancelado' ): ?>
                                    <button class="btn btn-danger bg-gradient col-lg-5 btn_delete_reserva_usuario"
                                        data-id-reserva-user=<?php echo $data_reservas['Id Reservas'] ?> id="btn_delete_reserva_usuario">
                                        <i class="fa-solid fa-trash"></i> Eliminar Reserva de Historial</button>
                                <?php endif; ?>

                            </span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <?php include './components/pagination.php' ?>

</div>


<script>
    function windowReload() {
        window.location.reload();
    }
    document.addEventListener('DOMContentLoaded', function() {

        // Evento para eliminar un reserva
        document.querySelectorAll('.btn_delete_reserva_usuario').forEach(button => {
            button.addEventListener('click', function() {

                const reserva_user_id = this.getAttribute('data-id-reserva-user');

                if (!reserva_user_id) {
                    console.error('Error: el ID de la reserva no está definido.');
                    alert('Error: el ID de la reserva no está definido.');
                    return;
                }

                const formData = new FormData();
                formData.append('action', 'deleteReservaUsuario');
                formData.append('reserva_user_id', reserva_user_id);

                fetch('./src/user/usuariosReservas.php', {
                        method: 'POST',
                        body: formData,
                    })
                    .then(response => response.text())
                    .then(data => {
                        // Recargar la página tras la acción
                        console.log(data);
                        windowReload();
                    })
                    .catch(error => console.error('Error:', error));
            });
        });
        // Evento para cancelar  reserva
        document.querySelectorAll('.btn_cancelar_reserva_usuario').forEach(button => {
            button.addEventListener('click', function() {

                const reserva_user_id = this.getAttribute('data-id-reserva-user');

                if (!reserva_user_id) {
                    console.error('Error: el ID de la reserva no está definido.');
                    alert('Error: el ID de la reserva no está definido.');
                    return;
                }

                const formData = new FormData();
                formData.append('action', 'cancelarReservaUsuario');
                formData.append('reserva_user_id', reserva_user_id);

                fetch('./src/user/usuariosReservas.php', {
                        method: 'POST',
                        body: formData,
                    })
                    .then(response => response.text())
                    .then(data => {
                        // Recargar la página tras la acción
                        console.log(data);
                        windowReload();
                    })
                    .catch(error => console.error('Error:', error));
            });
        });
        // Evento para confirmar reserva
        document.querySelectorAll('.btn_confirmar_reserva_usuario').forEach(button => {
            button.addEventListener('click', function() {
                const reserva_user_id = this.getAttribute('data-id-reserva-user');

                if (!reserva_user_id) {
                    console.error('Error: el ID de la reserva no está definido.');
                    alert('Error: el ID de la reserva no está definido.');
                    return;
                }

                const formData = new FormData();
                formData.append('action', 'confirmarReservaUsuario');
                formData.append('reserva_user_id', reserva_user_id);

                fetch('./src/user/usuariosReservas.php', {
                        method: 'POST',
                        body: formData,
                    })
                    .then(response => response.text())
                    .then(data => {
                        // Recargar la página tras la acción
                        console.log(data);
                        windowReload();
                    })
                    .catch(error => console.error('Error:', error));
            });
        });


    });
</script>