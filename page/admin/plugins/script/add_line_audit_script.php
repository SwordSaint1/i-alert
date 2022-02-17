<script type="text/javascript">

 const create_line_audit =()=> {

    setTimeout(generateBatchID,100);

} 
// GENERATE BATCH ID
const generateBatchID =()=>{
    $.ajax({
        url: '../../process/admin_processor.php',
        type: 'POST',
        cache: false,
        data:{
            method: 'LineAuditCode'
        },success:function(response){
            $('#lineauditCode').html(response);
        }
    });
}


const save_request_line =()=> {

	var date_audited  = document.querySelector('#date_line_audited').value;
	var group  = document.querySelector('#group_line').value;
	var shift  = document.querySelector('#shift_line').value;
	var audit_categ  = document.querySelector('#line_audit_categ').value;
	var carmaker  = document.querySelector('#carmaker_line').value;
	var carmodel  = document.querySelector('#carmodel_line').value;
	var emline  = document.querySelector('#emline_line').value;
	var emprocess  = document.querySelector('#process_line').value;
	var audit_findings  = document.querySelector('#line_audit_findings').value;
	var audited_by  = document.querySelector('#line_audited_by').value;
	var audit_type  = document.querySelector('#line_audit_type').value;
    var remarks = document.querySelector('#remarks_line').value;
    var esection = '<?=$esection;?>';
    var username = '<?=$username;?>';
    var audit_code = document.querySelector('#lineauditCode').innerHTML;
    
   if(audit_code == ''){     
        swal('Notification', 'Missing Line Audit Code, Please reload your browser!','info');
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
            method: 'insert_line_audit',
            date_audited:date_audited,
			group:group,
			shift:shift,
			audit_categ:audit_categ,
			carmaker:carmaker,
			carmodel:carmodel,
			emline:emline,
			emprocess:emprocess,
			audit_findings:audit_findings,
			audited_by:audited_by,
			audit_type:audit_type,
			remarks:remarks,
			esection:esection,
			username:username,
			audit_code:audit_code
        },success:function(x){
            

             if (x == 'Successfully Saved'){
                 swal('SUCCESS',x,'success');     
            $('#date_line_audited').val('');
            $('#group_line').val('');
            $('#shift_line').val('');
            $('#line_audit_categ').val('');
            $('#carmaker_line').val('');
            $('#emline_line').val('');
            $('#process_line').val('');
            $('#line_audit_findings').val('');
            $('#line_audited_by').val('');
            $('#line_audit_type').val('');
            $('#remarks_line').val('');
           load_line_prev();     
         }else{

         }
          
           
           
            
        }
    });
 }
}


//function prev in request training
const load_line_prev =()=>{
     var audit_code = $('#lineauditCode').html();

    // console.log(batch);
    $.ajax({
        url:'../../process/admin_processor.php',
        type:'POST',
        cache:false,
        data:{
            method:'prev_line_audit',
            audit_code:audit_code
        },success:function(response){
            $('#data_preview_line_audit').html(response);
        }
    });
}


</script>