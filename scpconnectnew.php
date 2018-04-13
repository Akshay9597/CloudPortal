<?php
session_start();
	if(!isset($_SESSION['user'])){
		   header("Location:/cloudfiles/index.html");
	}

include './nodesinfo.php';
/*$hostname = "localhost";
$username = "akshay";
$password = "tomnjerry123";*/
//$nodes[0][0] host
//$nodes[0][1] user
//$nodes[0][2] pass

/************some hash function to calculate i *****************/
$i = 0;

echo "start";
echo '************';
$user = $_SESSION["user"];
$filename = $_SESSION["filename"];
echo $filename;
echo "*********";

$connection = ssh2_connect($nodes[$i][0], 22);
if($connection == TRUE) {
	echo "connection established <br>";
} else {
	echo "connedtion can't be established <br>";
}
$sftp = ssh2_sftp($connection);
if($sftp == TRUE) {
	echo "sftp connection established <br>";
} else {
	echo "sftp connedtion can't be established <br>";
}
$auth = ssh2_auth_password($connection, $nodes[$i][1], $nodes[$i][2]);
if($auth == TRUE) {
	echo "auth established <br>";
} else {
	echo "auth connedtion can't be established <br>";
}

//$target_dir = '/var/www/html/testnew/'.$user.'/';
$target_dir = '/home/akshay/Desktop/'.$user.'/';
echo $target_dir;
echo '*************';
/*
if (!file_exists($target_dir)) {
	$oldmask = umask(0);
    mkdir($target_dir, 0777);
	umask($oldmask);
} else {
	echo "faileddddddddd";
}
*/

$remotedir = ssh2_sftp_mkdir($sftp, $target_dir);
if($remotedir == TRUE) {
	echo "remote dir made <br>";
} else {
	echo "remote dir failed <br>";
}
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
