<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><img src="<?php echo base_url('assets/icons/person_black.png'); ?>" class="sidebar_icons" /> Agent</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard')?>">Home</a></li>
              <li class="breadcrumb-item active">Agent</li>
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
                    <label for="name">Name<span class="validate-star">*</span></label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter Name" data-validation="required">
                  </div>
                  <div class="form-group">
                    <label for="gender">Gender<span class="validate-star">*</span></label>
                    <select name="gender" class="form-control" data-validation="required">
                      <option value="">Select Gender</option>
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                    </select>
                  </div>
                  <div class="form-group" style="display:none">
                    <label for="dob">Date of Birth<span class="validate-star">*</span></label>
                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                      <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker" >
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                        <input type="text" name="dob" id="dob" placeholder="e.g. 08/31/2021" class="form-control datetimepicker-input" data-target="#reservationdate"  data-validation="required">
                        
                    </div>
                  </div>
                  <input type="hidden" name="dob" id="dob" placeholder="e.g. 08/31/2021" class="form-control datetimepicker-input" data-target="#reservationdate"  data-validation="required">
                        
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email Address<span class="validate-star">*</span></label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" data-validation="email">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password<<span class="validate-star">*</span></label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" data-validation="required">
                  </div>
                  <div class="form-group">
                    <label for="phone">Phone<span class="validate-star">*</span></label>
                    <input type="text" name="phone" class="form-control allow_only_number" id="phone" placeholder="Enter Phone No" data-validation="required,number">
                  </div>
                  <div class="form-group">
                    <label for="phone">Address</label>
                    <textarea name="address" class="form-control" id="address" placeholder="Address"></textarea>
                  </div>
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
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