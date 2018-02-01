<?php
if(isset($_POST['emailCliente'])) {
        // Edita las dos líneas siguientes con tu dirección de correo
        $email_to = "fedegnery@gmail.com";

        function died($error) {
            // si hay algún error, el formulario puede desplegar su mensaje de aviso
            echo "Lo sentimos, hubo un error en sus datos y el formulario no puede ser enviado en este momento. ";
            echo "Detalle de los errores.<br /><br />";
            echo $error."<br /><br />";
            echo "Porfavor corrija estos errores e inténtelo de nuevo.<br /><br />";
            //Si el mensaje no se envía muestra el mensaje de error
            echo '<div class="modal fade" id="respuesta2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <strong>ERROR. Intente mas tarde.</strong>
                </div>
              </div>
            </div>'
            die();
        }

        // Se valida que los campos del formulairo estén llenos
        if(!isset($_POST['nombreCliente']) ||
            !isset($_POST['emailCliente']) ||
            !isset($_POST['asunto']) ||
            !isset($_POST['mensaje'])) {
            died('Lo sentimos pero parece haber un problema con los datos enviados.');
        }
     //En esta parte el valor "name" nos sirve para crear las variables que recolectaran la información de cada campo
        $nombre_cliente = $_POST['nombreCliente']; // requerido
        $email_cliente = $_POST['emailCliente']; // requerido
        $mensaje_cliente = $_POST['mensaje']; // requerido
        $email_subject = $_POST['asunto'];
        $error_message = "Error";

    //En esta parte se verifica que la dirección de correo sea válida
       $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
      if(!preg_match($email_exp,$email_cliente)) {
        $error_message .= 'La dirección de correo proporcionada no es válida.<br />';
      }

    //En esta parte se validan las cadenas de texto
        $string_exp = "/^[A-Za-z .'-]+$/";
      if(!preg_match($string_exp,$nombre_cliente)) {
        $error_message .= 'El formato del nombre no es válido<br />';
      }

      if(strlen($mensaje_cliente) < 2) {
        $error_message .= 'El formato del texto no es válido.<br />';
      }

      if(strlen($error_message) < 0) {
        died($error_message);
      }

    //A partir de aqui se contruye el cuerpo del mensaje tal y como llegará al correo
        $email_message = "Contenido del Mensaje.\n\n";

        function clean_string($string) {
          $bad = array("content-type","bcc:","to:","cc:","href");
          return str_replace($bad,"",$string);
        }

        $email_message .= "Nombre: ".clean_string($nombre_cliente)."\n";
        $email_message .= "Email: ".clean_string($email_cliente)."\n";
        $email_message .= "Mensaje: ".clean_string($mensaje_cliente)."\n";

    //Se crean los encabezados del correo
    $headers = 'From: '.$email_cliente."\r\n".
    'Reply-To: '.$email_cliente."\r\n" .
    'X-Mailer: PHP/' . phpversion();
    @mail($email_to, $email_subject, $email_message, $headers);
    ?>

      <!-- incluye aqui tu propio mensaje de Éxito-->
      Gracias! Nos pondremos en contacto contigo a la brevedad
      //Si el mensaje se envía muestra una confirmación
      echo '<div class="modal fade" id="respuesta2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="alert alert-success alert-dismissable">
              <button type="button" class="close" data-dismiss="modal">×</button>
              <strong>Su mensaje ha sido enviado correctamente.</strong>
          </div>
        </div>
      </div>';
      header("Location: index.html");
    <?php
  }
?>
