<?php
    date_default_timezone_set("Asia/kolkata");
    echo date('d-m-y', strtotime('+1 day', strtotime(date('H:i'))));
?>