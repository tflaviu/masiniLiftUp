<?php
function listCars($db) {
	
	$sql = "SELECT * FROM `carlist` ORDER BY id";
	$result = $db->query($sql);
	
	while ($row = $result -> fetch_assoc()) {
		echo $row['id'] . " " . $row['marca'] . " " . $row['model'] . " " . $row['capacitateMotor'] . " " . $row['caiPutere'] . " " . $row['imagine'];	
	}
}