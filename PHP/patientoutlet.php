<!doctype html>
<html lang="en">
 
<head>
    <title>E-Heart</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="../assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/libs/css/style.css">
    <link rel="stylesheet" href="../assets/libs/css/patientoutlet.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script type="text/javascript">
        history.pushState(null, null, location.href);
        window.onpopstate = function () {
            window.location.href="dashboard.php"
        };
    </script>
</head>

<body>
    <div class="dashboard-main-wrapper">
        <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg bg-white fixed-top">
                <a class="navbar-brand" href="index.html">E-Heart</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-right-top">
                        <li class="nav-item">
                        <?php
                                    session_start();
                                    error_reporting(0);
                                    include('./conn.php');
                                    $doctor = $_SESSION['output'];
                                    if($doctor['tablelink']==''){
                                        header('Location:../index.html');    
                                    }
                                    if($_POST['patientid']!=''){
                                        $query = "select * from ".$doctor['tablelink']." where patientid = '".$_POST['patientid']."'";
                                        $_SESSION['patientid'] = $_POST['patientid'];
                                    }else{
                                        $query = "select * from ".$doctor['tablelink']." where patientid = '".$_SESSION['patientid']."'";
                                    }
                                    $result = mysqli_query($conn, $query);
                                    
                                    $row = mysqli_fetch_assoc($result);
                                    $_SESSION['data'] = $row;
                                    $date = $_POST['date'];
                                    if($date==''){
                                        $date = date('d-m-y');
                                    }
                                    ?>
                            <div class="dropdown">
                                <form method="POST" action="patientoutlet.php">
                                    <button class="btn btn-primary dropdown-toggle" style="margin: 10px 20px 0px 0px;" type="button" data-toggle="dropdown"><?php echo $date; ?>
                                    <span class="caret"></span></button>
                                        <ul class="dropdown-menu">
                                            <?php
                                                $datequery = "select distinct date from ".$row['tablelink']."";
                                                $dateresult = mysqli_query($conn, $datequery);
                                                while($listdate=mysqli_fetch_assoc($dateresult)){
                                                    echo '<li><input class="btn btn-primary" style="width:160px;" type="submit" value="'.$listdate['date'].'" name="date"></li>';
                                                }
                                            ?>
                                        </ul>
                                </form>
                            </div>
                        </li>
                        <li class="nav-item dropdown nav-user">
                            <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo $row['imagelink']; ?>" alt="image not supported" class="user-avatar-md rounded-circle"></a>
                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                                <div class="nav-user-info">
                                    <h5 class="mb-0 text-white nav-user-name">
                                    <?php
                                        echo $row['patientid'];
                                    ?></h5>
                                    <span class="status"></span><span class="ml-2">Available</span>
                                </div>
                                <a class="dropdown-item" href="account.php"><i class="fas fa-user mr-2"></i>Account Update</a>
                                </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="nav-left-sidebar sidebar-dark">
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                            <li class="nav-divider">
                                Patient Details
                            </li>
                            <li class="nav-item">
                                <img src="<?php echo $row['imagelink']; ?>" alt="image not supported" style="height:200px;width:200px;object-fit: cover;object-position: center center;border-radius:200px;border:1px solid white;">
                            </li>
                            <li class="nav-item">
                                <?php
                                    echo "Patientid : ".$row['patientid'];
                                ?>
                            </li>
                            <li class="nav-item">
                               <?php
                                    echo "Name : ".$row['name'];
                                ?>
                            </li>
                            <li class="nav-item">
                               <?php
                                    echo "Age : ".$row['age'];
                                ?>
                            </li>
                            <li class="nav-item">
                                <?php
                                    echo "Address : ".$row['address'];
                                ?>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>


        <div class="dashboard-wrapper">
            <div class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content ">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="page-header">
                                <h2 class="pageheader-title">Heart Beat</h2>
                                <p class="pageheader-text">details</p>
                                <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
            </div>
            <div class="ecommerce-widget">
                    
                    <div class="row">
                            <div style="height:450px;width:750px;margin-left: 100px;display:flex;flex-direction:row;">
                                <canvas id="myChart"></canvas>
                                <div style="display:flex;flex-direction:column;margin-top:100px;margin-left:60px;">
                                    <img src="../IMAGES/heart.gif" style="height:100px;width:100px;">
                                        <h1 style="margin-left:35px;">
                                        <?php
                                            date_default_timezone_set("Asia/kolkata");
                                            $query = "select * from ".$row['tablelink']." where date='".$date."' ORDER BY timestamp DESC LIMIT 1";
                                            $result = mysqli_query($conn, $query);
                                            $result = mysqli_fetch_assoc($result);
                                            if($result['heartbeat']!='')
                                                echo $result['heartbeat'];
                                            else
                                                echo "No Data";
                                        ?>
                                        </h1>
                                </div>
                            </div>
                                <?php
                                    $query = "select * from ".$row['tablelink']." where date='".$date."'";
                                    $result = mysqli_query($conn, $query);
                                ?>
                                <script>
                                    var ctx = document.getElementById('myChart').getContext('2d');
                                    var timestamp = ['watch not weared'
                                        <?php
                                            while($row1 = mysqli_fetch_assoc($result)){
                                                echo ",'".$row1['timestamp']."'";
                                            }
                                        ?>];
                                    var heartbeat = [''
                                        <?php
                                            $query = "select * from ".$row['tablelink']." where date='".$date."'";
                                            $result = mysqli_query($conn, $query);
                                            while($row1 = mysqli_fetch_assoc($result)){
                                                echo ",'".$row1['heartbeat']."'";
                                            }
                                        ?>];
                                    var chart = new Chart(ctx, {
                                        // The type of chart we want to create
                                        type: 'line',
                                    
                                        // The data for our dataset
                                        data: {
                                            labels: timestamp,
                                            datasets: [{
                                                label: 'Heartbeats',
                                                backgroundColor: 'rgba(0, 0, 0, 0.1)',
                                                borderColor: 'rgb(255, 99, 132)',
                                                data: heartbeat
                                            }]
                                        },
                                    
                                        // Configuration options go here
                                        options: {}
                                    });
                                </script>
                        </div>
                    </div>
                </div>
        <div class="dashboard-wrapper">
            <div class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content ">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="page-header">
                                <h2 class="pageheader-title">High Blood Preasure</h2>
                                <p class="pageheader-text">details</p>
                                <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
            </div>
            <div class="ecommerce-widget">

                        <div class="row">
                            <div style="height:450px;width:750px;margin-left: 100px;display:flex;flex-direction:row;">
                                <canvas id="myChart1"></canvas>
                                <div style="display:flex;flex-direction:column;margin-top:100px;margin-left:40px;">
                                    <img src="../IMAGES/bp.gif" style="height:100px;width:160px;">
                                        <h1 style="margin-left:30px;">
                                        <?php
                                            $query = "select * from ".$row['tablelink']." ORDER BY date DESC LIMIT 1";
                                            $result = mysqli_query($conn, $query);
                                            $result = mysqli_fetch_assoc($result);
                                            echo $result['highbp']."/".$result['lowbp'];
                                        ?>
                                        </h1>
                                </div>
                            </div>
                                <?php
                                    $query = "select * from ".$row['tablelink']." where date='".$date."'";
                                    $result = mysqli_query($conn, $query);
                                ?>
                                <script>
                                    var ctx = document.getElementById('myChart1').getContext('2d');
                                    var timestamp = ['watch not weared'
                                        <?php
                                            while($row1 = mysqli_fetch_assoc($result)){
                                                echo ",'".$row1['timestamp']."'";
                                            }
                                        ?>];
                                    var heartbeat = [''
                                        <?php
                                            $query = "select * from ".$row['tablelink']." where date='".$date."'";
                                            $result = mysqli_query($conn, $query);
                                            while($row1 = mysqli_fetch_assoc($result)){
                                                echo ",'".$row1['highbp']."'";
                                            }
                                        ?>];
                                    var chart = new Chart(ctx, {
                                        // The type of chart we want to create
                                        type: 'line',
                                    
                                        // The data for our dataset
                                        data: {
                                            labels: timestamp,
                                            datasets: [{
                                                label: 'HighBP',
                                                backgroundColor: 'rgba(0, 0, 0, 0.1)',
                                                borderColor: 'blue',
                                                data: heartbeat
                                            }]
                                        },
                                    
                                        // Configuration options go here
                                        options: {}
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                    
                    <div class="dashboard-wrapper">
            <div class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content ">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="page-header">
                                <h2 class="pageheader-title">Low Blood Preasure</h2>
                                <p class="pageheader-text">details</p>
                                <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
            </div>
            <div class="ecommerce-widget">

                    <div class="row">
                            <div style="height:400px;width:750px;margin-left: 100px;display:flex;flex-direction:row;">
                                <canvas id="myChart2"></canvas>
                            </div>
                                <?php
                                    $query = "select * from ".$row['tablelink']." where date='".$date."'";
                                    $result = mysqli_query($conn, $query);
                                ?>
                                <script>
                                    var ctx = document.getElementById('myChart2').getContext('2d');
                                    var timestamp = ['watch not weared'
                                        <?php
                                            while($row1 = mysqli_fetch_assoc($result)){
                                                echo ",'".$row1['timestamp']."'";
                                            }
                                        ?>];
                                    var heartbeat = [''
                                        <?php
                                            $query = "select * from ".$row['tablelink']." where date='".$date."'";
                                            $result = mysqli_query($conn, $query);
                                            while($row1 = mysqli_fetch_assoc($result)){
                                                echo ",'".$row1['lowbp']."'";
                                            }
                                        ?>];
                                    var chart = new Chart(ctx, {
                                        // The type of chart we want to create
                                        type: 'line',
                                    
                                        // The data for our dataset
                                        data: {
                                            labels: timestamp,
                                            datasets: [{
                                                label: 'LowBP',
                                                backgroundColor: 'rgba(0, 0, 0, 0.1)',
                                                borderColor: 'green',
                                                data: heartbeat
                                            }]
                                        },
                                    
                                        // Configuration options go here
                                        options: {}
                                    });
                                </script>
                    </div>
              </div>
        </div>
        
    </div>
    
    <script src="../assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="../assets/vendor/slimscroll/jquery.slimscroll.js"></script>
</body>
 
</html>