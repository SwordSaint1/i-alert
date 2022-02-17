<?php 
	include 'conn.php';
	include 'conn2.php';

//requestor  
	$method = $_POST['method'];

if($method == 'AuditCode'){
		$prefix = "AC:";
		$dateCode = date('ymd');
		$randomCode = mt_rand(10000,50000);
		echo $prefix."".$dateCode."".$randomCode;
	}

if($method == 'fetch_details_req'){
        $employee_num = trim($_POST['employee_num']);
        // CHECK
        $sql = "SELECT idNumber, empName, empPosition, empAgency, lineNo FROM a_m_employee WHERE idNumber = '$employee_num'";
        $stmt = $conn2->prepare($sql);
        $stmt->execute();
        if($stmt->rowCount() > 0){
        	foreach($stmt->fetchALL() as $x){
            echo $x['empName'].'~!~'.$x['empPosition'].'~!~'.$x['empAgency'].'~!~'.$x['lineNo'];
        }
    }else{
    	echo '';
    }
    }

   
if ($method == 'insert_audit') {

	$employee_num = trim($_POST['employee_num']);
	$full_name = $_POST['full_name'];
	$position = $_POST['position'];
	$provider = $_POST['provider'];
	$shift = $_POST['shift'];
	$group = $_POST['group'];
	$date_audited = $_POST['date_audited'];
	$carmaker = $_POST['carmaker'];
	$carmodel = $_POST['carmodel'];
	$emline = $_POST['emline'];
	$emprocess = $_POST['emprocess'];
	$audit_findings = $_POST['audit_findings'];
	$audited_by = $_POST['audited_by'];
	$audit_type = $_POST['audit_type'];
	$audit_categ = $_POST['audit_categ'];
	$remarks = $_POST['remarks'];
	$esection = $_POST['esection'];
	$username = $_POST['username'];
	$audit_code = trim($_POST['audit_code']);

// $check = "SELECT id FROM ialert_audit WHERE employee_num = '$employee_num' AND ft_status != '0' ";
 

// 	$stmt = $conn->prepare($check);
// 	$stmt->execute();
// 	if ($stmt->rowCount() > 0) {

// 		// echo 'Already have Training Request!';
// 		echo 'Already Have Audit Data';
	
// 	}else{
		$insert = "INSERT INTO ialert_audit (`batch`, `date_audited`, `full_name`,`employee_num`,`provider`,`position`,`shift`,`group`,`car_maker`,`car_model`,`line_no`,`process`,`audit_findings`,`audited_by`,`audited_categ`,`audit_type`,`remarks`,`pd`,`hr`,`agency`,`date_created`) VALUES('$audit_code', '$date_audited','$full_name','$employee_num','$provider','$position','$shift','$group','$carmaker','$carmodel','$emline','$emprocess','$audit_findings','$audited_by','$audit_categ','$audit_type','$remarks',NULL,NULL,NULL,'$server_date_time')";
		$stmt= $conn->prepare($insert);
		if ($stmt->execute()) {

			echo 'Successfully Saved';
		
		}else{
			
			echo 'Error';
		
		}
	// }

}

