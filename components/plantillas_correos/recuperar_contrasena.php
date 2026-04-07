<?php include_once 'header.php' ?>
<div class="header">
    <h1>Recuperación de contraseña</h1>
</div>
<div class="content">
    <p>Hola, {{nombre_usuario}}</p>
    <p>Recibimos una solicitud para restablecer tu contraseña. Haz clic en el botón de abajo para proceder:</p>
    <a href="{{link_recuperacion}}" target="_blank">Restablecer contraseña</a>
    <p>Si no realizaste esta solicitud, ignora este mensaje. Tu contraseña actual seguirá siendo válida.</p>
</div>
<div class="footer">
    <p>Atentamente,</p>
    <p>El equipo de <strong>{{nombre_empresa}}</strong></p>
    <p><a href="{{sitio_web}}" class="button">Visitar Sitio Web</a></p>
    <br>
    <p>&copy; <?php echo date("d/m/Y") ?> {{nombre_empresa}} Todos los derechos reservados.</p>
</div>