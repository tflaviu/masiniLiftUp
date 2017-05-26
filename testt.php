<?php
include_once './functions/connect.php';
include_once './functions/imageUpload.php';
include_once './functions/update.php';
$id = $_GET['id'];
$db = dbConnect();
$sql = "SELECT * FROM cars WHERE CarID = '$id'";
$result = $db -> query($sql);

while ($row = $result->fetch_assoc()) {
    $model = $row['Model'];
    $carBrand = $row['CarBrandID'];
    $engineCapacity = $row['EngineCapacity'];
    $powerHorses = $row['PowerHorses'];
    $image = $row['Image'];
}
?>
<form name = "update" method = "post" action = "" enctype="multipart/form-data">
			
    <select name = "carBrand" />
	<?php
            $sql = "SELECT * FROM carbrands ORDER BY CarBrand";
            $result = $db -> query($sql);
            while ($row = $result->fetch_assoc()) : ?>
		<option value = "<?php echo $row['CarBrandID'] ?>"><?php echo $row['CarBrand'] ?></option>  
            <?php endwhile; ?>
    </select>
    <input style ="display: block;" type = "text" name = "model" value = "<?php echo $model; ?>" />
    <input style ="display: block;" type = "number" name = "engineCapcity" value ="<?php echo $engineCapacity; ?>" />
    <input style ="display: block;" type = "number" name = "powerHorses" value = "<?php echo $powerHorses; ?>"/>
    <img class = "carImg" src = "<?php echo "./uploads/" . $row['Image']; ?>"/>
    <input style ="display: block;" type="file" name="image" id="fileSelect">
    
    <input type = "submit" name = "upSubmit" />
</form> 
<?php
if (isset($_POST['upSubmit'])) {
    if(!isset($_FILES['image']) || $_FILES['image']['error'] == UPLOAD_ERR_NO_FILE) {
	$imageName = $image;
    } else {
    unlink("./uploads/" . $image);
    $filename = $_FILES["image"]["name"];
    $filetype = $_FILES["image"]["type"];
    $filesize = $_FILES["image"]["size"];
    $imageName = imageUpload($filename, $filetype, $filesize);
    }
    update($_POST['carBrand'], $_POST['model'], $_POST['engineCapcity'], $_POST['powerHorses'], $imageName, $id, $db);
}