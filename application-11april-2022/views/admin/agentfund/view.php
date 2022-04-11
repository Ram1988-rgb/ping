<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><img src="<?php echo base_url('assets/icons/person_black.png'); ?>" class="sidebar_icons" /> Agent Fund</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"> <a href="<?php echo base_url('admin/dashboard')?>">Home</a></li>
              <li class="breadcrumb-item active">Agent Fund</li>
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
        <div class="box-shadow mb-3 p-2 text-right">
              <a href="<?php echo base_url('admin/')?>agentfund/add" class="btn btn-primary">Add Fund</a>
        </div>
          <?php echo load_alert()?>
          
            <div class="box-shadow mb-3 p-2">
              
             
              
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Code</th>
                    <th>Amount (<?php echo CURRENCY;?>)</th>
                    <th>Date</th>
                    <th>Details</th>
                    
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  if($all_record){
                  foreach ($all_record as $record)
                  {
                  ?>
                  <tr id="row-<?php echo $record->id?>">
                    <td style="display:none">1</td>
                    <td><?php echo $record->name?></td>
                    <td><?php echo $record->email?></td>
                    <td><?php echo $record->phone?></td>
                    <td><?php echo $record->code?></td>                    
                    <td><?php echo show_number($record->amount)?></td>
                    <td><?php echo showDateFormateTime($record->createdAt)?></td>
                    <th><a href="<?php echo base_url('admin/agentfund/detail/'.$record->id)?>"><button type="button" class="btn btn-block btn-primary btn-sm">Details</button></a></th>
                  </tr>
                  <?php }}?>
                  
                  </tbody>
                 
                </table>
             
            </div>
     

           
         
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
