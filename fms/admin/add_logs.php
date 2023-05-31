<?php
include_once "conn.php";
if(isset($_POST['add']))
{
$office_received_from=$_POST['received_from'];
$date_received=$_POST['date'];
$forwarded_to=$_POST['forwarded_to'];
$dispatched_to=$_POST['dispatched_to'];
$action_taken_by=$_POST['action_taken_by'];
$subject=$_POST['subject'];
$target_dir = "files/";
$target_file = $target_dir .$_FILES["fileToUpload"]["name"];
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "pdf" &&  $imageFileType != "sql" && $imageFileType != "doc"
&& $imageFileType != "gif" ) {
  echo "Sorry, only PDF, DOC, SQLfiles are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
   $sql="insert into logs(date,Forwarded_to,subject,action_taken_by,dispatched_to,received_from,file_path)
   values('$date_received','$forwarded_to','$subject','$action_taken_by','$dispatched_to','$office_received_from','$target_file')";
   $query=mysqli_query($conn,$sql);
   if($query){
      header("location:logs.php");
   }
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
?>