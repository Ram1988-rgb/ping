<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><img src="<?php echo base_url('assets/icons/loan-black.png'); ?>" class="sidebar_icons" /> Add Loan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('user/loan/myloan')?>">My Loan</a></li>
              <li class="breadcrumb-item active">Add Loan</li>
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
			<form id="" action="" enctype="multipart/form-data" method="POST">		
        <div class="card-body">
					<div class="form-group">
						<label for="name">Maximum Loan Amount</label><br>
						<label for="name">HTG 100,000</label>
					</div>
          <div class="form-group">
            <label for="name">Type of Loan</label><span class="validate-star">*</span>                 
            <div>
            <?php
              if($category ){
              foreach ($category as $record){
              ?>  <!--onchange="manageloanbusiness()"-->
                <input type="radio" class="radioBtnClass" id="plan_id" <?php if($record->name =='Personal'){?> checked <?php } ?> name="plan_id" value="<?php echo $record->id?>" >
      						<label for="html"><?php echo $record->name?></label> </br> 
              <?php 
                }
              }
              ?>
            </div>

          </div>

          <div class="row" id="loanform">
          <div class="card-body">
                  <div class="form-group">
                    <label for="name">Select your loan request</label>
                    <label for="name">You can loan up to HTG 80,000</label><span class="validate-star">*</span>
                    <input type="text" name="amount" class="form-control" id="amount" placeholder="Enter Amount" data-validation="required">
					          <label for="name">(Your Interest will be <span id="plan_rate">3%</span>)</label>
                 </div>
                
                 
                  <div class="form-group">
                      <label for="name">Payment Duration will be?</label>                
                  <div>
                  
                       <select name="payment_duration" id="payment_duration" class="form-control" data-validation="required" onchange="loan_validation()">
                            <option value="">Select</option>
                            <?php
                                if($payment_duration ){
                                    foreach ($payment_duration as $record){
                            ?>  
                                <option value="<?php echo $record->paymenttype_id;?>"><?php echo $record->label?></option>
                            <?php 
                                    }
                                }
                            ?>
                        </select>
                   
                  </div>
                 </div>
                 <div class="form-group">
                    <label for="name">Your Loan Duration</label><span class="validate-star">*</span>                 
                    <div>
                        <select name="loan_duration" id="loan_duration" class="form-control" data-validation-url="<?php echo base_url('/user/cash/check_plan_duration');?>" data-validation-req-params="" onchange="get_rate_according_plan(this.value,'<?php echo $plan_id?>')" data-validation="required,server">
                            <option value="">Select</option>
                            <?php
                                if($loan_duration ){
                                    foreach ($loan_duration as $record){
                            ?>  
                                <option value="<?php echo $record->paymentduration_id;?>>"><?php echo $record->label?></option>
                            <?php 
                                    }
                                }
                            ?>
                        </select>
                      </div>
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
  <script>
    
  </script>
