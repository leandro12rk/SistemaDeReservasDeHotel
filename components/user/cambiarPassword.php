<?php require_once './src/user/usuario.php'; ?>

<div class="modal fade" id="changePasswordUser" tabindex="-1" aria-labelledby="changePasswordUserLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="changePasswordUserLabel">Cambiar Contraseña</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="formChangePass">
        <div class="modal-body">
          <div class="form-group">
            <input type="hidden" id="id_perfil_change">
          </div>
          <div class="form-group">
            <label for="newPassword">New Password</label>
            <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="Ingresa la nueva Contraseña" required>
          </div>
          <div class="form-group">
            <label for="confirmPassword">Confirm Password</label>
            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirme la contraseñan ingresada" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Actualizar</button>
        </div>
      </form>
      <div id="respuesta"></div>
    </div>
  </div>
</div>


<script>
  document.getElementById('formChangePass').addEventListener('submit', function(event) {
    // Evita el envío tradicional del formulario
    event.preventDefault();

    // Obtener los valores de las contraseñas
    const newPassword = document.getElementById('newPassword').value.trim();
    const confirmPassword = document.getElementById('confirmPassword').value.trim();

    // Validar que los campos no estén vacíos
    if (newPassword === "" || confirmPassword === "") {
      document.getElementById("respuesta").innerHTML = "Por favor, completa todos los campos.";
      return; // Detener el envío si hay campos vacíos
    }

    // Validar que ambas contraseñas sean iguales
    if (newPassword !== confirmPassword) {
      document.getElementById("respuesta").innerHTML = "Las contraseñas no coinciden.";
      return; // Detener el envío si las contraseñas no coinciden
    }

    // Crear un objeto FormData a partir del formulario
    const formData = new FormData(this);
    formData.append("action", "changeUserPassword"); // Agregar el campo 'action' con el valor 'changeUser Password'

    const xhr = new XMLHttpRequest();
    xhr.open("POST", './src/user/usuario.php', true);

    // Manejador para la respuesta del servidor
    xhr.onload = function() {
      if (xhr.status === 200) {
        document.getElementById("respuesta").innerHTML = xhr.responseText;
        newPassword.value = '';
        confirmPassword.value = '';
      } else {
        document.getElementById("respuesta").innerHTML = "Error en la petición";
        newPassword.value = '';
        confirmPassword.value = '';
      }
    };

    // Enviar los datos del formulario
    xhr.send(formData);

  });
</script>