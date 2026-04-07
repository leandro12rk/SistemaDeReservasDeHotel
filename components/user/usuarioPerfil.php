<?php require_once './src/user/usuario.php'; ?>

<div class="modal fade" id="perfilUser" tabindex="-1" aria-labelledby="perfilUserLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <h1 class="modal-title fs-5" id="perfilUserLabel">Perfil de Usuario</h1> -->
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="card">
          <div class="card-header text-center">
            <h3>Perfil de Usuario</h3>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-4 text-center">
                <img src="https://cdn-icons-png.freepik.com/512/6063/6063734.png" class="img-fluid rounded-circle" alt="Imagen de perfil">
                <h4 class="mt-3" id="nombre_perfil"></h4>
                <p id="apellido_perfil"></p>
              </div>
              <div class="col-md-8">
                <h5>Información del Usuario</h5>
                <div class="list-group">
                  <div class="list-group-item">
                    <strong>ID de Usuario:</strong> <span id="user_id_perfil"></span>
                  </div>
                  <div class="list-group-item">
                    <strong>Correo Electrónico:</strong> <span id="email_perfil"></span>
                  </div>
                  <div class="list-group-item">
                    <strong>Teléfono:</strong> <span id="telefono_perfil"></span>
                  </div>
                  <div class="list-group-item">
                    <strong>Dirección:</strong> <span id="direccion_perfil"></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


