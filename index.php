<?php
session_start();
if (isset($_SESSION['username'])) {
    header('Location: registro.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <center>
        <form action="loguear.php" method="POST">
            <input type="text" name="txtUsuario" placeholder="Digite un Usuario" autocomplete="off"><br><br>
            <input type="password" name="txtPass" placeholder="Digite un Password"><br><br>
            <div id="msg_error" class="alert alert-danger" role="alert" style="display: none;"></div>
            <button type="submit">Ingresar</button>
            
        </form>
    </center>

</body>

</html>