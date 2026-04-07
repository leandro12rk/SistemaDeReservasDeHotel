<?php include_once 'header.php' ?>
<div class="container">
    <div class="header">
        <h1>Nos Pondremos en Contacto</h1>
    </div>
    <div class="content">
        <p>Estimado/a <strong>{{nombre_usuario}}</strong>,</p>
        <p>Gracias por ponerte en contacto con nosotros. Hemos recibido tu solicitud y uno de nuestros representantes se pondrá en contacto contigo lo antes posible.</p>
        <p>Si tienes alguna consulta adicional, no dudes en responder a este correo o visitarnos en nuestro sitio web.</p>
        <p>¡Gracias por confiar en nosotros!</p>
    </div>
    <div class="footer">
        <p>Atentamente,</p>
        <p>El equipo de <strong>{{nombre_empresa}}</strong></p>
        <p><a href="{{sitio_web}}" class="button">Visitar Sitio Web</a></p>
        <br>
        <p>&copy; <?php echo date("d/m/Y") ?> {{nombre_empresa}} Todos los derechos reservados.</p>
    </div>
</div>