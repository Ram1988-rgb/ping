<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><i class="fas fa-envelope"></i> <?php echo $this->lang->line('Verify')?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo base_url('user/dashboard')?>"><?php echo $this->lang->line('Dashboard')?></a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url('user/home')?>"><?php echo $this->lang->line('Profile')?></a></li>
              <li class="breadcrumb-item active"><?php echo $this->lang->line('Verify')?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

   <!-- Main content -->
   <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">              
              <!-- /.card-header -->
              <?php echo load_alert();?>
              <!-- form start -->
              <form id="verify_contact" action="" method="POST">
                <div class="card-header">
                        <h4 class="theme_heading mb-0"><?php echo $this->lang->line('Why do your Email verified')?></h4>
                </div>
                <div class="card-body">
                    <div class="form-group email-head">
                        <div class="alert alert-warning"><i class="fas fa-exclamation-triangle"></i> To protect your Nuvest account, your email address must be verified.</div>
                    </div>
                  <div class="form-group">
                    <label for="name"><?php echo $this->lang->line('Email Address')?></label>					
                    <input type="text" name="email" id="email" class="form-control" placeholder="<?php echo $this->lang->line('Email Address')?>" data-validation="email">
                </div>
                
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary submit_verify_contact"><?php echo $this->lang->line('Send')?></button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 
