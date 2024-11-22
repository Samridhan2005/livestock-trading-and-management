<?php

$Name = $_POST['Name'];
$Email  = $_POST['Email'];
$Password = $_POST['Password'];




if (!empty($Name) || !empty($Email) || !empty($Password))
{

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "minorproject";



// Create connection
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()){
  die('Connect Error ('. mysqli_connect_errno() .') '
    . mysqli_connect_error());
}
else{
  $SELECT = "SELECT Email From login Where Email = ? Limit 1";
  $INSERT = "INSERT Into login (Name, Email ,Password)values(?,?,?)";

//Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $Email);
     $stmt->execute();
     $stmt->bind_result($Email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;

     //checking username
      if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("sss", $Name,$Email,$Password);
      $stmt->execute();
      echo "New record inserted sucessfully";
     } else {
      echo "Someone already register using this email";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>