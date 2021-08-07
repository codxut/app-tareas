<?php 
	require_once('conexion.php');
	$query = "SELECT * FROM tareas";
	$result = mysqli_query($conex, $query);
	if(!$result) {
		die("Query failed!..");
	}
	while($row = mysqli_fetch_array($result)) {
		$json[] = [
			'id' => $row['id_tarea'],
			'name' => $row['nombre_tarea'],
			'description' => $row['descripcion_tarea']
		];
	}
	$jsonStr = json_encode($json);
	echo $jsonStr;
?>