if ($method == 'prev_audit') {
	$c =0;
	$audit_code = trim($_POST['audit_code']);
	$query = "SELECT * FROM ialert_audit WHERE batch LIKE '$audit_code%' ORDER BY id ASC";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	foreach($stmt->fetchALL() as $x){
		$c++;
		echo '<tr>';

		echo '<td>'.$c.'</td>';
		echo '<td>'.$x['date_audited'].'</td>';
		echo '<td>'.$x['full_name'].'</td>';
		echo '<td>'.$x['employee_num'].'</td>';
		echo '<td>'.$x['provider'].'</td>';
		echo '<td>'.$x['position'].'</td>';
		echo '<td>'.$x['shift'].'</td>';
		echo '<td>'.$x['group'].'</td>';			
		echo '<td>'.$x['car_maker'].'</td>';
		echo '<td>'.$x['car_model'].'</td>';
		echo '<td>'.$x['line_no'].'</td>';
		echo '<td>'.$x['process'].'</td>';	
		echo '<td>'.$x['audit_findings'].'</td>';
		echo '<td>'.$x['audited_by'].'</td>';	
		echo '<td>'.$x['audited_categ'].'</td>';
		echo '<td>'.$x['remarks'].'</td>';			
		echo '</tr>';
	}
}

  if ($method == 'fetch_audit_list') {
  		$dateFrom = $_POST['dateFrom'];
        $dateTo = $_POST['dateTo'];
        $empid =$_POST['empid'];
		$fname =$_POST['fname'];
		$line = $_POST['line'];
        $c = 0;

    $query = "SELECT * FROM ialert_audit
    WHERE  employee_num LIKE '$empid%' AND full_name LIKE '$fname%' AND line_no LIKE '$line%' AND (date_audited >='$dateFrom' AND date_audited <= '$dateTo') 
     GROUP BY id ORDER BY date_audited ASC";



    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        foreach($stmt->fetchALL() as $x){
        $c++;

           
                echo '<tr">';
                echo '<td>'.$c.'</td>';
                echo '<td style="display: none;">'.$x['batch'].'</td>';
                echo '<td>'.$x['date_audited'].'</td>';
                 echo '<td>'.$x['full_name'].'</td>';
                echo '<td>'.$x['employee_num'].'</td>';
                echo '<td>'.$x['provider'].'</td>';
                echo '<td>'.$x['group'].'</td>';
                echo '<td>'.$x['car_maker'].'</td>';
                echo '<td>'.$x['car_model'].'</td>';
                echo '<td>'.$x['line_no'].'</td>';
                echo '<td>'.$x['process'].'</td>';
                 echo '<td>'.$x['audit_findings'].'</td>';
                  echo '<td>'.$x['audited_by'].'</td>';
                  echo '<td>'.$x['audited_categ'].'</td>';
                   echo '<td>'.$x['remarks'].'</td>';
                   echo '<td>'.$x['pd'].'</td>';
                    echo '<td>'.$x['agency'].'</td>';
                     echo '<td>'.$x['hr'].'</td>';
                      

  
                echo '</tr>';
          
    }
}else{
        echo '<tr>';
            echo '<td colspan="14" style="text-align:center;">NO RESULT</td>';
            echo '</tr>';
            }
    }



// LINE AUDIT

if($method == 'LineAuditCode'){
		$prefix = "LAC:";
		$dateCode = date('ymd');
		$randomCode = mt_rand(10000,50000);
		echo $prefix."".$dateCode."".$randomCode;
	}


if ($method == 'insert_line_audit') {

	
	$shift = $_POST['shift'];
	$group = $_POST['group'];
	$date_audited = $_POST['date_audited'];
	$carmaker = $_POST['carmaker'];
	$carmodel = $_POST['carmodel'];
	$emline = $_POST['emline'];
	$emprocess = $_POST['emprocess'];
	$audit_findings = $_POST['audit_findings'];
	$audited_by = $_POST['audited_by'];
	$audit_type = $_POST['audit_type'];
	$audit_categ = $_POST['audit_categ'];
	$remarks = $_POST['remarks'];
	$esection = $_POST['esection'];
	$username = $_POST['username'];
	$audit_code = trim($_POST['audit_code']);

// $check = "SELECT id FROM ialert_line_audit WHERE line_no = '$emline' AND process = '$emprocess'";
 	

// 	$stmt = $conn->prepare($check);
// 	$stmt->execute();
// 	if ($stmt->rowCount() > 0) {

// 		echo 'Already Have Line Audit Data';
	
// 	}else{
		$insert = "INSERT INTO ialert_line_audit (`batch`, `date_audited`,`shift`,`group`,`car_maker`,`car_model`,`line_no`,`process`,`audit_findings`,`audited_by`,`audited_categ`,`audit_type`,`remarks`,`date_created`) VALUES('$audit_code', '$date_audited','$shift','$group','$carmaker','$carmodel','$emline','$emprocess','$audit_findings','$audited_by','$audit_categ','$audit_type','$remarks','$server_date_time')";
		$stmt= $conn->prepare($insert);
		if ($stmt->execute()) {

			echo 'Successfully Saved';
		
		}else{
			
			echo 'Error';
		
		}
	// }

}


