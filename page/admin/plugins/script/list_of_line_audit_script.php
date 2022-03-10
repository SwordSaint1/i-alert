<script type="text/javascript">
	


const load_list_of_line_audit_findings =()=>{
    $('#spinner_line').css('display','block');
     var line_n = document.getElementById('line_n').value;
     var dateFrom = document.getElementById('lineauditeddatefrom').value;
     var dateTo = document.getElementById('lineauditeddateto').value;

           $.ajax({
                url: '../../process/admin_processor.php',
                type: 'POST',
                cache: false,
                data:{
                    method: 'fetch_line_audit_list',
                    dateFrom:dateFrom,
					dateTo:dateTo,
                    line_n:line_n
                    
                },success:function(response){
                    // console.log(response);
                    document.getElementById('line_audit_data').innerHTML = response;
                    $('#spinner_line').fadeOut(function(){
                        
                    });
               
               
                }
            });
   
}	

function export_Line_audit_list(table_id, separator = ',') {
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
    var filename = 'List_of_Line_Audit_Findings'+ '_' + new Date().toLocaleDateString() + '.csv';
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
    var select_all = document.getElementById('check_all_line');
    select_all.checked = false;
    $('.singleCheck').each(function(){
        this.checked=false;
    });
}
const select_all_func =()=>{
    var select_all = document.getElementById('check_all_line');
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

const delete_lineaudit =()=>{
   var arr = [];
    $('input.singleCheck:checkbox:checked').each(function () {
        arr.push($(this).val());
    });
    var numberOfChecked = arr.length;
    if(numberOfChecked > 0){


    $.ajax({
        url: '../../process/admin_processor.php',
        type: 'POST',
        cache: false,
        data:{
            method: 'deletelineaudit',
            id:arr
      
            
        },success:function(response) {
            console.log(response);
            if (response == 'success') {
             load_list_of_line_audit_findings();
             uncheck_all();
                swal('SUCCESS!', 'Success', 'success');
               
            }else{
                swal('FAILED', 'FAILED', 'error');
            }
        }
    });
   }
}

 const get_set_line =(param)=>{
    console.log(param);
     var data = param.split('~!~');
     var id = data[0];
     var shift = data[1];
     var groups = data[2];
     var date_audited = data[3];
     var car_maker = data[4];
     var car_model = data[5];
     var line_no = data[6];
     var process = data[7];
     var audit_findings = data[8];
     var audited_by = data[9];
     var audited_categ = data[10];
     var remarks = data[11];
     var audit_type = data[12];

      document.getElementById('id_line_update').value = id;
      document.getElementById('shift_line_update').value = shift;
      document.getElementById('group_line_update').value = groups;
      document.getElementById('date_line_audited_update').value = date_audited;
      document.getElementById('carmaker_line_update').value = car_maker;
      document.getElementById('carmodel_line_update').value = car_model;
      document.getElementById('emline_line_update').value = line_no;
      document.getElementById('process_line_update').value = process;
      document.getElementById('line_audit_findings_update').value = audit_findings;
      document.getElementById('line_audited_by_update').value = audited_by;
      document.getElementById('line_audit_categ_update').value = audited_categ;
      document.getElementById('remarks_line_update').value = remarks;
      document.getElementById('line_audit_type_update').value = audit_type;
}

const update_lineaudit =()=>{
  
   var id = document.getElementById('id_line_update').value;
   var shift = document.getElementById('shift_line_update').value;
   var groups = document.getElementById('group_line_update').value;
   var audit_type = document.getElementById('audit_type_update').value;
   var audit_categ = document.getElementById('line_audit_categ_update').value;
   var carmaker = document.getElementById('carmaker_line_update').value;
   var carmodel = document.getElementById('carmodel_line_update').value;
   var emline = document.getElementById('emline_line_update').value;
   var process = document.getElementById('process_line_update').value;
   var audit_findings = document.getElementById('line_audit_findings_update').value;
   var audited_by = document.getElementById('line_audited_by_update').value;
   var audit_type = document.getElementById('line_audit_type_update').value;
   var date_audited = document.getElementById('date_line_audited_update').value;
   var remarks = document.getElementById('remarks_line_update').value;

   console.log(groups);
    $.ajax({
        url: '../../process/admin_processor.php',
        type: 'POST',
        cache: false,
        data:{
            method: 'updatelineaudit',
            id:id,
            shift:shift,
            groups:groups,
            audit_type:audit_type,
            audit_categ:audit_categ,
            carmaker:carmaker,
            carmodel:carmodel,
            emline:emline,
            process:process,
            audit_findings:audit_findings,
            audited_by:audited_by,
            date_audited:date_audited,
            remarks:remarks,
            audit_type:audit_type
            
        },success:function(response) {
            console.log(response);
            if (response == 'success') {
             load_list_of_line_audit_findings();
             uncheck_all();
                swal('SUCCESS!', 'Success', 'success');
               
            }else{
                swal('FAILED', 'FAILED', 'error');
            }
        }
    });
   }

</script>