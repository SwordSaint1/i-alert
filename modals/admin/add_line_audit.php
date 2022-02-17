

<div class="modal fade bd-example-modal-xl" id="line_audit" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
            <div id="lineauditCode">
               
            </div>

        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"  onclick="javascript:window.location.reload()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
           <div class="row">
                <div class="col-3">
                    <span>Date Audited:</span>
                    <input type="date" name="" id="date_line_audited" class="form-control">
                </div>
                <div class="col-3">
                     <span>Group:</span>
                    <select class="form-control" id="group_line">
                        <option value="">Select Group</option>
                        <option value="a">A</option>
                        <option value="b">B</option>
                    </select>
                </div>
                <div class="col-3">
                     <span>Shift:</span>
                    <select class="form-control" id="shift_line">
                        <option value="">Select Shift</option>
                        <option value="ds">DS</option>
                        <option value="ns">NS</option>
                    </select>
                </div>
                <div class="col-3">
                     <span>Audit Category:</span>
                   <select class="form-control" id="line_audit_categ">
                        <option value="">Select Audit Category</option>
                        <option value="minor">Minor</option>
                        <option value="major">Major</option>
                    </select>
                </div>

            </div>   
           <div class="row">
                <div class="col-3">
                     <span> Car Maker:   </span> <input type="text" id="carmaker_line" class="form-control-lg" autocomplete="OFF" class="noSpace">
                </div>
                <div class="col-3">
                     <span> Car Model:   </span> <input type="text" id="carmodel_line" class="form-control-lg"  autocomplete="OFF" class="noSpace">
                </div>
                <div class="col-3">
                     <span> Line No:   </span> 
                      <input list="lines" id="emline_line" name="emline_line" class="form-control-lg">

<datalist id="lines" name="">
       <option value="">Select Line</option>
                      <?php
                            require '../../process/conn.php';
                            $line = "SELECT DISTINCT line_no FROM ialert_lines ORDER BY line_no ASC";

                         $stmt = $conn->prepare($line);
                         $stmt->execute();
            foreach($stmt->fetchALL() as $j){
      
                    echo '<option value="'.$j['line_no'].'">';
                                            
        }

        ?>

</datalist>
                </div>
                <div class="col-3">
                     <span> Process:   </span> <input type="text" id="process_line" class="form-control-lg" autocomplete="OFF" class="noSpace">
                </div>
           </div>
           <div class="row">
               <div class="col-3">
                   <span>Audit Findings:</span>
             <!--       <input type="text" name="" id="line_audit_findings" class="form-control-lg" autocomplete="OFF"> -->
                     <input list="audit_findingss" id="line_audit_findings" name="line_audit_findings" class="form-control">

<datalist id="audit_findingss" name="">
       <option value="">Select Line</option>
                      <?php
                            require '../../process/conn.php';
                            $audit_findingss = "SELECT DISTINCT audit_findings FROM ialert_audit_findings_categ";

                         $stmt = $conn->prepare($audit_findingss);
                         $stmt->execute();
            foreach($stmt->fetchALL() as $j){
      
                    echo '<option value="'.$j['audit_findings'].'">';
                                            
        }

        ?>

</datalist>
               </div>
               <div class="col-3">
                   <span>Audited By:</span>
                   <input type="text" name="" id="line_audited_by" class="form-control-lg" autocomplete="OFF">
               </div>
               <div class="col-3">
                 <span>Audit Type:</span>
                    <input type="text" name="" id="line_audit_type" class="form-control-lg" value="Line Audit" readonly>
                    
               </div>
               <div class="col-3">
                   <span>Remarks</span>
                   <input type="text" name="" id="remarks_line" class="form-control-lg" autocomplete="OFF">
               </div>
           </div>
         
           <br>
           <div class="row">
                        <div class="col-12">
                          <p style="text-align:right;">
                        <button type="button" class="btn btn-primary"  onclick="save_request_line()" id="planBtnCreate">Submit</button>

                         <!--  <button class="btn blue darken-3  col s12" onclick="save_request()" id="planBtnCreate">submit</button> -->
                          </p>
                        </div>
           </div>
      </div>
      <div class="modal-footer">

         <div class="card-body table-responsive p-0" style="height: 200px;">
       <table  class="table table-head-fixed text-nowrap table-hover" style="">
    <thead  style="text-align:center;">
                    <th>#</th>
                    <th>Date Audited</th>
                    <th>Shift</th>
                    <th>Group</th>
                    <th>Car Maker</th>
                    <th>Car Model</th>
                    <th>Line No</th>
                    <th>Process</th>
                    <th>Audit Findings</th>
                    <th>Audited By</th>
                    <th>Audit Category</th>
                    <th>Audit Type</th>
                    <th>Remarks</th>          
      
    </thead>
    <tbody id="data_preview_line_audit"></tbody>
</table>
</div>
      </div>
    </div>
  </div>
</div>

