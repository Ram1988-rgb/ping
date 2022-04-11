<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><i class="fas fa-address-book"></i> <?php echo $this->lang->line('Verified Contact')?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo base_url('user/dashboard')?>"><?php echo $this->lang->line('Dashboard')?></a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url('user/home')?>"><?php echo $this->lang->line('Profile')?></a></li>
              <li class="breadcrumb-item active"><?php echo $this->lang->line('Contact')?></li>
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
              <form id="contactForm" action="" method="POST">
               <div class="card-header">
                   <h4 class="theme_heading mb-0"><?php echo $this->lang->line('Please enter your mobile number')?></h4>
               </div>
                <div class="card-body">
                  <div class="form-group">
                    <label for="name"><?php echo $this->lang->line('Phone Number')?> <span class="text-danger">*</span></label>					
                    <input type="text" name="phone" id="phone" class="form-control allow_only_number" placeholder="<?php echo $this->lang->line('Phone Number')?>" data-validation="required,number,length" data-validation-length="min10" >
                </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary"><?php echo $this->lang->line('Get Verified')?></button>
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
