<?php
require_once './src/admin/reservas.php';
require_once "components/admin/infoUserReservas.php";
require_once "components/admin/addReserva.php";
require_once "components/admin/editReserva.php";

?>

<div class=" body container-fluid justify-content-center " id="container-info-reservas">
    <div class="header-admin">
        <h2> Reservas Registrados</h2>
    </div>
    <div class="eventos d-flex p-2 gap-3">
        <span>
            <input type="checkbox" class="btn-check" id="btn-check_all_reservas" autocomplete="off">
            <label class="btn btn-primary" for="btn-check_all_reservas">Select All</label>
        </span>

        <button class="btn btn-danger" id="btn_delete_all_reserva" disabled> <i class="fa-solid fa-trash"></i> Delete All</button>

        <button class="btn btn-secondary" data-bs-target="#add_admin_reserva" data-bs-toggle="modal">
            <i class="fa-solid fa-plus"></i> Add New Reserva
        </button>
    </div>
    <div class="overflow-x-auto">
        <table class="table table-light table-hover">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Acciones</th>
                    <th scope="col">#</th>
                    <th scope="col">Id Reservas</th>
                    <th scope="col">Huesped</th>
                    <th scope="col">Check In</th>
                    <th scope="col">Check Out</th>
                    <th scope="col">Numero de Noches</th>
                    <th scope="col">Cantidad de Habitaciones</th>
                    <th scope="col">Tipo de Habitación</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Estado</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($arrayDatosPorPaginaReservas as $data => $data_reservas): ?>
                    <tr>
                        <th scope='row'>
                            <input class="form-check-input" type="checkbox"
                                value="<?php echo $user_info['re_id_Rserva'] ?>"
                                id="checbox<?php echo $user_info['re_id_Rserva'] ?>">
                        </th>
                        <td class="container-acciones">

                            <span data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Edit">
                                <buttom
                                    class=" btn btn-primary "
                                    data-reserva-id="<?php echo $user_info['re_id_Rserva'];?>"
                                    data-bs-target="#edit_admin_modal_reservas"
                                    id="btn_edit_reserva"
                                    data-bs-toggle="modal">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </buttom>
                            </span>
                            <button
                                class="btn btn-danger" data-bs-toggle="tooltip"
                                data-bs-placement="right" data-bs-title="Delete"
                                id="btnDeleteReserva"
                                data-reserva-id="<?php echo $user_info['IdReserva']; ?>"
                                class="btn btn-danger" data-bs-toggle="tooltip">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                        <td class='item-table'><?php  ?></td>
                        <td class='item-table'><?php echo  $data_reservas['IdReservas'] ?></td>
                        <td id="infoReservaUser" onclick='onclickInfoUserReserva()' data-bs-toggle='modal'
                            data-bs-target='#infoUserReservas'
                            data-userReserva-id="<?php echo $user_info['IdReservas'];
                                                    ?>"
                            class='item-table modal-select'>
                            <?php echo  $data_reservas['Huesped'] ?></td>
                        <td class='item-table'><?php echo  $data_reservas['CheckIn'] ?></td>
                        <td class='item-table'><?php echo  $data_reservas['CheckOut'] ?></td>
                        <td class='item-table'><?php echo  $data_reservas['NumerodeNoches'] ?></td>
                        <td class='item-table'><?php echo  $data_reservas['CantidaddeHabitaciones'] ?></td>
                        <td class='item-table'><?php echo  $data_reservas['TipodeHabitación'] ?></td>
                        <td class='item-table'><?php echo  $data_reservas['Correo'] ?></td>
                        <td class='item-table'><?php echo  $data_reservas['Estado'] ?></td>   
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- Paginación -->
    <?php include './components/pagination.php' ?>
