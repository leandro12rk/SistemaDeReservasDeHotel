<?php
require_once './src/admin/usuarios.php';
require_once "components/admin/editUser.php";
require_once "components/admin/addUser.php";

?>
<div class=" body container-fluid justify-content-center " id="container-usuarios">
    <div class="header-admin">

        <h2> Usuario Registrados</h2>
    </div>
    <div class="container-eventos d-flex">

        <div class="eventos d-flex p-2 gap-3">
            <button class="btn btn-secondary" data-bs-target="#add_admin_modal" data-bs-toggle="modal">
                <i class="fa-solid fa-plus"></i> Add New User
            </button>
        </div>
    </div>
    <!-- table  -->
    <div class="overflow-x-auto mt-5">
        <table class="table table-light table-hover">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Acciones</th>
                    <th scope="col">Rol</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">E mail</th>
                    <th scope="col">Télefono</th>
                    <th scope="col">Dirrección</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($arrayDatosPorPagina as $user_info): ?>
                    <tr>
                        <th scope='row'></th>
                        <td class="container-acciones">
                            <!-- Edit button that opens the modal and passes the user ID -->
                            <span data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Edit">
                                <buttom class=" btn btn-primary btn_edit_user " data-user-id="<?php echo $user_info['us_id_Usuario']; ?>"
                                    data-bs-target="#edit_admin_modal"
                                    id="btn_edit_user"
                                    data-bs-toggle="modal">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </buttom>
                            </span>

                            <button
                                class="btn btn-danger btnDeleteUser" data-bs-toggle="tooltip"
                                data-bs-placement="right" data-bs-title="Delete"
                                id="btnDeleteUser"
                                data-user-id="<?php echo $user_info['us_id_Usuario']; ?>"
                                class="btn btn-danger" data-bs-toggle="tooltip">
                                <i class="fa fa-trash"></i>
                            </button>

                        </td>
                        <td><?php echo $user_info['us_id_Rol'] ?></td>
                        <td><?php echo $user_info['us_nombre'] ?></td>
                        <td><?php echo $user_info['us_apellido'] ?></td>
                        <td><?php echo $user_info['us_correo'] ?></td>
                        <td><?php echo $user_info['us_telefono'] ?></td>
                        <td><?php echo $user_info['us_direccion'] ?></td>
                    </tr>
                <?php endforeach ?>

            </tbody>
        </table>
    </div>
    <!-- Paginación -->
    <?php include './components/pagination.php' ?>
</div>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        const btnEditUser = document.querySelectorAll('.btn_edit_user'); // Cambia a querySelectorAll para manejar múltiples botones
        btnEditUser.forEach(button => {
            button.addEventListener('click', (e) => {
                const userId = button.getAttribute('data-user-id'); // Obtiene el `userId` del atributo `data-user-id`

                // Verifica que `userId` no esté vacío
                if (!userId) {
                    console.error('Error: el ID de usuario no está definido.');
                    alert('Error: el ID de usuario no está definido.');
                    return;
                }

                // Crear un objeto FormData a partir del formulario
                const formData = new FormData();
                formData.append("action", "getDataUser"); // Agregar el campo 'action' con el valor 'editUser '
                formData.append("userId", userId); // Agregar el campo 'userId'

                fetch('./src/admin/usuarios.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json()) // Asegúrate de que el servidor devuelva un JSON
                    .then(data => {
                        // Aquí se asume que el servidor devuelve un objeto con los datos del usuario
                        if (data) {
                            console.log(data);
                            // Actualiza los campos del formulario en el modal
                            document.getElementById('edit_user_id').value = data.us_id_Usuario;
                            document.getElementById('edit_rol').value = data.rol;
                            document.getElementById('edit_nombre').value = data.us_nombre;
                            document.getElementById('edit_apellido').value = data.us_apellido;
                            document.getElementById('edit_email').value = data.us_correo;
                            document.getElementById('edit_telefono').value = data.us_telefono;
                            document.getElementById('edit_direccion').value = data.us_direccion;
                        } else {
                            console.error('Error: no se recibieron datos del usuario.');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
        });

        //btn delete 
        document.querySelectorAll('.btnDeleteUser').forEach(button => {

            button.addEventListener('click', (e) => {
                const userId = button.getAttribute('data-user-id'); // Obtiene el `userId` del atributo `data-user-id`

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
                        // Recargar la página después del llamado
                        window.location.reload();
                    })
                    .catch(error => console.error('Error:', error));
            });
        })
    });
</script>