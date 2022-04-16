<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><img src="<?php echo base_url('assets/icons/plan-black.png'); ?>" class="sidebar_icons" /> Users</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard')?>">Home</a></li>
              <li class="breadcrumb-item active">Users</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <!-- Main content -->
    <section class="content pdf_csv_admin_subadmin_view">
      <div class="container-fluid">          
     
            <div class="box-shadow p-2 mb-2 text-right">
              <a href="<?php echo base_url('admin/')?>admin/add" class="btn btn-primary">Add User </a>
            </div>

          <?php echo load_alert()?>
          
            <div class="box-shadow p-2 mb-3">
              
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Name</th>
                    <th>Email</th> 
                    <th>Mobile</th>  
                    <th>Date</th>                 
                    <th>Edit</th>
                    <th>Delete </th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  if($all_record ){
                    foreach ($all_record as $record)
                    {

                    ?>                    
                    <tr id="row-<?php echo $record->id?>">
                    <td><?php echo $record->first_name?></td>
                      <td><?php echo $record->emailId?></td>
                      <td><?php echo $record->mobile?> <?php echo $record->addDate;?></td>
                      <td><?php echo showDateFormate($record->addDate)?></td>
                      <td>
                        <a href="<?php echo site_url('admin/')?>admin/edit/<?php echo $record->id?>">
                          <button type="button" class="btn btn-block btn-primary btn-sm edit-btn">Edit</button>
                        </a>
                      </td>
                      <td>
                        <a onclick="deleteData('<?php echo site_url('admin/')?>admin/delete/<?php echo $record->id?>');" >
                          <button type="button" class="btn btn-block btn-primary btn-sm edit-btn">Delete</button>
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
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
