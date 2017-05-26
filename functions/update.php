    <?php
function update($carBrand, $model, $engineCapacity, $powerHorses, $image, $carID, $db) {
	if ($engineCapacity == "") {
		$engineCapacity = 0;
	}
	if ($powerHorses == "") {
		$powerHorses = 0;
	}
	$sql = "SELECT CarID FROM cars WHERE CarID = '$carID'";
	$result = $db->query($sql);
        //unlink("..uploads/" . $image);
	if ($result->fetch_assoc()) {
            $sql = "UPDATE cars SET CarBrandID = '$carBrand' , Model = '$model', EngineCapacity = '$engineCapacity', PowerHorses = '$powerHorses', Image = '$image' WHERE CarID = '$carID' ";
            if($db->query($sql) === TRUE) {
		echo "Record updated";
            } else {
		echo "Error updating";
            }
	} else {
	echo "Id not found!";
    }	
}
