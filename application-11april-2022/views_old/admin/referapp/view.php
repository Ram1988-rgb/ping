<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><img src="<?php echo base_url('assets/icons/ocal_offer_sale black.png'); ?>" class="sidebar_icons" /> Refer App</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard')?>">Home</a></li>
              <li class="breadcrumb-item active">Refer App</li>
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
         
          <?php echo load_alert()?>
          
            <div class="card">
              
              <!-- /.card-header -->
              <div class="card-body">
              
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th colspan="3" style="text-align:center">Shared By</th>
                    <th colspan="4" style="text-align:center">Shared To</th>
                    <th colspan="2"style="text-align:center">Date</th>
                  </tr>
                  <tr>
                    <th>Customer Name</th>
                    <th>Email</th>
                    <th> Phone</th>
                    
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                  <pr>
                  <?php
                  foreach ($all_record as $record)
                  {
                  ?>
                  <tr id="row-<?php echo $record->id?>">
                    <td><?php echo $record->name?></td>
                    <td><?php echo $record->email?>
                    </td>
                    <td><?php echo $record->phone?></td>
                    <td><?php echo $record->fname?></td>
                    <td><?php echo $record->lname?></td>
                    <td><?php echo $record->bemail?></td>
                    <td><?php echo $record->bphone?></td>
                    <td><?php echo showDateFormateTime($record->createdAt)?></td>
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
