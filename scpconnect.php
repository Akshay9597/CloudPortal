<?php
session_start();
	if(!isset($_SESSION['user'])){
		   header("Location:/cloudfiles/index.html");
	}

include './nodesinfo.php';
//$nodes[0][0] host
//$nodes[0][1] user
//$nodes[0][2] pass
/*$hostname = "localhost";
$username = "akshay";
$password = "tomnjerry123";*/

/************some hash function to calculate i *****************/
//$filename = $_SESSION["filename"];
//$i = sha1($filename) % 2;
$i = 1;
/**********************************/
echo $nodes[0][0];
echo $nodes[0][1];
echo $nodes[0][2];
echo "start";
echo '************';
$user = $_SESSION["user"];

echo $filename;
echo "*********";
$connection = ssh2_connect($nodes[$i][0], 22);
if($connection == TRUE) {
	echo "connection established <br>";
} else {
	echo "connedtion can't be established <br>";
}
ssh2_auth_password($connection, $nodes[$i][1], $nodes[$i][2]);
$target_dir = '/var/www/html/cloudfiles/';
echo $target_dir;
echo '*************';
echo '*************';
$sourceFile = './uploads/'.$filename;
echo $sourceFile;
echo '*************';
$targetFile = $target_dir.$filename;
echo $targetFile;
echo '*************';
if(ssh2_scp_send($connection, $sourceFile, $targetFile, 0777) == TRUE) {
	echo "file sent <br>";
} else {
	echo "file not trans <br>";
}
ssh2_exec($connection, 'exit');
echo "done";
?>
