<?php 
	require_once('conexion.php');
	if (isset($_POST['name']) && isset($_POST['description']) && isset($_POST['id'])) {
		$name = $_POST['name'];
		$description = $_POST['description'];
		$id = $_POST['id'];
		$query = "UPDATE tareas SET nombre_tarea = '$name', descripcion_tarea = '$description' WHERE id_tarea = $id";
		$result = mysqli_query($conex, $query);
	}
?>