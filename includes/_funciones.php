<?php 
require_once("_db.php")
switch ($_POST["accion"]) {
	case 'login':
		login();
		break;
	
	default:
		# code...
		break;
}
	function login(){
		//echo "Tu usuario es: " .$_POST["usuario"]. ", Tu contraseña es: ".$_POST["password"];
		/*
			-conectar a la bd 
			-consultar si el usuario existe
			-si existe, verificar la contraseña correcta
				-si el password es correcto imprimir 1
				-si el password no es correcto imprime 0
			si el usuario no existe imprime 2
		*/

		global $mysqli;//conectar a la bd y consultar a la bd la existecia del usuario
		$user = $_POST['user'];
		$pass = $_POST['password'];



		if ($user && $pass == "") {//imprimir 3 si los campos estas vacios
			echo "No hay datos = 3";
		}else{

		$consulta = "SELECT * FROM usuarios WHERE correo_usr = '$user'";
		$resultado = $mysqli->query($consulta);
		$fila = $resultado->fetch_assoc();

	
		if($fila == false){//imprimir 2 si el usuario no existe
		 echo "Sin existencia de usuario = 2";
		} 
		 else{
		
		
		$consulta = "SELECT * FROM usuarios WHERE correo_usr = '$user'";//verificacion de contraseña correcta
		$resultado = $mysqli->query($consulta);
		$fila = $resultado->fetch_assoc();
			
				
			if ($fila['correo_usr'] == $user && $fila['password_usr'] == $pass) {//contraseña cprrecta
				echo "Contraseña correcta = 1";
			}
			}else{
				echo "Contraseña inconrrecta = 0";//contraseña erronea
			}
			}
		}
		}
	}
	}

 ?>