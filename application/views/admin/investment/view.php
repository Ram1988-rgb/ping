<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><img src="<?php echo base_url('assets/icons/all_inboxblack.png'); ?>" class="sidebar_icons" /> Investment</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard')?>">Home</a></li>
              <li class="breadcrumb-item active">Investment</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <!-- Main content -->
    <section class="content">
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
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Investment Plan</th>
                    <th>Payment Type</th>
                    <th>Payment Duration</th>
                    <th>Amount(<?php echo CURRENCY?>)</th>
                    <th>Status</th>
                    <th>Investment Date</th>
                    <th>Details</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  foreach ($all_record as $record)
                  {
                  ?>
                  <tr id="row-<?php echo $record->id?>">
                    <td><?php echo $record->name?></td>
                    <td><?php echo $record->email?>
                    </td>
                    <td><?php echo $record->phone?></td>
                    <td><?php echo JSON_DECODE($record->plan_data)->name;?></td>
                    <td><?php echo isset(JSON_DECODE($record->payment_type_data)->label) ?isset(JSON_DECODE($record->payment_type_data)->label):'';?></td>
                    <td><?php echo isset(JSON_DECODE($record->payment_deuration_data)->label)?JSON_DECODE($record->payment_deuration_data)->label:''?></td>
                    
                    <td><?php echo show_number($record->amount)?></td>
                    <td id="status-<?php echo $record->id;?>">
                        <?php if($record->status == 1){ ?>
                          <a onclick="changeInvestmentStatus('<?php echo TBL_INVESTMENTS;?>','<?php echo $record->id;?>','investment')" class="mini-card-verify px-3">Active </a> 
                          <?php }else{ ?>
                            <a onclick="changeInvestmentStatus('<?php echo TBL_INVESTMENTS;?>', '<?php echo $record->id;?>','investment')" class="mini-card-pending px-3">Inactive </a> 
                        <?php } ?>                     
						        </td>
                    <td><?php echo showDateFormateTime($record->createdAt)?></td> 
                    <td>	
                      <a href="<?php echo site_url('admin')?>/investment/investment_detail/<?php echo $record->id?>">
                        <button type="button" class="btn btn-block btn-primary btn-sm">Details</button>
                      </a>
                    </td>
                  </tr>
                  <?php }?>
                  
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
