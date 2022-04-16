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
                                <input type="radio" class="radioBtnClass" id="plan_id" <?php if($record->name =='Personal'){?> checked <?php } ?> name="plan_id" value="<?php echo $record->id?>" onchange="manageloanbusiness()">
                      						<label for="html"><?php echo $record->name?></label> </br> 
                            <?php 
                                }
                            }
                            ?>
                            </div>

                        </div>
                        <div class="row" id="loanform">
                        </div>

                    </div>
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
