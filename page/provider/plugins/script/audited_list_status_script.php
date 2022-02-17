<script type="text/javascript">
	
const load_list_of_audited_findings_provider_status =()=>{
    $('#spinner').css('display','block');
     var empid = document.getElementById('empid_audited_provider_status').value;
     var fname = document.getElementById('fname_audited_provider_status').value;
     var dateFrom = document.getElementById('providerauditedliststatusdatefrom').value;
     var dateTo = document.getElementById('providerauditedliststatusdateto').value;
     var esection = '<?=$esection;?>';
     console.log();
     console.log();
           $.ajax({
                url: '../../process/provider_processor.php',
                type: 'POST',
                cache: false,
                data:{
                    method: 'fetch_audited_list_provider_status',
                    dateFrom:dateFrom,
					dateTo:dateTo,
                    empid:empid,
                    fname:fname,
                    esection:esection
                    
                },success:function(response){
                    // console.log(response);
                    document.getElementById('audited_data_provider_status').innerHTML = response;
                    $('#spinner').fadeOut(function(){
                        
                    });
               
               
                }
            });
   
}	

function export_audited_list_provider_status(table_id, separator = ',') {
    // Select rows from table_id
    var rows = document.querySelectorAll('table#' + table_id + ' tr');
    // Construct csv
    var csv = [];
    for (var i = 0; i < rows.length; i++) {
        var row = [], cols = rows[i].querySelectorAll('td, th');
        for (var j = 0; j < cols.length; j++) {
            var data = cols[j].innerText.replace(/(\r\n|\n|\r)/gm, '').replace(/(\s\s)/gm, ' ')
            data = data.replace(/"/g, '""');
            // Push escaped string
            row.push('"' + data + '"');
        }
        csv.push(row.join(separator));
    }
    var csv_string = csv.join('\n');
    // Download it
    var filename = 'Provider_List_of_Audited_Findings_With_Status'+ '_' + new Date().toLocaleDateString() + '.csv';
    var link = document.createElement('a');
    link.style.display = 'none';
    link.setAttribute('target', '_blank');
    link.setAttribute('href', 'data:text/csv;charset=utf-8,' + encodeURIComponent(csv_string));
    link.setAttribute('download', filename);
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

// check all and uncheck
const uncheck_all =()=>{
    var select_all = document.getElementById('check_all_status');
    select_all.checked = false;
    $('.singleCheck').each(function(){
        this.checked=false;
    });
}
const select_all_func =()=>{
    var select_all = document.getElementById('check_all_status');
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


const update_status =()=>{
   var arr = [];
    $('input.singleCheck:checkbox:checked').each(function () {
        arr.push($(this).val());
    });
    var numberOfChecked = arr.length;
    if(numberOfChecked > 0){

    var status = $('#status').val();

 if(status == ''){
         swal('ALERT','Select Status!','info'); 

   } else{

    $.ajax({
        url: '../../process/provider_processor.php',
        type: 'POST',
        cache: false,
        data:{
            method: 'update',
            id:arr,
            status:status
      
            
        },success:function(response) {
            console.log(response);
            if (response == 'success') {
             load_list_of_audited_findings_provider_status();
             uncheck_all();
                swal('SUCCESS!', 'Success', 'success');
                $('#status_status').val('');
            }else{
                swal('FAILED', 'FAILED', 'error');
            }
        }
    });
   }
}
}
</script>