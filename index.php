<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>Car sale</title>
        <meta title="Car sale"/>
        <meta description="Cars for sale"/>
        <link rel="stylesheet" type="text/css" href="./style/style.css">
    </head>
    <body>
        <div id = "header">

        </div>
        <div id = "centered_content">
            <form action = "" method = "post">
                <select name = "car">
                    <?php include_once "./functions/connect.php";
			$db = dbConnect();
                        $sql = "SELECT * FROM carbrands ORDER BY CarBrand";
			$result = $db->query($sql);
                            while ($row = $result->fetch_assoc()) { ?>
				<option value = "<?= $row['CarBrand'] ?>"><?= $row['CarBrand'] ?> </option>
		<?php }	?>
		</select>
                <input type = "submit" name = "submit" value = "Cauta"/>
            </form>
            
            <?php if (isset($_POST['submit'])) { ?>
                <table>
                    <tr>
                        <th>Marca</th>
                        <th>Model</th>
                        <th>Capacitate motor</th>
                        <th>Cai putere</th>
                        <th>Imagine</th>
                    </tr>
               
                    <?php 
                        $selected_val = $_POST['car']; 
                        $sql = "SELECT carbrands.*, cars.* FROM carbrands INNER JOIN cars ON carbrands.CarBrandID = cars.CarBrandID";

                        $result = $db->query($sql);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) { ?>
                                <tr>
                                    <td><?php echo $row['CarBrand']; ?></td>
                                    <td><?php echo $row['Model']; ?></td>
                                    <td><?php echo $row['EngineCapacity'] ; ?></td>
                                    <td><?php echo $row['PowerHorses']; ?></td>
                                    <td>
                                        <?php
                                            if (!$row['Image'] == "") { ?>
                                                <img class = "carImg" src = "<?php echo "./uploads/" . $row['Image']; ?>"/></td>
                                        <?php } else { ?>
                                    <span><?php echo "No image"; } ?></span>
                                    </tr> <?php 
                                }
                        } else {
                            echo "0 results";
                        }    
                    }
                ?> 
                </table>
        
		
        </div>
    </body>
</html>