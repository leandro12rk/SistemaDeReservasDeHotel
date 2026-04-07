<form id="login-form" method="POST" action="./src/login.php" class="needs-validation">
    <div class="mb-3">
        <label for="loginUser" class="form-label">Usuario</label>
        <input type="text" class="form-control" id="loginUser" name="userName" placeholder="Ingrese su usuario" required>
    </div>
    <div class="mb-3">
        <label for="loginPassword" class="form-label">Contraseña</label>
        <input type="password" class="form-control" id="loginPassword" placeholder="Ingresa tu contraseña" name="password" required>
    </div>
    <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>
    <div id="respuesta" class="invalid-feedback"></div>
    <div class="text-center mt-3">
        <span>¿No tienes cuenta? <a href="#" id="show-register-form">Regístrate aquí</a></span>
        <br>
        <span>¿Olvidaste tu Contraseña <a href="#" id="show-recuperar-form">Recuperar Contraseña</a></span>
    </div>
</form>

<!-- <i class="fa-solid fa-eye-slash"></i>
<i class="fa-solid fa-eye"></i> -->