<?php 
	require_once("conexion.php");
	$search = $_POST['search'];
	if (!empty($search)) {
		$query = "SELECT * FROM tareas WHERE nombre_tarea LIKE '$search%'";
		$result = mysqli_query($conex, $query);
		if (!$result) {
			die("Query error: {mysqli_error($conex)}");
		}
		$json = array();
		while($row = mysqli_fetch_array($result)) {
			$json[] = array(
				'name' => $row['nombre_tarea'],
				'description' => $row['descripcion_tarea'],
				'id' => $row['id_tarea']
			);
		}
		$jsonStr = json_encode($json);
		echo $jsonStr;
	}
?>