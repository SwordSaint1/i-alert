<?php
    $servername = 'localhost';
    $username = 'root';
    $pass = 'trspassword2022';
    date_default_timezone_set('Asia/Manila');
    $server_date_time = date('Y-m-d H:i:s');
    $server_date_only = date('Y-m-d');
    $server_month = date('Y-m-01');
    $server_date_month_time = date('Y-m-01 H:i:s');
    $server_time = date('H:i:s');

    try {
        $conn = new PDO ("mysql:host=$servername;dbname=ialert",$username,$pass);

  //        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // echo "Connected successfully";
  
    }catch(PDOException $e){
        echo 'NO CONNECTION'.$e->getMessage();
    }
?>