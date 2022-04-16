<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><img src="<?php echo base_url('assets/icons/all_inboxblack.png'); ?>" class="sidebar_icons" /> Account Report</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('user/dashboard/index')?>"><?php echo $this->lang->line('Dashboard')?></a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url('user/investment/index')?>"><?php echo $this->lang->line('Account Report')?></a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->

    <section class="content">
      <div class="container-fluid">
          
        <p class="text-center box-shadow p-2 rounded mb-2"><?php echo ACCOUNT_REPORT_TITLE?></p>
          
        
          
          
         
        

        <div class="gray-box p-4">
            <!-- jquery validation -->
              
          
              
              <!-- /.card-header -->
              <?php echo load_alert();?>
              
              <!-- form start -->
              <form id="" action="" method="POST">
                <div class="row">
                  <div class="form-group col-lg-6"><a  href="<?php echo base_url('user/index/makefundhistoryPdf/'.$user_id)?>">
                     <span><?php echo base_url('user/index/makefundhistoryPdf/'.$user_id)?></span>
                    </a>
                  </div>
                  </div>
                </div>
                <a  href="<?php echo base_url('user/index/makefundhistoryPdf/'.$user_id)?>">
                    <button type="button" class="btn btn-primary my-2">Download</button>
                </a>
              </form>
            
 
            </div>
    

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  
  <!-- /.content-wrapper -->

  
  