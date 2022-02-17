
<?php include 'plugins/navbar.php';?>
<?php include 'plugins/sidebar/list_of_auditbar.php';?>

<section class="content">
      <div class="container-fluid">
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">List of Audit Findings</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">List of Audit Findings</li>
            </ol>
          </div>
          <div class="col-sm-6">
              <div class="row">
                    <div class="col-4">
                <label for="">Audited Date From:</label> <input type="date" id="auditeddatefrom" class="form-control" value="<?=$server_month;?>" autocomplete=off>
                    </div>
                    <div class="col-4">
                <label for="">Audited Date To:</label>  <input type="date" id="auditeddateto" class="form-control" value="<?=$server_date_only;?>" autocomplete=off> 
                  </div>
                 
          </div>
          <!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
       <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                		<div class="row">
 						<table>
 							<tr>
 								<th>
 									<div class="row">
 										<div class="col-4">
 								 <span>Employee ID: </span>
                  <input type="text" name="empid" id="empid" class="form-control">
 										</div>
 										<div class="col-4">
 							<span>Full Name: </span>
                  <input type="text" name="fname" id="fname" class="form-control">
                  </div>
                  <div class="col-4">
              <span>Line No: </span>
                  <input type="text" name="linen" id="linen" class="form-control">
                  </div>
 								</th>
 								</div>
 								</div>
 							
                <th>
                </th>
 								<th>
 									<div class="row">

 									<div class="col-5">
 							<span style="color: white;">a</span>
 							<button class="btn btn-info" data-toggle="modal" data-target="#count">Count</button>
 									</div>
                  <div class="col-5">
              <span style="color: white;">a</span>
              <button class="btn btn-success" onclick="export_audit_list('audit_list_data')">Export</button>
                  </div>
 									</div>
 							
                  
                  </div>
                </th>
 							</tr>

 						
 						</table>
 					</div>
                </h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 100px;">
                    <button class="btn btn-primary" id="searchReqBtn" onclick="load_list_of_audit_findings()">Search <i class="fas fa-search"></i></button> 
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 420px;">
                <table class="table table-head-fixed text-nowrap table-hover" id="audit_list_data">
                 <thead>
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
                    <th style="text-align:center;">Concerned Group</th>              
                    <th style="text-align:center;">AGENCY Status</th> 
                    <th style="text-align:center;">HR Status</th> 

                </thead>
                <tbody id="audit_data" style="text-align:center;"></tbody>
                </table>
                <div class="row">
                  <div class="col-6">
                    
                  </div>
                  <div class="col-6">
                      <input type="hidden" name="" id="audit_data">
   
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
<?php include 'plugins/script/list_of_audit_script.php'; ?>