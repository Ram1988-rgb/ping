<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0"><img src="<?php echo base_url('assets/icons/mask_group_46_black.png'); ?>" class="sidebar_icons" /> <?php echo $this->lang->line('Cash Detail');?></h1>
         </div>
         <!-- /.col -->
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="<?php echo base_url('user/dashboard')?>"><?php echo $this->lang->line('Dashboard');?></a></li>
               <li class="breadcrumb-item active"><?php echo $this->lang->line('Cash Detail');?></li>
            </ol>
         </div>
         <!-- /.col -->
      </div>
      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</div>
<!-- /.content-header -->


<!-- Main content -->
<section class="content">
    <div class="container-fluid">
      
        <div class="box-shadow p-2 rounded text-center mb-2">
            <div class="card-bodyy">
                <?php echo $this->lang->line('Strict saving automatically. Daily, weekly or monthly.')?>                
            </div>
        </div>
        
        <div class="box-shadow p-2 rounded mb-2">
            <div class="row align-items-end">
                <div class="col-8">
                    <div class="bg-white">
                        <h4 class="theme_heading"><?php echo $this->lang->line('Total Savings')?></h4>
                        <p class="mb-0 text-success font-weight-bold"><?php echo CURRENCY;?> <span id="cash_saving"><?php echo $this->cash_model->get_cash_saving($this->session->userdata('CUSTOMERID'))?></span></p>
                    </div>
                </div>
                <div class="col-4 text-right">
                    <a href="<?php echo base_url('user/cash/'); ?>" class="btn btn-primary"><?php echo $this->lang->line('Back')?></a>
                </div>
            </div>
        </div>
        
        <table class="table table-bordered">
               <tr>
                    <th class="font-weight-bold" width="200">Plan Name </th>
                    <td><?php echo JSON_DECODE($record->plan_data)->name?></td>
                </tr>
                <tr>
                    <th class="font-weight-bold" width="200"><?php echo $this->lang->line('Payment Type');?> </th>
                    <td><?php echo JSON_DECODE($record->payment_type_data)->label?></td>
                </tr>
                <tr>
                    <th class="font-weight-bold" width="200"><?php echo $this->lang->line('Payment Duration');?> </th>
                    <td><?php echo JSON_DECODE($record->payment_deuration_data)->label?></td>
                </tr>
                <tr>
                    <th class="font-weight-bold" width="200"><?php echo $this->lang->line('Start Date');?> </th>
                    <td><?php echo showDateFormate($record->start_date);?></td>
                </tr>
                <tr>
                    <th class="font-weight-bold" width="200"><?php echo $this->lang->line('End Date');?> </th>
                    <td><?php echo showDateFormateEndDate($record->end_date);?></td>
                </tr>
                <tr>
                    <th class="font-weight-bold" width="200"> Amount </th>
                    <td><?php echo CURRENCY;?> <?php echo $record->amount ? show_number($record->amount) : 0.00 ;?></td>
                </tr>
                <tr>
                    <th class="font-weight-bold" width="200"> Interest </th>
                    <td><?php echo $record->interest_rate ? show_number($record->interest_rate) : 0.00 ;?>%</td>
                </tr>
                
            </table>
        
        
        <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th><?php echo $this->lang->line('Payment Due Date');?></th>
                    <th><?php echo $this->lang->line('Paid Amount');?>(<?php echo CURRENCY;?>)</th>                      
                    <th><?php echo $this->lang->line('Interest Earned Amount');?>(<?php echo CURRENCY;?>)</th>
                    <th><?php echo $this->lang->line('Payment Status');?></th>
                    <th><?php echo $this->lang->line('Payment Date');?></th>
                    <th><?php echo $this->lang->line('Withdrawl in wallet');?></th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  if($cash_payment ){
                    foreach ($cash_payment as $crecord)
                    {
                        
                    ?>
                    <tr id="row-<?php echo $crecord->id?>">
                      <td><?php echo showDateFormate($crecord->cpdate)?></td>
                      <td><?php echo show_number($record->amount)?></td>
                      <td><?php echo show_number(($record->amount * $record->interest_rate)/100)?></td>
                      <td id="cash_payment-<?php echo $crecord->id;?>"><?php if(!$crecord->status ){?>Pending
                      <br/>
                      <?php if($record->status){?>
                        <button type="button" class="btn btn-primary" onclick="cashPayment('<?php echo $crecord->id;?>')">Pay</button>
                      <?php }}else{echo "Done";}?></td>
                      <td id="payment_date-<?php echo $crecord->id?>"><?php if($crecord->payment_date){echo showDateFormateTime($crecord->payment_date);}else{ echo "--";}?></td>
                      <td id="wallet-<?php echo $crecord->id?>"><?php if($crecord->status){if($crecord->move_to_wallet){?>Done<?php }else{?><button type="button" class="btn btn-block btn-primary btn-sm" onclick="move_to_wallet('<?php echo $crecord->bid?>','<?php echo $crecord->id?>')">Move to Wallet</button><?php }}else{echo "--";}?></td>
                    </tr>
                  <?php
                    }
                  }
                  ?>
                  
                  </tbody>
                 
                </table>
      
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->