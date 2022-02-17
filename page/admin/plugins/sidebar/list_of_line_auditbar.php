  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="../../dist/img/i.png" alt="TRS Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><?=$esection;?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../../dist/img/user.png" class="img-circle elevation-2" alt="User Image">

        </div>
        <div class="info">
          <a href="#" class="d-block"><?=$username;?></a>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">

        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item">
            <a href="dashboard.php" class="nav-link">
              <i class="fas fa-chalkboard"></i>
              <p>
                Dashboard
               
              </p>
            </a>
          </li>
            <li class="nav-item menu-close">
            <a href="#" class="nav-link">
              <i class="  fa fa-edit"></i>
              <p>
                Audit Findings
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="add_audit.php" class="nav-link">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p> Add Audit Findings</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="add_line_audit.php" class="nav-link ">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p> Add Line Audit Findings</p>
                </a>
              </li>
            </ul>
          </li>
            <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="fas fa-tasks"></i>
              <p>
                List of Audit Findings
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="list_of_audit.php" class="nav-link ">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>Audit Findings</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="list_of_line_audit.php" class="nav-link active">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>Line Audit Findings</p>
                </a>
              </li>
            </ul>
          </li>
          
           
          </li>  
         <?php include 'logout.php' ;?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
