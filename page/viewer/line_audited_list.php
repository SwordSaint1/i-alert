
<?php include 'plugins/navbar.php';?>
<?php include 'plugins/sidebar/line_audited_listbar.php';?>

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
          </div><!-- /.col -->
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
                    <div class="col-6">
                <span for="">Audited Date From:</span> <input type="date" id="line_auditeddatefrom" class="form-control" value="<?=$server_month;?>" autocomplete=off>
                    </div>
                    <div class="col-6">
                <span for="">Audited Date To:</span>  <input type="date" id="line_auditeddateto" class="form-control" value="<?=$server_date_only;?>" autocomplete=off> 

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
                </th>
                <th>
                </th>
                <th>
                </th>
                <th>
                  <div class="row">
                    <div class="col-12">
                      <span>Line No:</span>
                      <input type="text" name="line_n_audited" id="line_n_audited" class="form-control">
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
                <th>
                  <div class="row">

                  <div class="col-5">
              <span style="color: white;">a</span>
              <button class="btn btn-success" onclick="export_Line_audited_list('line_audited_list_data')">Export</button>
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
                    <button class="btn btn-primary" id="searchReqBtn" onclick="load_list_of_line_audited_findings()">Search <i class="fas fa-search"></i></button> 
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 420px;">
                <table class="table table-head-fixed text-nowrap table-hover" id="line_audited_list_data">
                 <thead>
                    <th style="text-align:center;">#</th>
                    <th style="text-align:center; display: none;">Audit Code:</th>
                    <th style="text-align:center;">Date Audited</th>
                    <th style="text-align:center;">Group</th>
                    <th style="text-align:center;">Car Maker</th>
                    <th style="text-align:center;">Car Model</th>
                    <th style="text-align:center;">Line No.</th>
                    <th style="text-align:center;">Process</th>
                    <th style="text-align:center;">Audit Findings</th>
                    <th style="text-align:center;">Audited By</th>
                    <th style="text-align:center;">Audit Category</th>
                    <th style="text-align:center;">Remarks</th> 
                   

                </thead>
                <tbody id="line_audited_data" style="text-align:center;"></tbody>
                </table>
                <div class="row">
                  <div class="col-6">
                    
                  </div>
                  <div class="col-6">
                      <input type="hidden" name="" id="line_audited_data">
   
                    <div class="spinner_line_audited" id="spinner_line_audited" style="display:none;">
                        
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
<?php include 'plugins/script/list_of_line_audited_list_script.php'; ?>