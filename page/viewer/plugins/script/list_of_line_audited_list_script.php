<script type="text/javascript">
	


const load_list_of_line_audited_findings =()=>{
    $('#spinner_line_audited').css('display','block');
     var line_n = document.getElementById('line_n_audited').value;
     var dateFrom = document.getElementById('line_auditeddatefrom').value;
     var dateTo = document.getElementById('line_auditeddateto').value;

           $.ajax({
                url: '../../process/viewer_processor.php',
                type: 'POST',
                cache: false,
                data:{
                    method: 'fetch_line_audited_list',
                    dateFrom:dateFrom,
					dateTo:dateTo,
                    line_n:line_n
                    
                },success:function(response){
                    // console.log(response);
                    document.getElementById('line_audited_data').innerHTML = response;
                    $('#spinner_line_audited').fadeOut(function(){
                        
                    });
               
               
                }
            });
   
}	

function export_Line_audited_list(table_id, separator = ',') {
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
    var filename = 'List_of_Line_Audited_Findings'+ '_' + new Date().toLocaleDateString() + '.csv';
    var link = document.createElement('a');
    link.style.display = 'none';
    link.setAttribute('target', '_blank');
    link.setAttribute('href', 'data:text/csv;charset=utf-8,' + encodeURIComponent(csv_string));
    link.setAttribute('download', filename);
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

</script>