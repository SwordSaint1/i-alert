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
                    // $batch = $line[0];
                     $date_audited = $line[0];
                      $shift = $line[1];
                      $group = $line[2];
                      $carmaker = $line[3];
                      $carmodel = $line[4];
                      $line_n = $line[5];
                      $emprocess = $line[6];
                      $audit_findings = $line[7];
                      $audited_by = $line[8];
                      $audited_categ = $line[9];
                      $audit_type = $line[10];
                      $remark = $line[11];
                      // $date_created = $line[13];
                    // $qrcode = $line[3];
                    // CHECK IF BLANK DATA
                    if($line[0] == '' || $line[1] == '' || $line[2] == '' || $line[3] == '' || $line[4] == '' || $line[5] == '' || $line[6] == '' || $line[7] == ''){
                        // IF BLANK DETECTED ERROR += 1
                        $error = $error + 1;
                    }else{
                        $insert = "INSERT INTO ialert_line_audit (`batch`,`date_audited`,`shift`,`groups`,`car_maker`,`car_model`,`line_no`,`process`,`audit_findings`,`audited_by`,`audited_categ`,`audit_type`,`remarks`,`date_created`) VALUES ('$lc','$date_audited','$shift','$group','$carmaker','$carmodel','$line_n','$emprocess','$audit_findings','$audited_by','$audited_categ','$audit_type','$remark','$server_date_only')";
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