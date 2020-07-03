<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title> PHP - MySQL /  SELECT / Ver todos los usuarios </title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="css/estilos.css" />
	</head>
	<body>

    <?php
    $subtitulo = "Ver todos los usuarios";
    include('header.php');//si hay errores de inclusion, el documento se sigue ejecutando
    //require('header.php');//si hay error de requierimiento, se interrumpe la ejecucion del documento - Fatal Error!
    ?>

		<div class="contenedor ">
			<div class="datos mb-5">

<?php

//Conexion MySQL
include("conexion.php");

//Consulta SELECT
$query_select="SELECT id,nombre,email,localidad from datosform";
//$query_select2="SELECT nombre,email,localidad,mensaje from datosform where id=25";
$consulta=mysqli_query($conexion,$query_select);

//Conteo de resultados (o de filas devueltas)
$cant_resultados = mysqli_num_rows($consulta);//devuelve un numero

if($cant_resultados==0){
    echo "No hay usuarios.";
}else{
    echo "<h2>Cantidad de resultados: ".$cant_resultados."</h2>";
    
    //Procesar los resultados, conviertendolos en un array
    //el array se construye en la variable que ejecuta la funcion fetch
    //tantos indices como columnas pedidas en el SELECT
    ?>

<table class="table table-hover mb-5">
<!-- Cabecera de la tabla -->  
<thead class='thead-dark'>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nombre</th>
      <th scope="col">Email</th>
      <th scope="col">Localidad</th>
    </tr>
  </thead>
<tbody>
    
  <?php

    while($datos = mysqli_fetch_array($consulta)){

        /*
        echo "<div class='cajas'>nombre: ".$datos[0]."<br>";
        echo "email: ".$datos['email']."<br>";
        echo "localidad: ".$datos['localidad']."</div>";
        echo "<hr>";
        */
        echo "<tr>";
        echo '<th scope="row">'.$datos['id'].'</th>';
        echo "<td>".$datos['nombre']."</td>";
        echo "<td>".$datos['email']."</td>";
        echo "<td>".$datos['localidad']."</td>";
        echo "</tr>";
    }   

}

//liberamos la memoria de la consulta
mysqli_free_result($consulta);
//Cerramos la conexion
mysqli_close($conexion);

  ?>

    
  </tbody>
</table>

<a href="buscador.php" class='btn btn-warning'>Buscador de Personas</a>

</div>

<?php
include("footer.php");
?>
		</div>


	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	</body>
</html>