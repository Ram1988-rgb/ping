<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><img src="<?php echo base_url('assets/icons/plan-black.png'); ?>" class="sidebar_icons" /> Plan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard')?>">Home</a></li>
              <li class="breadcrumb-item active">Plan</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <!-- Main content -->
    <section class="content pdf_csv_admin_plan_view">
      <div class="container-fluid">
          
            <?php if(1=='Harikesh'){?>
              <div class="box-shadow p-2 mb-2 text-right">
                <a href="<?php echo base_url('admin/')?>plan/add" class="btn btn-primary">Create Plan </a>
              </div>
              <?php }?>

          <?php echo load_alert()?>
          
            <div class="box-shadow p-2 mb-3">
              
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Category</th>
                    <th>Name</th> 
                    <th>Date</th>                   
                    <th>Edit</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  if($all_record ){
                    foreach ($all_record as $record)
                    {
                      if(MAINPLAN[$record->plan_cat]!='Cash'){
                    ?>                    
                    <tr id="row-<?php echo $record->id?>">
                    <td><?php echo MAINPLAN[$record->plan_cat]?></td>
                      <td><?php echo $record->name?></td>
                      <td><?php echo showDateFormateTime($record->createdAt)?></td>
                      <td>
                        <a href="<?php echo site_url('admin/')?>plan/edit/<?php echo $record->id?>">
                          <button type="button" class="btn btn-block btn-primary btn-sm edit-btn">Edit</button>
                        </a>
                      </td>
                    </tr>
                  <?php
                    }
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
