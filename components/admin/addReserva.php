<div class="modal fade" id="add_admin_reserva" tabindex="-1" aria-labelledby="reservas_usuarios_adminLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="reservas_usuarios_adminLabel">Añadir Nuevos Usuarios</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="./src/reservas.php" method="POST" enctype="multipart/form-data">
                    <div class="input-group">
                        <div class="form-group">
                            <label for="checkin">Fecha de Entrada</label>
                            <input type="date" class="form-control" id="checkin" name="checkIn" required>
                        </div>
                        <span class="align-self-center"><i class="fa-solid fa-arrow-right"></i></span>
                        <div class="form-group">
                            <label for="checkout">Fecha de Salida</label>
                            <input type="date" class="form-control" id="checkout" name="checkOut" required>
                        </div>
                    </div>
                    <div class="input-group">
                        <div class="form-group">
                            <label for="name">Nombre </label>
                            <input type="text" class="form-control" id="name" name="firstName" required>

                        </div>
                        <div class="form-group">
                            <label for="name">Apellido</label>
                            <input type="text" class="form-control" id="apellido_c" name="lastName" required>

                        </div>
                    </div>
                    <div class="input-group">
                        <div class="form-group">
                            <label for="email_r">Correo Electrónico</label>
                            <input type="email" class="form-control" id="email_r" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Teléfono</label>
                            <input type="tel" class="form-control" id="phone" name="phoneNumber" required>
                        </div>
                    </div>
                    <div class="input-group">
                        <div class="form-group">
                            <label for="room-type">Tipo de Habitación</label>
                            <select class="form-control" id="room-type" required name="roomType">
                                <option value="">Seleccione una opción</option>
                                <?php foreach (getRoomInformation() as $key => $array): ?>
                                    <option value='<?php //echo $array['id'] ?>'>
                                        <?php
                                        //$tipo_habitacion_activo = $array['id'];
                                        //echo $array['tipo']
                                        ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <p><?php echo $tipo_habitacion_activo ?></p>
                        <div class="form-group">
                            <label for="rooms">Número de Habitaciones</label>
                            <input type="number" class="form-control" id="rooms" min="1" max='50' name="cantRoom" required>
                        </div>
                    </div>
                    <div class="input-group">
                        <div class="form-group">
                            <label for="adults">Adultos</label>
                            <input type="number" class="form-control" id="adults" min="1" max='50' name="cantAdults" required>
                        </div>
                        <div class="form-group">
                            <label for="teenagers">Adolescentes <span>(13-17 años)</span> </label>
                            <input type="number" class="form-control" id="teenagers" min="0" max='50' name="cantTeen">
                        </div>
                        <div class="form-group">
                            <label for="children">Niños <span>(0-12 años)</span> </label>
                            <input type="number" class="form-control" id="children" min="0" max='50' name="cantChild">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Cotizar Habitación</button>
                </form>
            </div>
        </div>
    </div>
</div>