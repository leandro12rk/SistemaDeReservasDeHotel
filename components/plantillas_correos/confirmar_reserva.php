<?php include_once 'header.php' ?>
<div class="container">
    <div class="header">
        <h1>Gracias por tu reserva!</h1>
    </div>
    <div class="content">
        <p>Hola, {{nombre_usuario}}</p>

        <p>Hemos recibido tu solicitud de reserva de habitacion. Estaremos en contacto contigo pronto para confirmar los detalles de tu reserva.</p>
        <p>Este es un correo automático, por favor, no respondas a este mensaje.</p>

        <a href="{{link_confirmar_reserva}}"> Confirmar Reserva </a>
        <br>
        <a href="{{link_pagina}}"> Puede Visitar La Pagina </a>
    </div>
    <div class="footer">
        <p>Atentamente,</p>
        <p>El equipo de <strong>{{nombre_empresa}}</strong></p>
        <p><a href="{{sitio_web}}" class="button">Visitar Sitio Web</a></p>
        <br>
        <p>&copy; <?php echo date("d/m/Y") ?> {{nombre_empresa}} Todos los derechos reservados.</p>
    </div>
</div>