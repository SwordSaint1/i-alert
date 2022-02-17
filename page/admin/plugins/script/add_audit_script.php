<script type="text/javascript">

 const create_audit =()=> {

    setTimeout(generateBatchID,100);

} 
// GENERATE BATCH ID
const generateBatchID =()=>{
    $.ajax({
        url: '../../process/admin_processor.php',
        type: 'POST',
        cache: false,
        data:{
            method: 'AuditCode'
        },success:function(response){
            $('#auditCode').html(response);
        }
    });
} 

const detect_part_info =()=>{
    var employee_num = document.querySelector('#employee_num').value;
    $.ajax({
        url: '../../process/admin_processor.php',
        type: 'POST',
        cache: false,
        data:{
            method: 'fetch_details_req',
            employee_num:employee_num
        },success:function(response){
            if(response !== ''){
                var str = response.split('~!~');
                document.querySelector('#full_name').value = str[0];
                document.querySelector('#position').value = str[1];
                document.querySelector('#provider').value = str[2];
               	document.querySelector('#emline').value = str[3];           
            }
            else{
          
               $('#full_name').val('');
               $('#position').val('');
               $('#provider').val('');
               $('#shift').val('');
               $('#date_audited').val('');
               $('#carmaker').val('');
               $('#carmodel').val('');
               $('#emline').val('');
               $('#process').val('');
               $('#audit_findings').val('');
               $('#audited_by').val('');
               $('#audit_categ').val('');
               $('#remarks').val('');                
            }
        }
    });
}


const save_request =()=> {

    var employee_num = document.querySelector('#employee_num').value;
    var full_name = document.querySelector('#full_name').value;
    var position = document.querySelector('#position').value;
    var provider = document.querySelector('#provider').value;
    var shift = document.querySelector('#shift').value;
    var group = document.querySelector('#group').value;
    var date_audited = document.querySelector('#date_audited').value;
    var carmaker = document.querySelector('#carmaker').value;
    var carmodel = document.querySelector('#carmodel').value;
    var emline = document.querySelector('#emline').value;
    var emprocess = document.querySelector('#process').value;
    var audit_findings = document.querySelector('#audit_findings').value;
    var audited_by = document.querySelector('#audited_by').value;
    var audit_type = document.querySelector('#audit_type').value;
    var audit_categ = document.querySelector('#audit_categ').value;
    var remarks = document.querySelector('#remarks').value;
    var esection = '<?=$esection;?>';
    var username = '<?=$username;?>';
    var audit_code = document.querySelector('#auditCode').innerHTML;
    
    if(employee_num == ''){      
        swal('Notification', 'Please Enter EMPLOYEE ID','info');
    }else if(audit_code == ''){     
        swal('Notification', 'Missing Audit Code, Please reload your browser!','info');
    }else if(full_name == ''){
        swal('Notification', 'Please Enter Full Name','info');
    }else if(position == ''){
         swal('Notification', 'Please Enter Position','info');
    }else if(provider == ''){
        swal('Notification', 'Please Enter Prodiver','info');
    }else if(shift == ''){
        swal('Notification', 'Please Select Shift','info');
    }else if(group == ''){
        swal('Notification', 'Please Select Group','info');
    }else if(audit_type == ''){
        swal('Notification', 'Please Select Audit Type','info');
    }else if(date_audited == '-'){
        swal('Notification', 'Please Enter Date Audited','info');
    }else if(carmaker == ''){
        swal('Notification', 'Please Enter Car Maker','info');
    }else if(carmodel == ''){
        swal('Notification', 'Please Enter Car Model','info');
    }else if(emline == ''){
        swal('Notification', 'Please Enter Line No','info');
    }else if(emprocess == ''){
        swal('Notification', 'Please Enter Process','info');
    }else if(audit_findings == ''){
        swal('Notification', 'Please Enter Audit Findings','info');
    }else if(audited_by == ''){
        swal('Notification', 'Please Enter Audited By','info');
    }else if(audit_categ == ''){
        swal('Notification', 'Please Select Audit Category','info');
    }else if(remarks == ''){
        swal('Notification', 'Please Enter Remarks','info');
    }else{
    $.ajax({
        url: '../../process/admin_processor.php',
        type: 'POST',
        cache: false,
        data:{
            method: 'insert_audit',
            employee_num:employee_num,
            full_name:full_name,
            position:position,
            provider:provider,
            shift:shift,
            group:group,
            date_audited:date_audited,
            carmaker:carmaker,
            carmodel:carmodel,
            emline:emline,
            emprocess:emprocess,
            audit_findings:audit_findings,
            audited_by:audited_by,
            audit_type:audit_type,
            audit_categ:audit_categ,
            remarks:remarks,
            esection:esection,
            username:username,
            audit_code:audit_code
        },success:function(x){
          
         if (x == 'Successfully Saved'){
                 swal('SUCCESS',x,'success');
                     $('#employee_num').val('');
            $('#full_name').val('');
            $('#position').val('');
            $('#provider').val('');
            $('#shift').val('');
            $('#group').val('');
            $('#date_audited').val('');
            $('#carmaker').val('');
            $('#carmodel').val('');
            $('#emline').val('');
            $('#emprocess').val('');
            $('#audit_findings').val('');
            $('#audited_by').val('');
            $('#audit_type').val('');
            $('#audit_categ').val('');
            $('#remarks').val('');
          
           load_prev();     
         }
         else{

         }

          
            
        }
    });
 }
}


//function prev in request training
const load_prev =()=>{
     var audit_code = $('#auditCode').html();

    // console.log(batch);
    $.ajax({
        url:'../../process/admin_processor.php',
        type:'POST',
        cache:false,
        data:{
            method:'prev_audit',
            audit_code:audit_code
        },success:function(response){
            $('#data_preview_audit').html(response);
        }
    });
}


</script>