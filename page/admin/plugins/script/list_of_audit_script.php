<script type="text/javascript">
	
 

const load_list_of_audit_findings =()=>{
    $('#spinner').css('display','block');
     var empid = document.getElementById('empid').value;
     var fname = document.getElementById('fname').value;
     var dateFrom = document.getElementById('auditeddatefrom').value;
     var dateTo = document.getElementById('auditeddateto').value;
     var line = document.getElementById('linen').value;
           $.ajax({
                url: '../../process/admin_processor.php',
                type: 'POST',
                cache: false,
                data:{
                    method: 'fetch_audit_list',
                    dateFrom:dateFrom,
					dateTo:dateTo,
                    empid:empid,
                    fname:fname,
                    line:line
                    
                },success:function(response){
                    // console.log(response);
                    document.getElementById('audit_data').innerHTML = response;
                    $('#spinner').fadeOut(function(){
                        
                    });
               
               
                }
            });
   
}	

function export_audit_list(table_id, separator = ',') {
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
    var filename = 'List_of_Audit_Findings'+ '_' + new Date().toLocaleDateString() + '.csv';
    var link = document.createElement('a');
    link.style.display = 'none';
    link.setAttribute('target', '_blank');
    link.setAttribute('href', 'data:text/csv;charset=utf-8,' + encodeURIComponent(csv_string));
    link.setAttribute('download', filename);
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}


const count =()=>{
      var employee_num_count = document.querySelector('#employee_num_count').value;
      var full_name_count = document.getElementById('full_name_count').value;
    // console.log(tangina);
    $.ajax({
        url:'../../process/admin_processor.php',
        type:'POST',
        cache:false,
        data:{
            method:'count_kana',
            employee_num_count:employee_num_count,
            full_name_count:full_name_count
        },success:function(response){
            $('#count_data').html(response);
        }
    });
}
</script>