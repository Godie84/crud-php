c:\xampp\htdocs\gestion_telcos-main\vista\registro_usuarios_web.php<?php
$user = $_POST['txtUsuario'];
$pass = $_POST['txtPass'];
$sentencia = $conexion->prepare('SELECT * FROM users WHERE cedula = ? and pass = ?; ');
$sentencia->execute([$user, $pass]);
$datos = $sentencia->fetch(PDO::FETCH_OBJ);

if ($datos > 0) {
    //header('Location: ../index.php');
    $_SESION['username'] = $datos->cedula;
    header("location: #home");
} else {
        sleep(2);
    echo "Error en la autenticacion";

    header("Location: index.php");
}