</div>
<script>
    const btnCheckAllReserva = document.getElementById('btn-check_all_reservas');
    const btnDeleteAllReserva = document.getElementById('btn_delete_all_reserva');
    const btnDeleteReservas = document.getElementById('btnDeleteReserva');
    btnCheckAllReserva.onclick = function() {
        var checkboxes = document.querySelectorAll('.form-check-input');
        for (var checkbox of checkboxes) {
            checkbox.checked = this.checked;
        }
        //valida el estado del boton de eliminar todos los usuario
        let status = btnCheckAllReserva.checked ? false : true;
        btnDeleteAllReserva.disabled = status;
    }

    function onclickInfoUserReserva() {
        const reservaId = document.getElementById('infoReservaUser').getAttribute('data-userReserva-id'); // Obtiene el `reservaId` del atributo `data-user-id`

        // Verifica que `reservaId` no esté vacío
        if (!reservaId) {
            console.error('Error: el ID de usuario no está definido.');
            alert('Error: el ID de usuario no está definido.');
            return;
        }

        // Crear un objeto FormData a partir del formulario
        const formData = new FormData();
        formData.append("action", "getDataReservaUserInfo"); // Agregar el campo 'action' con el valor 'editUser '
        formData.append("reservaId", reservaId); // Agregar el campo 'reservaId'

        fetch('./src/admin/usuarios.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json()) // Asegúrate de que el servidor devuelva un JSON
            .then(data => {
                // Aquí se asume que el servidor devuelve un objeto con los datos del usuario
                if (data) {
                    // Actualiza los campos del formulario en el modal

                } else {
                    console.error('Error: no se recibieron datos del usuario.');
                }
            })
            .catch(error => console.error('Error:', error));
    }

    document.addEventListener('DOMContentLoaded', function() {
        const btnEditReserva = document.querySelectorAll('#btn_edit_reserva'); // Cambia a querySelectorAll para manejar múltiples botones

        btnEditReserva.forEach(button => {
            button.addEventListener('click', (e) => {
                const reservaId = button.getAttribute('data-reserva-id'); // Obtiene el `reservaId` del atributo `data-user-id`

                // Verifica que `reservaId` no esté vacío
                if (!reservaId) {
                    console.error('Error: el ID de usuario no está definido.');
                    alert('Error: el ID de usuario no está definido.');
                    return;
                }

                // Crear un objeto FormData a partir del formulario
                const formData = new FormData();
                formData.append("action", "getDataReservaEdit"); // Agregar el campo 'action' con el valor 'editUser '
                formData.append("reservaId", reservaId); // Agregar el campo 'reservaId'

                fetch('./src/admin/usuarios.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json()) // Asegúrate de que el servidor devuelva un JSON
                    .then(data => {
                        // Aquí se asume que el servidor devuelve un objeto con los datos del usuario
                        if (data) {
                            // Actualiza los campos del formulario en el modal
                            /*
                                                        document.getElementById('user_id').value = data.id;
                                                        document.getElementById('rol').value = data.rol;
                                                        document.getElementById('nombre').value = data.nombre;
                                                        document.getElementById('apellido').value = data.apellido;
                                                        document.getElementById('email').value = data.correo;
                                                        document.getElementById('telefono').value = data.telefono;
                                                        document.getElementById('direccion').value = data.direccion;
                                                        */
                            /*
                                                        // Muestra el modal
                                                        const modal = new bootstrap.Modal(document.getElementById('edit_admin_modal'));
                                                        modal.show();*/

                        } else {
                            console.error('Error: no se recibieron datos del usuario.');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
        });
    });
    btnDeleteReservas.addEventListener('click', (e) => {
        const userId = btnDeleteReservas.getAttribute('data-user-id'); // Obtiene el `userId` del atributo `data-user-id`

        // Verifica que `userId` no esté vacío
        if (!userId) {
            console.error('Error: el ID de usuario no está definido.');
            alert('Error: el ID de usuario no está definido.');
            return;
        }
        // Crear un objeto FormData a partir del formulario
        const formData = new FormData();
        formData.append("action", "deleteUser"); // Agregar el campo 'action' con el valor 'addUser'
        formData.append("userId", userId); // Agregar el campo 'action' con el valor 'addUser'

        fetch('./src/admin/usuarios.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                alert(data);
            })
            .catch(error => console.error('Error:', error));
    });

    btnDeleteAllReserva.addEventListener('click', (e) => {
        // Crear un objeto FormData a partir del formulario
        const formData = new FormData();
        formData.append("action", "deleteAllUser"); // Agregar el campo 'action' con el valor 'addUser'

        fetch('./src/admin/usuarios.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                alert(data);
            })
            .catch(error => console.error('Error:', error));
    });


    document.addEventListener('DOMContentLoaded', function() {
        const checkboxes = document.querySelectorAll('.form-check-input');

        function updateButtonState() {
            let selectedCount = 0;

            checkboxes.forEach((checkbox) => {
                if (checkbox.checked) {
                    selectedCount++;
                }
            });

            // Habilita el botón si hay 2 o más checkboxes seleccionados
            btnDeleteAllReserva.disabled = selectedCount < 2;
        }

        // Llama a la función al cargar la págiNna para establecer el estado inicial del botón
        updateButtonState();

        // Añade el evento 'change' a cada checkbox para actualizar el estado del botón en tiempo real
        checkboxes.forEach((checkbox) => {
            checkbox.addEventListener('change', updateButtonState);
        });
    });
</script>