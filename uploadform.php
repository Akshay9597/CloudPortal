<!DOCTYPE html>

<html>
<head>
	<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
	<meta content="utf-8" http-equiv="encoding">
</head>
<body>
<?php
	session_start();
	if(!isset($_SESSION['user'])){
		   header("Location:/cloudfiles/index.html");
	}
	$user = $_SESSION["user"];
	echo 'Welcome '.$user;
	
?>

<form action="upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>

<a href="logout.php">Logout</a>
</body>
</html>

