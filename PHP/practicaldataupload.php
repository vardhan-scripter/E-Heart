<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="refresh" content="60">
    <link rel="stylesheet" type="text/css" media="screen" href="../assets/libs/css/main.css">
    <script src="main.js"></script>
</head>
<body>

<?php
            include('./conn.php');
            error_reporting(0);
            session_start();
            $tablename = $_POST['tablename'];
            if($tablename=='' && $_SESSION['countdata']!=''){
                $tablename = $_SESSION['tablename'];
                $result = $_SESSION['tablename'];
            }else{
                $_SESSION['tablename'] = $tablename;
            }
            date_default_timezone_set("Asia/kolkata");
            $cur_time=date("H:i");
            $duration='-1 minutes';
            $query = "select * from ".$tablename." ORDER BY date and timestamp DESC LIMIT 1";
            $result = mysqli_query($conn, $query);
            $result = mysqli_fetch_assoc($result);
            $_SESSION['countdata'] = $result;
            $count = 0;
            if($result['date']==date('d-m-y')&&$result['timestamp']==date('H:i', strtotime($duration, strtotime($cur_time)))){
                $date = date('d-m-y');
                $timestamp = date("H:i");
                $heartbeat = rand(60,120);
                $highbp = rand(120,180);
                $lowbp = rand(60,120);
                $query = "insert into ".$tablename." values('".$date."','".$timestamp."','".$heartbeat."','".$highbp."','".$lowbp."') ";
                if(mysqli_query($conn, $query)){
                    echo "data inserted successfully";
                }
            }else if($result['date']==date('d-m-y')&&$result['timestamp']!=date('H:i', strtotime($duration, strtotime($cur_time)))){
                $timestamp = date('H:i', strtotime('+1 minutes', strtotime($result['timestamp'])));
                while (date('H:i')!=$timestamp) {
                    $date = date('d-m-y');
                    $heartbeat = 0;
                    $highbp = 0;
                    $lowbp = 0;
                    $query = "insert into ".$tablename." values('".$date."','".$timestamp."','".$heartbeat."','".$highbp."','".$lowbp."') ";
                    if(mysqli_query($conn, $query)){
                        $count++;
                    }
                    $timestamp = date('H:i', strtotime('+1 minutes ', strtotime($timestamp)));
                }
                $query = "insert into ".$tablename." values('".$date."','".$timestamp."','".$heartbeat."','".$highbp."','".$lowbp."') ";
                    if(mysqli_query($conn, $query)){
                        $count++;
                    }
                echo $count."rows inserted successfully";
            }else{
                $date = date('d-m-y');
                
                    $timestamp = "00:00";
                    while (date('H:i')!=$timestamp) {
                        $heartbeat = 0;
                        $highbp = 0;
                        $lowbp = 0;
                        $query = "insert into ".$tablename." values('".$date."','".$timestamp."','".$heartbeat."','".$highbp."','".$lowbp."') ";
                        if(mysqli_query($conn, $query)){
                            $count++;
                        }
                        $timestamp = date('H:i', strtotime('+1 minutes ', strtotime($timestamp)));

                    }
                echo $count."rows inserted successfully";
            }
            

        ?>

</body>
</html>