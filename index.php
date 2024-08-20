<?php

include 'mail.php';
function validateForm($name, $email, $subject, $message)
{
    return !empty($name) && !empty($email) && !empty($subject) && !empty($message);         
}

$status = '';

// Comprobamos si el formulario fue enviado
if (isset($_POST['form'])) {    
    // Invocamos función para validar y con el unpacking array le pasamos los parametros solicitados a la función
    if (validateForm($_POST['name'], $_POST['email'], $_POST['subject'], $_POST['message'], $_POST['form'])) {               
        // Sanitizando los datos
        $name = htmlspecialchars($_POST['name']);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $subject = htmlspecialchars($_POST['subject']);
        $message = htmlspecialchars($_POST['message']);
        $body =  "<p>Hola esta es una prueba de mensaje</p>";
        $status = sendMail($subject, $body, $email, $name, true);       
    } else {
        $status = "error";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de contacto</title>
    <link rel='stylesheet' type='text/css' href='src/css/form.css' />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<body>

    <?php if ($status == "error"): ?>
        <div class='alert_container_danger'>
            <span class="alert_message">¡Surgió un problema!</span>
        </div>
    <?php endif; ?>

    <?php if ($status == "success"): ?>
        <div class="alert_container_success">
            <span class="alert_message">¡Mensaje enviado con éxito!</span>
        </div>
    <?php endif; ?>

    <form action="" method="POST">        
        <h1>¡Contáctanos!</h1>
        <div class="input_group">
            <label for="name">Nombre:</label>
            <input type="text" name='name'>
        </div>
        <div class="input_group">
            <label for="email">Correo:</label>
            <input type="email" name='email' placeholder="name@example.com">
        </div>
        <div class="input_group">
            <label for="subject">Asunto:</label>
            <input type="text" name="subject" >
        </div>
        <div class="input_group">
            <label for="message">Mensaje:</label>
            <textarea name="message"></textarea>
        </div>
        <div class="button_container">
            <button type="submit" name="form">Enviar</button>
        </div>

        <div class="contact_info_container">
            <div class="address_container">
                <span> Alborada </span>
            </div>
            <div class="number_container">
                <span> +593 981464552 - Sinfoec</span>
            </div>
        </div>
    </form>

</body>

</html>
