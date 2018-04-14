<?php
	session_start();
	$_SESSION["user"] = $_POST["user"];

	include './passdb.php';
	$dbname = "cloudportalDB";
	
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	$flag = 0;
	$sql = "SELECT username, password FROM customer";
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
    
    		while($row = $result->fetch_assoc()) {
    			$user = $_POST["user"];
			$pass = $_POST["pass"];
			if($row["username"] == $user) {
				$flag = 1;
				if($row["password"] == $pass) {
					echo "login successful";
					header("Location:uploadform.php");
				}
				else {
					echo "<script type=\"text/javascript\">window.alert('Invalid Password!!');window.location.href = 'index.html';</script>"; 
   					exit;
    				}
    			}
    		}
    		if($flag == 0) {
    			echo "<script type=\"text/javascript\">window.alert('New User? SignUp for free!!');window.location.href = './signup.html';</script>"; 
   			exit;
   		}
	} else {
		echo "<script type=\"text/javascript\">window.alert('New User? SignUp for freeeeee!!');window.location.href = 'signup.html';</script>"; 
   		exit;
   	}
		
		

		
?>
