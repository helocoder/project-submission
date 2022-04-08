<?php
 //connecting
require 'Db/conn.php';
global $conn;
$regno = "";
$password = "";


if(isset($_POST["login"]))
{
     $regno = $_POST["reg"];
     $password = $_POST["pwd"];
     
     $sql = "select * from students where regno = '$regno' and password = '$password' " ;
     $result = mysqli_query($conn,$sql);
     
     $num = mysqli_num_rows($result);
     $row = mysqli_fetch_assoc($result);
     if($num>0)
     {

          $logname = $row['name'];
           echo "Hello Mr. "." $logname"; 
           require 'Upload.php';
     }
       else {
             echo "user not found ";
             echo "<br>";
            }   

}

