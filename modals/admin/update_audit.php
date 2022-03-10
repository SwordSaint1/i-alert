<div class="modal fade bd-example-modal-xl" id="update" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
         <input type="hidden" name="id_update" id="id_update">

        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"  onclick="javascript:window.location.reload()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
           <div class="row">
                <div class="col-3">
                     <span> Employee No:   </span> <input type="text" id="employee_num_update" class="form-control-lg" onchange="detect_part_info()" autocomplete="OFF">
                </div>
                <div class="col-3">
                     <span> Full Name:   </span> <input type="text" id="full_name_update" class="form-control-lg" autocomplete="OFF" class="noSpace">
                </div>
                <div class="col-3">
                     <span> Position:   </span> <input type="text" id="position_update" class="form-control-lg"  autocomplete="OFF" class="noSpace">
                </div>
                 <div class="col-3">
                     <span> Provider:   </span> <input type="text" id="provider_update" class="form-control-lg"  autocomplete="OFF" class="noSpace">
                </div>
           </div>
           <div class="row">
                <div class="col-3">
                    <span>Shift:</span>
                 
                   <input list="shifts" id="shift_update" name="shift_update" class="form-control-lg">

<datalist id="shifts" name="">
           <option value="DS">
              <option value="NS">

</datalist>
                </div>
                <div class="col-3">
                     <span>Group:</span>
                     <input type="text" name="group_update" id="group_update" class="form-control">

                </div>
                <div class="col-3">
                   <span>Audit Type:</span>
               
                <input list="audit_typee" id="audit_type_update" name="audit_type_update" class="form-control-lg">

<datalist id="audit_typee" name="">
           <option value="Initial">
              <option value="Final">
                  <option value="Warehouse">
</datalist>
                </div>
                <div class="col-3">
                   <span>Audit Category:</span>
             

                  <input list="audit_categ" id="audit_categ_update" name="audit_categ_update" class="form-control-lg">

<datalist id="audit_categ" name="">
           <option value="Minor">
              <option value="Major">
</datalist>

                </div>
           </div>
           <div class="row">
                <div class="col-3">
                     <span> Car Maker:   </span> <input type="text" id="carmaker_update" class="form-control-lg" autocomplete="OFF" class="noSpace">
                </div>
                <div class="col-3">
                     <span> Car Model:   </span> <input type="text" id="carmodel_update" class="form-control-lg"  autocomplete="OFF" class="noSpace">
                </div>
                <div class="col-3">
                     <span> Line No:   </span> 

                       <input list="lines" id="emline_update" name="emline" class="form-control-lg">

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
                     <span> Process:   </span> <input type="text" id="process_update" class="form-control-lg" autocomplete="OFF" class="noSpace">
                </div>
           </div>
           <div class="row">
               <div class="col-3">
                   <span>Audit Findings:</span>
                   
                    <input list="audit_findingss" id="audit_findings_update" name="audit_findings" class="form-control">

<datalist id="audit_findingss" name="">
       <option value="">Select Audit Findings</option>
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
                   <input type="text" name="" id="audited_by_update" class="form-control-lg" autocomplete="OFF">
               </div>
               
               <div class="col-3">
                 <span>Date Audited:</span>
                    <input type="date" name="" id="date_audited_update" class="form-control">
                    
               </div>
               <div class="col-3">
                   <span>Remarks</span>
                   <input type="text" name="" id="remarks_update" class="form-control-lg" autocomplete="OFF">
               </div>
           </div>
         
           <br>
           <div class="row">
                        <div class="col-12">
                          <p style="text-align:right;">
                        <button type="button" class="btn btn-primary"  onclick="update_audit_data()" id="planBtnCreate">Update</button>
                          </p>
                        </div>
           </div>
      </div>
    
    </div>
  </div>
</div>

