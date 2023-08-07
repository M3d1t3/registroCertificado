<?php

//Comprobamos si hemos recibido un archivo mediante POST
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['certificado'])) {
    //Almacenamos el archivo en una variable
    $certificado_tmp = $_FILES['certificado']['tmp_name'];

    // Extraer los datos del certificado. Tendria que saber que tipo de certificado se usaria para poder 
    //cambiar el sistema de validacion y extraccion del formulario
    $cert_data = openssl_x509_parse(file_get_contents($certificado_tmp));
    if (!$cert_data) {
        die("Certificado no válido.");
    }

    // Tomar algún dato del certificado, por ejemplo, el email
    $email_de_cert = isset($cert_data['subject']['email']) ? $cert_data['subject']['email'] : null;
    if (!$email_from_cert) {
        die("El certificado no tiene una dirección de correo electrónico válida.");
    }

    // Aquí insertarías en la base de datos los datos recogidos del certificado
    // Por ejemplo:
    // $conexion = new mysqli('host', 'usuario', 'contraseña', 'base_de_datos');
    // $query = "INSERT INTO usuarios(email) VALUES ('{$email_de_cert}')";
    // $conexion->query($query);

    echo "Usuario registrado con éxito usando el email: {$email_de_cert}";
}
?>
