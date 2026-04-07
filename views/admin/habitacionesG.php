<?php require './src/admin/habitacionesG.php'; ?>
<div class=" body container-fluid justify-content-center " id="container-gestion-habitaciones">
    <div class="header-admin">

        <h2> Tipos de Habitaciones Habitaciones</h2>
    </div>
    <div class="eventos d-flex p-2 gap-3">
        <button class="btn btn-secondary" data-bs-target="#add_admin_modal" data-bs-toggle="modal">
            <i class="fa-solid fa-plus"></i> Add Tipo Habitacíon
        </button>
    </div>
    <div class="overflow-x-auto">
        <table class="table table-light table-hover">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">Tipo de Habitación</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Caracteristicas</th>
                    <th scope="col">Precio</th>
                    <th scope="col">disponibles</th>
                    <th scope="col">Total</th>
                    <th scope="col">Imgaen</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php foreach ($arrayDatosPorPagina as $index => $array) : ?>

                    <tr>
                        <th scope='row'>
                        </th>
                        <td>
                            <buttom class=" btn btn-primary btnEdittipoHabitacion"
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
                        <td class='item-table'><?php echo $array['tipo'] ?></td>
                        <td class='item-table'><?php echo $array['description'] ?></td>
                        <td class='item-table'><?php 
                        foreach($array['caracteristicas'] as $data){ 
                            foreach($data as $valor){ echo $valor.'<br>';} 
                            }  ?></td>
                        <td class='item-table'><?php echo $array['precio'] ?></td>
                        <td class='item-table'><?php echo $array['disponibles'] ?></td>
                        <td class='item-table'><?php echo $array['total'] ?></td>
                        <td class='item-table'>
                            <span class="img-container-admin">
                                <a href="<?php echo $array['imgLink'] ?>" class="glightbox" data-gallery="gallery1">
                                    <img class="img-fluid" src="<?php echo $array['imgLink'] ?>" alt="Example 1" />
                                </a>
                            </span>
                        </td>
        

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- Paginación -->
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
        });
        document.querySelectorAll('.btnEdittipoHabitacion').forEach(button => {

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
                formData.append("action", "editTipoHabitacion"); // Agregar el campo 'action' con el valor 'addUser'
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
        });
    });
</script>