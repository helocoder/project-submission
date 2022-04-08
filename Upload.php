<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
     <link rel = "stylesheet" href="style.css">
      <title>upload file</title>
    </head>
    <body>
    
  <form action="Upload.php" method="POST" enctype="multipart/form-data" style="display: flex;flex-direction: column;align-items: center;margin-top: 100px;">
  <h3 style="color: #dc3545;margin-top:font-family: system-ui;"> Upload your Project Here </h3>  

      <!---|||||||||||||||||||||Form|||||||||||||||||||||-->    

      <div class="mb-3 col-md-3">
      <label for="name" class="form-label">Name</label>
      <input type="text" class="form-control" id="nam" name = "nam">
  </div>

  <div class="mb-3 col-md-3" >
      <label for="reg" class="form-label ">Registration Number</label>
      <input type="number" class="form-control" id="reg" name="reg">
    <!-- //subject// -->
    </div>
        <div class="mb-3 col-md-3">
      <label for="sub" class="form-label">Subject</label>
      <input type="sub" class="form-control" id="sub" name = "sub">
  </div>

    <!-- //subject// -->

    <div class="mb-3 col-md-3" >
      <label for="usrname" class="form-label">Project Name</label>
      <input type="text" class="form-control" id="prjctname" name="prjctname">
      <span style="color:#dc3545;">Project name must be short.</span>
    </div>
 
  <!---||||||||||||||||||||| Form|||||||||||||||||||||-->  


<div class="col-md-3">
  <input class="form-control btn btn-outline-danger" type="file"
  name="fileToUpload" id="fileToUpload">
  <br>
  <button style ="margin-top:10px;"type="submit" name="submit" class="btn btn-danger">Submit</button>
</div>
</form>

<?php
if(isset($_POST["submit"]))
{
  // Db start
    require 'Db/conn.php';
  global $conn;
  $Name = $_POST["nam"];
  $Reg_no= $_POST["reg"];
  $Subject = $_POST["sub"];
  $Prjct_name = $_POST["prjctname"];

  $sql = "INSERT INTO `students`(`name`,`regno`,`subject`,`prjctname`) VALUES('$Name','$Reg_no','$Subject','$Prjct_name')";
  
  $sql_search = "select * from students where regno = '$Reg_no' and subject = '$Subject'" ;
       $result_search = mysqli_query($conn,$sql_search);
       $num = mysqli_num_rows($result_search);
       $row = mysqli_fetch_assoc($result_search);

        if($num>0)
     {
            echo'
                <div id="message">
                     <div id="inner-message" class="alert alert-danger" style="padding: 6px;margin-top: -600px;">                        
                    <strong>Sorry! </strong> You already submitted your project </strong>
                </div>
                </div>'; 

     
     }
// Db end//

else{

  $target_dir = "upload_prjct/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        //echo "$target_file";
        
        // Check if file already exists
        if (file_exists($target_file)) {
          
          echo'
                <div id="message">
                <div id="inner-message" class="alert alert-warning" style="padding: 6px;margin-top: -600px;">                        
                <strong>Sorry! </strong> File already exist <strong>:\ </strong>
                </div>
                </div>';  
                $uploadOk = 0;
              }
              // Check file size (500kb)
              if ($_FILES["fileToUpload"]["size"] > 1e+8) {
                echo'
                <div id="message">
                <div id="inner-message" class="alert alert-danger" style="padding: 6px;margin-top: -600px;">                        
                <strong>Sorry! </strong> Your file is too large  <strong> :( </strong>
                </div>
                </div>'; 
                $uploadOk = 0;
              }
              
              // Allow certain file formats
              if($imageFileType != "pdf" && $imageFileType != "doc" && $imageFileType != "docx" ) {
                echo'
                <div id="message">
                <div id="inner-message" class="alert alert-warning" style="padding: 6px;margin-top: -600px;">                        
                <strong>Sorry! </strong> Only <strong> PDF </strong> and <strong> DOC</strong> file are allowed <strong>:\ </strong>
                </div>
                </div>'; 
            $uploadOk = 0;
                            }
                            // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                  //echo "Sorry, your file was not uploaded.";
                  // if everything is ok, try to upload file
                } else {
                  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    $file_nam = "The file". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"]));
                    //echo "$file_nam";
                    //data inserting in db //
                    $result = mysqli_query($conn,$sql);
                    echo'
                    <div id="message">
                    <div id="inner-message" class="alert alert-success" style="padding: 6px;margin-top: -600px;">                        
                    <strong>Success </strong> The file <?php echo $file_nam ; ?> has been uploaded. <strong> :) </strong>;
                </div>
                </div>'; 
              } else {
                echo'
                <div id="message">
                <div id="inner-message" class="alert alert-danger" style="padding: 6px;margin-top: -600px;">                        
                <strong>Sorry! </strong> there was an error uploading your file. <strong> :( </strong>
                </div>
                </div>'; 
              }
            }
  }
}
?>


<!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>