<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><img src="<?php echo base_url('assets/icons/plan-black.png'); ?>" class="sidebar_icons" /> Edit Plan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard')?>">Home</a></li>
              <li class="breadcrumb-item"><a href="<?php echo site_url('admin/plan')?>">Plan</a></li>
              <li class="breadcrumb-item active">Edit</li>
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
              <form id="addplan" action="" method="POST">
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Plan Category<span class="validate-star">*</span></label>
                    <select name="plan_cat" id="plan_cat" class="form-control" data-validation="required">
                      <option value="">Select</option>
                      <?php foreach(MAINPLAN as $key=>$val){?>
                        <option value="<?php echo $key;?>" <?php if($key == $detail->plan_cat){?>selected="selected"<?php }?>><?php echo $val;?></option>
                      <?php }?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="name">Name<span class="validate-star">*</span></label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter Name" value="<?php echo $detail->name?$detail->name:''; ?>" data-validation="required">
                  </div>
                  <div class="form-group">
                    <label for="name">Payment Type<span class="validate-star">*</span></label>
                    <?php foreach($all_paymentType as $paymenttype){?>
                        <div class="d-flex align-items-center mb-2">
                            <input type="checkbox" name="paymenttype[]" class="" id="paymenttype" value="<?php echo $paymenttype->id?>" data-validation="required" <?php if($this->plan_model->checkedPaymentType($detail->id,$paymenttype->id)){?>checked="checked"<?php }?>>
                            <label class="ml-2 mb-0"><?php echo $paymenttype->label?></label>
                        </div>
                    <?php }?>
                  </div>
                  <div class="form-group">
                    <label for="name">Payment Duration Interest<span class="validate-star">*</span></label>
                    <?php foreach($all_paymentDuration as $paymentduration){?>
                        <div class="d-flex align-items-center mb-2">
                          <input type="checkbox" name="paymentduration[]" class="" id="paymentduration" value="<?php echo $paymentduration->id?>"  data-validation="required" <?php if($this->plan_model->checkedDuration($detail->id,$paymentduration->id)){?>checked="checked"<?php }?> onchange="duration_change(this,'<?php echo $paymentduration->id?>_check')">
                          <label class="ml-2 mb-0"><?php echo $paymentduration->label?></label>
                        </div>
                        <div class="d-flex align-items-center mb-2"> <?php $plan_duration= $this->plan_model->getPlanPaymentDuration($detail->id, $paymentduration->id);?>
                        <input style="margin-left:10%" type="text" name="rate[<?php echo $paymentduration->id;?>]" value="<?php echo isset($plan_duration->rate)?$plan_duration->rate:0.00?>" id="<?php echo $paymentduration->id?>_check" placeholder="Rate of interest" class="" <?php if(!$this->plan_model->checkedDuration($detail->id,$paymentduration->id)){?>disabled="disabled"<?php }?> data-validation="required,number" data-validation-allowing="float"> &nbsp;%
                            
                        </div>
                    <?php }?>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Description</label>
                    <textarea name="description" name="description" class="form-control"><?php echo $detail->description?$detail->description:''; ?></textarea>
                  </div>
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
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