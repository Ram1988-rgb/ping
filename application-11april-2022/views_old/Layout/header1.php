<?php
  $module = $this->uri->segment(1, 0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php if($headTitle){ echo $headTitle; }else{?>Nuvest | Dashboard<?php }?></title>
  <?php if($this->router->fetch_class() !=''){?>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo ROUTE_STIE_PATH; ?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?php echo ROUTE_STIE_PATH; ?>assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo ROUTE_STIE_PATH; ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?php echo ROUTE_STIE_PATH; ?>assets/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo ROUTE_STIE_PATH; ?>assets/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo ROUTE_STIE_PATH; ?>assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo ROUTE_STIE_PATH; ?>assets/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo ROUTE_STIE_PATH; ?>assets/plugins/summernote/summernote-bs4.min.css">
  <?php }?>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">

  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo ROUTE_STIE_PATH; ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo ROUTE_STIE_PATH; ?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo ROUTE_STIE_PATH; ?>assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  
  <link rel="stylesheet" href="<?php echo ROUTE_STIE_PATH; ?>assets/dist/css/custom.css">
  
<script>
  var baseURL = "<?php echo base_url();?>";
</script>

  <script src="<?php echo ROUTE_STIE_PATH; ?>assets/plugins/jquery/jquery.min.js"></script>
  <script src="<?php echo ROUTE_STIE_PATH; ?>assets/js/custom.js"></script>
  <script src="<?php echo ROUTE_STIE_PATH; ?>assets/js/notification.js"></script>
<!-- SweetAlert2 -->
<script src="<?php echo ROUTE_STIE_PATH; ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<script>
$(function () {
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
})
</script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class=" flex-column justify-content-center align-items-center loader_loader">
    <img class="animation__shake" src="<?php echo ROUTE_STIE_PATH; ?>assets/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <!-- <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a> -->
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-bell"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="<?php echo ROUTE_STIE_PATH; ?>assets/dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="<?php echo ROUTE_STIE_PATH; ?>assets/dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="<?php echo ROUTE_STIE_PATH; ?>assets/dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
	  <li class="nav-item"> 
	    <a class="nav-link"  href="<?php echo base_url($module); ?>/dashboard/logout">
          <i class="fa fa-sign-out-alt"></i> Logout 
        </a>
    </li>
      <!-- Notifications Dropdown Menu -->
	  <!---
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>-->
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
      <img src="<?php echo ROUTE_STIE_PATH; ?>assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Nuvest</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      

      <!-- SidebarSearch Form 
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>-->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
         
          <?php if($module == "admin"){?>
            <li class="nav-item menu-open">
            <a href="<?php echo base_url($module)?>/dashboard/index" class="nav-link <?php if($this->router->fetch_class() =='dashboard'){?>active<?php }?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>            
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('admin')?>/user" class="nav-link <?php if($this->router->fetch_class() =='user'){?>active<?php }?>">
              <i class="fa fa-user"></i>
              <p> User</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('admin')?>/cash" class="nav-link <?php if($this->router->fetch_class() =='cash'){?>active<?php }?>">
              <i class="fas fa-wallet"></i>
              <p> Cash</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('admin')?>/paymenttype" class="nav-link <?php if($this->router->fetch_class() =='paymenttype'){?>active<?php }?>">
              <i class="far fa-credit-card"></i>
              <p> Payment Type</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('admin')?>/paymentduration" class="nav-link <?php if($this->router->fetch_class() =='paymentduration'){?>active<?php }?>">
              <i class="far fa-calendar-alt"></i>
              <p> Payment Duration</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('admin/')?>plan" class="nav-link <?php if($this->router->fetch_class() =='plan'){?>active<?php }?>">
              <i class="fas fa-chart-pie"></i>
              <p> Plan</p>
            </a>
          </li>
           <li class="nav-item">
            <a href="<?php echo base_url('admin/')?>loan" class="nav-link <?php if($this->router->fetch_class() =='loan'){?>active<?php }?>">
              <i class="fas fa-balance-scale"></i>
              <p> Loan</p>
            </a>            
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('admin/')?>fund" class="nav-link <?php if($this->router->fetch_class() =='fund'){?>active<?php }?>">
              <i class="fas fa-file-invoice-dollar"></i>
              <p> Manage Fund</p>
            </a>            
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('admin/')?>investment" class="nav-link <?php if($this->router->fetch_class() =='investment'){?>active<?php }?>">
              <i class="fas fa-hand-holding-usd"></i>
              <p> Investment</p>
            </a>            
          </li>
          
          <li class="nav-item">
            <a href="<?php echo base_url($module)?>/referapp/index" class="nav-link <?php if($this->router->fetch_class() =='1'){?>active<?php }?>">
              <i class="fas fa-user-friends"></i>
              <p>Refer Friend</p>
            </a>            
          </li>
          <li class="nav-item">
			<a href="<?php echo base_url($module); ?>/dashboard/logout" class="nav-link <?php if($this->router->fetch_class() =='cash'){?>active<?php }?>">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>Logout</p>
            </a>
          </li>
          <?php }?>
          
          
          
          <?php if($module == "user"){?>
          <li class="nav-item menu-open">
            <a href="<?php echo base_url($module)?>/dashboard/index" class="nav-link <?php if($this->router->fetch_class() =='dashboard'){?>active<?php }?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>            
          </li>
          <li class="nav-item menu-open">
            <a href="<?php echo base_url($module)?>/home/index" class="nav-link <?php if($this->router->fetch_class() =='home'){?>active<?php }?>">
              <i class="fas fa-user"></i>
              <p>Profile</p>
            </a>            
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url($module)?>/cash" class="nav-link <?php if($this->router->fetch_class() =='cash'){?>active<?php }?>">
              <i class="fas fa-wallet"></i>
              <p>Cash</p>
            </a>            
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url($module)?>/fund" class="nav-link <?php if($this->router->fetch_class() =='fund'){?>active<?php }?>">
              <i class="fas fa-file-invoice-dollar"></i>
              <p>Fund</p>
            </a>            
          </li>
         
          <li class="nav-item <?php if($this->router->fetch_class() =='investment'){?>menu-is-opening menu-open<?php }?>" >
            <a href="#" class="nav-link">
            <i class="fas fa-hand-holding-usd"></i>
              <p>
                Manage Investment
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
              <a href="<?php echo base_url($module)?>/investment" class="nav-link <?php if($this->router->fetch_class() =='investment' && $this->router->fetch_method() =='index'){?>active<?php }?>">
             
                <i class="fas fa-hand-holding-usd"></i>
                  <p>Investment</p>
                </a>
              </li>
              <li class="nav-item">
              <a href="<?php echo base_url($module)?>/investment/myinvestment" class="nav-link <?php if($this->router->fetch_method() =='myinvestment'){?>active<?php }?>">
             
              <i class="fas fa-hand-holding-usd"></i>
                  <p>My Investment</p>
                </a>
              </li>              
            </ul>
          </li>

          <li class="nav-item <?php if($this->router->fetch_class() =='loan'){?>menu-is-opening menu-open<?php }?>" >
            <a href="#" class="nav-link">
            <i class="fas fa-balance-scale"></i>
              <p>
                Manage Loan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
              <a href="<?php echo base_url($module)?>/loan/index" class="nav-link <?php if($this->router->fetch_class() =='loan' && $this->router->fetch_method() =='index'){?>active<?php }?>">
             
              <i class="fas fa-balance-scale"></i>
                  <p>Loan</p>
                </a>
              </li>
              <li class="nav-item">
              <a href="<?php echo base_url($module)?>/loan//myloan" class="nav-link <?php if($this->router->fetch_method() =='myloan'){?>active<?php }?>">
             
              <i class="fas fa-balance-scale"></i>
                  <p>My Loan</p>
                </a>
              </li>              
            </ul>
          </li>
         
          <!-- <li class="nav-item">
            <a href="<?php echo base_url($module)?>/loan/index" class="nav-link <?php if($this->router->fetch_class() =='1'){?>active<?php }?>">
              <i class="fas fa-balance-scale"></i>
              <p>Loan</p>
            </a>            
          </li>
         <li class="nav-item">
            <a href="<?php echo base_url($module)?>/cash/index" class="nav-link <?php if($this->router->fetch_class() =='1'){?>active<?php }?>">
              <i class="nav-icon fas fa-comments-dollar"></i>
              <p>Transfer</p>
            </a>            
          </li>-->
          <li class="nav-item">
            <a href="<?php echo base_url($module)?>/notification" class="nav-link <?php if($this->router->fetch_class() =='1'){?>active<?php }?>">
              <i class="fas fa-bell"></i>
              <p>Notification</p>
            </a>            
          </li>
         <li class="nav-item">
            <a href="<?php echo base_url($module)?>/dashboard/summary" class="nav-link <?php if($this->router->fetch_class() =='history'){?>active<?php }?>">
              <i class="fas fa-history"></i>
              <p>History</p>
            </a>            
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url($module)?>/referapp/index" class="nav-link <?php if($this->router->fetch_class() =='1'){?>active<?php }?>">
              <i class="fas fa-user-friends"></i>
              <p>Refer Friend</p>
            </a>            
          </li>
         <!-- <li class="nav-item">
            <a href="<?php echo base_url($module)?>/cash/index" class="nav-link <?php if($this->router->fetch_class() =='1'){?>active<?php }?>">
              <i class="nav-icon fas fa-file-invoice-dollar"></i>
              <p>Account Report</p>
            </a>            
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url($module)?>/cash/index" class="nav-link <?php if($this->router->fetch_class() =='1'){?>active<?php }?>">
              <i class="nav-icon fas fa-cog"></i>
              <p>Setting</p>
            </a>            
          </li>-->
          <li class="nav-item">
            <a href="<?php echo base_url($module); ?>/dashboard/logout" class="nav-link <?php if($this->router->fetch_class() =='logout'){?>active<?php }?>">
              <i class="fas fa-sign-out-alt"></i>
              <p>Logout</p>
            </a>            
          </li>
          <?php }?>
          
         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
