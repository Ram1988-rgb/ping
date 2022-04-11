<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><img src="<?php echo base_url('assets/icons/person_black.png'); ?>" class="sidebar_icons" /> Customer</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"> <a href="<?php echo base_url('admin/dashboard')?>">Home</a></li>
              <li class="breadcrumb-item active">Customer</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <!-- Main content -->
    <section class="content pdf_csv_admin_user_view">
      <div class="container-fluid">
        <div class="box-shadow mb-3 p-2 text-right">
              <a href="<?php echo base_url('admin/')?>user/add" class="btn btn-primary">Add Customer</a>
        </div>
          <?php echo load_alert()?>
          
            <div class="box-shadow mb-3 p-2">
              
             
              
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Dermalog</th>
                    <th>Nif</th>
                    <th>2FA</th>
                    <th>Date</th>
                    <th>status</th>
                    <th>Action</th>
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
                    <td><a href="<?php echo base_url('admin/user/detail/'.$record->id)?>"><?php echo $record->name?></a></td>
                    <td><?php echo $record->email?>
                    </td>
                    <td><?php echo $record->phone?></td>
                    <td>
                      <?php if($record->verify_dermalog == 0){?>
                      Not Uploaded
                      <?php }else if($record->verify_dermalog == 1){ ?>
                        <a href="<?php echo site_url('admin/user/dermalog/'.$record->id)?>">Refused</a>
                      <?php }else if($record->verify_dermalog == 2){ ?>
                        <a href="<?php echo site_url('admin/user/dermalog/'.$record->id)?>">Verified</a>
                        <?php }else if($record->verify_dermalog == 3){ ?>
                          <a href="<?php echo site_url('admin/user/dermalog/'.$record->id)?>">Requested</a>
                        <?php }?>
                    </td>
                    <td>
                      <?php if($record->verify_nif == 0){?>
                      Not Uploaded
                      <?php }else if($record->verify_nif == 1){ ?>
                        <a href="<?php echo site_url('admin/user/nif/'.$record->id)?>">Refused</a>
                      <?php }else if($record->verify_nif == 2){ ?>
                        <a href="<?php echo site_url('admin/user/nif/'.$record->id)?>">Verified</a>
                        <?php }else if($record->verify_nif == 3){ ?>
                          <a href="<?php echo site_url('admin/user/nif/'.$record->id)?>">Requested</a>
                        <?php }?>
                    </td>
                    <td>
                      <?php if($record->tofa == 1){ ?>
                        <a  class="mini-card-verify px-3" style="" >Active </a> 
                        <?php }else{ ?>
                          <a  class="mini-card-pending px-3">Inactive </a> 
                      <?php } ?> 
                    </td>
                    <td><?php echo showDateFormateTime($record->createdAt)?></td>
                    <td id="status-<?php echo $record->id;?>">
                      <?php if($record->status == 1){ ?>
                        <a onclick="changeStatus('<?php echo TBL_USER;?>','<?php echo $record->id;?>','user')" class="mini-card-verify px-3" style="cursor: pointer" >Active </a> 
                        <?php }else{ ?>
                          <a onclick="changeStatus('<?php echo TBL_USER;?>', '<?php echo $record->id;?>','user')" class="mini-card-pending px-3" style="cursor: pointer">Inactive </a> 
                      <?php } ?> 
                    </td>

                    <td>
                      <div>
                        <a href="<?php echo site_url('admin/user/bank/'.$record->id)?>">Bank Details</a>
                      </div>
                      <div>
                        <a href="<?php echo site_url('admin/user/card/'.$record->id)?>">Card Details</a>
                      </div>
                      <div>
                        <a href="<?php echo site_url('admin/user/transaction/'.$record->id)?>">View Transaction</a>
                      </div>
                    </td>
                    <td>
                      <a href="<?php echo site_url('admin')?>/user/edit/<?php echo $record->id?>">
                        <button type="button" class="btn btn-block btn-primary btn-sm">Edit</button>
                      </a>
                    </td>
                    <td><a onclick="deleteData('<?php echo site_url('admin')?>/user/deleterecord/<?php echo $record->id?>')"><button type="button" class="btn btn-block btn-danger btn-sm">Delete</button></td>
                  </tr>
                  <?php }?>
                  
                  </tbody>
                 
                </table>
             
            </div>
     

           
         
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
