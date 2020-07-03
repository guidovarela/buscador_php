<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title> PHP - mail() y MySQL  </title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="css/estilos.css" />
	</head>
	<body>
	<?php
	$subtitulo = "envio por mail y alta a la base de datos";
	include('header.php');
	?>
		<div class="contenedor">
			<div class="datos">
<?php

//Verificar que los datos llegan
/*echo $_POST['nombre'];
echo $_POST['email'];
echo $_POST['localidad'];
echo $_POST['mensaje'];*/

//Reasignar variables para mejorar el manejo de los datos

//Verificacion de datos vacios (recordar que le pusimos required a los campos, por ende esto seria opcional)
/*
//opcion 1
if($_POST['nombre'] == null){
	echo "Falta el nombre. Completalo.<br>";
}else{
	$nombre = $_POST['nombre'];
}
// != distinto
if($_POST['email'] != null){
	$email = $_POST['email'];
}else{
	echo "Falta el email. Completalo.<br>";
}*/

//opcion 2
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$localidad = $_POST['localidad'];
$mensaje = $_POST['mensaje'];
$fechaEnvio = date("d/m/Y");


//Configurar la funcion mail()
//mail('destinatario','asunto','cuerpo del mensaje','adicionales')
$destinatario = "correositio@mail.com";
$asunto = "Nuevo mensaje desde el sitio";
//$cuerpoMensaje = $_POST['nombre'].$_POST['email'].$_POST['localidad'].$_POST['mensaje'];
$cuerpoMensaje = "<div style='background:black;color:white>Nombre: ".$nombre."<br>Email: ".$email."<br>localidad: ".$localidad."<br>Mensaje: ".$mensaje."<br> Enviado el ".$fechaEnvio."</div>";
// Para enviar un correo con formato HTML (por dafault lo envia en texto plano), debe establecerse la cabecera Content-type
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

//echo $cuerpoMensaje;

//Envio
//Tip del dia: para ocultar errores, la linea debe comenzar con @

$envio = mail($destinatario,$asunto,$cuerpoMensaje,$cabeceras);//devuelve true o false

//Evaluar si el correo fue enviado
// = asignacion
// == comparacion
// === comparacion por valor y tipo de dato

if($envio != true){
	echo "Gracias ".$nombre." por contactarnos!";
}else{
	echo "hubo un error en el envio.";
	echo "escribanos a ".$destinatario;
}


// Aprovechamos los datos que llegan por POST, para cargarlos a una base de datos MySQL

//Conexion MySQL - al servidor MySQL de XAMPP
//puede ser exit() o tambien die()
include('conexion.php');

//En caso de ejecutar el codigo, sin el form, no se va a carga un nuevo registro (fila) con datos vacios

if($nombre=="" and $email=="" and $localidad=="" and $mensaje==""){
	echo "Los datos estan vacios, no se cargarán a la Base de datos";
}else{
	//Consulta MySQL
	//generamos una consulta de prueba
	$query1 = "INSERT INTO datosform VALUES (0,'maria','mail@pepe.com.ar','I.Casanova','Ya esta subidoooo x2')";
	
	//consulta con las variables del formulario
	$query2="INSERT INTO datosform VALUES (0,'$nombre','$email','$localidad','$mensaje')";
	
	$consulta = mysqli_query($conexion,$query2);

	// Verificar que los datos fueron subidos
	if($consulta == true){
		echo "Tambien te guardamos en la base de datos";
	}
}
?>
<div>
	<a href="verUsuarios.php" class="btn btn-warning">Ver usuarios</a>
</div>

			</div>
		</div>
<?php
include("footer.php");
?>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	</body>
</html>