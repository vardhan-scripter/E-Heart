<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Account Update</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../assets/libs/css/account.css">
</head>
<body>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
      
      <h1>Patient Creation</h1>
      <?php
        session_start();
        $data = $_SESSION['data'];
      ?>
    
      
      <div class="upload-button">
          <button class="btn"><img src="<?php echo $data['imagelink']; ?>" alt="image not supported" id="image"></button>
          <input type="file" name="imagelink" id="imagelink" onclick="change();">
      </div>

      <input type="text" class="form-control" name="name" id="name" value="<?php echo $data['name'];  ?>">
    
      <input type="text" class="form-control" name="age" id="age" value="<?php echo $data['age'];  ?>">
    
      <input type="text" class="form-control" name="address" id="address" value="<?php echo $data['address'];  ?>">
    
      <input type="submit" class="form-control" value="update">
</form>
<script>
    function change(){
        var interval = setInterval(function(){
            let imagelink = document.getElementById('imagelink').value;
            if(imagelink){
                document.getElementById('image').src = imagelink;
                clearInterval(interval);
            }
        }, 1000);
    }
</script>

<?php
error_reporting(0);
include('./conn.php');
$name = $_POST['name'];
$age = $_POST['age'];
$address = $_POST['address'];
$file=$_FILES['imagelink'];
$fileName=$_FILES['imagelink']['name'];
        $fileTmpName=$_FILES['imagelink']['tmp_name'];
        $filesize=$_FILES['imagelink']['size'];
        $fileError=$_FILES['imagelink']['error'];
        $fileType=$_FILES['imagelink']['type'];

        $fileExt=explode('.', $fileName);
        $fileActualExt=strtolower(end($fileExt));

        $allowed=array('jpg','jpeg','png');
        if(isset($fileName)){
            if(in_array($fileActualExt, $allowed)){
                if ($fileError === 0) {
                    if ($filesize <5000000) {
                        $fileNameNew=uniqid('',true).".".$fileActualExt;
                        $fileDestination='../IMAGES/'.$fileNameNew;
                        move_uploaded_file($fileTmpName, $fileDestination);
                    }else{
                        echo "file size too big";
                    }
                }
            }else{
                echo "there was error in uploading file";
            }
            if ($fileNameNew) {
                $query = "update ".$_SESSION['output']['tablelink']." set name='".$name."',age='".$age."',address='".$address."',imagelink='../IMAGES/".$fileNameNew."' where patientid='".$data['patientid']."'";
                if(mysqli_query($conn, $query)){
                    header('Location:patientoutlet.php');
                }else{
                    echo "patient account updation unsuccessfull";
                }
            }
    
        }
?>

</body>
</html>