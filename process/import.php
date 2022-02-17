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
                    $batch = $line[0];
                    $date_audited = $line[1];
                    $full_name = $line[2];
                     $employee_num = $line[3];
                      $provider = $line[4];
                      $position = $line[5];
                      $shift = $line[6];
                      $group = $line[7];
                      $carmaker = $line[8];
                      $carmodel = $line[9];
                      $line_n = $line[10];
                      $emprocess = $line[11];
                      $audit_findings = $line[12];
                      $audited_by = $line[13];
                      $audited_categ = $line[14];
                      $audit_type = $line[15];
                      $remark = $line[16];
                      $date_created = $line[17];
                    // $qrcode = $line[3];
                    // CHECK IF BLANK DATA
                    if($line[0] == '' || $line[1] == '' || $line[2] == '' || $line[3] == '' || $line[4] == '' || $line[5] == '' || $line[6] == '' || $line[7] == '' || $line[8] == '' || $line[9] == '' || $line[10] == '' || $line[11] == '' || $line[12] == '' || $line[13] == '' || $line[14] == '' || $line[15] == '' || $line[16] == '' || $line[17] == '' ){
                        // IF BLANK DETECTED ERROR += 1
                        $error = $error + 1;
                    }else{
                        $insert = "INSERT INTO ialert_audit (`batch`,`date_audited`,`full_name`,`employee_num`,`provider`,`position`,`shift`,`group`,`car_maker`,`car_model`,`line_no`,`process`,`audit_findings`,`audited_by`,`audited_categ`,`audit_type`,`remarks`,`date_created`) VALUES ('$batch','$date_audited','$full_name','$employee_num','$provider','$position','$shift','$group','$carmaker','$carmodel','$line_n','$emprocess','$audit_findings','$audited_by','$audited_categ','$audit_type','$remark', '$server_date_only')";
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
                        location.replace("../page/admin/add_audit.php");
                    }else{
                        location.replace("../page/admin/add_audit.php");
                    }
                </script>'; 
               }else{
                    echo '<script>
                    var x = confirm("WITH ERROR! # OF ERRORS '.$error.' ");
                    if(x == true){
                        location.replace("../page/admin/add_audit.php");
                    }else{
                        location.replace("../page/admin/add_audit.php");
                    }
                </script>'; 
               }
            }else{
                echo '<script>
                        var x = confirm("CSV FILE NOT UPLOADED! # OF ERRORS '.$error.' ");
                        if(x == true){
                            location.replace("../page/admin/add_audit.php");
                        }else{
                            location.replace("../page/admin/add_audit.php");
                        }
                    </script>';
            }
        }else{
            echo '<script>
                        var x = confirm("INVALID FILE FORMAT! # OF ERRORS '.$error.' ");
                        if(x == true){
                            location.replace("../page/admin/add_audit.php");
                        }else{
                            location.replace("../page/admin/add_audit.php");
                        }
                    </script>';
        }
        
    
    // KILL CONNECTION
    $conn = null;
?>