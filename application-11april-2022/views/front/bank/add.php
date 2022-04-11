<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><i class="fas fa-piggy-bank"></i> <?php echo $this->lang->line("add_bank_account")?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('user/home/bank')?>"><?php echo $this->lang->line('bank');?></a></li>
              <li class="breadcrumb-item active"><?php echo $this->lang->line("add_bank_account")?></li>
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
              <form id="addamount" action="add" enctype="multipart/form-data" method="POST">
                <div class="card-body">
					<div class="form-group">
						<label for="name"><?php echo $this->lang->line("name")?></label>
						<input type="text" name="name" class="form-control" id="name" placeholder="<?php echo $this->lang->line("enter_bank_name")?>" required>
					 </div>    
					 
					 <div class="form-group">
						<label for="name"><?php echo $this->lang->line("account_number")?></label>
						<input type="text" name="account_number" class="form-control" id="account_number" placeholder="<?php echo $this->lang->line("enter_account_number")?>" required>
					 </div>
					 
					 <div class="form-group">
						<label for="name"><?php echo $this->lang->line("account_holder_name")?></label>
						<input type="text" name="account_holder_name" class="form-control" id="account_holder_name" placeholder="<?php echo $this->lang->line("enter_account_holder_name")?>" required>
					 </div>
					 
					 <div class="form-group">
						<label for="name"><?php echo $this->lang->line("swift_code")?></label>
						<input type="text" name="swift_code" class="form-control" id="swift_code" placeholder="<?php echo $this->lang->line("enter_swift_code")?>" required>
					 </div>                           
                 
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary"><?php echo $this->lang->line("save")?></button>
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
