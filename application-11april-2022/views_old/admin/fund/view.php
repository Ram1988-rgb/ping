<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><img src="<?php echo base_url('assets/icons/funding-black.png'); ?>" class="sidebar_icons" /> Fund</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard')?>">Home</a></li>
              <li class="breadcrumb-item active">Fund</li>
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
						<th>Customer Name</th>                    
						<th>Email</th>                    
						<th>Phone</th>                    
						<th>Type</th>                    
						<th>Amount(<?php echo CURRENCY?>)</th>                    
						<th>Status</th> 
            <th>Fund Date</th>                   
						<th>Details</th>
					  </tr>
                  </thead>
                  <tbody>
                  <?php
                  if($all_record ){
                    foreach ($all_record as $record)
                    {
                      $user_detail = get_user_detail($record->user_id);
                    ?>
                    <tr id="row-<?php echo $record->id?>">
                      <td><?php echo $user_detail->name?></td>
                      <td><?php echo $user_detail->email?></td>
                      <td><?php echo $user_detail->phone?></td>
                      <td><?php echo $record->name?></td>
                      <td><?php echo show_number($record->amount)?></td>
                      <td>
						<?php if($record->status == 1){ ?>
						  <a onclick="statusData('<?php echo site_url('admin')?>/fund/updateStatus/<?php echo $record->id?>/0')" class="mini-card-verify px-3">Active </a> 
						  <?php }else{ ?>
							  <a onclick="statusData('<?php echo site_url('admin')?>/fund/updateStatus/<?php echo $record->id?>/1')" class="mini-card-pending px-3">Inactive </a> 
						<?php } ?>                     
					  </td>
            <td><?php echo showDateFormateTime($record->createdAt)?></td>
					  <td>
						<a href="<?php echo site_url('admin')?>/fund/view/<?php echo $record->id?>">
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
