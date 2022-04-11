<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><img src="<?php echo base_url('assets/icons/logs-black.png'); ?>" class="sidebar_icons" /> Agent Log</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard')?>">Home</a></li>
              <li class="breadcrumb-item active">Agent Log</li>
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
      <div class="search-container">
        <form action="" method="post">
          
          <div class="row">
            <div class='col-sm-3'>
              <label>From Date</label>
              <input type='text' class="form-control alldate" value="<?php echo $this->input->get_post('fromdate');?>" name="fromdate" id="fromdate" />
            </div>
            <div class='col-sm-3'>
              <label>To Date</label>
              <input type='text' class="form-control alldate" name="todate" id="todate" value="<?php echo $this->input->get_post('todate');?>"  />
            </div>
            
            <div class='col-sm-3'>
            
              <input type="submit" name="submit" value="Search" class="btn btn-primary" style="margin-top:30px;" >
              <a href="<?php echo base_url('admin/logs/agent')?>"><input type="button" value="Clear" class="btn btn-primary" style="margin-top:30px;" ></a>
            </div>
          </div>
          </form>
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
                  <th>Sr.No</th>
                    <th>Name</th>
                    <th>Last transaction date</th>
                    <th>Total Debit</th>
                    <th>Total Credit</th>
                    <th>Total Transaction</th>
                    <th>Last Login</th>
                    <th>Detail</th>                    
                  </tr>
                </thead>
                <tbody>
                <?php if($users){
                  $i=1;
                  $url ='';
                  if($this->input->get_post('fromdate') & $this->input->get_post('todate')){
                    $url = '?fromdate='.$this->input->get_post("fromdate").'&todate='.$this->input->get_post("todate");
                  }
                  foreach($users as $line){
                  ?>
                  <tr>
                    <td><?php echo $i++;?></td>
                    <td><?php echo $line->name;?></td>
                    <td><?php echo showDateFormateTime($line->last_transaction_date);?></td>
                    <td><?php echo $line->total_debit;?></td>
                    <td><?php echo $line->total_credit;?></td>
                    <td><?php echo $line->total_transaction;?></td>
                    <th><?php echo showDateFormateTime($line->last_login);?></th>
                    <td><a href="<?php echo base_url('admin/logs/agent_detail/'.$line->id.$url)?>">
                          <button type="button" class="btn btn-block btn-primary btn-sm">Details</button>
                        </a>
                    </td>
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
