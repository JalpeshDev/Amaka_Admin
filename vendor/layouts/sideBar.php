<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../index.php" class="brand-link">
      <img src="../dist/img/AppLogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">BOB</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        <?php if(isset($_SESSION['profileImage'])) { ?>
          <img src="<?php echo $baseUrlFile."/images/".$_SESSION['profileImage']; ?>" class="img-circle elevation-2" alt="User Image">
        <?php } elseif(isset($_SESSION['userDetails']['data']['pictureUrl'])){ ?>
          <img src="<?php echo $baseUrlFile."/images/".$_SESSION['userDetails']['data']['pictureUrl']; ?>" class="img-circle elevation-2" alt="User Image">
        <?php }else{ ?>
          <img src="https://mdbootstrap.com/img/Photos/Others/placeholder-avatar.webp" class="img-circle elevation-2" alt="User Image">
        <?php } ?>
        </div>
        <div class="info">
          <a href="../profile/profile" class="d-block"><?php echo $_SESSION['userDetails']['data']['firstName']; ?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <!-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="../index.php" class="nav-link">
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../serviceType/list" class="nav-link">
              
              <p>
              Service
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../vendorService/list" class="nav-link">              
              <p>
              Vendor Service
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../voucher/list" class="nav-link">              
              <p>
              Voucher
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../album/list" class="nav-link">              
              <p>
              Album
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../account/index" class="nav-link">              
              <p>
              Account
              </p>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Service
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../serviceType/add.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Service</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../layout/top-nav-sidebar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Service List</p>
                </a>
              </li>
            </ul>
          </li> -->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>