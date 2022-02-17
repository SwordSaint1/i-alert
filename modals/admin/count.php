<div class="modal fade" id="count" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel"><b>Count Audit Findings</b></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="javascript:window.location.reload()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="row">
                <div class="col-sm-6">
                  <label>Employee ID:</label>  <input type="text" id="employee_num_count" name="employee_num_count" class="form-control">        
                </div>
                <div class="col-sm-6">
                  <label>Full Name:</label>  <input type="text" id="full_name_count" name="full_name_count" class="form-control">        
                </div>
          </div>
           </div>

           <div class="row">
            <div class="col-12">
              <div class="card">
  <div class="card-body">
    <h5 class="card-title">
    </h5>
    <div class="row">
      <div class="col-3">
       <label> No of Audit:</label>
      </div>
      <div class="col-6 float-sm-left" id="count_data">
        
      </div>
    </div>
  
  </div>
</div>
</div>
           </div>

      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" class="close" data-dismiss="modal" onclick="javascript:window.location.reload()">Close</button>
        <button class="btn btn-primary" onclick="count()">Proceed</button>
      </div>
  </div>
</div>