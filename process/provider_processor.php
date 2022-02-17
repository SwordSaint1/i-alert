<?php 
	include 'conn.php';
	include 'conn2.php';

//requestor   
	$method = $_POST['method'];

if ($method == 'fetch_audited_list_provider') {
  	$dateFrom = $_POST['dateFrom'];
        $dateTo = $_POST['dateTo'];
        $empid =$_POST['empid'];
	$fname =$_POST['fname'];
        $esection = $_POST['esection'];
        $lname = $_POST['lname'];
        $c = 0;

    $query = "SELECT * FROM ialert_audit
    WHERE  employee_num LIKE '$empid%' AND full_name LIKE '$fname%' AND line_no LIKE '$lname%' AND (date_audited >='$dateFrom' AND date_audited <= '$dateTo')  AND provider = '$esection' AND agency IS NULL
     GROUP BY id ORDER BY date_audited ASC";

    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        foreach($stmt->fetchALL() as $x){
        $c++;

               
                echo '<tr">';
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
                   // echo '<td>'.$x['pd'].'</td>';
                    echo '<td>'.$x['agency'].'</td>';
                     // echo '<td>'.$x['hr'].'</td>';
                      

  
                echo '</tr>';
          
    }
}else{
        echo '<tr>';
            echo '<td colspan="14" style="text-align:center;">NO RESULT</td>';
            echo '</tr>';
            }
    }


if ($method == 'update') {
    $id = [];
    $id = $_POST['id'];
    $status = $_POST['status'];
    //COUNT OF ITEM TO BE UPDATED
    $count = count($id);
    foreach($id as $x){
        $update = "UPDATE ialert_audit SET agency = '$status' WHERE id = '$x'";
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


if ($method == 'fetch_audited_list_provider_status') {
    $dateFrom = $_POST['dateFrom'];
        $dateTo = $_POST['dateTo'];
        $empid =$_POST['empid'];
    $fname =$_POST['fname'];
        $esection = $_POST['esection'];
        $c = 0;

    $query = "SELECT * FROM ialert_audit
    WHERE  employee_num LIKE '$empid%' AND full_name LIKE '$fname%' AND (date_audited >='$dateFrom' AND date_audited <= '$dateTo')  AND provider = '$esection' AND agency != ''
     GROUP BY id ORDER BY date_audited ASC";

    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        foreach($stmt->fetchALL() as $x){
        $c++;

               
                echo '<tr">';
                   echo '<td>';
                echo '<p>
                        <label>
                            <input type="checkbox" name="" id="" class="singleCheck" value="'.$x['id'].'">
                            <span></span>
                        </label>
                    </p>';
                echo '</td>';
                echo '</td>';
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
                   // echo '<td>'.$x['pd'].'</td>';
                    echo '<td>'.$x['agency'].'</td>';
                     // echo '<td>'.$x['hr'].'</td>';
                      

  
                echo '</tr>';
          
    }
}else{
        echo '<tr>';
            echo '<td colspan="14" style="text-align:center;">NO RESULT</td>';
            echo '</tr>';
            }
    }

if ($method == 'update_status') {
    $id = [];
    $id = $_POST['id'];
    $status = $_POST['status'];
    //COUNT OF ITEM TO BE UPDATED
    $count = count($id);
    foreach($id as $x){
        $update = "UPDATE ialert_audit SET agency = '$status' WHERE id = '$x'";
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



if ($method == 'fetch_audited_list_fas') {
    $dateFrom = $_POST['dateFrom'];
        $dateTo = $_POST['dateTo'];
        $empid =$_POST['empid'];
    $fname =$_POST['fname'];
        $esection = $_POST['esection'];
        $lname = $_POST['lname'];
        $c = 0;

    $query = "SELECT * FROM ialert_audit
    WHERE  employee_num LIKE '$empid%' AND full_name LIKE '$fname%' AND line_no LIKE '$lname%' AND (date_audited >='$dateFrom' AND date_audited <= '$dateTo')  AND provider = '$esection' AND pd IS NULL AND hr IS NULL
     GROUP BY id ORDER BY date_audited ASC";

    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        foreach($stmt->fetchALL() as $x){
        $c++;

               
                echo '<tr">';
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
                   // echo '<td>'.$x['pd'].'</td>';
                    echo '<td>'.$x['agency'].'</td>';
                     // echo '<td>'.$x['hr'].'</td>';
                      

  
                echo '</tr>';
          
    }
}else{
        echo '<tr>';
            echo '<td colspan="14" style="text-align:center;">NO RESULT</td>';
            echo '</tr>';
            }
    }


if ($method == 'update_fas') {
    $id = [];
    $id = $_POST['id'];
    $status = $_POST['status'];
    //COUNT OF ITEM TO BE UPDATED
    $count = count($id);
    foreach($id as $x){
        $update = "UPDATE ialert_audit SET pd = '$status' WHERE id = '$x'";
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

if ($method == 'fetch_audited_list_fass_status') {
    $dateFrom = $_POST['dateFrom'];
        $dateTo = $_POST['dateTo'];
        $empid =$_POST['empid'];
    $fname =$_POST['fname'];
        $esection = $_POST['esection'];
        $lname = $_POST['lname'];
        $c = 0;

    $query = "SELECT * FROM ialert_audit
    WHERE  employee_num LIKE '$empid%' AND full_name LIKE '$fname%'  AND (date_audited >='$dateFrom' AND date_audited <= '$dateTo')  AND provider = '$esection' AND pd != '' AND line_no LIKE '$lname%'
     GROUP BY id ORDER BY date_audited ASC";

    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        foreach($stmt->fetchALL() as $x){
        $c++;

               
                echo '<tr">';
                   echo '<td>';
                echo '<p>
                        <label>
                            <input type="checkbox" name="" id="" class="singleCheck" value="'.$x['id'].'">
                            <span></span>
                        </label>
                    </p>';
                echo '</td>';
                echo '</td>';
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
                    // echo '<td>'.$x['agency'].'</td>';
                     echo '<td>'.$x['hr'].'</td>';
                      

  
                echo '</tr>';
          
    }
}else{
        echo '<tr>';
            echo '<td colspan="14" style="text-align:center;">NO RESULT</td>';
            echo '</tr>';
            }
    }


if ($method == 'update_fass') {
    $id = [];
    $id = $_POST['id'];
    $status = $_POST['status'];
    //COUNT OF ITEM TO BE UPDATED
    $count = count($id);
    foreach($id as $x){
        $update = "UPDATE ialert_audit SET pd = '$status' WHERE id = '$x'";
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
?>