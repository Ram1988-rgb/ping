<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0"><img src="<?php echo base_url('assets/icons/loan-black.png'); ?>" class="sidebar_icons" /> <?php echo $this->lang->line('My Loan');?></h1>
         </div>
         <!-- /.col -->
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="<?php echo base_url('user/dashboard')?>"><?php echo $this->lang->line('Dashboard');?></a></li>
               <li class="breadcrumb-item active"><?php echo $this->lang->line('My Loan');?></li>
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
    <div class="row align-items-end">
                <div class="col-8">
                    
                </div>
                <div class="col-4 text-right">
                    <a href="<?php echo base_url('/')?>user/loan/index"><button type="button" class="btn btn-primary"><?php echo $this->lang->line('Create Loan');?></button></a>
                </div>
            </div>
            
            <hr />
        <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    
                    <th><?php echo $this->lang->line('Payment Type');?></th>
                    <th><?php echo $this->lang->line('Payment Duration');?></th>
                    <th><?php echo $this->lang->line('Start Date');?></th>
                    <th><?php echo $this->lang->line('End Date');?></th>
                    <th><?php echo $this->lang->line('Installment Amount');?>(<?php echo CURRENCY;?>)</th>                    
                    <th><?php echo $this->lang->line('Amount');?>(<?php echo CURRENCY;?>)</th>                    
                    <th><?php echo $this->lang->line('Date');?></th>                    
                    <th><?php echo $this->lang->line('Status');?></th>
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
                      <td><?php echo JSON_DECODE($record->payment_type_data)->label?></td>
                      <td><?php echo JSON_DECODE($record->payment_deuration_data)->label?></td>
                      <td><?php echo showDateFormate($record->start_date);?></td>
                      <td><?php echo showDateFormateEndDate($record->end_date);?></td>
                      <td><?php echo show_number($record->install_amount)?></td>
                      <td><?php echo show_number($record->amount)?></td>
                      <td><?php echo showDateFormateTime($record->createdAt)?></td> 
                      <td id="status-<?php echo $record->id?>">
                      <?php if($record->status == 1){ ?>
							  
                              <button type="button" class="mini-card-verify text-center px-3" disabled>Active</button>
							  <?php }else{ ?>
								  <button type="button" class="mini-card-pending text-center px-3" disabled>InActive</button>
							<?php } ?> </td>
                     <td><a href="<?php echo base_url('user/loan/loan_detail/'.$record->id)?>">
                      <button type="button" class="btn btn-block btn-primary btn-sm">Details</button></a></td>
                      
                                                              
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