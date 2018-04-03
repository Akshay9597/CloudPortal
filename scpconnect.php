<?php

error_reporting(-1);
ini_set('display_errors', 'On');

echo "hello";

$hostname = "localhost";
$username = "akshay";
$password = "tomnjerry123";
$sourceFile = "test.txt";
$targetFile = '/home/akshay/Desktop/test.txt';
$connection = ssh2_connect($hostname, 22);
ssh2_auth_password($connection, $username, $password);
ssh2_exec($connection,'gedit');
ssh2_scp_send($connection, $sourceFile, $targetFile, 0777);
?>
