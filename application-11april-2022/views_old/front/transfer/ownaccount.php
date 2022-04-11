<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><img src="<?php echo base_url('assets/icons/ocal_offer_sale black.png'); ?>" class="sidebar_icons" /> <?php echo $this->lang->line("Own Account Transfer")?> <?php // echo $this->lang->line("Refer a Friend")?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('user/dashboard')?>"><?php echo $this->lang->line("Dashboard")?></a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url('user/transfer')?>"><?php echo $this->lang->line("Transfer")?></a></li>
              <li class="breadcrumb-item active"><?php echo $this->lang->line("Own Account Transfer")?></li>
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
                    <label for="name"><?php echo $this->lang->line("Enter Amount")?></label><span class="validate-star">*</span> 
                    <input type="text" name="amount" class="form-control" id="amount" placeholder="<?php echo $this->lang->line("amount")?>" data-validation="required,number">
                  </div>
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Transfer</button>
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