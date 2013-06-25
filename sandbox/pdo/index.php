<?php

require 'lib/config.php';
$id = 5;
try {
	$conn = new PDO('mysql:host=' . $config['DB_HOST'] . ';dbname=' . $config['DB_NAME'], $config['DB_USERNAME'], $config['DB_PASSWORD']);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	/* ANTI-PATTERN */
	//$results = $conn->query('SELECT * FROM location WHERE location_id = '. $conn->quote($id));

	/* Better Way */
	// $stmt = $conn->prepare('SELECT * FROM location WHERE location_id = :id');
	// $stmt->setFetchMode(PDO::FETCH_OBJ);
	// $stmt->execute(array(
	// 		'id' => $id
	// 	));

	/* Another Way Bind Parameter */
	// $stmt->bindParam(':id', $id, PDO::PARAM_INT);
	// $stmt->execute();

	/* Combine with bindParam or Execute */
	// while ($row = $stmt->fetch())
	// {
	// 	print_r($row);
	// }

	// $result = $stmt->fetchAll(); 
	// print_r($result);

	/* ====================== */
	/* To Insert */
	$stmt = $conn->prepare('INSERT INTO location(city_name) VALUES(:loc)');
	$stmt->bindParam('loc', $loc, PDO::PARAM_STR);

	$cities = array('A','B','C');

	foreach ($cities as $loc) {
		$stmt->execute();
	}

} catch (PDOException $e){
	echo 'ERROR: ' . $e->getMessage();
}