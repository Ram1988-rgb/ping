<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Transaction</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard')?>">Home</a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin/user')?>">User</a></li>
              <li class="breadcrumb-item active">Transaction</li>
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
        <div class="col-md-12">
          
            <p>Customer Name : <?php echo $userDetail->name?></p>
          </div>
          <div class="col-md-12">
            <p>Email : <?php echo $userDetail->email?></p>
          </div>
          <div class="col-md-12">
            <p>Phone : <?php echo $userDetail->phone?></p>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
          
          <?php echo load_alert()?>
          
            <div class="card">
             
              
              <!-- /.card-header -->
              <div class="card-body">
              
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                  <th>Card Owner Name</th>
                    <th>Account no</th>
                    <th>Month</th>
                    <th>Year</th>
                    <th>Cvv</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  foreach ($all_record as $record)
                  {
                  ?>
                  <tr id="row-<?php echo $record->id?>">
                    <td><?php echo $record->card_owner_name?></td>
                    <td><?php echo $record->account_no?>
                    </td>
                    <td><?php echo $record->month?></td>
                    <td><?php echo $record->year?></td>
                    <td><?php echo $record->cvv?></td>
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
