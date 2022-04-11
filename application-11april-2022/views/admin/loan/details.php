<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><img src="<?php echo base_url('assets/icons/loan-black.png'); ?>" class="sidebar_icons" /> Loan Details</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin/loan')?>">Loan</a></li>
              <li class="breadcrumb-item active">Loan Details</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

   <!-- Main content -->
   <section class="content pdf_csv_admin_loan_detail">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
        
              <?php echo load_alert();?>
              <!-- form start -->
              
                <div class="mb-3">
                     <table class="table table-bordered text-dark">
                        <tr>
                            <th width="150" class="font-weight-bold"> Customer Name</th>
                            <td class="text-capitalize"><?php echo $details->name ? $details->name : 0 ;?></td>
                        </tr>
                        <tr>
                            <th width="150" class="font-weight-bold">Email</th>
                            <td><?php echo $details->email ? $details->email : 0 ;?></td>
                        </tr>
                        <tr>
                            <th width="150" class="font-weight-bold">Phone</th>
                            <td><?php echo $details->phone ? $details->phone : 0 ;?></td>
                        </tr>
                        <tr>
                            <th width="150" class="font-weight-bold">Loan Amount</th>
                            <td><?php echo CURRENCY?> <?php echo $details->amount ? show_number($details->amount) : 0 ;?></td>
                        </tr>
                        <tr>
                            <th width="150" class="font-weight-bold">Payment Type</th>
                            <td><?php echo JSON_DECODE($details->payment_type_data)->label; ?></td>
                        </tr>
                        <tr>
                            <th width="150" class="font-weight-bold">Loan Duration</th>
                            <td><?php echo JSON_DECODE($details->payment_deuration_data)->label; ?></td>
                        </tr>
                        <tr>
                            <th width="150" class="font-weight-bold">No of installment</th>
                            <td><?php echo $details->installment_count ? $details->installment_count : 0 ;?></td>
                        </tr>
                        <tr>
                            <th width="150" class="font-weight-bold">Installment Amount</th>
                            <td><?php echo $details->install_amount ? $details->install_amount : 0 ;?></td>
                        </tr>
                        <tr>
                            <th width="150" class="font-weight-bold">Status</th>
                            <td>
                                <!--<?php // echo $details->status ? "ACTIVe" : "PENDING" ;?>-->
                                <span class="mini-card-<?php echo $details->status ? "verify" : "pending" ;?> text-center px-1"><?php echo $details->status ? "ACTIVE" : "PENDING" ;?></span>
                            </td>
                        </tr>
                        <tr>
                            <th width="150"></th>
                            <td>
                                <a href="<?php echo base_url('admin/loan')?>" class="btn btn-primary">Back </a>
                            </td>
                        </tr>
                    </table>
                    <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th><?php echo $this->lang->line('Payment Due Date');?></th>                      
                    <th><?php echo $this->lang->line('Install Ammount');?>(<?php echo CURRENCY;?>)</th> 
                    <!-- <th><?php echo $this->lang->line('Interest Amount');?>(<?php echo CURRENCY;?>)</th> -->
                    <th><?php echo $this->lang->line('Payment Status');?></th>
                    <th><?php echo $this->lang->line('Payment Date');?></th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  if(isset($loan_payment) ){
                    foreach ($loan_payment as $crecord)
                    {
                       // print_r(JSON_ENCODE($record));die;
                    ?>
                    <tr id="row-<?php echo $crecord->id?>">
                      <td><?php echo showDateFormate($crecord->payment_date)?></td>
                      <td><?php echo show_number($crecord->install_amount)?></td>
                      <!-- <th><?php echo show_number(($crecord->install_amount*$details->interest_rate)/100)?></th>  -->
                      <td id="payment_status-<?php echo $crecord->id?>"><?php if($details->status){if($crecord->status){?>Done<?php }else{?>--<?php }}else{echo "Pending";}?></td>
                      <td id="payment_date-<?php echo $crecord->id?>"> <?php echo showDateFormateTime($crecord->date)?></td>
                    </tr>
                  <?php
                    }
                  }
                  ?>
                  
                  </tbody>
                 
                </table>
      
                   
                </div>                           
        
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
