<?php require './src/admin/habitaciones.php'; ?>

<div class=" body container-fluid justify-content-center " id="container-habitaciones">
    <h2> Tipos de Habitaciones Habitaciones</h2>

 

    <div class="overflow-x-auto mt-5">
        <table class="table table-light table-hover">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">#</th>
                    <th scope="col">numero de habitacion</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Cantidad de camas </th>
                    <th scope="col">Estado</th>
                    <th scope="col">Usuario Ocupado</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($arrayDatosPorPagina as $index => $array) : ?>
                    <tr>
                        <th scope='row'></th>
                        <td class="container-acciones">
                            <span data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Edit">
                                <buttom class=" btn btn-primary " 
                                data-habitacion-tipo-id="<?php echo $array['id']; ?>"
                                    data-bs-target="#edit_admin_modal"
                                    id="btn_edit_user"
                                    data-bs-toggle="modal">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </buttom>
                            </span>

                            <button
                                class="btn btn-danger" data-bs-toggle="tooltip"
                                data-bs-placement="right" data-bs-title="Delete"
                                id="btnDeletetipoHabitacion"
                                data-habitacion-tipo-id="<?php echo $array['id']; ?>"
                                class="btn btn-danger btnDeletetipoHabitacion" data-bs-toggle="tooltip">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                        <th scope='row'><? echo $index ?></th>
                        <td class='item-table'><?php echo $array['numeroDeHabitacion'] ?></td>
                        <td class='item-table'><?php echo $array['tipo'] ?></td>
                        <td class='item-table'><?php echo $array['cantiadDeCamas'] ?></td>
                        <td class='item-table'><?php echo $array['estado'] ?></td>
                        <td class='item-table'><?php echo $array['huesped'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php include './components/pagination.php' ?>
</div>

<script>


    document.addEventListener('DOMContentLoaded', function() {

        document.querySelectorAll('.btnDeletetipoHabitacion').forEach(button => {

            button.addEventListener('click', (e) => {
                const tipoIdHabitacion = button.getAttribute('data-habitacion-tipo-id'); // Obtiene el `tipoIdHabitacion` del atributo `data-habitacion-tipo-id`

                // Verifica que `tipoIdHabitacion` no esté vacío
                if (!tipoIdHabitacion) {
                    console.error('Error: el ID de usuario no está definido.');
                    alert('Error: el ID de usuario no está definido.');
                    return;
                }
                // Crear un objeto FormData a partir del formulario
                const formData = new FormData();
                formData.append("action", "deleteTipoHabitacion"); // Agregar el campo 'action' con el valor 'addUser'
                formData.append("tipoIdHabitacion", tipoIdHabitacion); // Agregar el campo 'action' con el valor 'addUser'

                fetch('./src/admin/habitaciones.php', {
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