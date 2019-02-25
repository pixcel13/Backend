<?php 
require_once("_db.php");
switch ($_POST["accion"]) {
	case 'login':
	login();
	break;
	case 'consultar_usuarios':
	consultar_usuarios();
	break;
	case 'insertar_usuarios':
	insertar_usuarios();
	break;
	case 'consultar_download':
	consultar_download();
	break;
	case 'insertar_download':
	insertar_download();
		break;
	default:
			# code...
	break;
}
function consultar_usuarios(){
	global $mysqli;
	$consulta = "SELECT * FROM usuarios";
	$resultado = mysqli_query($mysqli, $consulta);
	$arreglo = [];
	while($fila = mysqli_fetch_array($resultado)){
		array_push($arreglo, $fila);
	}
	echo json_encode($arreglo); //Imprime el JSON ENCODEADO
}//fin consultar usuarios
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
	
		if($fila == ""){//imprimir 2 si el usuario no existe
		 echo "Sin existencia de usuario = 2";
		} 
		 else{
							
			if ($fila['correo_usr'] == $user && $fila['password_usr'] == $pass) {//seña correcta
				echo "Contraseña correcta = 1";
			}
			}
		}
	}//fin login

	function insertar_usuarios(){
	global $mysqli;
	$nombre_usr = $_POST['nombre_usr'];
	$correo_usr = $_POST['correo_usr'];
	$telefono_usr = $_POST['telefono_usr'];
	$password_usr = $_POST['password_usr'];

	$consulta = "INSERT INTO usuarios VALUES('', '$nombre_usr', '$correo_usr', '$password_usr', '$telefono_usr', 1)";
	$resultado = mysqli_query($mysqli, $consulta);
	
		}

	function consultar_download(){
	global $mysqli;
	$consulta = "SELECT * FROM download";
	$resultado = mysqli_query($mysqli, $consulta);
	$arreglo = [];
	while($fila = mysqli_fetch_array($resultado)){
		array_push($arreglo, $fila);
	}
	echo json_encode($arreglo); //Imprime el JSON ENCODEADO
	}

	function insertar_download(){
	global $mysqli;
	$titulo_download = $_POST['titulo_download'];
	$subtitulo_download = $_POST['subtitulo_download'];

	$consulta = "INSERT INTO download VALUES('', '$titulo_download', '$subtitulo_download')";
	$resultado = mysqli_query($mysqli, $consulta);
	}
?>