<?php require_once './src/admin/correos.php'; ?>
<div class="body container-fluid justify-content-center" id="container-correos">
    <div class="header-admin">
        <h2> Estados de Correos</h2>
    </div>
    <div class="overflow-x-auto mt-5">
        <table class="table table-light table-hover" id="table_correos">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Asunto</th>
                    <th scope="col">Mensaje</th>
                    <th scope="col">Persona</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($arrayDatosPorPagina as $correo_info): ?>
                    <tr>
                        <td class="container-acciones">
                            <button
                                class="btn btn-danger btnDeleteCorreo"
                                data-bs-toggle="tooltip"
                                data-bs-placement="right"
                                data-bs-title="Delete"
                                data-user-id="<?php echo $correo_info['id']; ?>">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                        <td><?php echo $correo_info['asunto'] ?></td>
                        <td><?php echo $correo_info['mensaje'] ?></td>
                        <td><?php echo $correo_info['nombre'] . ' , ' . $correo_info['apellido'] ?></td>
                        <td><?php echo $correo_info['correo'] ?></td>
                        <td><?php echo $correo_info['date'] ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <!-- Paginación -->
    <?php include './components/pagination.php' ?>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const btnCheckAll = document.getElementById('btn-check_all');
    const btnDeleteAllCorreo = document.getElementById('btn_delete_all_correo');

    // Evento para seleccionar/deseleccionar todos los checkboxes
    if (btnCheckAll && btnDeleteAllCorreo) {
        btnCheckAll.addEventListener('click', function () {
            const checkboxes = document.querySelectorAll('.form-check-input');
            checkboxes.forEach(checkbox => {
                checkbox.checked = btnCheckAll.checked;
            });
            btnDeleteAllCorreo.disabled = !btnCheckAll.checked;
        });
    }

    // Evento para eliminar un correo
    document.querySelectorAll('.btnDeleteCorreo').forEach(button => {
        button.addEventListener('click', function () {
            const correoId = this.getAttribute('data-user-id');

            if (!correoId) {
                console.error('Error: el ID del correo no está definido.');
                alert('Error: el ID del correo no está definido.');
                return;
            }

            const formData = new FormData();
            formData.append('action', 'deleteCorreo');
            formData.append('correoId', correoId);

            fetch('./src/admin/correos.php', {
                method: 'POST',
                body: formData,
            })
                .then(response => response.text())
                .then(data => {
                    // Recargar la página tras la acción
                    window.location.reload();
                })
                .catch(error => console.error('Error:', error));
        });
    });

    // Evento para eliminar todos los correos seleccionados
    if (btnDeleteAllCorreo) {
        btnDeleteAllCorreo.addEventListener('click', function () {
            const formData = new FormData();
            formData.append('action', 'deleteAllUser');

            fetch('./src/admin/correos.php', {
                method: 'POST',
                body: formData,
            })
                .then(response => response.text())
                .then(data => {
                    // Recargar la página tras la acción
                    window.location.reload();
                })
                .catch(error => console.error('Error:', error));
        });
    }

    // Manejo de habilitación del botón de eliminar todos
    const checkboxes = document.querySelectorAll('.form-check-input');
    if (checkboxes.length > 0) {
        const updateButtonState = () => {
            let selectedCount = 0;

            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    selectedCount++;
                }
            });

            btnDeleteAllCorreo.disabled = selectedCount < 2;
        };

        // Inicializa el estado del botón
        updateButtonState();

        // Actualiza el estado al cambiar los checkboxes
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateButtonState);
        });
    }
});
</script>