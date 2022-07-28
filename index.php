<?php 
    namespace Modules;
    include "MAILGUN.php";
    
    $resultEmail = MAILGUN::buildBodyEmail();
    
    print_r($resultEmail);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <BR>
    PRUEBA DE ENVIO DE correo son solo recargar se envia el correo
</body>
</html>