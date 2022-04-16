<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><img src="<?php echo base_url('assets/icons/change-password-black.png'); ?>" class="sidebar_icons" /> Change Password</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('agent/dashboard')?>">Dashboard</a></li>
              <li class="breadcrumb-item active">Change Password</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
         
          <?php echo load_alert()?>
          
            <div class="card">
              
              <!-- /.card-header -->
              <div class="card-body">
              
              <form action="" method="POST">
                <div class="card-body">
                  
                  <div class="form-group">
                    <label for="name">Current Password <span class="text-danger">*</span></label>
                    <input type="password" name="oldpassword" class="form-control" id="oldpassword" placeholder="" data-validation="server" data-validation-url="<?php echo base_url('agent/dashboard/checkPassword')?>">
                  </div>
                  <div class="form-group">
                    <label for="name">New Password <span class="text-danger">*</span></label>
                    <input type="password" name="pass_confirmation" class="form-control" id="password" placeholder="Password" data-validation="length" data-validation-length="min6">
                  </div>
                  <div class="form-group">
                    <label for="name">Confirm Password <span class="text-danger">*</span></label>
                    <input type="password" name="pass" class="form-control" id="pass" placeholder="Confirm Password" data-validation="confirmation">
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

           
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
