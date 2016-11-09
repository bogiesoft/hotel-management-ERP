<?php
if(is_array($_FILES)) {
if(is_uploaded_file($_FILES['dp']['tmp_name'])) {
$sourcePath = $_FILES['dp']['tmp_name'];
$targetPath = "images/".$_FILES['dp']['name'];
if(move_uploaded_file($sourcePath,$targetPath)) {
 echo $targetPath;  
   }
  }
}
?>