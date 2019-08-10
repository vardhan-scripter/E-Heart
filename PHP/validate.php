<?php
    include('./conn.php');
    session_start();
    $userid = test_input($_POST['userid']);

    $pass = test_input($_POST['password']);

    if (isset($userid) && isset($pass)) {
        $query = "select * from doctors where doctorid = '".$userid."' and dpass = '".$pass."'";
        $output = mysqli_query($conn, $query);

        $output = mysqli_fetch_array($output);

        if ($output['doctorid'] == $userid) {
            $_SESSION['output'] = $output;
            header('Location:dashboard.php');
        }else{
            echo " your not authorised to use this website";
        }
    }


    function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
    }
?>