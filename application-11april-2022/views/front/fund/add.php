<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><img src="<?php echo base_url('assets/icons/funding-black.png'); ?>" class="sidebar_icons" /> <?php echo $this->lang->line('Add Wallet Amount')?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('user/cash')?>"><?php echo $this->lang->line('Wallet')?></a></li>
              <li class="breadcrumb-item active"><?php echo $this->lang->line('Add Wallet Amount')?></li>
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
              <form id="addcash" action="" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="name"><?php echo $this->lang->line('Select Fund Type')?><span class="validate-star">*</span></label>					
                  </div> 
                <?php
                  if($all_record ){
                    foreach ($all_record as $record){
                    ?>  
                  <input type="radio" id="fund_type" <?php if($record->id ==1){?> checked <?php } ?> name="fund_type" value="<?php echo $record->id?>">
        						<label for="html"><?php echo $record->name?></label> </br> 
					<?php 
						}
					}
					?>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary"><?php echo $this->lang->line('Continue')?></button>
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
