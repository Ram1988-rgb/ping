<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><img src="<?php echo base_url('assets/icons/loan-black.png'); ?>" class="sidebar_icons" /> Bank Deposit</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            
              <li class="breadcrumb-item"><a href="<?php echo base_url('user/loan')?>">Loan</a></li>
              <li class="breadcrumb-item active">Apply Loan</li>
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
              <form id="addamount" action="<?php echo base_url('user/loan/record')?>" enctype="multipart/form-data" method="POST">
				        <input type='hidden' name="type_id" id="type_id" value="<?php echo $type_id?>">
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Select your loan request</label>
                    <label for="name">You can loan up to HTG 80,000</label>
                    <input type="text" name="amount" class="form-control" id="amount" placeholder="Enter Amount" required>
					        <label for="name">(Your Interest will be 3%)</label>
                 </div>
                
                 <div class="form-group">
                    <label for="name">Your Loan Duration</label><span class="validate-star">*</span>                 
                    <div>
                      <?php
                        if($loan_duration ){
                        foreach ($loan_duration as $record){
                        ?>  
                          <input type="radio" id="loan_duration" <?php if($record->month =='3'){?> checked <?php } ?> name="loan_duration" value="<?php echo $record->id?>">
                						<label for="html"><?php echo $record->label?></label> </br> 
                        <?php 
                          }
                        }
                        ?>
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="name">Payment Duration will be?</label><span class="validate-star">*</span>                 
                  <div>
                  <?php
                    if($payment_duration ){
                    foreach ($payment_duration as $record){
                    ?>  
                      <input type="radio" id="payment_duration" <?php if($record->days =='30'){?> checked <?php } ?> name="payment_duration" value="<?php echo $record->id?>">
            						<label for="html"><?php echo $record->label?></label> </br> 
                    <?php 
                      }
                    }
                    ?>
                  </div>
                        </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                          <button type="submit" class="btn btn-primary">Next</button>
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
