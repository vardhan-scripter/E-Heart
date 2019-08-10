<?php
session_start();
include('./conn.php');
$doctorid = $_POST['doctorid'];
$doctorpass = $_POST['doctorpass'];

$patientid = $_POST['patientid'];

$ppass = $_POST['ppass'];

$name = $_POST['name'];

$age = $_POST['age'];

$address = $_POST['address'];

$tablename = $patientid.rand(10000,1000000);

$query = "select * from doctors where doctorid = '".$doctorid."' and dpass = '".$doctorpass."' ";

$result = mysqli_query($conn, $query);

$result = mysqli_fetch_array($result);

if ($result['doctorid'] == $doctorid) {
    $query = "insert into ".$result['tablelink']." values('".$patientid."','".$ppass."','".$name."','".$age."','".$address."','".$tablename."','../IMAGES/user.png') ";
    echo $query;
    if(mysqli_query($conn, $query)){
        $query = "create table ".$tablename." (
            `date` varchar(30) NOT NULL,
            `timestamp` varchar(30) NOT NULL,
            `heartbeat` varchar(10) NOT NULL,
            `highbp` varchar(10) NOT NULL,
            `lowbp` varchar(10) NOT NULL
          )";
          if(mysqli_query($conn, $query)){
              echo "patient acoount created successfully";
              header('Location:heart.php');
          }
    }else{
        echo "patient creation not successfull";
    }
    
}else{
    echo "enter proper details";
}

?>