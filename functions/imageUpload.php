<?php
function imageUpload($filename, $filetype, $filesize) {
			$allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
			
			// Verify file extension
			$ext = pathinfo($filename, PATHINFO_EXTENSION);
			if(!array_key_exists($ext, $allowed)) {
				die("Error: Please select a valid file format.");
			}
		
			// Verify file size - 5MB maximum
			$maxsize = 5 * 1024 * 1024;
			if($filesize > $maxsize) {
				die("Error: File size is larger than the allowed limit.");
			}
		
			// Verify MYME type of the file
			if(in_array($filetype, $allowed)){
				// Check whether file exists before uploading it
				if(file_exists("uploads/" . $_FILES["image"]["name"])){
					echo $_FILES["image"]["name"] . " already exists.";
				} else {
					$temp = explode(".", $_FILES["image"]["name"]);
					$newfilename = round(microtime(true)) . '.' . end($temp);
					move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/" . $newfilename);
					//move_uploaded_file($_FILES["imagine"]["tmp_name"], "uploads/" . $_FILES["imagine"]["name"]);
				} 
			}
		return $newfilename;
	} 
?>
