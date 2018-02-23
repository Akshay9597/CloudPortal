<?php
$user = $_POST["user"];
echo $user;
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
 $tmp_name = $_FILES["fileToUpload"]["tmp_name"];
 move_uploaded_file($tmp_name, "$target_file");
?>

