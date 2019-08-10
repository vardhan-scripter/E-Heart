<!doctype html>
<html lang="en">
 
<head>
    <title>Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="../assets/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/libs/css/style.css">
    <link rel="stylesheet" href="../assets/libs/css/dashboard.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
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
                            <div id="custom-search" class="top-search-bar">
                                <a name="newuser" id="newuser" class="btn btn-primary" href="../HTML/addpatient.html" role="button">+AddNewPatient</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown nav-user">
                            <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../assets/images/avatar-1.jpg" alt="" class="user-avatar-md rounded-circle"></a>
                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                                <div class="nav-user-info">
                                    <h5 class="mb-0 text-white nav-user-name">
                                        <?php
                                            session_start();
                                            include('./conn.php');
                                            $output = $_SESSION['output'];
                                            if($output['doctorid']==''){
                                                header('Location:../index.html');    
                                            }
                                            echo $output['doctorid'];

                                        ?>
                                    </h5>
                                    <span class="status"></span><span class="ml-2">Available</span>
                                </div>
                                <a class="dropdown-item" href="#"><i class="fas fa-user mr-2"></i>Account</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-cog mr-2"></i>Setting</a>
                                <a class="dropdown-item" href="logout.php"><i class="fas fa-power-off mr-2"></i>Logout</a>
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
                    <form method="POST" action="patientoutlet.php">
                        <ul class="navbar-nav flex-column">
                            <li class="nav-divider">
                                Patient's List
                            </li>
                            <?php
                                    $query = "select * from ".$output['tablelink']."";

                                    $result = mysqli_query($conn, $query);
                                    while($row = mysqli_fetch_assoc($result)){
                                        echo '<li class="nav-item">
                                        <a class="nav-link" href="#">
                                        <i class="fa fa-fw fa-rocket"></i>
                                        <input type="submit" name="patientid" value="'.$row['patientid'].'">
                                        </a>
                                        </li>';
                                    }

                            ?>
                                
                        </ul>
                    </form>
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
                                <h2 class="pageheader-title"><?php echo $output['doctorid']; ?>'s Stats</h2>
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
                            <div style="height:400px;width:700px;margin-left: 100px;display:flex;flex-direction:row;">
                                <canvas id="myChart"></canvas>
                            </div>
                                <?php
                                    $query = "select * from ".$row['tablelink']."";
                                    $result = mysqli_query($conn, $query);
                                ?>
                                <script>
                                    var ctx = document.getElementById('myChart').getContext('2d');
                                    var timestamp = ['jan','feb','mar','apr','may','jun','july','aug','sep','oct','nov','dec'];
                                    var patientcount = ['0','1','6','3','0','5','6','2','8','9','5','4'];
                                    var chart = new Chart(ctx, {
                                        // The type of chart we want to create
                                        type: 'line',
                                    
                                        // The data for our dataset
                                        data: {
                                            labels: timestamp,
                                            datasets: [{
                                                label: 'Patient Count',
                                                backgroundColor: 'rgba(0, 0, 0, 0.1)',
                                                borderColor: 'seagreen',
                                                data: patientcount
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
        
    </div>
    
    <script src="../assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="../assets/vendor/slimscroll/jquery.slimscroll.js"></script>
</body>
 
</html>