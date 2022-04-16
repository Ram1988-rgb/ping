<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><img src="<?php echo base_url('assets/icons/mask_group_46_black.png'); ?>" class="sidebar_icons" /> Cash</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard')?>">Home</a></li>
              <li class="breadcrumb-item active">Cash</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <!-- Main content -->
    <section class="content pdf_csv_admin_cash_view">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
          <div class="row">
            
          </div>
          <?php echo load_alert()?>
          
            <div class="card">
              
              <!-- /.card-header -->
              <div class="card-body">
              
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
					  <tr>
						<th>Customer Name</th>                    
						<th>Email</th>                    
						<th>Phone</th>                    
						<th>Plan</th>                    
						<th>Payment Type</th>                    
						<th>Payment Duration</th> 
            <th>Amount(<?php echo CURRENCY;?>)</th>                      
            <th>Start Date</th> 
            <th>Matured Date</th>                       
						<th>Status</th>  
            <th>Deposited Date</th>                  
						<th>Details</th>
					  </tr>
                  </thead>
                  <tbody>
                  <?php
                  if($all_record ){
                    foreach ($all_record as $record)
                    {
                      
                    ?>
                    <tr id="row-<?php echo $record->id?>">
                      <td><?php echo $record->name?></td>
                      <td><?php echo $record->email?></td>
                      <td><?php echo $record->phone?></td>
                      <td><?php echo JSON_DECODE($record->plan_data)->name?></td>
                      <td><?php echo JSON_DECODE($record->payment_type_data)->label?></td>
                      <td><?php echo JSON_DECODE($record->payment_deuration_data)->label?></td>
                      <td><?php echo show_number($record->amount);?></td>
                      <td><?php echo showDateFormate($record->start_date);?></td>
                      <td><?php echo showDateFormateEndDate($record->end_date);?></td>
                      <td id="status-<?php echo $record->id;?>">
                        <?php if($record->status == 1){ ?>
                          <a onclick="changeCashStatus('<?php echo TBL_CASH;?>','<?php echo $record->id;?>','cash')" class="mini-card-verify px-3">Active </a> 
                          <?php }else{ ?>
                            <a onclick="changeCashStatus('<?php echo TBL_CASH;?>', '<?php echo $record->id;?>','cash')" class="mini-card-pending px-3">Inactive </a> 
                        <?php } ?>                     
					           </td>
                     <td><?php echo showDateFormateTime($record->createdAt);?></td>
                      <td>
                        <a href="<?php echo site_url('admin')?>/cash/view/<?php echo $record->id?>">
                          <button type="button" class="btn btn-block btn-primary btn-sm">Details</button>
                        </a>
                      </td>
                      
                    </tr>
                  <?php
                    }
                  }
                  ?>
                  
                  </tbody>
                 
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

           
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
