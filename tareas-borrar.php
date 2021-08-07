<?php 
	require_once('conexion.php');
	if (isset($_POST['id'])) {
		$id = $_POST['id'];
		$query = "DELETE FROM tareas WHERE id_tarea = $id";
		$result = mysqli_query($conex, $query);
		if (!$result) {
			die("Query fail");
		}
		echo "Tarea eliminada";
	}
?>