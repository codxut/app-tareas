<?php 
	require_once('conexion.php');
	if (isset($_POST['id'])) {
		$id = $_POST['id'];
		$query = "SELECT * FROM tareas WHERE id_tarea = $id";
		$result = mysqli_query($conex, $query);
		if (!$result) {
			die("Query fail");
		}
		while($row = mysqli_fetch_array($result)) {
			$json[] = [
				'name' => $row['nombre_tarea'],
				'description' => $row['descripcion_tarea'],
				'id' => $row['id_tarea']
			];
		}
		$jsonStr = json_encode($json[0]);
		echo $jsonStr;
	}
?>