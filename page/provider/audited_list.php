<?php include 'plugins/navbar.php';?>
<?php include 'plugins/sidebar/audited_listbar.php';?>

<section class="content">
      <div class="container-fluid">
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">List of Audited</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">List of Audited</li>
            </ol>
          </div>
           <div class="col-sm-6">
              <div class="row">
                    <div class="col-6">
                <label for="">Audited Date From:</label> <input type="date" id="providerauditedlistdatefrom" class="form-control" value="<?=$server_month;?>" autocomplete=off>
                    </div>
                    <div class="col-6">
                <label for="">Audited Date To:</label>  <input type="date" id="providerauditedlistdateto" class="form-control" value="<?=$server_date_only;?>" autocomplete=off> 
                  </div>
          </div>
          <!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <div class="row">
      <div class="col-4">
       <label><h3 style="color: red;"><b>Pending:</b></h3></label>
       <input type="hidden" name="server_date" id="server_date" value="<?=$server_date_only;?>">
      </div>
      <div class="col-3 float-sm-left" id="count_for_update_data_provider">
        
      </div>
    </div>

                    <div class="row">
            <table>
              <tr>
                <th>
                  <div class="row">
                    <div class="col-4">
                <span>Employee ID: </span>
                  <input type="text" name="empid" id="empid_audited_provider" class="form-control">
                    </div>
                    <div class="col-4">
                  <span>Full Name: </span>
                  <input type="text" name="fname" id="fname_audited_provider" class="form-control">
                  </div>
                     <div class="col-4">
                <span for="">Line Name:</span>  <input type="text" id="linename_audited_prodivder" class="form-control" autocomplete=off> 
                  </div>
                </th>
                <th></th><th></th><th></th><th></th>
                 <th>
                  <div class="row">
                    <div class="col-4">
                <span>Car Maker: </span>
                  <input type="text" name="carmaker" id="carmaker" class="form-control">
                    </div>
                    <div class="col-4">
                  <span>Car Model: </span>
                  <input type="text" name="carmodel" id="carmodel" class="form-control">
                  </div>
                </th>
              
                </div>
              </tr>

             
            </table>
          </div>
                </h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 100px;">
                    <button class="btn btn-primary" id="searchReqBtn" onclick="load_list_of_audited_findings_provider()">Search <i class="fas fa-search"></i></button> 

                  </div>
                </div>
              </div>
               
                  <br>
              
              <!-- /.card-header -->
              <div class="row">
                
                <div class="col-12">
                  <table>
              <tr>
                <th>
                  <div class="row">
                    <div class="col-6">
                 <button class="btn btn-secondary" onclick="uncheck_all()">Uncheck</button>
                    </div>
                    <div class="col-6">
               <button class="btn btn-success " onclick="export_audited_list_provider('audited_list_data_provider')">Export</button>

                </th>
                </div>
                </div>
                <th>
                </th>
                <th>
                </th>
                <th>
                </th>
                <th>
                    <div class="row">

                  <div class="col-12">
                          
                          <select class="form-control" id="status_status">
                          <option value="">Select Status</option>
                          <option value="IR"> IR</option>
                          <option value="Written"> Written</option>
                          <option value="Verbal"> Verbal</option>
                        </select>
                  </div>
                
                  </div>
                </th>
                 <th>
                </th>
                <th>
                </th>
                <th>
                </th>
    
          <th> <div class="row">
                     <div class="col-12 float-sm-right">
                        <button class="btn btn-primary float-sm-right" onclick="update_status_status()">Update</button>
                  </div></th>
                </div>
        </table>
            
                 
             
              <br>
              <div class="card-body table-responsive p-0" style="height: 420px;">
                <table class="table table-head-fixed text-nowrap table-hover" id="audited_list_data_provider">
                 <thead>
                    <th style="text-align:center;">
                      <input type="checkbox" name="" id="check_all" onclick="select_all_func()">
                    </th>
                    <th style="text-align:center;">#</th>
                    <th style="text-align:center; display: none;">Audit Code:</th>
                    <th style="text-align:center;">Date Audited</th>
                    <th style="text-align:center;">Full Name</th>
                    <th style="text-align:center;">Employee ID</th>
                    <th style="text-align:center;">Provider</th>
                    <th style="text-align:center;">Group</th>
                    <th style="text-align:center;">Car Maker</th>
                    <th style="text-align:center;">Car Model</th>
                    <th style="text-align:center;">Line No.</th>
                    <th style="text-align:center;">Process</th>
                    <th style="text-align:center;">Audit Findings</th>
                    <th style="text-align:center;">Audited By</th>
                    <th style="text-align:center;">Audit Category</th>
                    <th style="text-align:center;">Remarks</th> 
                    <!-- <th style="text-align:center;">PD Status</th>       -->        
                    <th style="text-align:center;">AGENCY Status</th> 
                   <!--  <th style="text-align:center;">HR Status</th>  -->

                </thead>
                <tbody id="audited_data_provider" style="text-align:center;"></tbody>
                </table>
                <div class="row">
                  <div class="col-6">
                    
                  </div>
                  <div class="col-6">
                      <input type="hidden" name="" id="audited_data_provider">
   
                    <div class="spinner" id="spinner" style="display:none;">
                        
                        <div class="loader float-sm-center"></div>    
                    </div>
             
                  </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
</div>
</div>
</section>

 


<?php include 'plugins/footer.php';?>
<?php include 'plugins/script/audited_list_script.php'; ?>