<?php 
	require_once('conexion.php');
	if(isset($_POST['name']) && isset($_POST['description'])) {
		$name = $_POST['name'];
		$description = $_POST['description'];
		$query = "INSERT INTO tareas(nombre_tarea, descripcion_tarea) VALUES ('$name', '$description')";
		$result = mysqli_query($conex, $query);
		if (!$result) {
			die("Query failed!..");
		}
		echo "Task add";
	}
?>