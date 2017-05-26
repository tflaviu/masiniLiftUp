<?php
    include_once './functions/connect.php';
    $db = dbConnect();
?>

<form id = "carInsert" action = "adminActions.php?action=insert" method = "post" enctype="multipart/form-data">
    <label style = "display: block;" for = "marca">Marca:</label>
    <select name = "marca">
    <?php
        $sql = "SELECT * FROM CarBrands ORDER BY CarBrand";
	$result = $db -> query($sql);
	while ($row = $result->fetch_assoc()) : ?>
            <option value = "<?php echo $row['CarBrandID'] ?>"><?php echo $row['CarBrand'] ?></option>  
    <?php endwhile; ?>
    </select>
    <label for = "model">Model:</label>
    <input type = "text" name = "model" id = "model"/>
    <label for = "capacitateMotor">Capacitate motor:</label>
    <input type = "number" min = "0" name = "capacitateMotor" id = "capacitateMotor"/>
    <label for = "caiPutere">Cai putere:</label>
    <input type = "number" min = "0" name = "caiPutere" id = "caiPutere"/>
    <input type="file" name="image" id="fileSelect">
			
    <input name = "save" type = "submit" value = "Insert"/>
</form>