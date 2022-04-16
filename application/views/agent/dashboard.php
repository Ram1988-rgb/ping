<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><i class="fas fa-tachometer-alt"></i> <?php echo $this->lang->line('Dashboard');?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('agent/dashboard')?>"><?php echo $this->lang->line('Dashooard');?></a></li>
              <li class="breadcrumb-item active"><?php echo $this->lang->line('Dashboard');?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
          
          
          
          
        
        
        
        
        
        <div class="card mb-2">
            <!--<div class="card-header">-->
            <!--    <h4 class="text-capitalize mb-0"><?php echo $this->lang->line('Total Fund');?></h4>-->
            <!--</div>-->
            <div class="card-body">
                
                <div class="row align-items-center">
                    <!--Left col-->
                    <div class="col-lg-3 pr-lg-0">
                        <h4 class="text-capitalize border-bottom pb-2 mb-3"><!--<img src="<?php echo base_url('assets/icons/person_black.png'); ?>" class="sidebar_icons" />--> Agent Fund</h4>
                        
                        <a href="#">
                            <div class="dash-small-box small-box-primary">
                              <div class="icon">
                                <img src="<?php echo base_url('assets/icons/person.png'); ?>" class="sidebar_iconss" />
                              </div>
                              <div class="inner">
                                <h3 class="dash_card_title1"><?php echo $this->session->userdata('AGENTNAME')?></h3>
                                <p>HTG 5000</p>
                              </div>
                            </div>
                        </a>
                    </div>
                    
                   
                </div>
                
                 
            </div> <!--card-body-->
        </div> <!--card-->
       

        
        
        
       
        

        
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
