<?php
include_once './functions/connect.php';
$db = dbConnect();
$id = $_GET['id'];

$sql = "SELECT * FROM cars WHERE CarID = '$id'";
$result = $db -> query($sql);
while ($row = $result->fetch_assoc()) {
    $model = $row['Model'];
    $carBrand = $row['CarBrandID'];
    $engineCapacity = $row['EngineCapacity'];
    $powerHorses = $row['PowerHorses'];
    $image = $row['Image'];
}

/*
public function edit() {
    $car = Car::getById(Request::get('id'));
    return View::make('edit.html', ['car' => $car]);
}
 * 
 */
?>

<form name = "update" method = "post" action = "adminActions.php?action=edit" enctype="multipart/form-data">
    <select name = "carBrand" />
	<?php
            $sql = "SELECT * FROM carbrands ORDER BY CarBrand";
            $result = $db -> query($sql);
            while ($row = $result->fetch_assoc()) : ?>
		<option value = "<?php echo $row['CarBrandID'] ?>"><?php echo $row['CarBrand'] ?></option>  
            <?php endwhile; ?>
    </select>
    <input style ="display: block;" type = "text" name = "model" value = "<?php echo $model; ?>" />
    <input style ="display: block;" type = "number" name = "engineCapacity" value ="<?php echo $engineCapacity; ?>" />
    <input style ="display: block;" type = "number" name = "powerHorses" value = "<?php echo $powerHorses; ?>"/>
    
    <input style ="display: block;" type="file" name="image" id="fileSelect">
    <input style ="display: block;" type="hidden" name ="id" value = "<?php echo $id; ?>"/>
    <input style ="display: block;" type="hidden" name ="imageName" value = "<?php echo $image; ?>"/>
    <input type = "submit" name = "upSubmit" />
</form> 
    <img class = "carImg" alt="<?php echo $model; ?>" src = "<?php echo "./uploads/" . $image; ?>"/>
    <?php echo "./uploads/" . $image;
    echo $image;
    ?>


