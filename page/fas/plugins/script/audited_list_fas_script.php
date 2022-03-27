<script type="text/javascript">
$(document).ready(function(){
    counts();
});	

const counts =()=>{
        var server_date = document.getElementById('server_date').value;
        var car_maker = document.getElementById('carmakers').value;
        var esection = '<?$esection;?>';
        var section = document.getElementById('count_section').value;

        console.log(car_maker);
        $.ajax({
                url: '../../process/provider_processor.php',
                type: 'POST',
                cache: false,
                data:{
                    method: 'count_for_update_fas',
                    server_date:server_date,
                    car_maker:car_maker,
                    esection:esection,
                    section:section
                    
                },success:function(response){
                    // console.log(response);
                    document.getElementById('count_for_update_data_fas').innerHTML = response;   
               
                }
            });
}
 
const load_list_of_audited_findings_fas =()=>{
    $('#spinner').css('display','block');
     var empid = document.getElementById('empid_audited_fas').value;
     var fname = document.getElementById('fname_audited_fas').value;
     var lname = document.getElementById('linename_audited_fas').value;
     var dateFrom = document.getElementById('providerauditedlistfasdatefrom').value;
     var dateTo = document.getElementById('providerauditedlistfasdateto').value;
     var esection = '<?=$esection;?>';
     var carmaker = document.getElementById('carmaker').value;
     var carmodel = document.getElementById('carmodel').value;
     var section = document.getElementById('section').value;
     var audit_type = document.getElementById('audit_type').value;
     var position = document.getElementById('position').value;
                $.ajax({
                url: '../../process/provider_processor.php',
                type: 'POST',
                cache: false,
                data:{ 
                    method: 'fetch_audited_list_fas',
                    dateFrom:dateFrom,
					dateTo:dateTo,
                    empid:empid,
                    fname:fname,
                    esection:esection,
                    lname:lname,
                    carmaker:carmaker,
                    carmodel:carmodel,
                    section:section,
                    audit_type:audit_type,
                    position:position
                    
                },success:function(response){
                    // console.log(response);
                    document.getElementById('audited_data_fas').innerHTML = response;
                    $('#spinner').fadeOut(function(){
                        
                    });
               
               
                }
            });
   
}	

function export_audited_list_fas(table_id, separator = ',') {
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
    var filename = 'FAS_List_of_Audited_Findings'+ '_' + new Date().toLocaleDateString() + '.csv';
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
    var select_all = document.getElementById('check_all_fas');
    select_all.checked = false;
    $('.singleCheck').each(function(){
        this.checked=false;
    });
}
const select_all_func =()=>{
    var select_all = document.getElementById('check_all_fas');
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


const update_status_fas =()=>{
   var arr = [];
    $('input.singleCheck:checkbox:checked').each(function () {
        arr.push($(this).val());
    });
    var numberOfChecked = arr.length;
    if(numberOfChecked > 0){

    var status = $('#status_fas').val();

 if(status == ''){
         swal('ALERT','Select Status!','info'); 

   } else{ 

    $.ajax({
        url: '../../process/provider_processor.php',
        type: 'POST',
        cache: false,
        data:{
            method: 'update_fas',
            id:arr,
            status:status
      
            
        },success:function(response) {
            console.log(response);
            if (response == 'success') {
             load_list_of_audited_findings_fas();
             counts();
             uncheck_all();
                swal('SUCCESS!', 'Success', 'success');
                $('#status_fas').val('');
            }else{
                swal('FAILED', 'FAILED', 'error');
            }
        }
    });
   }
}
}

</script>