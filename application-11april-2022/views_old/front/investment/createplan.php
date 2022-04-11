<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><img src="<?php echo base_url('assets/icons/all_inboxblack.png'); ?>" class="sidebar_icons" /> <?php echo $planDetail->name?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('user/dashboard/index')?>"><?php echo $this->lang->line('Dashboard')?></a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url('user/investment/index')?>"><?php echo $this->lang->line('Investment Plan')?></a></li>
              <li class="breadcrumb-item active"><?php echo $planDetail->name?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->

    <section class="content">
      <div class="container-fluid">
          
        <p class="text-center box-shadow p-2 rounded mb-2"><?php echo $planDetail->description?></p>
          
        <div class="text-center box-shadow p-2 py-4 rounded mb-2">
            <div class="my-balance mb-4">
              <p class="theme_heading mb-0"><b><?php echo $this->lang->line('Total Savings')?></b> : <?php echo CURRENCY;?> <?php echo (getCurrentBalence())?show_number(getCurrentBalence()):0.00;?></p>
            </div>
            
            <div class="row align-items-center">
                <div class="col-6 border-right">
                    <div class="text-center">
                        <span class="mini-rounded" style="cursor:pointer" data-toggle="modal" data-target="#modal-default"><?php echo $this->lang->line('Interest')?></span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="text-center">
                        <span class="mini-rounded" style="cursor:pointer" data-toggle="modal" data-target="#modal-setting"><?php echo $this->lang->line('Settings')?></span>
                    </div>
                </div>
            </div>
        </div>
          
          
         
        <div class="text-center box-shadow p-2 py-3 rounded mb-2">
            <p class="theme_heading mb-0 text-capitalize"><?php echo $this->lang->line('Select a saving option')?></p>
        </div>

        <div class="gray-box p-4">
            <!-- jquery validation -->
              
          
              
              <!-- /.card-header -->
              <?php echo load_alert();?>
              
              <!-- form start -->
              <form id="addplan" action="" method="POST">
                <div class="row">
                  <div class="form-group col-lg-6">
                    <label for="name"><?php echo $this->lang->line('Payment Type')?></label><span class="validate-star">*</span>
                    <select name="payment_type" id="payment_type" class="form-control" data-validation="required" onchange="setInterestAmountModal()">
                      <?php foreach($paymentType as $pType){?>
                        <option value="<?php echo $pType->id;?>"><?php echo $pType->label;?></option>
                      <?php }?>
                    </select>
                  </div>
                  <div class="form-group col-lg-6">
                    <label for="name"><?php echo $this->lang->line('Your plan duration')?></label><span class="validate-star">*</span>
                    <select name="payment_duration" id="payment_duration" class="form-control" data-validation-url="<?php echo base_url('/user/cash/check_plan_duration');?>" data-validation-req-params="" onchange="get_rate_according_plan(this.value,'<?php echo $planDetail->id?>')" data-validation="required, server">
                      <option value="">Select</option>
                      <?php foreach($paymentDuration as $pDuration){?>
                        <option value="<?php echo $pDuration->id;?>"><?php echo $pDuration->label;?></option>
                      <?php }?>
                    </select>
                    <div id="plan_rate"></div>
                  </div>
                 
                  <div class="form-group col-lg-6">
                        <?php if($planDetail->id==3){?>
                        <?php }?>
                      <label for="name">
                        <?php 
                        if($planDetail->id==3){
                          echo $this->lang->line('Enter Amount');
                        }else{
                          echo $this->lang->line('Enter Amount for Saving');
                        }
                        ?>
                      </label><span class="validate-star">*</span>
                      <input type="text" name="amount" class="form-control" id="amount" placeholder="<?php echo CURRENCY?> 500" data-validation="required" onblur="setInterestAmountModal()"><?php //echo $paymenttype->label?>
                  </div>   

                  <div class="form-group col-lg-6">
                    <label for="name"><?php echo $this->lang->line('Start Date')?></label><span class="validate-star">*</span>                      
                
                        <input type="text" name="start_date" id="start_date" placeholder="e.g. 08/31/2021" class="form-control datetimepicker-input alldate" data-target="#reservationdate"  data-validation="required">
                        
                    </div>
                  </div>
                </div>
                
                <button type="submit" class="btn btn-primary my-2">Save & Continue</button>
                
              </form>
            
 
            </div>
    

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  
  <!-- /.content-wrapper -->

  <div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Interest</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?php $duration = $this->plan_model->getPaymentDurationByPlanId($planDetail->id);?>
      
        <?php foreach($duration as $line){?>
        <div class="row">
          <div class="form-group col-lg-6">
            <label for="name"><?php echo $line->label;?></label>
            <?php echo $line->rate;?> %
          </div>
      </div>
      <?php }?>
      
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
</div>
      <!-- /.modal -->
  <style>
      .investment-plans{
    border-style: solid;
    border-width: thin;
    background-color: wheat;
    padding:10px;
    margin:10px;
    margin-right:20px;

}

      </style>
<div class="modal fade" id="modal-setting">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Finish Setting</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <h6>Complete your autosave setting.</h6>
          <div class="row">
              <div class="col-md-12"><span id="amount_plan">50000</span> <span id="plan_type">Daily</span></div>
              <div class="col-md-12">Complete Your Setting Below</div>
          </div>
  
        <div class="row">
          <div class="form-group col-lg-6">
            <label for="name">Date</label>
            <input type="text" name="modal_date" id="modal_date" class="form-control alldate" onblur="manage_start_date(this.value, true)">
          </div>
      </div>

      <div class="row">
          <div class="form-group col-lg-6">
            <label for="name">Where should fund comes from?</label><br/>
            <?php $comes_from = ammount_comes_from(); if($comes_from){
              foreach($comes_from as $line){
              ?>            
              <input type="radio" name="comes_from" value="<?php echo $line->id?>" data-validation="required"><?php echo $line->name?><br/>
            
            <?php }}?>
          </div>
      </div>

      <div class="row">
          <div class="form-group col-lg-6">
            <label for="name">Where do you want to start?</label><br/>
            
            
              <input type="radio" name="start_from" value="today" data-validation="required" onchange="manage_start_date(this.value)">Start Now<br/>
              <input type="radio" name="start_from" value="tomarrow" data-validation="required" onchange="manage_start_date(this.value)">Tomarrow<br/>
            
            
          </div>
      </div>
     
      <button type="submit" data-dismiss="modal" class="btn btn-primary my-2">Save the setting</button>
                
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
</div>
      <!-- /.modal -->