<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">User</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('user/dashboard')?>">Dashboard</a></li>
              <li class="breadcrumb-item active">User</li>
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
            <div class="col-2"style="float:right;margin-bottom:20px">
              <a href="<?php echo base_url('admin/')?>user/add"><button type="button" class="btn btn-block btn-primary">Add User</button></a>
            </div>
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
                    <th>Bank</th>
                    <th>Edit</th>
                    <th>Delete</th>
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
                    <td><a href="<?php echo site_url('admin/user/bank/'.$record->id)?>">Bank Detail</td>
                    <td>
                      <a href="<?php echo site_url('admin')?>/user/edit/<?php echo $record->id?>">
                        <button type="button" class="btn btn-block btn-primary btn-sm">Edit</button>
                      </a>
                    </td>
                    <td><a href="<?php echo site_url('admin')?>/user/deleterecord/<?php echo $record->id?>"><button type="button" class="btn btn-block btn-danger btn-sm">Delete</button></td>
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
