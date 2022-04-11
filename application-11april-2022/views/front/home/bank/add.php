<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><i class="fas fa-university"></i> <?php echo $this->lang->line("Add Bank Account")?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('user/home')?>"><?php echo $this->lang->line('Profile');?></a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url('user/home/bank')?>"><?php echo $this->lang->line('My Bank');?></a></li>
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
                  <div class="card-header">
                      <h4 class="theme_heading mb-0"><?php echo $this->lang->line("Connect your bank")?></h4>
                  </div>
                <div class="card-body">
                  <div class="form-group bank-head">
                    <div class="alert alert-warning"><?php echo $this->lang->line("Make sure the bank accounts BELONGS to you.")?></div>
                  </div>  
					<div class="form-group">
						<label for="name"><?php echo $this->lang->line("Bank Name")?> <span class="text-danger">*</span></label>
						<input type="text" name="name" class="form-control" id="name" placeholder="<?php echo $this->lang->line("Bank Name")?>" data-validation="required">
					 </div>    
					 
					 <div class="form-group">
						<label for="name"><?php echo $this->lang->line("Account Number")?> <span class="text-danger">*</span></label>
						<input type="text" name="account_number" class="form-control" id="account_number" placeholder="<?php echo $this->lang->line("Account Number")?>" data-validation="required">
					 </div>
					 
					 <div class="form-group">
						<label for="name"><?php echo $this->lang->line("Account owner name")?> <span class="text-danger">*</span></label>
						<input type="text" name="account_holder_name" class="form-control" id="account_holder_name" placeholder="<?php echo $this->lang->line("Account owner name")?>" data-validation="required">
					 </div>
					 
					 <div class="form-group">
						<label for="name"><?php echo $this->lang->line("swift_code")?> <span class="text-danger">*</span></label>
						<input type="text" name="swift_code" class="form-control" id="swift_code" placeholder="<?php echo $this->lang->line("Swift Code")?>" data-validation="required">
					 </div>                           
                 
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary"><?php echo $this->lang->line("Add Account")?></button>
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
