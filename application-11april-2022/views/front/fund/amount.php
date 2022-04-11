<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><img src="<?php echo base_url('assets/icons/funding-black.png'); ?>" class="sidebar_icons" /> Bank Deposit</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('user/cash')?>">Cash</a></li>
              <li class="breadcrumb-item active">Bank Deposit</li>
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
              <form id="" action="save_data" enctype="multipart/form-data" method="POST">
                <div class="card-body">
					<input type="hidden" name="fund_id" value="<?php echo $fund_id ?>">
                  <div class="form-group">
                    <label for="name">Total Deposit Amount<span class="validate-star">*</span></label>
                    <input type="text" name="amount" class="form-control allow_float_number" id="amount" placeholder="Enter Amount" data-validation="required">
                  </div>
                  <?php if($fund_id == 1){ ?>                  
                  <div class="form-group">
                    <label for="exampleInputFile">Upload Receipt/Proof Image<span class="validate-star">*</span></label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" <?php if($fund_id==1){?> enabled <?php }else{ ?> disabled <?php } ?> name="receipt"  id="receipt" data-validation="required">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <!--<div class="input-group-append">-->
                      <!--  <span class="input-group-text">Upload</span>-->
                      <!--</div>-->
                    </div>
                  </div>
                  <?php } ?>
                  <?php if($fund_id == 2){ ?>
					          <label for="exampleInputEmail1">Upload Check Image<span class="validate-star">*</span></label>
                  

                  <div class="form-group">
                    <label for="exampleInputFile">Front Side<span class="validate-star">*</span></label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" <?php if($fund_id==2){?> enabled <?php }else{ ?> disabled <?php } ?> type="file" name="front_side" class="form-control" id="front_side" data-validation="required">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Back Side<span class="validate-star">*</span></label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" <?php if($fund_id==2){?> enabled <?php }else{ ?> disabled <?php } ?> type="file" name="back_side" class="form-control" id="back_side" required>
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <!--<div class="input-group-append">-->
                      <!--  <span class="input-group-text">Upload</span>-->
                      <!--</div>-->
                    </div>
                  </div>
                  <?php } ?>
                  <?php if($fund_id == 3){ ?>
                  <div class="form-group" >
                    <label for="exampleInputEmail1">Special Code<span class="validate-star">*</span></label>
                    <input <?php if($fund_id==3){?> enabled <?php }else{ ?> disabled <?php } ?> type="text" name="agent_special_code" class="form-control" id="agent_special_code" placeholder="Enter Special Code" data-validation="required,server"  data-validation-url="<?php echo base_url('user/fund/check_agent_code')?>" >
                  </div>
                  <?php } ?>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Confirm & Proceed</button>
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
