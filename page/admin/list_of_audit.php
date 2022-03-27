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
                  <div class="col-4">
                      <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 100px;">
                    <button class="btn btn-primary" id="searchReqBtn" onclick="load_count()">Search <i class="fas fa-search"></i></button> 
                  </div>
                </div>
              </div>
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
                     <input type="hidden" name="server_date" id="server_date" value="<?=$server_date_only;?>">
  <div class="container-fluid">
        <div class="row">
          <div class="col-md-3 col-sm-6 col-12">
        <a href="" style="color:black;" data-toggle="modal" data-target="#sec1">    <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text"><b>Section 1</b></span>
                <span class="info-box-number"><label style="color:red;">Pending: <label id="count_sec1"></label></label></label>  /  <label>Total: <label id="grand_total"></label></label> </span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
        <a href="" style="color:black;" data-toggle="modal" data-target="#sec2">    <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text"><b>Section 2</b></span>
                <span class="info-box-number"><label style="color:red;">Pending: <label id="count_sec2"></label></label> / <label>Total: <label id="grand_total2"></label></label></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
      <a href="" style="color:black;" data-toggle="modal" data-target="#sec3">       <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text"><b>Section 3</b></span>
                <span class="info-box-number"><label style="color:red;">Pending: <label id="count_sec3"></label></label> / <label>Total: <label id="grand_total3"></label></label></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
       <a href="" style="color:black;" data-toggle="modal" data-target="#sec4">      <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text"><b>Section 4</b></span>
                <span class="info-box-number"><label style="color:red;">Pending: <label id="count_sec4"></label></label> / <label>Total: <label id="grand_total4"></label></label></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->


         <div class="row">
          <div class="col-md-3 col-sm-6 col-12">
   <a href="" style="color:black;" data-toggle="modal" data-target="#sec5">           <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                 <span class="info-box-text"><b>Section 5</b></span>
                <span class="info-box-number"><label style="color:red;">Pending: <label id="count_sec5"></label></label></label>  /  <label>Total: <label id="grand_total5"></label></label> </span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
     <a href="" style="color:black;" data-toggle="modal" data-target="#sec6">         <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text"><b>Section 6</b></span>
                <span class="info-box-number"><label style="color:red;">Pending: <label id="count_sec6"></label></label> / <label>Total: <label id="grand_total6"></label></label></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
      <a href="" style="color:black;" data-toggle="modal" data-target="#sec7">        <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text"><b>Section 7</b></span>
                <span class="info-box-number"><label style="color:red;">Pending: <label id="count_sec7"></label></label> / <label>Total: <label id="grand_total7"></label></label></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
        <a href="" style="color:black;" data-toggle="modal" data-target="#sec8">      <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text"><b>Section 8</b></span>
                <span class="info-box-number"><label style="color:red;">Pending: <label id="count_sec8"></label></label> / <label>Total: <label id="grand_total8"></label></label></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        
                   </div> 
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
            </th>
          </tr>
        </table>
      </div>
      <br>

        <div class="row">
                <table>
                  <tr>
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
                    <div class="col-4">
              <span>Position: </span>
                 <select id="position" class="form-control" autocomplete=off> 
                   <option value="">Select Position</option>
                        <option value="associate">Associate</option>
                        <option value="expert">Expert</option>
                        <option value="jr.staff">Jr. Staff</option>
                        <option value="staff">Staff</option>
                        <option value="supervisor">Supervisor</option>
                        <option value="assistant manager">Assistant Manager</option>
                        <option value="manager">Manager</option>
                        </select>
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
               <button class="btn btn-success " onclick="export_audit_list('audit_list_data')">Export</button>
                    </div>
                </th>
                <th>
                    <div class="row">

                  <div class="col-5">
              <button class="btn btn-info" data-toggle="modal" data-target="#count">Audit&nbsp;Count</button>
                  </div>
                </div>
                </th>
                <th>
                </th>
                <th>
                </th>
                <th>
                </th>
                 <th>
                </th>
                <th>
                </th>
                <th>
                </th>
    
          <th> <div class="row">
                     <div class="col-12 float-sm-right">
                        <button class="btn btn-danger float-sm-right" onclick="delete_audit()">Delete</button>
                  </div></th>
                </div>
              </th>
        </table>
      </div>
            </div>

                 
             
              <br>

              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 420px;">
                <table class="table table-head-fixed text-nowrap table-hover" id="audit_list_data">
                 <thead>
                    <th style="text-align:center;">
                      <input type="checkbox" name="" id="check_all_audit" onclick="select_all_func()">
                    </th>
                    <th style="text-align:center;">#</th>
                    <th style="text-align:center; display: none;">Audit Code:</th>
                    <th style="text-align:center;">Date Audited</th>
                    <th style="text-align:center;">Full Name</th>
                    <th style="text-align:center;">Position</th>
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