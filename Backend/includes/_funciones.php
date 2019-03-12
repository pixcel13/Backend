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
	case 'eliminar_registro':
	eliminar_registro($_POST["registro"]);
		break;
	case 'editar_registro':
	editar_registro($_POST["registro"]);
		break;
	case 'consultar_registro':
	consultar_registro($_POST["registro"]);
		break;
	case 'carga_foto':
	carga_foto();
		break;
		// ACTIVE BOX

	//DOWNLOAD
	case 'insertar_download':
	insertar_download();
		break;
	case 'consultar_download':
	consultar_download();
		break;
	case 'consultar_registro_download':
	consultar_registro_download($_POST["registro"]);
		break;
	case 'editar_download':
	editar_download($_POST["registro"]);
		break;
	case 'eliminar_download':
	eliminar_download($_POST["registro"]);
		break;

	//FOOTER
	case 'insertar_footer':
	insertar_footer();
		break;
	case 'consultar_footer':
	consultar_footer();
		break;
	case 'consultar_registro_footer':
	consultar_registro_footer($_POST["registro"]);
		break;
	case 'editar_footer':
	editar_footer($_POST["registro"]);
		break;
	case 'eliminar_footer':
	eliminar_footer($_POST["registro"]);
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
// function login(){
// 		//echo "Tu usuario es: " .$_POST["usuario"]. ", Tu contraseña es: ".$_POST["password"];
// 		/*
// 			-conectar a la bd 
// 			-consultar si el usuario existe
// 			-si existe, verificar la contraseña correcta
// 				-si el password es correcto imprimir 1
// 				-si el password no es correcto imprime 0
// 			si el usuario no existe imprime 2
// 		*/
// 		global $mysqli;//conectar a la bd y consultar a la bd la existecia del usuario
// 		$user = $_POST['user'];
// 		$pass = $_POST['password'];
// 		if ($user && $pass == "") {//imprimir 3 si los campos estas vacios
// 			echo "No hay datos = 3";
// 		}else{

// 		$consulta = "SELECT * FROM usuarios WHERE correo_usr = '$user'";
// 		$resultado = $mysqli->query($consulta);
// 		$fila = $resultado->fetch_assoc();
	
// 		if($fila == ""){//imprimir 2 si el usuario no existe
// 		 echo "Sin existencia de usuario = 2";
// 		} 
// 		 else{
							
// 			if ($fila['correo_usr'] == $user && $fila['password_usr'] == $pass) {//seña correcta
// 				echo "Contraseña correcta = 1";
// 			}
// 			}
// 		}
// 	}//fin login

	function insertar_usuarios(){
	global $mysqli;
	$nombre_usr = $_POST['nombre_usr'];
	$correo_usr = $_POST['correo_usr'];
	$telefono_usr = $_POST['telefono_usr'];
	$password_usr = $_POST['password_usr'];

	$consulta = "INSERT INTO usuarios VALUES('', '$nombre_usr', '$correo_usr', '$password_usr', '$telefono_usr', 1)";
	$resultado = mysqli_query($mysqli, $consulta);
	
	if ($resultado) {
			echo "Se agrego nuevo usuario";
		}else{
			echo "Hubo un problema";
		}
		
	}

	function eliminar_registro($id){
	global $mysqli;
	$consulta = "DELETE FROM usuarios WHERE id_usr = $id";
	$resultado = mysqli_query($mysqli, $consulta);

	if ($resultado) {
		echo "ya fue el dato karnal";
	}else{
		echo "No se quiere ir el dato karnal";
	}
	}

	function editar_registro($id){
		global $mysqli;

	$nombre_usr = $_POST['nombre_usr'];
	$correo_usr = $_POST['correo_usr'];
	$telefono_usr = $_POST['telefono_usr'];
	$password_usr = $_POST['password_usr'];

		$consulta = "UPDATE usuarios SET nombre_usr = '$nombre_usr', correo_usr = '$correo_usr', password_usr = 
		'$password_usr', telefono_usr = '$telefono_usr' WHERE id_usr = '$id'";
		$resultado = mysqli_query($mysqli, $consulta);
		if($resultado){
			echo "Se editó correctamente";
		}else{
			echo "No se pudo editar karnal";
		}
	}

	function consultar_registro($id){
		global $mysqli;
		$sql = "SELECT * FROM usuarios WHERE id_usr = $id";
		$rsl = $mysqli->query($sql);
		$fila = mysqli_fetch_array($rsl);
		echo json_encode($fila); //Imprime Json encodeado
	}

