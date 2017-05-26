<?php
include_once './functions/connect.php';
include_once './functions/imageUpload.php';
include_once './functions/update.php';
include_once 'car.php';
$db = dbConnect();
if ($_GET['action'] == 'insert') {
    ?>
    <form id = "carInsert" action = "adminActions.php?action=insert" method = "post" enctype="multipart/form-data">
        <label style = "display: block;" for = "marca">Marca:</label>
        <select name = "marca">
            <?php
            $sql = "SELECT * FROM CarBrands ORDER BY CarBrand";
            $result = $db->query($sql);
            while ($row = $result->fetch_assoc()) :
                ?>
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
    <?php
    /* $car = new Car();
      $attributes = array('marca' => $_POST['marca'], 'model' => $_POST['model'], 'capacitateMotor' => $_POST['capacitateMotor'], 'caiPutere' => $_POST['caiPutere'], 'image' => $imageName, 'db' => $db);
      $car -> set_object_vars($attributes);
      $car->save(); */
    //header('Location: admin.php');
}
elseif ($_GET['action'] == 'edit') {
    if (isset($_POST['upSubmit'])) {
        if (!isset($_FILES['image']) || $_FILES['image']['error'] == UPLOAD_ERR_NO_FILE) {
            $imageName = $_POST['imageName'];
        } else {
            //unlink("./uploads/" . $image);
            $filename = $_FILES["image"]["name"];
            $filetype = $_FILES["image"]["type"];
            $filesize = $_FILES["image"]["size"];
            $imageName = imageUpload($filename, $filetype, $filesize);
        }
        $car = new Car();
        $attributes = array('marca' => $_POST['carBrand'], 'model' => $_POST['model'], 'capacitateMotor' => $_POST['engineCapacity'], 'caiPutere' => $_POST['powerHorses'], 'image' => $imageName, 'db' => $db, 'id' => $_POST['id']);
        echo $imageName;
        $car->set_object_vars($attributes);
        $car->save();
    }
}
