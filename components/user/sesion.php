<!-- Modal -->
<div class="modal fade" id="sesion" tabindex="-1" aria-labelledby="sesionLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-4" id="sesionLabel">Iniciar Sesión</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Login Form -->
                <?php require_once "login.php" ?>
                <!-- Registration Form (Initially Hidden) -->
                <?php require_once "registro.php" ?>

                <?php require_once "recuperarContrasena.php" ?>
            </div>
        </div>
    </div>
</div>

<!-- Optional JavaScript to toggle between forms -->
<script>
    document.getElementById('show-register-form').addEventListener('click', function(event) {
        event.preventDefault();
        document.getElementById('login-form').style.display = 'none';
        document.getElementById('register-form').style.display = 'block';
        document.getElementById('back-to-login').style.display = 'block';
        document.getElementById('sesionLabel').textContent = 'Registro';
    });

    document.getElementById('show-login-form').addEventListener('click', function(event) {
        event.preventDefault();
        document.getElementById('login-form').style.display = 'block';
        document.getElementById('register-form').style.display = 'none';
        document.getElementById('back-to-login').style.display = 'none';
        document.getElementById('recuperar-form').style.display = 'none';
        document.getElementById('sesionLabel').textContent = 'Iniciar Sesión';
    });

    
    document.getElementById('show-recuperar-form').addEventListener('click', function(event) {
        event.preventDefault();
        document.getElementById('login-form').style.display = 'none';
        document.getElementById('recuperar-form').style.display = 'block';
        document.getElementById('back-to-login-r').style.display = 'block';
        document.getElementById('sesionLabel').textContent = 'Recuperar Constraseña';
    });


    document.getElementById('show-login-form-r').addEventListener('click', function(event) {
        event.preventDefault();
        document.getElementById('login-form').style.display = 'block';
        document.getElementById('register-form').style.display = 'none';
        document.getElementById('back-to-login-r').style.display = 'none';
        document.getElementById('recuperar-form').style.display = 'none';
        document.getElementById('sesionLabel').textContent = 'Iniciar Sesión';
    });

    
    


</script>