<?php
    // error_reporting(0);
    require 'conn.php';
    if(isset($_POST['upload'])){
        $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
        
        if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$csvMimes)){
            if(is_uploaded_file($_FILES['file']['tmp_name'])){
                //READ FILE
                $csvFile = fopen($_FILES['file']['tmp_name'],'r');
                // SKIP FIRST LINE
                fgetcsv($csvFile);
                // PARSE
                $error = 0;
                while(($line = fgetcsv($csvFile)) !== false){
                    $line_no = $line[0];
                    
                    // $qrcode = $line[3];
                    // CHECK IF BLANK DATA
                    if($line[0] == '' ){
                        // IF BLANK DETECTED ERROR += 1
                        $error = $error + 1;
                    }else{
                    $insert = "INSERT INTO ialert_lines (`line_no`) VALUES ('$line_no')";
                        $stmt = $conn->prepare($insert);
                        if($stmt->execute()){
                            $error = 0;
                        }else{
                            $error = $error + 1;
                        }
                    }
                    }
                }
                
                fclose($csvFile);
               if($error == 0){
                    echo '<script>
                    var x = confirm("SUCCESS! # OF ERRORS '.$error.' ");
                    if(x == true){
                        location.replace("../page/admin/add_line_audit.php");
                    }else{
                        location.replace("../page/admin/add_line_audit.php");
                    }
                </script>'; 
               }else{
                    echo '<script>
                    var x = confirm("WITH ERROR! # OF ERRORS '.$error.' ");
                    if(x == true){
                        location.replace("../page/admin/add_line_audit.php");
                    }else{
                        location.replace("../page/admin/add_line_audit.php");
                    }
                </script>'; 
               }
            }else{
                echo '<script>
                        var x = confirm("CSV FILE NOT UPLOADED! # OF ERRORS '.$error.' ");
                        if(x == true){
                            location.replace("../page/admin/add_line_audit.php");
                        }else{
                            location.replace("../page/admin/add_line_audit.php");
                        }
                    </script>';
            }
        }else{
            echo '<script>
                        var x = confirm("INVALID FILE FORMAT! # OF ERRORS '.$error.' ");
                        if(x == true){
                            location.replace("../page/admin/add_line_audit.php");
                        }else{
                            location.replace("../page/admin/add_line_audit.php");
                        }
                    </script>';
        }
        
    
    // KILL CONNECTION
    $conn = null;
?>