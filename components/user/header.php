<?php
include_once "sesion.php";
include_once "contacto.php";
include_once "cambiarPassword.php";
include_once "usuarioPerfil.php";
include_once "usuarioEditarPerfil.php";
$pages_array = [
    "home" => "Home",
];

if (getUserSesion()) {
    $pages_array["usuariosReservas"] = "Ver Reservas";
    $pages_array["reservas"] = "Reservar Habitacíon";
}

?>

<nav class="navbar navbar-expand-lg ">
    <div class="container-fluid">
        <a href="index.php">
            <h3> <?php echo SITE_NAME ?></h3>
        </a>
        <button class=" navbar-toggler hamburger hamburger--collapse" id="toggler_btn" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">

                <?php
                navbarItem($pages_array, "page");
                ?>
                <a class='nav-link' data-bs-toggle='modal' data-bs-target='#contacto_form' href="#">Contacto</a>
                <?php if (!isset($_SESSION['userRegistrado'])): ?>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#sesion">
                        Sesion
                    </button>
                <?php endif; ?>


                <?php if (getUserSesion()): ?>

                    <div class="btn-group d-none d-lg-block">
                        <button type="button" class="btn btn-secondary dropdown-toggle bg-transparent" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                            <i class="fa-solid fa-user text-light"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end ">
                            <li>
                                <button class="dropdown-item btnPerfilUser"
                                    data-bs-target="#perfilUser"
                                    id="btnPerfilUser"
                                    data-bs-toggle="modal">
                                    Perfil
                                </button>
                            </li>
                            <li>
                                <button class="dropdown-item btnEditPerfilUser"
                                    data-bs-target="#perfilEdithUser"
                                    id="btnEditPerfilUser"
                                    data-bs-toggle="modal">
                                    Editar Perfil
                                </button>
                            </li>
                            <li>
                                <button class="dropdown-item"
                                    data-bs-target="#changePasswordUser"
                                    id="btnChangePassword"
                                    data-bs-toggle="modal">
                                    Cambiar Password
                                </button>
                            </li>
                            <li>
                                <form method="POST" class="h-100 dropdown-item " action='./src/logout.php'>
                                    <button class="btn btn-primary shadow-sm" type="submit">Cerrar sesión</button>
                                </form>
                            </li>
                        </ul>
                    </div>

                    <div class="d-block d-lg-none">
                        <span class="text-light w-100 dropdown-toggle " type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                            Usuario Perfil
                        </span>
                        <div class="collapse" id="collapseExample">
                            <div class="card card-body bg-transparent border-dark">
                                <span class="text-light mt-3 btnPerfilUser"
                                    data-bs-target="#perfilUser"
                                    id="btnPerfilUser"
                                    data-bs-toggle="modal">
                                    Perfil
                                </span>
                                <span class="text-light mt-3 btnEditPerfilUser"
                                    data-bs-target="#perfilEdithUser"
                                    id="btnEditPerfilUser"
                                    data-bs-toggle="modal">
                                    Editar Perfil
                                </span>
                                <span class="text-light mt-3"
                                    data-bs-target="#changePasswordUser"
                                    id="btnChangePassword"
                                    data-bs-toggle="modal">
                                    Cambiar Password
                                </span>
                                <form method="POST" class="h-100  mt-3" action='./src/logout.php'>
                                    <button class="btn btn-primary shadow-sm" type="submit">Cerrar sesión</button>
                                </form>

                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>
<script>
    const btn_toggler = document.getElementById("toggler_btn");
    btn_toggler.addEventListener("click", (event) => {
        btn_toggler.classList.toggle("is-active");
    })

    document.addEventListener('DOMContentLoaded', function() {
        // Seleccionamos todos los botones con el id btnPerfilUser 
        const btnEditUser = document.querySelectorAll('.btnPerfilUser');
        btnEditUser.forEach(button => {
            button.addEventListener('click', (e) => {

                // Crear un objeto FormData para enviar la solicitud POST al servidor
                const formData = new FormData();
                formData.append("action", "getPerfilUser"); // El nombre de la acción

                // Realizar la solicitud fetch
                fetch('./src/user/usuario.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    // Verificar si la respuesta es válida y convertirla a JSON
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    console.log(response);
                    return response.json(); // Asegúrate de que la respuesta esté en formato JSON
                })
                .then(data => {
                    // Verificar si recibimos datos del servidor

                    console.log(data);
                    if (data) {
                        // Actualizar los campos del perfil con los datos recibidos
                        document.getElementById('nombre_perfil').textContent = data.us_nombre;
                        document.getElementById('apellido_perfil').textContent = data.apellido;
                        document.getElementById('email_perfil').textContent = data.us_correo;
                        document.getElementById('telefono_perfil').textContent = data.us_telefono;
                        document.getElementById('direccion_perfil').textContent = data.us_direccion;
                        document.getElementById('user_id_perfil').textContent = data.us_id_Usuario;
                    } else {
                        console.error('Error: no se recibieron datos del usuario.');
                    }
                })
                .catch(error => {
                    console.error('Error en la solicitud:', error);
                });
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Seleccionamos todos los botones con el id btnEditPerfilUser
        const btnEditUser = document.querySelectorAll('.btnEditPerfilUser');
        btnEditUser.forEach(button => {
            button.addEventListener('click', (e) => {
                // Obtener el ID de usuario de la sesión PHP

                // Crear un objeto FormData para enviar la solicitud POST al servidor
                const formData = new FormData();
                formData.append("action", "getPerfilUser"); // El nombre de la acción

                // Realizar la solicitud fetch
                fetch('./src/user/usuario.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => {
                        // Verificar si la respuesta es válida y convertirla a JSON
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json(); // Asegúrate de que la respuesta esté en formato JSON
                    })
                    .then(data => {
                        // Verificar si recibimos datos del servidor
                        if (data) {
                            console.log(data);
                            // Actualizar los campos del perfil con los datos recibidos
                            document.getElementById('nombre_perfil_edit').value = data.us_nombre;
                            document.getElementById('apellido_perfil_edit').value = data.us_apellido;
                            document.getElementById('email_perfil_edit').value = data.us_correo;
                            document.getElementById('telefono_perfil_edit').value = data.us_telefono;
                            document.getElementById('direccion_perfil_edit').value = data.us_direccion;
                            document.getElementById('user_id_perfil_edit').value = data.us_id_usuario;
                        } else {
                            console.error('Error: no se recibieron datos del usuario.');
                        }
                    })
                    .catch(error => {
                        console.error('Error en la solicitud:', error);
                    });
            });
        });
    });
</script>