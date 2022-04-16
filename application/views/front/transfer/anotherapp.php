<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><img src="<?php echo base_url('assets/icons/ocal_offer_sale black.png'); ?>" class="sidebar_icons" /> <?php echo $this->lang->line("Transfer to Another App")?> <?php // echo $this->lang->line("Refer a Friend")?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('user/dashboard')?>"><?php echo $this->lang->line("Dashboard")?></a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url('user/transfer')?>"><?php echo $this->lang->line("Transfer")?></a></li>
              <li class="breadcrumb-item active"><?php echo $this->lang->line("Transfer to Another App")?></li>
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
                    <label for="name"><?php echo $this->lang->line("Type Amount to transfer")?></label><span class="validate-star">*</span> 
                    <input type="text" name="amount" class="form-control" id="amount" placeholder="<?php echo $this->lang->line("Enter Amount")?>" data-validation="required,number">
                  </div>
                  <div class="form-group">
                    <label for="name"><?php echo $this->lang->line("Account Holder Name")?></label><span class="validate-star">*</span> 
                    <input type="text" name="account_holder_name" class="form-control" id="account_holder_name" placeholder="<?php echo $this->lang->line("Type Name/ID")?>" data-validation="required">
                  </div>

                  <div class="form-group">
                    <label for="name"><?php echo $this->lang->line("Mail Address")?></label><span class="validate-star">*</span> 
                    <input type="text" name="email" class="form-control" id="email" placeholder="<?php echo $this->lang->line("Mail Address")?>" data-validation="required,email">
                  </div>
                  <div class="form-group">
                    <label for="name"><?php echo $this->lang->line("Contact Number")?></label><span class="validate-star">*</span> 
                    <input type="text" name="phone" class="form-control allow_only_number" id="phones" placeholder="" data-validation="required,number">
                  </div>
                  <div class="form-group">
                    <label for="name"><?php echo $this->lang->line("Payment Method")?></label><span class="validate-star">*</span> 
                    <input type="radio" name="payment_method" value="biometric" data-validation="required"> Biometric
                    <input type="radio" name="payment_method" value="otpchannel" data-validation="required"> Otp Channel
                  </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary"><?php echo $this->lang->line("Transfer to Another App")?></button>
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