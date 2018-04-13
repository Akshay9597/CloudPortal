<?php
	session_start();
	if(!isset($_SESSION['user'])){
		   header("Location:/cloudfiles/index.html");
	}
	echo $_SESSION['user'];
	$onlyfilename = $_FILES["fileToUpload"]["name"];
	$target_dir = "./";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$tmp_name = $_FILES["fileToUpload"]["tmp_name"];
	move_uploaded_file($tmp_name, "$target_file");
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

	
	$sqlinsert = "INSERT INTO ".$user." (filename, filesize) VALUES ('".$onlyfilename."', '".$filesize."')";
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

	
/*************************************************************************************************/
	//Redirecting
	header("Location:uploadform.php");
?>

