<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?php echo $this->lang->line("Edit Profile")?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('user/dashboard')?>"><?php echo $this->lang->line("Dashbard")?></a></li>
              <li class="breadcrumb-item active"><?php echo $this->lang->line("Edit Profile")?></li>
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
              <form id="" action="" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="name"><?php echo $this->lang->line("Full Name")?></label>
                    <input type="text" name="name" class="form-control" id="fname" placeholder="<?php echo $this->lang->line("Name")?>" data-validation="required" value="<?php echo $userData->name;?>">
                  </div>
                  
                  <div class="form-group">
                    <label for="email"><?php echo $this->lang->line("Email")?></label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="<?php echo $this->lang->line("Email Address")?>" data-validation="required,email" value="<?php echo $userData->email;?>">
                  </div>                  
                  <div class="form-group">
                    <label for="exampleInputEmail1"><?php echo $this->lang->line("Phone Number")?></label>
                    <input type="text" name="phone" class="form-control allow_only_number" id="phone" placeholder="<?php echo $this->lang->line("Phone Number")?>" data-validation="required,number" value="<?php echo $userData->phone;?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1"><?php echo $this->lang->line("Date of Birth")?></label>
                    <input type="text" name="dob" class="form-control" id="" placeholder="<?php echo $this->lang->line("Date of Birth")?>" data-validation="required" value="<?php echo $userData->dob;?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1"><?php echo $this->lang->line("Address")?></label>
                    <input type="text" name="address" class="form-control" id="address" placeholder="<?php echo $this->lang->line("Address")?>" data-validation="required" value="<?php echo $userData->address;?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1"><?php echo $this->lang->line("Profile Image")?></label>
                    <?php if($userData->image) {?>
                      <img src="<?php echo SHOW_USER_IMAGE_THUMB.$userData->image?>">
                    <?php }?>
                    <input type="file" name="image" class="form-control" id="image" placeholder="<?php echo $this->lang->line("Profile Image")?>" >
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary"><?php echo $this->lang->line("Edit Profile")?></button>
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