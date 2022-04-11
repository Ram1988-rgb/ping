<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><i class="fas fa-tachometer-alt"></i> Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard')?>">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
        <div class="row">
          <div class="col-lg-3 col-6">
            <a href="<?php echo base_url('admin/user')?>">
            <div class="dash-small-box small-box-primary">
              <div class="inner">
                <h3 class="dash_card_title1"><?php echo $userCount?></h3>
                <p>Customer Registrations</p>
              </div>
              <div class="icon">
                <img src="<?php echo base_url('assets/icons/person.png'); ?>" class="sidebar_iconss" />
              </div>
              <!--<a href="<?php echo base_url('admin/user')?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>-->
            </div>
            </a>
          </div>
          <!-- col -->
          <div class="col-lg-3 col-6">
            <a href="<?php echo base_url('admin/plan')?>" class="small-box-footer">
                <div class="dash-small-box small-box-success">
                  <div class="inner">
                    <h3 class="dash_card_title1"><?php echo $planCount?><sup style="font-size: 20px"></sup></h3>
                    <p>Plan</p>
                  </div>
                  <div class="icon">
                    <img src="<?php echo base_url('assets/icons/plan.png'); ?>" class="sidebar_iconss" />
                  </div>
                  <!--<a href="<?php // echo base_url('admin/plan')?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>-->
                </div>
            </a>
          </div>
          <!-- col -->
          <div class="col-lg-3 col-6">
            <a href="#">
                <div class="dash-small-box small-box-warning">
                    <div class="inner">
                        <h3 class="dash_card_title1"><?php echo CURRENCY;?> <?php echo get_total_loan()?></h3>
                        <p>Total Loan</p>
                    </div>
                    <div class="icon">
                        <img src="<?php echo base_url('assets/icons/mask_group_46.png'); ?>" class="sidebar_iconss" />
                    </div>
                </div>
            </a>
          </div>
          <!-- col -->
          <div class="col-lg-3 col-6">
                <a href="#">
                    <div class="dash-small-box small-box-danger">
                        <div class="inner">
                            <h3 class="dash_card_title1"><?php echo CURRENCY;?> <?php echo show_number($this->investment_model->get_investment_saving());?></h3>
                            <p>Total Investment</p>
                        </div>
                        <div class="icon">
                            <img src="<?php echo base_url('assets/icons/all_inbox.png'); ?>" class="sidebar_iconss" />
                        </div>
                    </div>
                </a>
          </div>
          <!-- col -->
        </div>
        <!-- row -->
        
        <div class="card mb-2">
            <div class="card-header">
                <h4 class="text-capitalize mb-0">Summary</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php if(1=='2'){?>
                    <div class="col-lg-4 border-right">
                      <a href="https://nuvest.sarasolutions.in/user/cash">
                        <h4 class="theme_heading">Cash</h4>
                        <p>Add cash quickly into your account for favorable interest rate.</p>                        
                      </a>
                    </div>
                    <?php }?>
                    
                    <div class="col-lg-6 border-right">
                      <a href="https://nuvest.sarasolutions.in/user/investment">
                        <h4 class="theme_heading">Investment</h4>
                        <p>Invest for higher returns, make your money work for you.</p>
                      </a>
                    </div>
                    
                    <div class="col-lg-6">
                      <a href="https://nuvest.sarasolutions.in/user/loan">
                        <h4 class="theme_heading">Loan</h4>
                        <p>Take a loan to cover personal expenses and make purchases at low rates.</p>
                      </a>
                    </div>
                    
                </div>
            </div>
        </div>
      
        
     
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->