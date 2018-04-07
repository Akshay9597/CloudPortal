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
$connection = ssh2_connect($nodes[i][0], 22);
ssh2_auth_password($connection, $nodes[i][1], $nodes[i][2]);
$target_dir = './'.$user.'/';
echo $target_dir;
echo '*************';
if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
} else {
	echo "faileddddddddd";
}

echo '*************';
$sourceFile = './uploads/'.$filename;
echo $sourceFile;
echo '*************';
$targetFile = $target_dir.$filename;
echo $targetFile;
echo '*************';
ssh2_scp_send($connection, $sourceFile, $targetFile, 0777);
echo "done";
?>
