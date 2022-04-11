<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><img src="<?php echo base_url('assets/icons/person_black.png'); ?>" class="sidebar_icons" /> Agent Fund</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard')?>">Home</a></li>
              <li class="breadcrumb-item active">Agent Fund</li>
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
              <form id="" action="" method="POST" enctype='multipart/form-data'>
                <div class="card-body">
                  
                  <div class="form-group">
                    <label for="gender">Agent <?php echo CURRENCY;?><span class="validate-star">*</span></label>
                    <select name="agent_id" id="agent_id" class="form-control" data-validation="required">
                      <option value="">Select Agent</option>
                      <?php 
                        if($all_agent){
                          foreach($all_agent as $line){
                      ?>
                        <option value="<?php echo $line->id?>"><?php echo $line->name?>(<?php echo $line->email?>)</option>
                      <?php 
                        }
                      }
                      ?>
                    </select>
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Fund Amount<span class="validate-star">*</span></label>
                    <input type="text" name="amount" class="form-control" id="amount" placeholder="Amount" data-validation="required,number">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Remark</label>
                    <textarea class="form-control" name="remark"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Documnet slip</label>
                    <input type="file" name="document" class="form-control" id="document" placeholder="" accept="image/x-png,image/gif,image/jpeg,application/pdf">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Fund date<span class="validate-star">*</span></label>
                    <input type="text " name="fund_date" class="form-control alldate" id="fund_date" placeholder="Amount" data-validation="required">
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