<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><img src="<?php echo base_url('assets/icons/person_black.png'); ?>" class="sidebar_icons" /> Edit Customer</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard')?>">Home</a></li>
              <li class="breadcrumb-item"><a href="<?php echo site_url('admin/user')?>">Customer</a></li>
              <li class="breadcrumb-item active">Edit</li>
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
              <form id="edituser" action="" method="POST">
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Name<span class="validate-star">*</span></label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter Name" value="<?php echo $userDetail->name?$userDetail->name:''; ?>" data-validation="required">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address<span class="validate-star">*</span></label>
                    <input type="email" name="email" class="form-control" <?php if($userDetail->verify_email ==1){?>disabled<?php }?> id="exampleInputEmail1" placeholder="Enter email" value="<?php echo $userDetail->email?$userDetail->email:''; ?>" data-validation="required,email">
                  </div>
                  <div class="form-group">
                    <label for="phone">Phone<span class="validate-star">*</span></label>                    
                    <input type="text" <?php if($userDetail->verify_phone ==1){?>disabled<?php }?> name="phone" class="form-control allow_only_number" id="phone" placeholder="Enter Phone No" value="<?php echo $userDetail->phone?$userDetail->phone:''; ?>" data-validation="required,number">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Refer Friend</label>
                    <input type="text" name="refer_friend" class="form-control" id="refer_friend" placeholder="Refer Friend" value="<?php echo $userDetail->refer_friend?$userDetail->refer_friend:''; ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Hear About Us</label>
                    <input type="text" name="hear_about_us" class="form-control" id="hear_about_us" placeholder="How Did You Hear About Us?" value="<?php echo $userDetail->hear_about_us?$userDetail->hear_about_us:''; ?>">
                  </div>
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
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