if ($method == 'prev_line_audit') {
	$c =0;
	$audit_code = trim($_POST['audit_code']);
	$query = "SELECT * FROM ialert_line_audit WHERE batch LIKE '$audit_code%' ORDER BY id ASC";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	foreach($stmt->fetchALL() as $x){
		$c++;
		echo '<tr>';

		echo '<td>'.$c.'</td>';
		echo '<td>'.$x['date_audited'].'</td>';
		echo '<td>'.$x['shift'].'</td>';
		echo '<td>'.$x['group'].'</td>';			
		echo '<td>'.$x['car_maker'].'</td>';
		echo '<td>'.$x['car_model'].'</td>';
		echo '<td>'.$x['line_no'].'</td>';
		echo '<td>'.$x['process'].'</td>';	
		echo '<td>'.$x['audit_findings'].'</td>';
		echo '<td>'.$x['audited_by'].'</td>';	
		echo '<td>'.$x['audited_categ'].'</td>';
		echo '<td>'.$x['audit_type'].'</td>';
		echo '<td>'.$x['remarks'].'</td>';			
		echo '</tr>';
	}
}


 if ($method == 'fetch_line_audit_list') {
  		$dateFrom = $_POST['dateFrom'];
        $dateTo = $_POST['dateTo'];
        $line_n = $_POST['line_n'];
        $c = 0;


     $query ="SELECT * FROM ialert_line_audit
    WHERE  line_no LIKE '$line_n%' AND (date_audited >='$dateFrom' AND date_audited <= '$dateTo') 
     GROUP BY id ORDER BY date_audited ASC";

    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        foreach($stmt->fetchALL() as $x){
        $c++;

           
                echo '<tr">';
                echo '<td>'.$c.'</td>';
                echo '<td style="display: none;">'.$x['batch'].'</td>';
                echo '<td>'.$x['date_audited'].'</td>';
                echo '<td>'.$x['shift'].'</td>';
                echo '<td>'.$x['group'].'</td>';
                echo '<td>'.$x['car_maker'].'</td>';
                echo '<td>'.$x['car_model'].'</td>';
                echo '<td>'.$x['line_no'].'</td>';
                echo '<td>'.$x['process'].'</td>';
                 echo '<td>'.$x['audit_findings'].'</td>';
                  echo '<td>'.$x['audited_by'].'</td>';
                  echo '<td>'.$x['audited_categ'].'</td>';
                  echo '<td>'.$x['audit_type'].'</td>';
                   echo '<td>'.$x['remarks'].'</td>';
                   

  
                echo '</tr>';
          
    }
}else{
        echo '<tr>';
            echo '<td colspan="14" style="text-align:center;">NO RESULT</td>';
            echo '</tr>';
            }
    }



if ($method == 'count_kana') {
	$employee_num_count = $_POST['employee_num_count'];
    $full_name_count = $_POST['full_name_count'];
	$count = "SELECT count(*) as total FROM ialert_audit WHERE employee_num = '$employee_num_count'
	OR full_name = '$full_name_count'";
	$stmt = $conn->prepare($count);
	$stmt->execute();
	foreach($stmt->fetchALL() as $x){

		echo '<tr>';

		echo '<td>'.$x['total'].'</td>';
				
		echo '</tr>';
	}
}

?>