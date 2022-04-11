<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><img src="<?php echo base_url('assets/icons/logs-black.png'); ?>" class="sidebar_icons" />Customer Log(<?php echo $userdeail->name;?>)</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard')?>">Home</a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin/logs/index')?>">Customer Log</a></li>
              <li class="breadcrumb-item active">Detail</li>
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
                  <th>Sr.No</th>
                    <th>Transaction date</th>
                    <th>Amount</th>
                    <th>status</th>                    
                  </tr>
                </thead>
                <tbody>
                <?php if($logdetail){
                  $i=1;
                  foreach($logdetail as $line){
                  ?>
                  <tr>
                    <td><?php echo $i++;?></td>
                    <td><?php echo $line->createdAt;?></td>
                    <td><?php echo $line->amount;?></td>
                    <td><?php if($line->in_out=="IN"){?>Credit<?php }else{?> Dabit <?php }?></td>
                    
                  </tr>
                  <?php }}?>
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
