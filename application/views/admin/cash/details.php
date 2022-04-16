<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><img src="<?php echo base_url('assets/icons/mask_group_46_black.png'); ?>" class="sidebar_icons" /> Cash Details</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin/cash')?>">Cash</a></li>
              <li class="breadcrumb-item active">Cash Details</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

   <!-- Main content -->
   <section class="content pdf_csv_admin_cash_detail">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">              
              <!-- /.card-header -->
              <?php echo load_alert();?>
              <!-- form start -->
              
                <div class="card-body">
				        
                <table class="table table-bordered">
                  <tbody>
                    <tr>
                      <th>Customer Name </th>
                      <td><?php echo $details->name ? $details->name : '' ;?></td>
                    </tr>
                    <tr>
                      <th>Email </th>
                      <td><?php echo $details->email ? $details->email : '' ;?></td>
                    </tr>
                    <tr>
                      <th>Phone </th>
                      <td><?php echo $details->phone ? $details->phone: '' ;?></td>
                    </tr>
                    <tr>
                      <th>Plan </th>
                      <td><?php echo isset(JSON_DECODE($details->plan_data)->name) ? JSON_DECODE($details->plan_data)->name : '' ;?></td>
                    </tr>
                    <tr>
                      <th>Payment Type </th>
                      <td><?php echo isset(JSON_DECODE($details->payment_type_data)->label) ? JSON_DECODE($details->payment_type_data)->label: '' ;?></td>
                    </tr>
                    <tr>
                      <th>Payment Duration </th>
                      <td><?php echo isset(JSON_DECODE($details->payment_deuration_data)->label)? JSON_DECODE($details->payment_deuration_data)->label : '' ;?></td>
                    </tr>
                    <tr>
                      <th>Amount </th>
                      <td><?php echo $details->amount ? CURRENCY.' '.show_number($details->amount) : '0.00' ;?></td>
                    </tr>
                    <tr>
                      <th>Start Date </th>
                      <td><?php echo showDateFormate($details->start_date) ? showDateFormate($details->start_date) : '' ;?></td>
                    </tr>
                    <tr>
                      <th>Matured Date </th>
                      <td><?php echo showDateFormateEndDate($details->end_date) ? showDateFormateEndDate($details->end_date) : '' ;?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="card">
              <div class="card-body">
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
                  $record = $details;
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
                      <?php }else{echo "Done";}?></td>
                      <td id="payment_date-<?php echo $crecord->id?>"><?php if($crecord->payment_date){echo showDateFormateTime($crecord->payment_date);}else{ echo "--";}?></td>
                      <td id="wallet-<?php echo $crecord->id?>"><?php if($crecord->status){if($crecord->move_to_wallet){?>Done<?php }else{?>--<?php }}else{echo "--";}?></td>
                    </tr>
                  <?php
                    }
                  }
                  ?>
                  
                  </tbody>
                 
                </table>
      
   
                </div>
                <div class="card-footer">
                  <a href="<?php echo base_url('admin/cash')?>"><button class="btn btn-primary">Back</button></a>
                </div>   
                <!-- /.card-body -->
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
