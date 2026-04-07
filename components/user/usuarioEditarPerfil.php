<?php require_once './src/user/usuario.php'; ?>

<div class="modal fade" id="perfilEdithUser" tabindex="-1" aria-labelledby="perfilEdithUserLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="perfilEdithUserLabel">Editar Perfil de Usuario</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="perfilEditForm" action="">
          <div class="form-group">
            <input type="hidden" id="id_perfil_edit">
          </div>
          <div class="form-group">
            <label for="nombre_perfil">Nombre</label>
            <input type="text" class="form-control" id="nombre_perfil_edit">
          </div>
          <div class="form-group">
            <label for="apellido_perfil">Apellido</label>
            <input type="text" class="form-control" id="apellido_perfil_edit">
          </div>
          <div class="form-group">
            <label for="email_perfil">Correo Electrónico</label>
            <input type="email" class="form-control" id="email_perfil_edit">
          </div>
          <div class="form-group">
            <label for="telefono_perfil">Teléfono</label>
            <input type="text" class="form-control" id="telefono_perfil_edit">
          </div>
          <div class="form-group">
            <label for="direccion_perfil">Dirección</label>
            <input type="text" class="form-control" id="direccion_perfil_edit">
          </div>
          <button type="submit" class="btn btn-primary mt-3">
            Actualizar
          </button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  document.getElementById('perfilEditForm').addEventListener('submit', function(event) {
    // event.preventDefault(); // Evita el envío tradicional del formulario

    // Crear un objeto FormData a partir del formulario
    const formData = new FormData(this);
    formData.append("action", "updatePerfilUser"); // Agregar el campo 'action' con el valor 'addUser'

    const xhr = new XMLHttpRequest();
    xhr.open("POST", './src/user/usuarios.php', true);

    // Manejador para la respuesta del servidor
    xhr.onload = function() {
      if (xhr.status === 200) {
        document.getElementById("respuesta").innerHTML = xhr.responseText;

      } else {
        document.getElementById("respuesta").innerHTML = "Error en la petición";
      }
    };

    // Enviar los datos del formulario
    xhr.send(formData);
  });
</script>