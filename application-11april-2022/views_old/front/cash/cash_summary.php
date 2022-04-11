<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0"><img src="<?php echo base_url('assets/icons/mask_group_46_black.png'); ?>" class="sidebar_icons" /> <?php echo $this->lang->line('Cash Summary');?></h1>
         </div>
         <!-- /.col -->
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="<?php echo base_url('user/dashboard')?>"><?php echo $this->lang->line('Dashboard');?></a></li>
               <li class="breadcrumb-item active"><?php echo $this->lang->line('Cash Summary');?></li>
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
                        <p class="mb-0 text-success font-weight-bold"><?php echo CURRENCY;?> <?php echo $this->cash_model->get_cash_saving($this->session->userdata('CUSTOMERID'));?></p>
                    </div>
                </div>
                <div class="col-4 text-right">
                    <a href="<?php echo base_url('user/cash/addcash'); ?>" class="btn btn-primary"><?php echo $this->lang->line('Add Cash')?></a>
                </div>
            </div>
        </div>
        
        
        <!--loop
        <?php
            foreach($active_cash_data as $activecash){
        ?>
        <div class="gray-box mb-2">
            <div class="d-flex align-items-center">
                <i class="far fa-check-square fa-2x text-warning"></i> <div class="ml-2">Save <?php echo $activecash->install_amount?>  <?php echo  JSON_DECODE($activecash->payment_type_data)->label?></div>
            </div>
        </div>
        <?php }?>-->
        
       <!-- <div class="gray-box mb-2">
            <div class="d-flex align-items-center">
                <i class="far fa-check-square fa-2x text-success"></i> <div class="ml-2">Save 2,000.00 every day</div>
            </div>
        </div>
        
        <div class="gray-box mb-2">
            <div class="d-flex align-items-center">
                <i class="far fa-check-square fa-2x text-theme"></i> <div class="ml-2">Save 3,000.00 every day</div>
            </div>
        </div>-->
        
        <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th><?php echo $this->lang->line('Plan');?></th>  
                    <th><?php echo $this->lang->line('Payment Type');?></th>
                    <th><?php echo $this->lang->line('Payment Duration');?></th>
                    <th><?php echo $this->lang->line('Start Date');?></th>
                    <!-- <th><?php echo $this->lang->line('Installment Amount');?></th>    -->
                    <th><?php echo $this->lang->line('Interest Rate');?>(%)</th>                  
                    <th><?php echo $this->lang->line('Amount');?>(<?php echo CURRENCY;?>)</th>                    
                    <th><?php echo $this->lang->line('Status');?></th>
                    <th><?php echo $this->lang->line('Deposit date');?></th>
                    <th><?php echo $this->lang->line('Details');?></th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  if($all_record ){
                    foreach ($all_record as $record)
                    {
                        //print_r($record);
                    ?>
                    <tr id="row-<?php echo $record->id?>">
                      <td><?php  if(isset($record->plan_data)){echo JSON_DECODE($record->plan_data)->name;}?></td>
                      <td><?php echo JSON_DECODE($record->payment_type_data)->label?></td>
                      <td><?php echo JSON_DECODE($record->payment_deuration_data)->label?></td>
                      <td><?php echo showDateFormate($record->start_date);?></td>
                      <!-- <td><?php echo show_number($record->install_amount)?></td> -->
                      <td><?php echo $record->interest_rate?></td>
                      <td><?php echo show_number($record->amount)?></td>
                      <td id="status-<?php echo $record->id?>">
                      <?php if($record->status == 1){ ?>
							  
                              <button type="button" class="mini-card-verify text-center px-3" disabled>Active</button>
							  <?php }else{ ?>
								  <button type="button" class="mini-card-pending text-center px-3" disabled>InActive</button>
							<?php } ?> </td>
                      <td><?php echo showDateFormateTime($record->createdAt)?></td> 
                      <td><a href="<?php echo base_url('user/cash/cash_detail/'.$record->id)?>"><button type="button" class="btn btn-block btn-primary btn-sm">Details</button></a></td>                                         
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