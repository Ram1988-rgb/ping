<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><img src="<?php echo base_url('assets/icons/all_inboxblack.png'); ?>" class="sidebar_icons" /> Investment Detail</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('user/dashboard')?>">Home</a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url('user/investment')?>">Investment</a></li>
              <li class="breadcrumb-item active">Investment Detail</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    

   <!-- Main content -->
   <section class="content">
      <div class="container-fluid">
      
          <?php echo load_alert();?>
             
            
            <h4 class="theme_heading">Plan Detail</h4> <hr>
            
            <div class="row">
                <!-- <div class="col-lg-6 mb-3">
                    <table class="table table-bordered">
                        <tr>
                            <th class="font-weight-bold" width="150">Name:  </th>
                            <td><?php echo $record->name;?> </td>
                        </tr>
                        <tr>
                            <th class="font-weight-bold" width="150">Email:  </th>
                            <td><?php echo $record->email;?> </td>
                        </tr>
                        <tr>
                            <th class="font-weight-bold" width="150">Phone:  </th>
                            <td><?php echo $record->phone;?></td>
                        </tr>
                    </table>
                </div> -->
                <div class="col-lg-6 mb-3">
                    <table class="table table-bordered">
                        <tr>
                            <th class="font-weight-bold" width="150">Plan Name: </th>
                            <td><?php echo JSON_DECODE($record->plan_data)->name;?>  </td>
                        </tr>
                        <tr>
                            <th class="font-weight-bold" width="150">Payment Type: </th>
                            <td><?php echo JSON_DECODE($record->payment_type_data)->label;?>  </td>
                        </tr>
                        <tr>
                            <th class="font-weight-bold" width="150">Payment Duration : </th>
                            <td><?php if(JSON_DECODE($record->payment_deuration_data)!=null){ echo JSON_DECODE($record->payment_deuration_data)->label;}?></td>
                        </tr><tr>
                        <th class="font-weight-bold" width="150">Interest Rate : </th>
                            <td><?php echo $record->interest_rate;?>%</td>
                        </tr>

                    </table>
                </div>
            </div>
            
            
            <h4 class="main_heading mt-3">Investment Detail</h4> <hr>
            
            <div class="row">
                <div class="col-lg-6 mb-3">
                    <table class="table table-bordered">
                        <tr>
                            <th class="font-weight-bold" width="150">Start Date: </th>
                            <td><?php echo showDateFormate($record->start_date);?> </td>
                        </tr>
                        <tr>
                            <th class="font-weight-bold" width="150">Amount: </th>
                            <td><?php echo CURRENCY.' '.show_number($record->amount);?> </td>
                        </tr>
                        <tr>
                            <th class="font-weight-bold" width="150">Installment Amount: </th>
                            <td><?php echo CURRENCY.' '.show_number($record->amount);?></td>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-6 mb-3">
                    <table class="table table-bordered">
                        <tr>
                            <th class="font-weight-bold" width="150">End Date: </th>
                            <td><?php echo showDateFormateEndDate($record->end_date);?> </td>
                        </tr>
                        <tr>
                            <th class="font-weight-bold" width="150">Installment Count: </th>
                            <td><?php echo $record->installment_count;?> </td>
                        </tr>
                        <tr>
                            <th class="font-weight-bold" width="150">Payment Duration: </th>
                            <td><?php  if($record->payment_deuration_data!='null'){ echo JSON_DECODE($record->payment_deuration_data)->label;}else{echo '--';};?></td>
                        </tr>
                    </table>
                </div>
            </div>

            <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th><?php echo $this->lang->line('Payment Due Date');?></th>
                    <th><?php echo $this->lang->line('Paid Amount');?>(<?php echo CURRENCY;?>)</th> 
                    <th><?php echo $this->lang->line('Earned Interest Amount');?>(<?php echo CURRENCY;?>)</th>
                    <th><?php echo $this->lang->line('Payment Status');?></th>
                    <th><?php echo $this->lang->line('Payment Date');?></th>
                    <th><?php echo $this->lang->line('Withdrawl in wallet');?></th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  if(isset($cash_payment) ){
                    foreach ($cash_payment as $crecord)
                    {
                        //print_r($crecord);//die;
                    ?>
                    <tr id="row-<?php echo $crecord->id?>">
                    <td><?php echo showDateFormate($crecord->cpdate)?></td>
                      <td><?php echo show_number($record->amount)?></td>
                      <td><?php echo show_number(($record->amount * $record->interest_rate)/100)?></td>
                      <td id="cash_payment-<?php echo $crecord->id;?>"><?php if(!$crecord->status ){?>Pending
                      <br/>
                      <?php if($record->status){?>
                        <button type="button" class="btn btn-primary" onclick="investmentPayment('<?php echo $crecord->id;?>')">Pay</button>
                      <?php }}else{echo "Done";}?></td>
                      <td id="payment_date-<?php echo $crecord->id?>"><?php if($crecord->payment_date){echo showDateFormate($crecord->payment_date);}else{ echo "--";}?></td>
                      
                      <td id="wallet-<?php echo $crecord->id?>"><?php if($crecord->status){if($crecord->move_to_wallet){?>Done<?php }else{?><button type="button" class="btn btn-block btn-primary btn-sm" onclick="move_to_investment_wallet('<?php echo $crecord->bid?>','<?php echo $crecord->id?>')">Move to Wallet</button><?php }}else{echo '';}?></td>
                    </tr>
                  <?php
                    }
                  }
                  ?>
                  
                  </tbody>
                 
                </table>
      
      
      
      
    
              
        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->