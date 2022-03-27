<script type="text/javascript">
	
	const load_list_of_audited_findings_rts_checked =()=>{
    $('#spinner').css('display','block');
     var empid = document.getElementById('empid_audited_fass_checked').value;
     var fname = document.getElementById('fname_audited_fass_checked').value;
     var lname = document.getElementById('linename_audited_fass_checked').value;
     var dateFrom = document.getElementById('rtsauditedlistcheckeddatefrom').value;
     var dateTo = document.getElementById('rtsauditedlistcheckeddateto').value;
     var esection = '<?=$esection;?>';
       var carmaker = document.getElementById('carmaker_checked').value;
     var carmodel = document.getElementById('carmodel_checked').value;
     var position = document.getElementById('position_checked').value;
     var audit_type = document.getElementById('audit_type_checked').value;

           $.ajax({
                url: '../../process/rts_processor.php',
                type: 'POST',
                cache: false,
                data:{
                    method: 'fetch_audited_list_rts_checked',
                    dateFrom:dateFrom,
					dateTo:dateTo,
                    empid:empid,
                    fname:fname,
                    esection:esection,
                    lname:lname,
                    carmaker:carmaker,
                    carmodel:carmodel,
                    position:position,
                    audit_type:audit_type
                    
                },success:function(response){
                    // console.log(response);
                    document.getElementById('audited_data_rts_checked').innerHTML = response;
                    $('#spinner').fadeOut(function(){
                        
                    });
               
               
                }
            });
   
}	


// check all and uncheck
const uncheck_all =()=>{
    var select_all = document.getElementById('check_all_rts_checked');
    select_all.checked = false;
    $('.singleCheck').each(function(){
        this.checked=false;
    });
}
const select_all_func =()=>{
    var select_all = document.getElementById('check_all_rts_checked');
    if(select_all.checked == true){
        console.log('check');
        $('.singleCheck').each(function(){
            this.checked=true;
        });
    }else{
        console.log('uncheck');
        $('.singleCheck').each(function(){
            this.checked=false;
        }); 
    }
}


const update_status_rts_checked =()=>{
   var arr = [];
    $('input.singleCheck:checkbox:checked').each(function () {
        arr.push($(this).val());
    });
    var numberOfChecked = arr.length;
    if(numberOfChecked > 0){

    var status = $('#status_rts_checked').val();

 if(status == ''){
         swal('ALERT','Select Status!','info'); 

   } else{

    $.ajax({
        url: '../../process/rts_processor.php',
        type: 'POST',
        cache: false,
        data:{
            method: 'update_rts_checked',
            id:arr,
            status:status
      
            
        },success:function(response) {
            console.log(response);
            if (response == 'success') {
             load_list_of_audited_findings_rts_checked();
             uncheck_all();
                swal('SUCCESS!', 'Success', 'success');
                $('#status_rts_checked').val('');
            }else{
                swal('FAILED', 'FAILED', 'error');
            }
        }
    });
   }
}
}
</script>