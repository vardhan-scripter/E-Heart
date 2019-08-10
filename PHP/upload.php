<?php
session_start();
include('./conn.php');
date_default_timezone_set("Asia/kolkata");
$doctorid = $_POST['doctorid'];

$patientid = $_POST['patientid'];

$ppass = $_POST['ppass'];

$heartbeat = $_POST['heartbeat'];

$highbp = $_POST['highbp'];

$lowbp = $_POST['lowbp'];

$date = date('d-m-y');

$timestamp = date("h:i");

$query = "select * from doctors where doctorid = '".$doctorid."' ";

$result = mysqli_query($conn, $query);

$result = mysqli_fetch_array($result);

if ($result['doctorid'] == $doctorid) {
    $query = "select * from ".$result['tablelink']." where patientid = '".$patientid."' ";
    $result = mysqli_query($conn, $query);
    $result = mysqli_fetch_array($result);
    if ($result['patientid'] == $patientid) {
        $query = "insert into ".$result['tablelink']." values('".$date."','".$timestamp."','".$heartbeat."','".$highbp."','".$lowbp."') ";
        if(mysqli_query($conn, $query)){
            echo "data inserted successfully";
        }
    }
}

?>