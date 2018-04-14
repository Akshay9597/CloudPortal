<?php
	session_start();
	if(!isset($_SESSION['user'])){
		   header("Location:/cloudfiles/index.html");
	}
	$title = $_POST["title"];
	$flag = 0;
	$onlyfilename = $_FILES["fileToUpload"]["name"];
	if($_FILES['fileToUpload']['name'] == '') {
		//header("Location:/cloudfiles/uploadform.php");
		$flag = 1;
	}
	echo $flag;
	if($flag == 0) {
		echo "file:".$onlyfilename."<br>";
		echo "<br>";
		//moving files to main server
		echo $_SESSION['user'];
		$onlyfilename = $_FILES["fileToUpload"]["name"];
		$target_dir = "./";
		$target_dirextra = "./uploads/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$target_fileextra = $target_dirextra . basename($_FILES["fileToUpload"]["name"]);
		$tmp_name = $_FILES["fileToUpload"]["tmp_name"];

		copy($tmp_name, "$target_file");
		move_uploaded_file($tmp_name, "$target_fileextra");

		$_SESSION['filename'] = basename($_FILES["fileToUpload"]["name"]);
		//Connecting database
		include_once '../passdb.php';
		$dbname = "cloudportalDB";
	
		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		//Getting user from session variable and inserting with filename into user's table
		$user = $_SESSION['user'];
		$filesize = filesize($target_file);  
		echo $user . ' ' . $filesize. ' ' . $target_file;
	
		//$sqlinsert = "INSERT INTO akshay (filename,filesize) VALUES ('abc','343')";
		//$sqlinsert = "INSERT INTO '" . $user . "' (`filename`, `filesize`) VALUES ('$target_file', '$filesize')";

	
		$sqlinsert = "INSERT INTO ".$user." (filename, filesize, title) VALUES ('".$onlyfilename."', '".$filesize."','".$title."')";
	//	mysqli_query($conn,$sqlinsert);//for execute
		if($conn->query($sqlinsert) === TRUE) {
			echo "successful entry of files";
		}
		else{
			echo "invalid query";
		}
		$conn->close();

	//	writing to a file so it will be sent first to the node to know the contents.
	

		$filename= "filename.txt";

		// programatically set permissions
		if(!file_exists($filename)){
		    touch($filename);
		    chmod($filename, 0777);
		}
		$data = $user."#".$onlyfilename."\n";
		$newFile= fopen($filename, 'a') or die('error while opening');
		fwrite($newFile, $data);
		fclose($newFile);
	/***********************************************************************************************/
		//Transfer file from server to server
		//This is done using python
	
	/*************************************************************************************************/
		//Redirecting
	}
		header("Location:uploadform.php");
	
?>

