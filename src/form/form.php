<?php 

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