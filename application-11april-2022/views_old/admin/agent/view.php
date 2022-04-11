<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><img src="<?php echo base_url('assets/icons/person_black.png'); ?>" class="sidebar_icons" /> Agent</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"> <a href="<?php echo base_url('admin/dashboard')?>">Home</a></li>
              <li class="breadcrumb-item active">Agent</li>
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
              <a href="<?php echo base_url('admin/')?>agent/add" class="btn btn-primary">Add Agent</a>
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
                    <th>Current Amount(<?php echo CURRENCY;?>)</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Edit</th>
                    
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  if($all_record){
                  foreach ($all_record as $record)
                  {
                    $CI =& get_instance();
                    $CI->load->model('agentfund_model');
                  ?>
                  <tr id="row-<?php echo $record->id?>">
                    <td><?php echo $record->name?></td>
                    <td><?php echo $record->email?></td>
                    <td><?php echo $record->phone?></td>
                    <td><?php echo $record->code?></td>
                    <td><?php echo show_number($CI->agentfund_model->get_total_fund($record->id));?></td>
                    <td id="status-<?php echo $record->id;?>">
                        <?php if($record->status == 1){ ?>
                          <a onclick="changeStatus('<?php echo TBL_AGENT;?>','<?php echo $record->id;?>','agent')" class="mini-card-verify px-3">Active </a> 
                          <?php }else{ ?>
                            <a onclick="changeStatus('<?php echo TBL_AGENT;?>', '<?php echo $record->id;?>','agent')" class="mini-card-pending px-3">Inactive </a> 
                        <?php } ?>                     
					           </td>
                     <td><?php echo showDateFormateTime($record->createdAt)?></td>
                    <td>
                      <a href="<?php echo site_url('admin')?>/agent/edit/<?php echo $record->id?>">
                        <button type="button" class="btn btn-block btn-primary btn-sm">Edit</button>
                      </a>
                    </td>
                    
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
