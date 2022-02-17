<script type="text/javascript">
	
	const load_list_of_audited_findings_rts =()=>{
    $('#spinner').css('display','block');
     var empid = document.getElementById('empid_audited_rts').value;
     var fname = document.getElementById('fname_audited_rts').value;
     var lname = document.getElementById('linename_audited_rts').value;
     var dateFrom = document.getElementById('rtsauditedlistdatefrom').value;
     var dateTo = document.getElementById('rtsauditedlistdateto').value;
     var esection = '<?=$esection;?>';

           $.ajax({
                url: '../../process/rts_processor.php',
                type: 'POST',
                cache: false,
                data:{
                    method: 'fetch_audited_list_rts',
                    dateFrom:dateFrom,
					dateTo:dateTo,
                    empid:empid,
                    fname:fname,
                    esection:esection,
                    lname:lname
                    
                },success:function(response){
                    // console.log(response);
                    document.getElementById('audited_data_rts').innerHTML = response;
                    $('#spinner').fadeOut(function(){
                        
                    });
               
               
                }
            });
   
}	


// check all and uncheck
const uncheck_all =()=>{
    var select_all = document.getElementById('check_all_rts');
    select_all.checked = false;
    $('.singleCheck').each(function(){
        this.checked=false;
    });
}
const select_all_func =()=>{
    var select_all = document.getElementById('check_all_rts');
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


const update_status_rts =()=>{
   var arr = [];
    $('input.singleCheck:checkbox:checked').each(function () {
        arr.push($(this).val());
    });
    var numberOfChecked = arr.length;
    if(numberOfChecked > 0){

    var status = $('#status_rts').val();

 if(status == ''){
         swal('ALERT','Select Status!','info'); 

   } else{

    $.ajax({
        url: '../../process/rts_processor.php',
        type: 'POST',
        cache: false,
        data:{
            method: 'update_rts',
            id:arr,
            status:status
      
            
        },success:function(response) {
            console.log(response);
            if (response == 'success') {
             load_list_of_audited_findings_rts();
             uncheck_all();
                swal('SUCCESS!', 'Success', 'success');
                $('#status_rts').val('');
            }else{
                swal('FAILED', 'FAILED', 'error');
            }
        }
    });
   }
}
}
</script>