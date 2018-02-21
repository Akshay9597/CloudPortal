<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
var_dump($_FILES);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
 $tmp_name = $_FILES["fileToUpload"]["tmp_name"];
 move_uploaded_file($tmp_name, "$target_file");
?>

