<form id="recuperar-form" method="POST" action="./src/user/recuperarContrasena.php" style="display: none;" class="needs-validation">
    <div class="mb-3">
        <label for="correoRecuparar" class="form-label">Correo Electronico</label>
        <input type="email" class="form-control" id="correoRecuparar" name="correo_recuperar" placeholder="Ingrese su Correo Electronico" required>
    </div>
    <button type="submit" class="btn btn-primary w-100">Enviar Correo</button>
    <div id="respuesta" class="invalid-feedback"></div>
    <div class="text-center mt-3" id="back-to-login-r">
        <span>¿Ya tienes cuenta? <a href="#" id="show-login-form-r">Inicia sesión aquí</a></span>
    </div>
</form>

