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
	$section = $_POST['section'];

// $check = "SELECT id FROM ialert_audit WHERE employee_num = '$employee_num' AND ft_status != '0' ";
 

// 	$stmt = $conn->prepare($check);
// 	$stmt->execute();
// 	if ($stmt->rowCount() > 0) {

// 		// echo 'Already have Training Request!';
// 		echo 'Already Have Audit Data';
	
// 	}else{
		$insert = "INSERT INTO ialert_audit (`batch`, `date_audited`, `full_name`,`employee_num`,`provider`,`position`,`shift`,`groups`,`car_maker`,`car_model`,`line_no`,`process`,`audit_findings`,`audited_by`,`audited_categ`,`audit_type`,`remarks`,`pd`,`hr`,`agency`,`date_created`,`section`) VALUES('$audit_code', '$date_audited','$full_name','$employee_num','$provider','$position','$shift','$group','$carmaker','$carmodel','$emline','$emprocess','$audit_findings','$audited_by','$audit_categ','$audit_type','$remarks',NULL,NULL,NULL,'$server_date_time','$section')";
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
		echo '<td>'.$x['groups'].'</td>';			
		echo '<td>'.$x['car_maker'].'</td>';
		echo '<td>'.$x['car_model'].'</td>';
		echo '<td>'.$x['line_no'].'</td>';
		echo '<td>'.$x['process'].'</td>';	
		echo '<td>'.$x['audit_findings'].'</td>';
		echo '<td>'.$x['audited_by'].'</td>';	
		echo '<td>'.$x['audited_categ'].'</td>';
		echo '<td>'.$x['remarks'].'</td>';	
		echo '<td>'.$x['section'].'</td>';			
		echo '</tr>';
	}
}

  if ($method == 'fetch_audit_list') {
  		$dateFrom = $_POST['dateFrom'];
        $dateTo = $_POST['dateTo'];
        $empid =$_POST['empid'];
		$fname =$_POST['fname'];
		$line = $_POST['line'];
		$carmaker = $_POST['carmaker'];
		$carmodel = $_POST['carmodel'];
		$position = $_POST['position'];
        $c = 0;

    $query = "SELECT * FROM ialert_audit
    WHERE  employee_num LIKE '$empid%' AND full_name LIKE '$fname%' AND car_maker LIKE '$carmaker%' AND car_model LIKE '$carmodel%' AND line_no LIKE '$line%' AND position LIKE '$position%' AND (date_audited >='$dateFrom' AND date_audited <= '$dateTo') 
     GROUP BY id ORDER BY date_audited ASC";



    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        foreach($stmt->fetchALL() as $x){
        $c++;
        $date_audited = $x['date_audited'];
        $pd = $x['pd'];
        $agency = $x['agency'];
        $days_notif = date("Y-m-d", strtotime('+4 day',strtotime($date_audited)));

           
               
        if ($pd == '' && $agency == '' && $server_date_only >= $days_notif) {
        	  echo '<tr style="color:red;">'; 
                   echo '<td>';
                echo '<p>
                        <label>
                            <input type="checkbox" name="" id="" class="singleCheck" value="'.$x['id'].'">
                            <span></span>
                        </label>
                    </p>';
                echo '</td>';
                echo '<td>'.$c.'</td>';
                echo '<td style="display: none;">'.$x['batch'].'</td>';
                echo '<td>'.$x['date_audited'].'</td>';
                 echo '<td  style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#update" onclick="get_set(&quot;'.$x['id'].'~!~'.$x['employee_num'].'~!~'.$x['full_name'].'~!~'.$x['position'].'~!~'.$x['provider'].'~!~'.$x['shift'].'~!~'.$x['groups'].'~!~'.$x['audit_type'].'~!~'.$x['audited_categ'].'~!~'.$x['car_maker'].'~!~'.$x['car_model'].'~!~'.$x['line_no'].'~!~'.$x['process'].'~!~'.$x['audit_findings'].'~!~'.$x['audited_by'].'~!~'.$x['date_audited'].'~!~'.$x['remarks'].'&quot;)">'.$x['full_name'].'</td>';
                 echo '<td>'.$x['position'].'</td>';
                echo '<td>'.$x['employee_num'].'</td>';
                echo '<td>'.$x['provider'].'</td>';
                echo '<td>'.$x['groups'].'</td>';
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

        }else{
        	  echo '<tr>'; 
                   echo '<td>';
                echo '<p>
                        <label>
                            <input type="checkbox" name="" id="" class="singleCheck" value="'.$x['id'].'">
                            <span></span>
                        </label>
                    </p>';
                echo '</td>';
                echo '<td>'.$c.'</td>';
                echo '<td style="display: none;">'.$x['batch'].'</td>';
                echo '<td>'.$x['date_audited'].'</td>';
                 echo '<td  style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#update" onclick="get_set(&quot;'.$x['id'].'~!~'.$x['employee_num'].'~!~'.$x['full_name'].'~!~'.$x['position'].'~!~'.$x['provider'].'~!~'.$x['shift'].'~!~'.$x['groups'].'~!~'.$x['audit_type'].'~!~'.$x['audited_categ'].'~!~'.$x['car_maker'].'~!~'.$x['car_model'].'~!~'.$x['line_no'].'~!~'.$x['process'].'~!~'.$x['audit_findings'].'~!~'.$x['audited_by'].'~!~'.$x['date_audited'].'~!~'.$x['remarks'].'&quot;)">'.$x['full_name'].'</td>';
                 echo '<td>'.$x['position'].'</td>';
                echo '<td>'.$x['employee_num'].'</td>';
                echo '<td>'.$x['provider'].'</td>';
                echo '<td>'.$x['groups'].'</td>';
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
		$insert = "INSERT INTO ialert_line_audit (`batch`, `date_audited`,`shift`,`groups`,`car_maker`,`car_model`,`line_no`,`process`,`audit_findings`,`audited_by`,`audited_categ`,`audit_type`,`remarks`,`date_created`) VALUES('$audit_code', '$date_audited','$shift','$group','$carmaker','$carmodel','$emline','$emprocess','$audit_findings','$audited_by','$audit_categ','$audit_type','$remarks','$server_date_time')";
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
		echo '<td>'.$x['groups'].'</td>';			
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
        $carmaker = $_POST['carmaker'];
        $carmodel = $_POST['carmodel'];
        $c = 0;


     $query ="SELECT * FROM ialert_line_audit
    WHERE  line_no LIKE '$line_n%' AND car_model LIKE '$carmodel%' AND car_maker LIKE '$carmaker%' AND (date_audited >='$dateFrom' AND date_audited <= '$dateTo') 
     GROUP BY id ORDER BY date_audited ASC";

    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        foreach($stmt->fetchALL() as $x){
        $c++;

           
                 echo '<tr>';
                   echo '<td>';
                echo '<p>
                        <label>
                            <input type="checkbox" name="" id="" class="singleCheck" value="'.$x['id'].'">
                            <span></span>
                        </label>
                    </p>';
                echo '</td>';
                echo '<td >'.$c.'</td>';
                echo '<td style="display: none;">'.$x['batch'].'</td>';
                echo '<td>'.$x['date_audited'].'</td>';
                echo '<td>'.$x['shift'].'</td>';
                echo '<td>'.$x['groups'].'</td>';
                echo '<td>'.$x['car_maker'].'</td>';
                echo '<td>'.$x['car_model'].'</td>';
                echo '<td>'.$x['line_no'].'</td>';
                echo '<td>'.$x['process'].'</td>';
                 echo '<td style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#updateline" onclick="get_set_line(&quot;'.$x['id'].'~!~'.$x['shift'].'~!~'.$x['groups'].'~!~'.$x['date_audited'].'~!~'.$x['car_maker'].'~!~'.$x['car_model'].'~!~'.$x['line_no'].'~!~'.$x['process'].'~!~'.$x['audit_findings'].'~!~'.$x['audited_by'].'~!~'.$x['audited_categ'].'~!~'.$x['remarks'].'~!~'.$x['audit_type'].'&quot;)">'.$x['audit_findings'].'</td>';
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


if ($method == 'deleteaudit') {
    $id = [];
    $id = $_POST['id'];
    //COUNT OF ITEM TO BE UPDATED
    $count = count($id);
    foreach($id as $x){
        $update = "DELETE FROM ialert_audit WHERE id = '$x'";
        $stmt = $conn->prepare($update);
        if ($stmt->execute()) {
            // echo 'approved';
            $count = $count - 1;
        }else{
            // echo 'error';
        }
    }
        if($count == 0){
            echo 'success';
        }else{
            echo 'fail';
        }
} 



if ($method == 'deletesec1') {
    $id = [];
    $id = $_POST['id'];
    //COUNT OF ITEM TO BE UPDATED
    $count = count($id);
    foreach($id as $x){
        $update = "DELETE FROM ialert_audit WHERE id = '$x'";
        $stmt = $conn->prepare($update);
        if ($stmt->execute()) {
            // echo 'approved';
            $count = $count - 1;
        }else{
            // echo 'error';
        }
    }
        if($count == 0){
            echo 'success';
        }else{
            echo 'fail';
        }
} 

if ($method == 'deletesec2') {
    $id = [];
    $id = $_POST['id'];
    //COUNT OF ITEM TO BE UPDATED
    $count = count($id);
    foreach($id as $x){
        $update = "DELETE FROM ialert_audit WHERE id = '$x'";
        $stmt = $conn->prepare($update);
        if ($stmt->execute()) {
            // echo 'approved';
            $count = $count - 1;
        }else{
            // echo 'error';
        }
    }
        if($count == 0){
            echo 'success';
        }else{
            echo 'fail';
        }
} 

if ($method == 'deletesec3') {
    $id = [];
    $id = $_POST['id'];
    //COUNT OF ITEM TO BE UPDATED
    $count = count($id);
    foreach($id as $x){
        $update = "DELETE FROM ialert_audit WHERE id = '$x'";
        $stmt = $conn->prepare($update);
        if ($stmt->execute()) {
            // echo 'approved';
            $count = $count - 1;
        }else{
            // echo 'error';
        }
    }
        if($count == 0){
            echo 'success';
        }else{
            echo 'fail';
        }
} 

if ($method == 'deletesec4') {
    $id = [];
    $id = $_POST['id'];
    //COUNT OF ITEM TO BE UPDATED
    $count = count($id);
    foreach($id as $x){
        $update = "DELETE FROM ialert_audit WHERE id = '$x'";
        $stmt = $conn->prepare($update);
        if ($stmt->execute()) {
            // echo 'approved';
            $count = $count - 1;
        }else{
            // echo 'error';
        }
    }
        if($count == 0){
            echo 'success';
        }else{
            echo 'fail';
        }
} 
if ($method == 'deletesec5') {
    $id = [];
    $id = $_POST['id'];
    //COUNT OF ITEM TO BE UPDATED
    $count = count($id);
    foreach($id as $x){
        $update = "DELETE FROM ialert_audit WHERE id = '$x'";
        $stmt = $conn->prepare($update);
        if ($stmt->execute()) {
            // echo 'approved';
            $count = $count - 1;
        }else{
            // echo 'error';
        }
    }
        if($count == 0){
            echo 'success';
        }else{
            echo 'fail';
        }
} 

if ($method == 'deletesec6') {
    $id = [];
    $id = $_POST['id'];
    //COUNT OF ITEM TO BE UPDATED
    $count = count($id);
    foreach($id as $x){
        $update = "DELETE FROM ialert_audit WHERE id = '$x'";
        $stmt = $conn->prepare($update);
        if ($stmt->execute()) {
            // echo 'approved';
            $count = $count - 1;
        }else{
            // echo 'error';
        }
    }
        if($count == 0){
            echo 'success';
        }else{
            echo 'fail';
        }
} 

if ($method == 'deletesec7') {
    $id = [];
    $id = $_POST['id'];
    //COUNT OF ITEM TO BE UPDATED
    $count = count($id);
    foreach($id as $x){
        $update = "DELETE FROM ialert_audit WHERE id = '$x'";
        $stmt = $conn->prepare($update);
        if ($stmt->execute()) {
            // echo 'approved';
            $count = $count - 1;
        }else{
            // echo 'error';
        }
    }
        if($count == 0){
            echo 'success';
        }else{
            echo 'fail';
        }
} 

if ($method == 'deletesec8') {
    $id = [];
    $id = $_POST['id'];
    //COUNT OF ITEM TO BE UPDATED
    $count = count($id);
    foreach($id as $x){
        $update = "DELETE FROM ialert_audit WHERE id = '$x'";
        $stmt = $conn->prepare($update);
        if ($stmt->execute()) {
            // echo 'approved';
            $count = $count - 1;
        }else{
            // echo 'error';
        }
    }
        if($count == 0){
            echo 'success';
        }else{
            echo 'fail';
        }
} 
if ($method == 'updateaudit') {
    $id = $_POST['id'];
    $employee_num = $_POST['employee_num'];
	$full_name = $_POST['full_name'];
	$position = $_POST['position'];
	$provider = $_POST['provider'];
	$shift = $_POST['shift'];
	$groups = $_POST['groups'];
	$audit_type = $_POST['audit_type'];
	$audit_categ = $_POST['audit_categ'];
	$carmaker = $_POST['carmaker'];
	$carmodel = $_POST['carmodel'];
	$emline = $_POST['emline'];
	$process = $_POST['process'];
	$audit_findings = $_POST['audit_findings'];
	$audited_by = $_POST['audited_by'];
	$date_audited = $_POST['date_audited'];
	$remarks = $_POST['remarks'];
    
    $update = "UPDATE ialert_audit SET employee_num = '$employee_num', full_name = '$full_name', position = '$position', provider = '$provider', shift = '$shift', audit_type = '$audit_type', groups = '$groups', audit_type = '$audit_type', audited_categ = '$audit_categ', car_maker = '$carmaker', car_model = '$carmodel', line_no = '$emline', process = '$process',audit_findings = '$audit_findings', audited_by = '$audited_by', date_audited = '$date_audited', remarks = '$remarks', date_updated = '$server_date_only' WHERE id = '$id'";
    $stmt = $conn->prepare($update);
    if ($stmt->execute()) {
    	echo 'success';
    }else{
    	echo 'Error';
    }
   
} 


if ($method == 'deletelineaudit') {
    $id = [];
    $id = $_POST['id'];
    //COUNT OF ITEM TO BE UPDATED
    $count = count($id);
    foreach($id as $x){
        $update = "DELETE FROM ialert_line_audit WHERE id = '$x'";
        $stmt = $conn->prepare($update);
        if ($stmt->execute()) {
            // echo 'approved';
            $count = $count - 1;
        }else{
            // echo 'error';
        }
    }
        if($count == 0){
            echo 'success';
        }else{
            echo 'fail';
        }
} 



if ($method == 'updatelineaudit') {
    $id = $_POST['id'];
	$shift = $_POST['shift'];
	$groups = $_POST['groups'];
	$audit_type = $_POST['audit_type'];
	$audit_categ = $_POST['audit_categ'];
	$carmaker = $_POST['carmaker'];
	$carmodel = $_POST['carmodel'];
	$emline = $_POST['emline'];
	$process = $_POST['process'];
	$audit_findings = $_POST['audit_findings'];
	$audited_by = $_POST['audited_by'];
	$audit_type = $_POST['audit_type'];
	$date_audited = $_POST['date_audited'];
	$remarks = $_POST['remarks'];
    
    $update = "UPDATE ialert_line_audit SET shift = '$shift', audit_type = '$audit_type', groups = '$groups', audit_type = '$audit_type', audited_categ = '$audit_categ', car_maker = '$carmaker', car_model = '$carmodel', line_no = '$emline', process = '$process',audit_findings = '$audit_findings', audited_by = '$audited_by', date_audited = '$date_audited', remarks = '$remarks',audit_type = '$audit_type', date_updated = '$server_date_only' WHERE id = '$id'";
    $stmt = $conn->prepare($update);
    if ($stmt->execute()) {
    	echo 'success';
    }else{
    	echo 'Error';
    }
   
} 
 

if ($method == 'count_for_update') {
	$server_date = $_POST['server_date'];
	$count = "SELECT *,count(*) as total FROM ialert_audit ";
	$stmt = $conn->prepare($count);
	$stmt->execute();
	foreach($stmt->fetchALL() as $x){

		$date_audited = $x['date_audited'];
        $pd = $x['pd'];
        $agency = $x['agency'];
        $days_notif = date("Y-m-d", strtotime('+4 day',strtotime($date_audited)));

        	$count_na = "SELECT COUNT(*) as total FROM ialert_audit WHERE  pd IS NULL AND agency IS NULL";
        	$stmt2 = $conn->prepare($count_na);
        	$stmt2->execute();
        	foreach($stmt2->fetchALL() as $j){
        				echo '<tr>';

		echo '<td ><h3 style="color:red;"><b>'.$j['total'].'</b></h3></td>';
				
		echo '</tr>';
        	}
		 
	}
}

if ($method == 'count_section1') {
	$dateFrom = $_POST['dateFrom'];
	$dateTo = $_POST['dateTo'];
	$count = "SELECT *,count(*) as total FROM ialert_audit ";
	$stmt = $conn->prepare($count);
	$stmt->execute();
	foreach($stmt->fetchALL() as $x){

		$date_audited = $x['date_audited'];
        $pd = $x['pd'];
        $agency = $x['agency'];
        $days_notif = date("Y-m-d", strtotime('+4 day',strtotime($date_audited)));

        	$count_na = "SELECT COUNT(*) as total FROM ialert_audit WHERE  pd IS NULL AND agency IS NULL AND section = 'Section1' AND (date_audited >='$dateFrom' AND date_audited <= '$dateTo') ";
        	$stmt2 = $conn->prepare($count_na);
        	$stmt2->execute();
        	foreach($stmt2->fetchALL() as $j){
        				echo '<tr>';

		echo '<td ><h3 style="color:red;"><b>'.$j['total'].'</b></h3></td>';
				
		echo '</tr>';
        	}
		 
	}
}

if ($method == 'total_sec1') {
	$dateFrom = $_POST['dateFrom'];
	$dateTo = $_POST['dateTo'];
	$count_total = "SELECT count(*) as grand_total from ialert_audit where section = 'Section1' AND (date_audited >='$dateFrom' AND date_audited <= '$dateTo') ";
	$stmt = $conn->prepare($count_total);
	$stmt->execute();

	foreach($stmt->fetchALL() as $x){
		echo '<tr>';

		echo '<td ><h3><b>'.$x['grand_total'].'</b></h3></td>';
				
		echo '</tr>';
	}
}



if ($method == 'count_section2') {
	$dateFrom = $_POST['dateFrom'];
	$dateTo = $_POST['dateTo'];
	$count = "SELECT *,count(*) as total FROM ialert_audit ";
	$stmt = $conn->prepare($count);
	$stmt->execute();
	foreach($stmt->fetchALL() as $x){

		$date_audited = $x['date_audited'];
        $pd = $x['pd'];
        $agency = $x['agency'];
        $days_notif = date("Y-m-d", strtotime('+4 day',strtotime($date_audited)));

        	$count_na = "SELECT COUNT(*) as total FROM ialert_audit WHERE  pd IS NULL AND agency IS NULL AND section = 'Section2' AND (date_audited >='$dateFrom' AND date_audited <= '$dateTo')";
        	$stmt2 = $conn->prepare($count_na);
        	$stmt2->execute();
        	foreach($stmt2->fetchALL() as $j){
        				echo '<tr>';

		echo '<td ><h3 style="color:red;"><b>'.$j['total'].'</b></h3></td>';
				
		echo '</tr>';
        	}
		 
	}
}

if ($method == 'total_sec2') {
	$dateFrom = $_POST['dateFrom'];
	$dateTo = $_POST['dateTo'];
	$count_total = "SELECT count(*) as grand_total from ialert_audit where section = 'Section2' AND (date_audited >='$dateFrom' AND date_audited <= '$dateTo')";
	$stmt = $conn->prepare($count_total);
	$stmt->execute();

	foreach($stmt->fetchALL() as $x){
		echo '<tr>';

		echo '<td ><h3><b>'.$x['grand_total'].'</b></h3></td>';
				
		echo '</tr>';
	}
}


if ($method == 'count_section3') {
	$dateFrom = $_POST['dateFrom'];
	$dateTo = $_POST['dateTo'];
	$count = "SELECT *,count(*) as total FROM ialert_audit ";
	$stmt = $conn->prepare($count);
	$stmt->execute();
	foreach($stmt->fetchALL() as $x){

		$date_audited = $x['date_audited'];
        $pd = $x['pd'];
        $agency = $x['agency'];
        $days_notif = date("Y-m-d", strtotime('+4 day',strtotime($date_audited)));

        	$count_na = "SELECT COUNT(*) as total FROM ialert_audit WHERE  pd IS NULL AND agency IS NULL AND section = 'Section3' AND (date_audited >='$dateFrom' AND date_audited <= '$dateTo')";
        	$stmt2 = $conn->prepare($count_na);
        	$stmt2->execute();
        	foreach($stmt2->fetchALL() as $j){
        				echo '<tr>';

		echo '<td ><h3 style="color:red;"><b>'.$j['total'].'</b></h3></td>';
				
		echo '</tr>';
        	}
		 
	}
}

if ($method == 'total_sec3') {
	$dateFrom = $_POST['dateFrom'];
	$dateTo = $_POST['dateTo'];
	$count_total = "SELECT count(*) as grand_total3 from ialert_audit where section = 'Section3' AND (date_audited >='$dateFrom' AND date_audited <= '$dateTo')";
	$stmt = $conn->prepare($count_total);
	$stmt->execute();

	foreach($stmt->fetchALL() as $x){
		echo '<tr>';

		echo '<td ><h3><b>'.$x['grand_total3'].'</b></h3></td>';
				
		echo '</tr>';
	}
}

if ($method == 'count_section4') {
	$dateFrom = $_POST['dateFrom'];
	$dateTo = $_POST['dateTo'];
	$count = "SELECT *,count(*) as total FROM ialert_audit ";
	$stmt = $conn->prepare($count);
	$stmt->execute();
	foreach($stmt->fetchALL() as $x){

		$date_audited = $x['date_audited'];
        $pd = $x['pd'];
        $agency = $x['agency'];
        $days_notif = date("Y-m-d", strtotime('+4 day',strtotime($date_audited)));

        	$count_na = "SELECT COUNT(*) as total FROM ialert_audit WHERE  pd IS NULL AND agency IS NULL AND section = 'Section4' AND (date_audited >='$dateFrom' AND date_audited <= '$dateTo')";
        	$stmt2 = $conn->prepare($count_na);
        	$stmt2->execute();
        	foreach($stmt2->fetchALL() as $j){
        				echo '<tr>';

		echo '<td ><h3 style="color:red;"><b>'.$j['total'].'</b></h3></td>';
				
		echo '</tr>';
        	}
		 
	}
}
if ($method == 'total_sec4') {
	$dateFrom = $_POST['dateFrom'];
	$dateTo = $_POST['dateTo'];
	$count_total = "SELECT count(*) as grand_total4 from ialert_audit where section = 'Section4' AND (date_audited >='$dateFrom' AND date_audited <= '$dateTo')";
	$stmt = $conn->prepare($count_total);
	$stmt->execute();

	foreach($stmt->fetchALL() as $x){
		echo '<tr>';

		echo '<td ><h3><b>'.$x['grand_total4'].'</b></h3></td>';
				
		echo '</tr>';
	}
}

if ($method == 'count_section5') {
	$dateFrom = $_POST['dateFrom'];
	$dateTo = $_POST['dateTo'];
	$count = "SELECT *,count(*) as total FROM ialert_audit ";
	$stmt = $conn->prepare($count);
	$stmt->execute();
	foreach($stmt->fetchALL() as $x){

		$date_audited = $x['date_audited'];
        $pd = $x['pd'];
        $agency = $x['agency'];
        $days_notif = date("Y-m-d", strtotime('+4 day',strtotime($date_audited)));

        	$count_na = "SELECT COUNT(*) as total FROM ialert_audit WHERE  pd IS NULL AND agency IS NULL AND section = 'Section5' AND (date_audited >='$dateFrom' AND date_audited <= '$dateTo')";
        	$stmt2 = $conn->prepare($count_na);
        	$stmt2->execute();
        	foreach($stmt2->fetchALL() as $j){
        				echo '<tr>';

		echo '<td ><h3 style="color:red;"><b>'.$j['total'].'</b></h3></td>';
				
		echo '</tr>';
        	}
		 
	}
}

if ($method == 'total_sec5') {
	$dateFrom = $_POST['dateFrom'];
	$dateTo = $_POST['dateTo'];
	$count_total = "SELECT count(*) as grand_total5 from ialert_audit where section = 'Section5' AND (date_audited >='$dateFrom' AND date_audited <= '$dateTo')";
	$stmt = $conn->prepare($count_total);
	$stmt->execute();

	foreach($stmt->fetchALL() as $x){
		echo '<tr>';

		echo '<td ><h3><b>'.$x['grand_total5'].'</b></h3></td>';
				
		echo '</tr>';
	}
}

if ($method == 'count_section6') {
	$dateFrom = $_POST['dateFrom'];
	$dateTo = $_POST['dateTo'];
	$count = "SELECT *,count(*) as total FROM ialert_audit ";
	$stmt = $conn->prepare($count);
	$stmt->execute();
	foreach($stmt->fetchALL() as $x){

		$date_audited = $x['date_audited'];
        $pd = $x['pd'];
        $agency = $x['agency'];
        $days_notif = date("Y-m-d", strtotime('+4 day',strtotime($date_audited)));

        	$count_na = "SELECT COUNT(*) as total FROM ialert_audit WHERE  pd IS NULL AND agency IS NULL AND section = 'Section6' AND (date_audited >='$dateFrom' AND date_audited <= '$dateTo')";
        	$stmt2 = $conn->prepare($count_na);
        	$stmt2->execute();
        	foreach($stmt2->fetchALL() as $j){
        				echo '<tr>';

		echo '<td ><h3 style="color:red;"><b>'.$j['total'].'</b></h3></td>';
				
		echo '</tr>';
        	}
		 
	}
}

if ($method == 'total_sec6') {
	$dateFrom = $_POST['dateFrom'];
	$dateTo = $_POST['dateTo'];
	$count_total = "SELECT count(*) as grand_total6 from ialert_audit where section = 'Section6' AND (date_audited >='$dateFrom' AND date_audited <= '$dateTo')";
	$stmt = $conn->prepare($count_total);
	$stmt->execute();

	foreach($stmt->fetchALL() as $x){
		echo '<tr>';

		echo '<td ><h3><b>'.$x['grand_total6'].'</b></h3></td>';
				
		echo '</tr>';
	}
}

if ($method == 'count_section7') {
	$dateFrom = $_POST['dateFrom'];
	$dateTo = $_POST['dateTo'];
	$count = "SELECT *,count(*) as total FROM ialert_audit ";
	$stmt = $conn->prepare($count);
	$stmt->execute();
	foreach($stmt->fetchALL() as $x){

		$date_audited = $x['date_audited'];
        $pd = $x['pd'];
        $agency = $x['agency'];
        $days_notif = date("Y-m-d", strtotime('+4 day',strtotime($date_audited)));

        	$count_na = "SELECT COUNT(*) as total FROM ialert_audit WHERE  pd IS NULL AND agency IS NULL AND section = 'Section7' AND (date_audited >='$dateFrom' AND date_audited <= '$dateTo')";
        	$stmt2 = $conn->prepare($count_na);
        	$stmt2->execute();
        	foreach($stmt2->fetchALL() as $j){
        				echo '<tr>';

		echo '<td ><h3 style="color:red;"><b>'.$j['total'].'</b></h3></td>';
				
		echo '</tr>';
        	}
		 
	}
}

if ($method == 'total_sec7') {
	$dateFrom = $_POST['dateFrom'];
	$dateTo = $_POST['dateTo'];
	$count_total = "SELECT count(*) as grand_total7 from ialert_audit where section = 'Section7' AND (date_audited >='$dateFrom' AND date_audited <= '$dateTo')";
	$stmt = $conn->prepare($count_total);
	$stmt->execute();

	foreach($stmt->fetchALL() as $x){
		echo '<tr>';

		echo '<td ><h3><b>'.$x['grand_total7'].'</b></h3></td>';
				
		echo '</tr>';
	}
}
if ($method == 'count_section8') {
	$dateFrom = $_POST['dateFrom'];
	$dateTo = $_POST['dateTo'];
	$count = "SELECT *,count(*) as total FROM ialert_audit ";
	$stmt = $conn->prepare($count);
	$stmt->execute();
	foreach($stmt->fetchALL() as $x){

		$date_audited = $x['date_audited'];
        $pd = $x['pd'];
        $agency = $x['agency'];
        $days_notif = date("Y-m-d", strtotime('+4 day',strtotime($date_audited)));

        	$count_na = "SELECT COUNT(*) as total FROM ialert_audit WHERE  pd IS NULL AND agency IS NULL AND section = 'Section8' AND (date_audited >='$dateFrom' AND date_audited <= '$dateTo')";
        	$stmt2 = $conn->prepare($count_na);
        	$stmt2->execute();
        	foreach($stmt2->fetchALL() as $j){
        				echo '<tr>';

		echo '<td ><h3 style="color:red;"><b>'.$j['total'].'</b></h3></td>';
				
		echo '</tr>';
        	}
		 
	}
}

if ($method == 'total_sec8') {
	$dateFrom = $_POST['dateFrom'];
	$dateTo = $_POST['dateTo'];
	$count_total = "SELECT count(*) as grand_total8 from ialert_audit where section = 'Section8' AND (date_audited >='$dateFrom' AND date_audited <= '$dateTo')";
	$stmt = $conn->prepare($count_total);
	$stmt->execute();

	foreach($stmt->fetchALL() as $x){
		echo '<tr>';

		echo '<td ><h3><b>'.$x['grand_total8'].'</b></h3></td>';
				
		echo '</tr>';
	}
}

if ($method == 'fetch_sec1') {
		$dateFrom = $_POST['dateFrom'];
        $dateTo = $_POST['dateTo'];
        $empid =$_POST['empid'];
		$fname =$_POST['fname'];
		$line = $_POST['line'];
		$carmaker = $_POST['carmaker'];
		$carmodel = $_POST['carmodel'];
		$position = $_POST['position'];
        $c = 0;

        $sec1 = "SELECT * FROM ialert_audit WHERE section = 'Section1' AND pd IS NULL AND agency IS NULL AND employee_num LIKE '$empid%' AND full_name LIKE '$fname%' AND line_no LIKE '$line%' AND car_maker LIKE '$carmaker%' AND car_model LIKE '$carmodel%' AND position LIKE '$position%' ";
        $stmt = $conn->prepare($sec1);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
        	foreach($stmt->fetchALL() as $x){
        		$c++;

        		echo '<tr>';
        		    echo '<td>';
                echo '<p>
                        <label>
                            <input type="checkbox" name="" id="" class="singleCheck" value="'.$x['id'].'">
                            <span></span>
                        </label>
                    </p>';
                echo '</td>';
        				 echo '<td>'.$c.'</td>';
                echo '<td style="display: none;">'.$x['batch'].'</td>';
                echo '<td>'.$x['date_audited'].'</td>';
                 echo '<td   style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#update" onclick="get_set(&quot;'.$x['id'].'~!~'.$x['employee_num'].'~!~'.$x['full_name'].'~!~'.$x['position'].'~!~'.$x['provider'].'~!~'.$x['shift'].'~!~'.$x['groups'].'~!~'.$x['audit_type'].'~!~'.$x['audited_categ'].'~!~'.$x['car_maker'].'~!~'.$x['car_model'].'~!~'.$x['line_no'].'~!~'.$x['process'].'~!~'.$x['audit_findings'].'~!~'.$x['audited_by'].'~!~'.$x['date_audited'].'~!~'.$x['remarks'].'&quot;)">'.$x['full_name'].'</td>';
                 echo '<td>'.$x['position'].'</td>';
                echo '<td>'.$x['employee_num'].'</td>';
                echo '<td>'.$x['provider'].'</td>';
                echo '<td>'.$x['groups'].'</td>';
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
        }
        else{
        echo '<tr>';
            echo '<td colspan="14" style="text-align:center;">NO RESULT</td>';
            echo '</tr>';
            }
}


if ($method == 'fetch_sec2') {
		$dateFrom = $_POST['dateFrom'];
        $dateTo = $_POST['dateTo'];
        $empid =$_POST['empid'];
		$fname =$_POST['fname'];
		$line = $_POST['line'];
		$carmaker = $_POST['carmaker'];
		$carmodel = $_POST['carmodel'];
		$position = $_POST['position'];
        $c = 0;

        $sec2 = "SELECT * FROM ialert_audit WHERE section = 'Section2' AND pd IS NULL AND agency IS NULL AND employee_num LIKE '$empid%' AND full_name LIKE '$fname%' AND line_no LIKE '$line%' AND car_maker LIKE '$carmaker%' AND car_model LIKE '$carmodel%' AND position LIKE '$position%' ";
        $stmt = $conn->prepare($sec2);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
        	foreach($stmt->fetchALL() as $x){
        		$c++;

        		echo '<tr>';
        		    echo '<td>';
                echo '<p>
                        <label>
                            <input type="checkbox" name="" id="" class="singleCheck" value="'.$x['id'].'">
                            <span></span>
                        </label>
                    </p>';
                echo '</td>';
        				 echo '<td>'.$c.'</td>';
                echo '<td style="display: none;">'.$x['batch'].'</td>';
                echo '<td>'.$x['date_audited'].'</td>';
                 echo '<td   style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#update" onclick="get_set(&quot;'.$x['id'].'~!~'.$x['employee_num'].'~!~'.$x['full_name'].'~!~'.$x['position'].'~!~'.$x['provider'].'~!~'.$x['shift'].'~!~'.$x['groups'].'~!~'.$x['audit_type'].'~!~'.$x['audited_categ'].'~!~'.$x['car_maker'].'~!~'.$x['car_model'].'~!~'.$x['line_no'].'~!~'.$x['process'].'~!~'.$x['audit_findings'].'~!~'.$x['audited_by'].'~!~'.$x['date_audited'].'~!~'.$x['remarks'].'&quot;)">'.$x['full_name'].'</td>';
                 echo '<td>'.$x['position'].'</td>';
                echo '<td>'.$x['employee_num'].'</td>';
                echo '<td>'.$x['provider'].'</td>';
                echo '<td>'.$x['groups'].'</td>';
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
        }
        else{
        echo '<tr>';
            echo '<td colspan="14" style="text-align:center;">NO RESULT</td>';
            echo '</tr>';
            }
}


if ($method == 'fetch_sec3') {
		$dateFrom = $_POST['dateFrom'];
        $dateTo = $_POST['dateTo'];
        $empid =$_POST['empid'];
		$fname =$_POST['fname'];
		$line = $_POST['line'];
		$carmaker = $_POST['carmaker'];
		$carmodel = $_POST['carmodel'];
		$position = $_POST['position'];
        $c = 0;

        $sec3 = "SELECT * FROM ialert_audit WHERE section = 'Section3' AND pd IS NULL AND agency IS NULL AND employee_num LIKE '$empid%' AND full_name LIKE '$fname%' AND line_no LIKE '$line%' AND car_maker LIKE '$carmaker%' AND car_model LIKE '$carmodel%' AND position LIKE '$position%' ";
        $stmt = $conn->prepare($sec3);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
        	foreach($stmt->fetchALL() as $x){
        		$c++;

        		echo '<tr>';
        		    echo '<td>';
                echo '<p>
                        <label>
                            <input type="checkbox" name="" id="" class="singleCheck" value="'.$x['id'].'">
                            <span></span>
                        </label>
                    </p>';
                echo '</td>';
        				 echo '<td>'.$c.'</td>';
                echo '<td style="display: none;">'.$x['batch'].'</td>';
                echo '<td>'.$x['date_audited'].'</td>';
                 echo '<td   style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#update" onclick="get_set(&quot;'.$x['id'].'~!~'.$x['employee_num'].'~!~'.$x['full_name'].'~!~'.$x['position'].'~!~'.$x['provider'].'~!~'.$x['shift'].'~!~'.$x['groups'].'~!~'.$x['audit_type'].'~!~'.$x['audited_categ'].'~!~'.$x['car_maker'].'~!~'.$x['car_model'].'~!~'.$x['line_no'].'~!~'.$x['process'].'~!~'.$x['audit_findings'].'~!~'.$x['audited_by'].'~!~'.$x['date_audited'].'~!~'.$x['remarks'].'&quot;)">'.$x['full_name'].'</td>';
                 echo '<td>'.$x['position'].'</td>';
                echo '<td>'.$x['employee_num'].'</td>';
                echo '<td>'.$x['provider'].'</td>';
                echo '<td>'.$x['groups'].'</td>';
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
        }
        else{
        echo '<tr>';
            echo '<td colspan="14" style="text-align:center;">NO RESULT</td>';
            echo '</tr>';
            }
}


if ($method == 'fetch_sec4') {
		$dateFrom = $_POST['dateFrom'];
        $dateTo = $_POST['dateTo'];
        $empid =$_POST['empid'];
		$fname =$_POST['fname'];
		$line = $_POST['line'];
		$carmaker = $_POST['carmaker'];
		$carmodel = $_POST['carmodel'];
		$position = $_POST['position'];
        $c = 0;

        $sec4 = "SELECT * FROM ialert_audit WHERE section = 'Section4' AND pd IS NULL AND agency IS NULL AND employee_num LIKE '$empid%' AND full_name LIKE '$fname%' AND line_no LIKE '$line%' AND car_maker LIKE '$carmaker%' AND car_model LIKE '$carmodel%' AND position LIKE '$position%' ";
        $stmt = $conn->prepare($sec4);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
        	foreach($stmt->fetchALL() as $x){
        		$c++;

        		echo '<tr>';
        		    echo '<td>';
                echo '<p>
                        <label>
                            <input type="checkbox" name="" id="" class="singleCheck" value="'.$x['id'].'">
                            <span></span>
                        </label>
                    </p>';
                echo '</td>';
        				 echo '<td>'.$c.'</td>';
                echo '<td style="display: none;">'.$x['batch'].'</td>';
                echo '<td>'.$x['date_audited'].'</td>';
                 echo '<td   style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#update" onclick="get_set(&quot;'.$x['id'].'~!~'.$x['employee_num'].'~!~'.$x['full_name'].'~!~'.$x['position'].'~!~'.$x['provider'].'~!~'.$x['shift'].'~!~'.$x['groups'].'~!~'.$x['audit_type'].'~!~'.$x['audited_categ'].'~!~'.$x['car_maker'].'~!~'.$x['car_model'].'~!~'.$x['line_no'].'~!~'.$x['process'].'~!~'.$x['audit_findings'].'~!~'.$x['audited_by'].'~!~'.$x['date_audited'].'~!~'.$x['remarks'].'&quot;)">'.$x['full_name'].'</td>';
                 echo '<td>'.$x['position'].'</td>';
                echo '<td>'.$x['employee_num'].'</td>';
                echo '<td>'.$x['provider'].'</td>';
                echo '<td>'.$x['groups'].'</td>';
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
        }
        else{
        echo '<tr>';
            echo '<td colspan="14" style="text-align:center;">NO RESULT</td>';
            echo '</tr>';
            }
}


if ($method == 'fetch_sec5') {
		$dateFrom = $_POST['dateFrom'];
        $dateTo = $_POST['dateTo'];
        $empid =$_POST['empid'];
		$fname =$_POST['fname'];
		$line = $_POST['line'];
		$carmaker = $_POST['carmaker'];
		$carmodel = $_POST['carmodel'];
		$position = $_POST['position'];
        $c = 0;

        $sec5 = "SELECT * FROM ialert_audit WHERE section = 'Section5' AND pd IS NULL AND agency IS NULL AND employee_num LIKE '$empid%' AND full_name LIKE '$fname%' AND line_no LIKE '$line%' AND car_maker LIKE '$carmaker%' AND car_model LIKE '$carmodel%' AND position LIKE '$position%' ";
        $stmt = $conn->prepare($sec5);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
        	foreach($stmt->fetchALL() as $x){
        		$c++;

        		echo '<tr>';
        		    echo '<td>';
                echo '<p>
                        <label>
                            <input type="checkbox" name="" id="" class="singleCheck" value="'.$x['id'].'">
                            <span></span>
                        </label>
                    </p>';
                echo '</td>';
        				 echo '<td>'.$c.'</td>';
                echo '<td style="display: none;">'.$x['batch'].'</td>';
                echo '<td>'.$x['date_audited'].'</td>';
                 echo '<td   style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#update" onclick="get_set(&quot;'.$x['id'].'~!~'.$x['employee_num'].'~!~'.$x['full_name'].'~!~'.$x['position'].'~!~'.$x['provider'].'~!~'.$x['shift'].'~!~'.$x['groups'].'~!~'.$x['audit_type'].'~!~'.$x['audited_categ'].'~!~'.$x['car_maker'].'~!~'.$x['car_model'].'~!~'.$x['line_no'].'~!~'.$x['process'].'~!~'.$x['audit_findings'].'~!~'.$x['audited_by'].'~!~'.$x['date_audited'].'~!~'.$x['remarks'].'&quot;)">'.$x['full_name'].'</td>';
                 echo '<td>'.$x['position'].'</td>';
                echo '<td>'.$x['employee_num'].'</td>';
                echo '<td>'.$x['provider'].'</td>';
                echo '<td>'.$x['groups'].'</td>';
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
        }
        else{
        echo '<tr>';
            echo '<td colspan="14" style="text-align:center;">NO RESULT</td>';
            echo '</tr>';
            }
}

if ($method == 'fetch_sec6') {
		$dateFrom = $_POST['dateFrom'];
        $dateTo = $_POST['dateTo'];
        $empid =$_POST['empid'];
		$fname =$_POST['fname'];
		$line = $_POST['line'];
		$carmaker = $_POST['carmaker'];
		$carmodel = $_POST['carmodel'];
		$position = $_POST['position'];
        $c = 0;

        $sec6 = "SELECT * FROM ialert_audit WHERE section = 'Section6' AND pd IS NULL AND agency IS NULL AND employee_num LIKE '$empid%' AND full_name LIKE '$fname%' AND line_no LIKE '$line%' AND car_maker LIKE '$carmaker%' AND car_model LIKE '$carmodel%' AND position LIKE '$position%' ";
        $stmt = $conn->prepare($sec6);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
        	foreach($stmt->fetchALL() as $x){
        		$c++;

        		echo '<tr>';
        		    echo '<td>';
                echo '<p>
                        <label>
                            <input type="checkbox" name="" id="" class="singleCheck" value="'.$x['id'].'">
                            <span></span>
                        </label>
                    </p>';
                echo '</td>';
        				 echo '<td>'.$c.'</td>';
                echo '<td style="display: none;">'.$x['batch'].'</td>';
                echo '<td>'.$x['date_audited'].'</td>';
                 echo '<td   style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#update" onclick="get_set(&quot;'.$x['id'].'~!~'.$x['employee_num'].'~!~'.$x['full_name'].'~!~'.$x['position'].'~!~'.$x['provider'].'~!~'.$x['shift'].'~!~'.$x['groups'].'~!~'.$x['audit_type'].'~!~'.$x['audited_categ'].'~!~'.$x['car_maker'].'~!~'.$x['car_model'].'~!~'.$x['line_no'].'~!~'.$x['process'].'~!~'.$x['audit_findings'].'~!~'.$x['audited_by'].'~!~'.$x['date_audited'].'~!~'.$x['remarks'].'&quot;)">'.$x['full_name'].'</td>';
                 echo '<td>'.$x['position'].'</td>';
                echo '<td>'.$x['employee_num'].'</td>';
                echo '<td>'.$x['provider'].'</td>';
                echo '<td>'.$x['groups'].'</td>';
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
        }
        else{
        echo '<tr>';
            echo '<td colspan="14" style="text-align:center;">NO RESULT</td>';
            echo '</tr>';
            }
}

if ($method == 'fetch_sec7') {
		$dateFrom = $_POST['dateFrom'];
        $dateTo = $_POST['dateTo'];
        $empid =$_POST['empid'];
		$fname =$_POST['fname'];
		$line = $_POST['line'];
		$carmaker = $_POST['carmaker'];
		$carmodel = $_POST['carmodel'];
		$position = $_POST['position'];
        $c = 0;

        $sec7 = "SELECT * FROM ialert_audit WHERE section = 'Section7' AND pd IS NULL AND agency IS NULL AND employee_num LIKE '$empid%' AND full_name LIKE '$fname%' AND line_no LIKE '$line%' AND car_maker LIKE '$carmaker%' AND car_model LIKE '$carmodel%' AND position LIKE '$position%' ";
        $stmt = $conn->prepare($sec7);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
        	foreach($stmt->fetchALL() as $x){
        		$c++;

        		echo '<tr>';
        		    echo '<td>';
                echo '<p>
                        <label>
                            <input type="checkbox" name="" id="" class="singleCheck" value="'.$x['id'].'">
                            <span></span>
                        </label>
                    </p>';
                echo '</td>';
        				 echo '<td>'.$c.'</td>';
                echo '<td style="display: none;">'.$x['batch'].'</td>';
                echo '<td>'.$x['date_audited'].'</td>';
                 echo '<td   style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#update" onclick="get_set(&quot;'.$x['id'].'~!~'.$x['employee_num'].'~!~'.$x['full_name'].'~!~'.$x['position'].'~!~'.$x['provider'].'~!~'.$x['shift'].'~!~'.$x['groups'].'~!~'.$x['audit_type'].'~!~'.$x['audited_categ'].'~!~'.$x['car_maker'].'~!~'.$x['car_model'].'~!~'.$x['line_no'].'~!~'.$x['process'].'~!~'.$x['audit_findings'].'~!~'.$x['audited_by'].'~!~'.$x['date_audited'].'~!~'.$x['remarks'].'&quot;)">'.$x['full_name'].'</td>';
                 echo '<td>'.$x['position'].'</td>';
                echo '<td>'.$x['employee_num'].'</td>';
                echo '<td>'.$x['provider'].'</td>';
                echo '<td>'.$x['groups'].'</td>';
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
        }
        else{
        echo '<tr>';
            echo '<td colspan="14" style="text-align:center;">NO RESULT</td>';
            echo '</tr>';
            }
}

if ($method == 'fetch_sec8') {
		$dateFrom = $_POST['dateFrom'];
        $dateTo = $_POST['dateTo'];
        $empid =$_POST['empid'];
		$fname =$_POST['fname'];
		$line = $_POST['line'];
		$carmaker = $_POST['carmaker'];
		$carmodel = $_POST['carmodel'];
		$position = $_POST['position'];
        $c = 0;

        $sec8 = "SELECT * FROM ialert_audit WHERE section = 'Section8' AND pd IS NULL AND agency IS NULL AND employee_num LIKE '$empid%' AND full_name LIKE '$fname%' AND line_no LIKE '$line%' AND car_maker LIKE '$carmaker%' AND car_model LIKE '$carmodel%' AND position LIKE '$position%' ";
        $stmt = $conn->prepare($sec8);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
        	foreach($stmt->fetchALL() as $x){
        		$c++;

        		echo '<tr>';
        		    echo '<td>';
                echo '<p>
                        <label>
                            <input type="checkbox" name="" id="" class="singleCheck" value="'.$x['id'].'">
                            <span></span>
                        </label>
                    </p>';
                echo '</td>';
        				 echo '<td>'.$c.'</td>';
                echo '<td style="display: none;">'.$x['batch'].'</td>';
                echo '<td>'.$x['date_audited'].'</td>';
                 echo '<td   style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#update" onclick="get_set(&quot;'.$x['id'].'~!~'.$x['employee_num'].'~!~'.$x['full_name'].'~!~'.$x['position'].'~!~'.$x['provider'].'~!~'.$x['shift'].'~!~'.$x['groups'].'~!~'.$x['audit_type'].'~!~'.$x['audited_categ'].'~!~'.$x['car_maker'].'~!~'.$x['car_model'].'~!~'.$x['line_no'].'~!~'.$x['process'].'~!~'.$x['audit_findings'].'~!~'.$x['audited_by'].'~!~'.$x['date_audited'].'~!~'.$x['remarks'].'&quot;)">'.$x['full_name'].'</td>';
                 echo '<td>'.$x['position'].'</td>';
                echo '<td>'.$x['employee_num'].'</td>';
                echo '<td>'.$x['provider'].'</td>';
                echo '<td>'.$x['groups'].'</td>';
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
        }
        else{
        echo '<tr>';
            echo '<td colspan="14" style="text-align:center;">NO RESULT</td>';
            echo '</tr>';
            }
}
?>