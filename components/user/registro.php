<form id="register-form" style="display: none;" method="POST" action='./src/user/registro.php'>
    <div class="mb-3">
        <label for="registerName" class="form-label">Usuario</label>
        <input type="text" class="form-control" id="registerName" name="user" placeholder="Ingresa tu nombre completo" required>
    </div>
    <div class="row">
        <div class="mb-3 col-6">
            <label for="registerUser" class="form-label"> Nombre </label>
            <input type="text" class="form-control" id="registerUser" name="userName" placeholder="Ingresa tu nombre " required>
        </div>
        <div class="mb-3 col-6">
            <label for="registerApellido" class="form-label">Apellido </label>
            <input type="text" class="form-control" id="registerApellido" name="apellido" placeholder="Ingresa tu apellido" required>
        </div>
    </div>
    <div class="mb-3">
        <label for="registerEmail" class="form-label">Correo Electrónico</label>
        <input type="email" class="form-control" id="registerEmail" name="email" placeholder="Ingresa tu correo" required>
    </div>
    <div class="row">
        <div class="mb-3 col-6 ">
            <label for="rtelefono" class="form-label"> Telefono</label>
            <input type="text" class="form-control" id="rtelefono" name="telefono" placeholder="Ingresa su Telefono" required>
        </div>
        <div class="mb-3 col-6 ">
            <label for="rdireccion" class="form-label"> Direccion</label>
            <input type="text" class="form-control" id="rdireccion" name="direccion" placeholder="Ingresa tu Direccion" required>
        </div>
    </div>
    <div class="row">

        <div class="mb-3 col-6">
            <label for="registerPassword" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="registerPassword" name="password" placeholder="Ingresa tu contraseña" required>
        </div>

        <div class="mb-3 col-6">
            <label for="registerPasswordConfirm" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="registerPasswordConfirm" name="passwordConfirm" placeholder="Ingresa tu contraseña" required>
        </div>

    </div>

    <button type="submit" class="btn btn-success w-100">Registrarse</button>
    <div id="respuesta" class="invalid-feedback"></div>
    <div class="text-center mt-3" id="back-to-login">
        <span>¿Ya tienes cuenta? <a href="#" id="show-login-form">Inicia sesión aquí</a></span>
    </div>
</form>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const passwordInput = document.getElementById('registerPassword');
        const passwordConfirmInput = document.getElementById('registerPasswordConfirm');
        const respuestaContainer = document.getElementById('respuesta');

        function validatePasswords() {
            const password = passwordInput.value;
            const passwordConfirm = passwordConfirmInput.value;

            // Limpiar el contenedor de respuesta
            respuestaContainer.innerHTML = '';
            respuestaContainer.style.display = 'none';

            // Validar que las contraseñas sean iguales y que no excedan los 15 caracteres
            if (password !== passwordConfirm) {
                respuestaContainer.innerHTML = 'Las contraseñas no coinciden.';
                respuestaContainer.style.display = 'block';
            } else if (password.length > 15) {
                respuestaContainer.innerHTML = 'La contraseña no puede exceder los 15 caracteres.';
                respuestaContainer.style.display = 'block';
            }
        }

        // Agregar eventos de entrada para validar en tiempo real
        passwordInput.addEventListener('input', validatePasswords);
        passwordConfirmInput.addEventListener('input', validatePasswords);

        document.getElementById('register-form').addEventListener('submit', function(event) {
            const password = passwordInput.value;
            const passwordConfirm = passwordConfirmInput.value;

            // Evitar el envío del formulario si hay errores
            if (password !== passwordConfirm || password.length > 15) {
                event.preventDefault(); // Evitar el envío del formulario
            }
        });
    });
</script>