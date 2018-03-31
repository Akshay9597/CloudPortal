<?php
$server = 'localhost';
$connection = ssh2_connect($server, 22);

if (ssh2_auth_password($connection, 'akshay', 'tomnjerry123')) {
  echo "Authentication Successful!\n";
} else {
  die('Authentication Failed...');
}
?>

