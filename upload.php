<?php
	$server1 = '10.100.101.116';
	session_start();
	if(!isset($_SESSION['user'])){
		   header("Location:/cloudfiles/index.html");
	}
	echo $_SESSION['user'];
	$target_dir = "uploads/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$tmp_name = $_FILES["fileToUpload"]["tmp_name"];
	move_uploaded_file($tmp_name, "$target_file");

	//Connecting database
	include '../passdb.php';
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

	
	$sqlinsert = "INSERT INTO ".$user." (filename, filesize) VALUES ('".$target_file."', '".$filesize."')";
//	mysqli_query($conn,$sqlinsert);//for execute
	if($conn->query($sqlinsert) === TRUE) {
		echo "successful entry of files";
	}
	else{
		echo "invalid query";
	}
	$conn->close();

	//Transfer file from server to server
	set_time_limit(0); //Unlimited max execution time
	 
//	$path = 'newfile.zip';
//	$url = 'http://example.com/oldfile.zip';
	$url = $server1 . '/akshay.' . $target_file;
	
	echo 'Starting Download!<br>';
	$file = fopen ($target_file, "rb");
	if($file) {
		$newf = fopen ($url, "wb");
		if($newf)
			while(!feof($file)) {
				fwrite($newf, fread($file, 1024 * 8 ), 1024 * 8 );
				echo '1 MB File Chunk Written!<br>';
			}
	}
	if($file) {
		fclose($file);
	}
	if($newf) {
		fclose($newf);
	}
	echo 'Finished!';


	//Redirecting
	header("Location:uploadform.php");
?>

