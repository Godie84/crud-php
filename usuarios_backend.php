<?php
$txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
$txtNombres = (isset($_POST['txtNombres'])) ? $_POST['txtNombres'] : "";

$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";

$accionAgregar = "";
$accionModificar = $accionEliminar = $accionCancelar = "hidden";

$mostrarModal = false;

switch ($accion) {

  case "btnRegistrar":
    try {
      $sentencia = $conexion->prepare("INSERT INTO _users_telcos_db (cedula_personal_telcos_db, first_name, cargo_personal_telcos_db, area_personal_telcos_db, rol_personal_telcos_db, 
      status, ciudad_personal_telcos_db, perfil_personal_telcos_db, email) 
    VALUES (:cedula, :nombre, :cargo, :areas, :rol, :estado, :ciudad, :perfil, :email)");
      $sentencia->bindParam(':cedula', $txtCedula);
      $sentencia->bindParam(':nombre', $txtNombres);
      $sentencia->bindParam(':cargo', $txtCargo);
      $sentencia->bindParam(':areas', $txtArea);
      $sentencia->bindParam(':rol', $txtRol);
      $sentencia->bindParam(':estado', $txtEstado);
      $sentencia->bindParam(':ciudad', $txtCiudad);
      $sentencia->bindParam(':perfil', $txtPerfil);
      $sentencia->bindParam(':email', $txtEmail);
      $sentencia->execute();
      echo '<script>
			Swal.fire({
			 	icon: "success",
			 	title: "¡Registrado satisfactoriamente!",
			 	confirmButtonText: "Cerrar"
         }).then(function(result){
            if(result.value){                   
             window.location = "../vista/registro_usuarios_web.php";
            }
			 });
			</script>';
    } catch (PDOException $e) {
      if ($e->errorInfo[1] == 1062) {
        echo '<script>
        Swal.fire({
         icon: "error",
         title: "Oops...",
         text: "¡El usuario ya esta registrado!",
         showConfirmButton: true,
         confirmButtonText: "Cerrar"
         }).then(function(result){
            if(result.value){                   
             window.location = "../vista/registro_usuarios_web.php";
            }
         });
        </script>';
      } else {
        // an error other than duplicate entry occurred
      }
    }

    break;

  case "btnModificar":
    $sentencia = $conexion->prepare("UPDATE _users_telcos_db SET 
    cedula_personal_telcos_db=:cedula,
    first_name=:nombre,
    cargo_personal_telcos_db=:cargo,
    area_personal_telcos_db=:areas,
    rol_personal_telcos_db=:rol,
    status=:estado,
    ciudad_personal_telcos_db=:ciudad,
    perfil_personal_telcos_db=:perfil,
    email=:email WHERE id=:id");

    $sentencia->bindParam(':cedula', $txtCedula);
    $sentencia->bindParam(':nombre', $txtNombres);
    $sentencia->bindParam(':cargo', $txtCargo);
    $sentencia->bindParam(':areas', $txtArea);
    $sentencia->bindParam(':rol', $txtRol);
    $sentencia->bindParam(':estado', $txtEstado);
    $sentencia->bindParam(':ciudad', $txtCiudad);
    $sentencia->bindParam(':perfil', $txtPerfil);
    $sentencia->bindParam(':email', $txtEmail);
    $sentencia->bindParam(':id', $txtID);
    $sentencia->execute();


    echo '<script>
			Swal.fire({
			 	icon: "success",
			 	title: "¡Registro modificado satisfactoriamente!",
			 	confirmButtonText: "Cerrar"
         }).then(function(result){
            if(result.value){                   
             window.location = "../vista/registro_usuarios_web.php";
            }
			 });
			</script>';

    break;

  case "btnEliminar":

    try {
      $sentencia = $conexion->prepare("DELETE FROM _users_telcos_db WHERE id=:id");
      $sentencia->bindParam(':id', $txtID);
      $sentencia->execute();

      echo '<script>
			Swal.fire({
        title: "Eliminado satisfactoriamented.",
        width: 600,
        padding: "3em",
        color: "#716add",
        background: "#fff url(/images/trees.png)",
        backdrop: `
          rgba(255,0,0,0.4)
          left top
          no-repeat
        `
      })
			</script>';
    } catch (PDOException $e) {
      if ($e->errorInfo[1] == 1062) {
        echo '<script>
             window.location = "../vista/registro_usuarios_web.php";
        </script>';
      } else {
        // an error other than duplicate entry occurred
      }
    }

    break;

  case "btnCancelar":
    echo '<script>			            
    window.location = "../vista/registro_usuarios_web.php";            
		</script>';
    break;

  case "Seleccionar":
    $accionAgregar = "hidden";
    $accionModificar = $accionEliminar = $accionCancelar = "";
    $mostrarModal = true;


    $sentencia = $conexion->prepare("SELECT id, cedula_personal_telcos_db, first_name, cargo_personal_telcos_db, area_personal_telcos_db, rol_personal_telcos_db, status, ciudad_personal_telcos_db, perfil_personal_telcos_db, email FROM _users_telcos_db WHERE id=:id");
    $sentencia->bindParam(':id', $txtID);
    $sentencia->execute();
    $users = $sentencia->fetch(PDO::FETCH_LAZY);

    $txtCedula = $users['cedula_personal_telcos_db'];
    $txtNombres = $users['first_name'];
    $txtCargo = $users['cargo_personal_telcos_db'];
    $txtArea = $users['area_personal_telcos_db'];
    $txtRol = $users['rol_personal_telcos_db'];
    $txtEstado = $users['status'];
    $txtCiudad = $users['ciudad_personal_telcos_db'];
    $txtPerfil = $users['perfil_personal_telcos_db'];
    $txtEmail = $users['email'];

    break;
}

$sentencia = $conexion->prepare("SELECT id, cedula_personal_telcos_db, first_name, cargo_personal_telcos_db, ciudad_personal_telcos_db, email FROM _users_telcos_db WHERE 1");
$sentencia->execute();
$listaUsers = $sentencia->fetchAll(PDO::FETCH_ASSOC);

//print_r($listaUsers);
?>