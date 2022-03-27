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
                    $full_name = $line[1];
                     $employee_num = $line[2];
                      $provider = $line[3];
                      $position = $line[4];
                      $shift = $line[5];
                      $group = $line[6];
                      $carmaker = $line[7];
                      $carmodel = $line[8];
                      $line_n = $line[9];
                      $emprocess = $line[10];
                      $audit_findings = $line[11];
                      $audited_by = $line[12];
                      $audited_categ = $line[13];
                      $audit_type = $line[14];
                      $remark = $line[15];
                      $section = $line[16];
                    // || $line[17] == ''
                    // CHECK IF BLANK DATA
                    if($line[0] == '' || $line[1] == '' || $line[2] == '' || $line[3] == '' || $line[4] == '' || $line[5] == '' || $line[6] == '' || $line[7] == '' || $line[8] == '' || $line[9] == '' || $line[10] == ''  || $line[11] == '' || $line[12] == '' || $line[13] == '' || $line[14] == ''  || $line[15] == '' || $line[16] == '' ){
                        // IF BLANK DETECTED ERROR += 1
                        $error = $error + 1;
                    }else{
                        $insert = "INSERT INTO ialert_audit (`batch`,`date_audited`,`full_name`,`employee_num`,`provider`,`position`,`shift`,`groups`,`car_maker`,`car_model`,`line_no`,`process`,`audit_findings`,`audited_by`,`audited_categ`,`audit_type`,`remarks`,`date_created`,`section`) VALUES ('$ac','$date_audited','$full_name','$employee_num','$provider','$position','$shift','$group','$carmaker','$carmodel','$line_n','$emprocess','$audit_findings','$audited_by','$audited_categ','$audit_type','$remark','$server_date_only','$section')";
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