<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        <link rel="stylesheet" type="text/css" href="./style/admin.css">
        <?php
        session_start();
        include_once "./functions/connect.php";
        include_once "./functions/logout.php";
        //include_once "./functions/delete.php";
        include_once "/functions/update.php";
        include_once "./functions/listAllCars.php";
        include_once "./functions/imageUpload.php";
        include_once "car.php";
        $db = dbConnect();
        if (isset($_SESSION['loggedUser']) && $_SESSION['loggedIn'] == true) {
            echo "Welcome to the member's area, " . $_SESSION['loggedUser'] . "!" . "<br>" . "<br>";
        } else {
            echo "Please "
            ?> <a href = "adminLogin.php">log in</a> <?php
            echo " first to see this page.";
            die;
        }
        ?>

        <span>What do you want to do? : </span>
        <form style = "display: inline-block;" method = "post" action = "">
            <select name = "action">
                <option value = "listCars">List all cars</option>
                <option value = "insertCar">Insert a car</option>
                <option value = "insertMarca">Insert a car type</option>
                <input type = "submit" name = "submit" value = "Go" style = "display: inline-block; margin-left: 5px;" />
            </select>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            if ($_POST['action'] == 'insertCar') {
                header("Location: adminTools.php?action=insert");
            }
        }
        ?>

        <?php
        if (isset($_POST['submit'])) {
            $action = $_POST['action'];
            if ($action == "listCars") {
                $sql = "SELECT carbrands.CarBrandID, cars.* FROM carbrands INNER JOIN cars ON carbrands.CarBrandID = cars.CarBrandID";
                $result = $db->query($sql);
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <ul> <?php echo $row['CarID'] . " " . $row['CarBrandID'] . " " . $row['Model'] . " " . $row['EngineCapacity'] . " " . $row['PowerHorses'] . " " . $row['Image']; ?> <a href='delete.php?id=<?php echo $row['CarID']; ?>'>Delete</a> <a href='edit.php?id=<?php echo $row['CarID']; ?>'>Edit</a> <?php
                    }
                } elseif ($action == "insertCar") {
                    ?>
                    <form id = "carInsert" action = "" method = "post" enctype="multipart/form-data">
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
                    </form>  <?php
                }
                elseif ($action == "updateCar") {
                    ?>
                    <form name = "updateID" method = "post" action = "">
                        <select name = "editID">
                            <?php
                            $sql = "SELECT id FROM carlist";
                            $result = $db->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <option value = "<?php echo $row['id']; ?>"><?php echo $row['id']; ?> </option>
                            <?php } ?>
                            <input type = "submit" name = "updateIDSubmit">
                        </select>
                    </form>
                    <?php if (isset($_POST['updateIDSubmit'])) { ?>
                        <form name = "update" method = "post" action = "" enctype="multipart/form-data">

                            <select name = "marca" />
                            <?php
                            $sql = "SELECT carType FROM CarTypes ORDER BY carType";
                            $result = $db->query($sql);
                            while ($row = $result->fetch_assoc()) :
                                ?>
                                <option value = "<?php echo $row['carType'] ?>"><?php echo $row['carType'] ?></option>  
                            <?php endwhile; ?>
                            </select>
                            <input type = "text" name = "model" placeholder = "model" />
                            <input type = "number" name = "capacitateMotor" placeholder = "capacitateMotor" />
                            <input type = "number" name = "caiPutere" placeholder = "caiPutere" />
                            <input type="file" name="image" id="fileSelect">

                            <input type = "submit" name = "upSubmit" />
                        </form> <?php
                    }
                }
                elseif ($action == "deleteCar") {
                    ?>
                    <!--- Delete form -->
                    <form name = "delete" method = "post" action = "" >
                        <select name = "deleteID">
                            <?php
                            $sql = "SELECT id FROM carlist";
                            $result = $db->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <option value = "<?php echo $row['id']; ?>"><?php echo $row['id']; ?> </option>
                            <?php } ?>
                        </select>
                        <input type = "submit" name = "delSubmit" value = "Delete" />
                    </form> <?php
                } elseif ($action == "insertMarca") {
                    ?>
                    <form name = "insMarca" method = "post" action = "">
                        <input type = "text" name = "marca"/>
                        <input type = "submit" name = "submitMarca" />
                    </form>
                    <?php
                }
            }
            //update
            if (isset($_POST['upSubmit'])) {
                if (!isset($_FILES['image']) || $_FILES['image']['error'] == UPLOAD_ERR_NO_FILE) {
                    $imageName = "noImage";
                } else {
                    $filename = $_FILES["image"]["name"];
                    $filetype = $_FILES["image"]["type"];
                    $filesize = $_FILES["image"]["size"];
                    $imageName = imageUpload($filename, $filetype, $filesize);
                }
                $car = new Car($_POST['id']);
                $car->fill($_POST);

                update($_POST['marca'], $_POST['model'], $_POST['capacitateMotor'], $_POST['caiPutere'], $imageName, $_POST['editID'], $db);
                $car = new Car($_POST['id']);
                $car->fill($_POST);
                $car->save();
            }

            //delete
            if (isset($_POST['delSubmit'])) {
                delete("carlist", $db, $_POST['deleteID']);
            }

            //insert
            if (isset($_POST['save'])) {
                if (!isset($_FILES['image']) || $_FILES['image']['error'] == UPLOAD_ERR_NO_FILE) {
                    $imageName = "";
                } else {
                    $filename = $_FILES["image"]["name"];
                    $filetype = $_FILES["image"]["type"];
                    $filesize = $_FILES["image"]["size"];
                    $imageName = imageUpload($filename, $filetype, $filesize);
                }
                $the_car = new Car($_POST['marca'], $_POST['model'], $_POST['capacitateMotor'], $_POST['caiPutere'], $imageName, $db);
                $the_car->save();
            }

            if (isset($_POST['submitMarca'])) {
                $marca = $_POST['marca'];
                $sql = "INSERT INTO `cartypes`(`carType`) VALUES ('$marca')";
                if ($db->query($sql) === TRUE) {
                    echo "Car type inserted";
                } else {
                    echo "Error inserting car type";
                }
            }
            ?>