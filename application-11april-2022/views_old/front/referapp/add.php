<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><img src="<?php echo base_url('assets/icons/ocal_offer_sale black.png'); ?>" class="sidebar_icons" /> Refer App <?php // echo $this->lang->line("Refer a Friend")?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('user/dashboard')?>"><?php echo $this->lang->line("Dashboard")?></a></li>
              <li class="breadcrumb-item active"><?php echo $this->lang->line("Refer a Friend")?></li>
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
              <form id="" action="" method="POST">
                <div class="card-body">
                  <div class="form-group">
                    <label for="name"><?php echo $this->lang->line("First Name")?></label><span class="validate-star">*</span> 
                    <input type="text" name="fname" class="form-control" id="fname" placeholder="<?php echo $this->lang->line("First name")?>" data-validation="required">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1"><?php echo $this->lang->line("Last Name")?></label>
                    <input type="text" name="lname" class="form-control" id="lname" placeholder="<?php echo $this->lang->line("Last name")?>" >
                  </div>
                  <div class="form-group">
                    <label for="email"><?php echo $this->lang->line("Email Address")?></label><span class="validate-star">*</span> 
                    <input type="email" name="email" class="form-control" id="email" placeholder="<?php echo $this->lang->line("Email Address")?>" data-validation="required,email">
                  </div>                  
                  <div class="form-group">
                    <label for="exampleInputEmail1"><?php echo $this->lang->line("Phone Number")?></label><span class="validate-star">*</span> 
                    <input type="text" name="phone" class="form-control allow_only_number" id="phone" placeholder="<?php echo $this->lang->line("Phone Number")?>" data-validation="required,number">
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Send</button>
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