// DOWNLOAD



	function insertar_download(){
	global $mysqli;
	$titulo_download = $_POST['titulo_download'];
	$subtitulo_download = $_POST['subtitulo_download'];


	$consulta = "INSERT INTO download VALUES('', '$titulo_download', '$subtitulo_download')";
	$resultado = mysqli_query($mysqli, $consulta);

	if ($resultado) {
			echo "Se agrego nuevo registro";
		}else{
			echo "Hubo un problema";
		}
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

	function consultar_registro_download($id){
	global $mysqli;
	$sql = "SELECT * FROM download WHERE id_download = $id";
	$rsl = $mysqli->query($sql);
	$fila = mysqli_fetch_array($rsl);
	echo json_encode($fila); //Imprime Json encodeado
	}

	function editar_download($id){
	global $mysqli;

	$titulo_download = $_POST['titulo_download'];
	$subtitulo_download = $_POST['subtitulo_download'];


	$consulta = "UPDATE download SET titulo_download = '$titulo_download', subtitulo_download = '$subtitulo_download' WHERE id_download = '$id'";
	$resultado = mysqli_query($mysqli, $consulta);
	if($resultado){
			echo "Se editó correctamente";
	}else{
			echo "No se pudo editar karnal";
	}
	}
	function eliminar_download($id){
	global $mysqli;
	$consulta = "DELETE FROM download WHERE id_download = $id";
	$resultado = mysqli_query($mysqli, $consulta);

	if ($resultado) {
		echo "ya fue el dato karnal";
	}else{
		echo "No se quiere ir el dato karnal";
	}
	}

// FOOTER

	function insertar_footer(){
	global $mysqli;
	$titulo_direccion = $_POST['titulo_direccion'];
	$direccion = $_POST['direccion'];
	$titulo_compartir = $_POST['titulo_compartir'];
	$link_fb = $_POST['link_fb'];
	$link_ld = $_POST['link_ld'];
	$link_tw = $_POST['link_tw'];
	$titulo_about = $_POST['titulo_about'];
	$about = $_POST['about'];
	$copyright = $_POST['copyright'];
	
	$consulta = "INSERT INTO footer VALUES('', '$titulo_direccion', '$direccion', '$titulo_compartir', '$link_fb', '$link_ld', '$link_tw', '$titulo_about', '$about', '$copyright')";
	$resultado = mysqli_query($mysqli, $consulta);
	
	if ($resultado) {
		echo "Se agrego nuevo registro";
	}else{
		echo "Hubo un problema";
		}
	}

	function consultar_footer(){
	global $mysqli;
	$consulta = "SELECT * FROM footer";
	$resultado = mysqli_query($mysqli, $consulta);
	$arreglo = [];
	while($fila = mysqli_fetch_array($resultado)){
		array_push($arreglo, $fila);
	}
	echo json_encode($arreglo); //Imprime el JSON ENCODEADO
	}

	function consultar_registro_footer($id){
	global $mysqli;
	$sql = "SELECT * FROM footer WHERE id_footer = $id";
	$rsl = $mysqli->query($sql);
	$fila = mysqli_fetch_array($rsl);
	echo json_encode($fila); //Imprime Json encodeado	
	}

	function editar_footer($id){

	global $mysqli;

	$titulo_direccion = $_POST['titulo_direccion'];
	$direccion = $_POST['direccion'];
	$titulo_compartir = $_POST['titulo_compartir'];
	$link_fb = $_POST['link_fb'];
	$link_ld = $_POST['link_ld'];
	$link_tw = $_POST['link_tw'];
	$titulo_about = $_POST['titulo_about'];
	$about = $_POST['about'];
	$copyright = $_POST['copyright'];

	$consulta = "UPDATE footer SET titulo_direccion = '$titulo_direccion', direccion = '$direccion', titulo_compartir = '$titulo_compartir', link_fb = '$link_fb', link_ld ='$link_ld', link_tw ='$link_tw', titulo_about = '$titulo_about', about = '$about', copyright = '$copyright' WHERE id_footer = '$id'";
	$resultado = mysqli_query($mysqli, $consulta);
	if($resultado){
		echo "Se editó correctamente";
	}else{
		echo "No se pudo editar karnal";
	}
	}

	function eliminar_footer($id){

	global $mysqli;
	$consulta = "DELETE FROM footer WHERE id_footer = $id";
	$resultado = mysqli_query($mysqli, $consulta);

	if ($resultado) {
		echo "ya fue el dato karnal";
	}else{
		echo "No se quiere ir el dato karnal";
	}

	}

?>