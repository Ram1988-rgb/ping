<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><img src="<?php echo base_url('assets/icons/sms-black.png'); ?>" class="sidebar_icons" /> <?php echo $this->lang->line('Transfer');?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('user/dashboard')?>"><?php echo $this->lang->line('Dashboard');?></a></li>
              <li class="breadcrumb-item active"><?php echo $this->lang->line('Transfer');?></li>
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
                <a href="<?php echo base_url('user/transfer/ownaccount')?>">
                  <div class="row">                  
                      <div class="col-md-6 own-account">
                        <p><?php echo $this->lang->line('Own Account Transfer');?></p>
                      </div>
                    
                  </div>
                </a>
                <a href="<?php echo base_url('user/transfer/anotherapp')?>">
                  <div class="row">
                    <div class="col-md-6 another-app">
                    <p><?php echo $this->lang->line('Transfer to Another App');?></p>
                    </div>
                  </div>
                </a>
                <a href="<?php echo base_url('user/transfer/cashout')?>">
                  <div class="row">
                    <div class="col-md-6 cashout">
                      <p><?php echo $this->lang->line('Cashout');?></p>
                    </div>
                  </div>
                </a>
               
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
