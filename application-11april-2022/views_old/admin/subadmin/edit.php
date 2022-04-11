<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><img src="<?php echo base_url('assets/icons/plan-black.png'); ?>" class="sidebar_icons" />Edit Subadmin</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard')?>">Home</a></li>
              <li class="breadcrumb-item active">Edit Subadmin</li>
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
              <form id="addplanData" action="" method="POST">
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Name<span class="validate-star">*</span> </label>
                    <input type="text" name="name" value="<?php echo $record->first_name?>" class="form-control" id="name" placeholder="Enter Name" data-validation="required">
                  
                  </div>
                  <div class="form-group">
                    <label for="name">Email<span class="validate-star">*</span> </label>
                    <input type="text" name="email" value="<?php echo $record->emailId?>" class="form-control" id="email" placeholder="Enter Name" data-validation="required">
                  </div>
                 
                  <div class="form-group">
                    <label for="name">Mobile<span class="validate-star">*</span> </label>
                    <input type="text" name="mobile" value="<?php echo $record->mobile?>" class="form-control allow_only_number" id="mobile" placeholder="Enter Name" data-validation="required, number">
                  
                  </div>
                  <div class="form-group">
                    <label for="name">Password<span class="validate-star">*</span> </label>
                    <input type="text" name="password" class="form-control" id="password" placeholder="Enter Name" >
                  
                  </div>
                </div>
                <h2>Module Permission</h2>
                <table class="table">
                  <tr>
                    <th> Module</th>
                    <th>Permission</th>
                  </tr>
                  <?php foreach ($all_module as $line){
                     $check =  $this->admin_model->check_module_permission($record->id,$line->id);
                    ?>
                    <tr>
                      <td><?php echo $line->label?></td>
                      <td><input type="checkbox" <?php if($check){?>checked="checked"<?php }?> name="permission[<?php echo $line->id?>]" value="1"></td>
                    </tr>
                  <?php }?>
                </table>
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
  