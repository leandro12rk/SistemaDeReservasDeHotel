<?php require './src/user/reservas.php'; ?>

<div class="modal fade" id="add_reserva_user" tabindex="-1" aria-labelledby="reservas_usuarios_Label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="reservas_usuarios_Label">Agregar Habitaciones</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="agregarHabitacionFormUser">
        <div class="modal-body">
          <div class="form-group mt-3">
            <label for="rol">Agregar Habitacion</label>
            <select class="form-select" id="tipo_habitacion" name="tipo_habitacion" required>
              <option value="" default></option>
              <?php foreach ($array_tipo_habitacion as $array): ?>
                <option value="<?php echo $array['th_id_tipo'] ?>"><?php echo $array['th_esc_habitacion'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <p class="mt-3">Agregar Huespedes en La Habitacion <button class="btn btn-primary" id="btnAgregaHuespeHabitacion">Agregar otro huesped</button></p>
          <div class="form-group mt-3">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresa el nombre " required>
          </div>
          <div class="form-group mt-3 ">
            <label for="apellido">Apellido</label>
            <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Ingresa el apellido" required>
          </div>

          <div class="form-group mt-3">
            <label for="Edad">Edad</label>
            <input type="number" class="form-control" id="edad" name="edad" placeholder="Ingresa su edad" required>
          </div>

          <div class="form-group mt-3">
            <label for="cedula">cedula</label>
            <input type="text" class="form-control" id="cedula" name="cedula" placeholder="Ingresa su cedula " required>
          </div>
          <div id="huespedesContainer">

          </div>
        </div>
        <p class="mt-3 p-2">solo se puede agregar 3 huespedes por habitacion </p>
        <div class="modal-footer mt-3">
          <button type="submit" data-bs-dismiss="modal" aria-label="Close" id="btn_save_changes" class="btn btn-secondary">Save Changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  // Array global para almacenar los datos de los huespedes
  let huespedesArray = [];
  let countCantidadHuesped = 1;
  // Interceptar el evento de envío del formulario
  document.getElementById('agregarHabitacionFormUser').addEventListener('submit', function(event) {
    // Evitar que la página se recargue
    event.preventDefault();

    // Crear un objeto para la habitación
    const habitacion = {
      tipo_habitacion: document.getElementById('tipo_habitacion').value,
      huespedes: []
    };

    // Obtener todos los huéspedes
    const huespedes = document.querySelectorAll('.huesped');

    huespedes.forEach(huespedDiv => {
      const huespedNombre = huespedDiv.querySelector('input[name="nombre[]"]').value;
      const huespedApellido = huespedDiv.querySelector('input[name="apellido[]"]').value;
      const huespedEdad = huespedDiv.querySelector('input[name="edad[]"]').value;
      const cedula = huespedDiv.querySelector('input[name="cedula[]"]').value;
      // Crear un objeto para el huésped
      const huesped = {
        nombre: huespedNombre,
        apellido: huespedApellido,
        edad: huespedEdad
      };

      // Agregar el huésped al array de huéspedes
      habitacion.huespedes.push(huesped);
    });

    // Agregar también el primer huésped (el que no está en el contenedor)
    habitacion.huespedes.push({
      nombre: document.getElementById('nombre').value,
      apellido: document.getElementById('apellido').value,
      edad: document.getElementById('edad').value,
      cedula: document.getElementById('cedula').value
    });

    // Ahora puedes hacer lo que necesites con el objeto habitacion
    console.log(habitacion); // Solo para depuración, puedes eliminar esto

    // Limpiar los campos del formulario
    document.getElementById('agregarHabitacionFormUser').reset();
    document.getElementById('huespedesContainer').innerHTML = ''; // Limpiar huéspedes agregados
    countCantidadHuesped = 1; // Reiniciar contador de huéspedes

    // Crear un objeto FormData a partir del objeto habitacion
    const formData = new FormData(this);
    formData.append("action", "agregarReservaHuesped");
    formData.append("huespedes", JSON.stringify(habitacion)); // Convertir el objeto habitacion a JSON

    // Enviar los datos usando fetch
    fetch('./src/user/reservas.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.text())
      .then(data => {
        console.log('Respuesta:', data); // Procesa la respuesta si es necesario
      })
      .catch(error => console.error('Error:', error));
  });
  document.getElementById('btnAgregaHuespeHabitacion').addEventListener('click', function() {
    countCantidadHuesped += 1;
    if (countCantidadHuesped <= 3) {
      //alert(countCantidadHuesped)
      const huespedesContainer = document.getElementById('huespedesContainer');
      let countCantidadHuesped = 1;
      const nuevoHuespedDiv = document.createElement('div');
      nuevoHuespedDiv.classList.add('huesped');

      // Agregar campos para el nuevo huésped
      nuevoHuespedDiv.innerHTML = `
        <div class="form-group mt-3">
          <label for="nombre">Nombre</label>
          <input type="text" class="form-control" name="nombre[]" placeholder="Ingresa el nombre" required>
        </div>
        <div class="form-group mt-3">
          <label for="apellido">Apellido</label>
          <input type="text" class="form-control" name="apellido[]" placeholder="Ingresa el apellido" required>
        </div>
        <div class="form-group mt-3">
          <label for="edad">Edad</label>
          <input type="number" class="form-control" name="edad[]" placeholder="Ingresa su edad" required>
        </div>
        <div class="form-group mt-3">
          <label for="cedula">Cedula</label>
          <input type="text" class="form-control" name="cedula[]" placeholder="Ingresa su cedula" required>
        </div>
      `;

      // Agregar el nuevo div al contenedor de huéspedes
      huespedesContainer.appendChild(nuevoHuespedDiv);
    }

  });
</script>