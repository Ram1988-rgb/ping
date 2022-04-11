<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><img src="<?php echo base_url('assets/icons/mask_group_46_black.png'); ?>" class="sidebar_icons" /> Agent</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard')?>">Home</a></li>
              <li class="breadcrumb-item active">Agent</li>
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
          
          <div class="box-shadow mb-3 p-2 text-right">
              <a href="<?php echo base_url('admin/')?>agent/add" class="btn btn-primary">Add Agent</a>
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
						<th>Dob</th>                    
						<th>Gender</th>                    
						<th>Address</th> 
                        <th>Date</th>                      
                        <th>Edit</th> 
            
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
                      <td><?php echo showDateFormate($record->dob)?></td>
                      <td><?php echo $record->gender?></td>
                      <td><?php echo $record->address?></td>
                      <td><?php echo showDateFormateTime($record->createdAt)?></td>
                      <td><a href="<?php echo base_url('admin/agent/edit/'.$record->id)?>"><button type="button" class="btn btn-block btn-primary btn-sm">Edit</button></a></td>
                      
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
