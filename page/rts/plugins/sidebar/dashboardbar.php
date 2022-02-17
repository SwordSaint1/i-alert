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
          <a href="#" class="d-block"><?=$role;?></a>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">

        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item">
            <a href="dashboard.php" class="nav-link active">
              <i class="fas fa-chalkboard"></i>
              <p>
                Dashboard
               
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="for_checking.php" class="nav-link">
              <i class=" fas fa-edit"></i>
              <p>
               For Checking Findings
              </p>
            </a>
          </li>
           <li class="nav-item">
            <a href="checked.php" class="nav-link">
              <i class=" fas fa-check"></i>
              <p>
                Checked Audit Findings
              </p>
            </a>
          </li>
           
          </li>  
         <?php include 'logout.php' ;?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
