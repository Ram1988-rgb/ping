<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?php echo $this->lang->line('Fund');?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard')?>"><?php echo $this->lang->line('Home');?></a></li>
              <li class="breadcrumb-item active"><?php echo $this->lang->line('Fund');?></li>
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
              <a href="<?php echo base_url('/')?>user/fund/add"><button type="button" class="btn btn-block btn-primary"><?php echo $this->lang->line('Add Fund');?></button></a>
            </div>
          </div>
          <?php echo load_alert()?>
          
            <div class="card">
              
              <!-- /.card-header -->
              <div class="card-body">
                <h2><?php echo $this->lang->line('Total Avilable Fund');?></h2>
                <p><?php if($total_fund){echo "HTG ". $total_fund->amount;}?></p>
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th><?php echo $this->lang->line('Name');?></th>  
                    <th><?php echo $this->lang->line('Amount');?></th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  if($all_record ){
                    foreach ($all_record as $record)
                    {
                    ?>
                    <tr id="row-<?php echo $record->id?>">
                      <td><?php echo $record->name?></td>
                      <td><?php echo $record->amount?></td>                     
                    </tr>
                  <?php
                    }
                  }
                  ?>
                  
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
