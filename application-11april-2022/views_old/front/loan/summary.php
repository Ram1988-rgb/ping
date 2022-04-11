<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><img src="<?php echo base_url('assets/icons/loan-black.png'); ?>" class="sidebar_icons" /> Loan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">            
              <li class="breadcrumb-item"><a href="<?php echo base_url('user/loan')?>">Loan</a></li>
              <li class="breadcrumb-item active">Summary</li>
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
              <form id="addamount" action="" enctype="multipart/form-data" method="POST">
                 <input type="hidden" name="loan_form" value="1">
              <div class="card-body">
                  <div class="form-group">
                  <label for="name">Your Request Loan Amount</label><br>
                  <label for="name"><?php echo CURRENCY;?> <?php echo show_number($record->amount) ?></label><br>
                  <label for="name">(Your Interest will be <?php echo $record->interest_rate; ?>%)</label>
                </div>
                      
                <div class="form-group">
                  <label for="name">Loan Duration</label> <br>
                  <label for="name"><?php echo JSON_DECODE($record->payment_type_data)->label; ?></label> <br>
                </div>
                <div class="form-group">
                  <label for="name">Payment Type</label> <br>
                  <label for="name"><?php echo JSON_DECODE($record->payment_deuration_data)->label; ?></label> <br>
                </div>
                <div class="form-group">
                  <label for="name">Next Payment Date</label> <br>
                  <label for="name"><?php echo nextPaymentdate($record->start_date, JSON_DECODE($record->payment_type_data)->days)?></label> 
                </div>
                <div class="form-group">
                  <label for="name">Payment Amount</label> <br>
                  <label for="name"><?php echo CURRENCY;?> <?php echo show_number($record->install_amount);?></label> 
                </div>
               
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" value="Apply for Loan" class="btn btn-primary">Apply for Loan</button>
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
