<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><img src="<?php echo base_url('assets/icons/payment-duration-black.png'); ?>" class="sidebar_icons" /> Payment Duration</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard')?>">Home</a></li>
              <li class="breadcrumb-item active">Payment Duration</li>
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
     
      
        <div class="box-shadow p-2 mb-3 text-right">
          <a href="<?php echo base_url('admin/')?>paymentduration/add" class="btn btn-primary">Add Payment Duration </a>
        </div>

          <?php echo load_alert()?>
          
            <div class="box-shadow p-2 mb-3">
              
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Duration</th>
                    <th>Month</th>  
                    <th>Description</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  if($all_record ){
                    foreach ($all_record as $record)
                    {
                    ?>                    
                    <tr id="row-<?php echo $record->id?>">
                    <td><?php echo $record->label?></td>
                    <td><?php echo $record->month?></td>
                    <td><?php echo $record->description? $record->description: '--';?></td>
                      
                      <!--<td>
                        <a href="<?php echo site_url('admin/')?>paymentduration/edit/<?php echo $record->id?>">
                          <button type="button" class="btn btn-block btn-primary btn-sm edit-btn">Edit</button>
                        </a>
                      </td>-->
                    </tr>
                  <?
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