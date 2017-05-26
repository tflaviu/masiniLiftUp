<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>File Upload Form</title>
    </head>
    <body>
        <form action="" method="post" enctype="multipart/form-data">
            <h2>Upload File</h2>
            <label for="fileSelect">Filename:</label>
            <input type="file" name="photo" id="fileSelect"><br>
            <input type="submit" name="submit" value="Upload">
        </form>
    </body>
</html>

<?php
if (isset($_FILES["photo"]["error"])) {
    if ($_FILES["photo"]["error"] > 0) {
        echo "Error: " . $_FILES["photo"]["error"] . "<br>";
    } else {
        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        $filename = $_FILES["photo"]["name"];
        $filetype = $_FILES["photo"]["type"];
        $filesize = $_FILES["photo"]["size"];

        // Verify file extension
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if (!array_key_exists($ext, $allowed))
            die("Error: Please select a valid file format.");

        // Verify file size - 5MB maximum
        $maxsize = 5 * 1024 * 1024;
        if ($filesize > $maxsize)
            die("Error: File size is larger than the allowed limit.");

        // Verify MYME type of the file
        if (in_array($filetype, $allowed)) {
            // Check whether file exists before uploading it
            if (file_exists("uploads/" . $_FILES["photo"]["name"])) {
                echo $_FILES["photo"]["name"] . " is already exists.";
            } else {
                $temp = explode(".", $_FILES["photo"]["name"]);
                //$newfilename = round(microtime(true)) . '.' . end($temp);
                $newfilename = "flaviu" . '.' . end($temp);
                move_uploaded_file($_FILES["photo"]["tmp_name"], "uploads/" . $newfilename);
                //move_uploaded_file($_FILES["photo"]["tmp_name"], "uploads/" . $_FILES["photo"]["name"]);
                echo "Your file was uploaded successfully.";
            }
        } else {
            echo "Error: There was a problem uploading your file - please try again.";
        }
    }
} else {
    //echo "Error: Invalid parameters - please contact your server administrator.";
}
?>