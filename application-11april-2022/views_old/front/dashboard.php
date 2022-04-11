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
              <li class="breadcrumb-item"><a href="<?php echo base_url('user/dashboard')?>"><?php echo $this->lang->line('Home');?></a></li>
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
          
          
          
          
        <!-- Small boxes (Stat box) -->
        <!--<div class="card mb-2">-->
        <!--    <div class="card-body">-->
        <!--        <h4 class="theme_heading text-capitalize"><?php echo $this->session->userdata('CUSTOMERNAME')?></h4>-->
        <!--        <p>HTG <?php if($total_fund){ echo $total_fund->amount;}?></p>-->
        <!--    </div>-->
        <!--</div>-->
        
        
        
        
        <div class="card mb-2">
            <!--<div class="card-header">-->
            <!--    <h4 class="text-capitalize mb-0"><?php echo $this->lang->line('My Plan');?></h4>-->
            <!--</div>-->
            <div class="card-body">
                
                <div class="row align-items-center">
                    <!--Left col-->
                    <div class="col-lg-3 pr-lg-0">
                        <h4 class="text-capitalize border-bottom pb-2 mb-3"><!--<img src="<?php echo base_url('assets/icons/person_black.png'); ?>" class="sidebar_icons" />--> Profile</h4>
                        
                        <a href="<?php echo base_url('user/home/index')?>">
                            <div class="dash-small-box small-box-primary">
                              <div class="icon">
                                <img src="<?php echo base_url('assets/icons/person.png'); ?>" class="sidebar_iconss" />
                              </div>
                              <div class="inner">
                                <h3 class="dash_card_title1"><?php echo $this->session->userdata('CUSTOMERNAME')?></h3>
                                <p><?php echo CURRENCY;?> <?php echo show_number(getCurrentBalence($this->session->userdata('CUSTOMERID')));?></p>
                              </div>
                            </div>
                        </a>
                    </div>
                    
                    <!--free col-->
                    <div class="col-lg-1 text-center px-0">
                        <i class="fas fa-angle-double-right fa-3x" style="opacity:0.2;margin-top:30px;"></i>
                    </div>
                    
                    <!--Right col-->
                    <div class="col-lg-8 pl-lg-0">
                        <h4 class="text-capitalize border-bottom pb-2 mb-3"><!--<img src="<?php echo base_url('assets/icons/mask_group_46.png'); ?>" class="sidebar_icons" />--> <?php echo $this->lang->line('My Plan');?></h4>
                        
                        <div class="row">
                          <div class="col-lg-4 col-6">
                            <!-- small box -->
                            <a href="<?php echo base_url('user/cash')?>">
                                <div class="dash-small-box small-box-warning">
                                  <div class="icon">
                                    <img src="<?php echo base_url('assets/icons/mask_group_46.png'); ?>" class="sidebar_iconss" />
                                  </div>
                                  <div class="inner">
                                    <h3 class="dash_card_title1"><?php echo CURRENCY.' '.show_number($total_cash);?></h3>
                                    <p><?php echo $this->lang->line('Total Cash');?></p>
                                  </div>
                                </div>
                            </a>
                          </div>
                          <!-- ./col -->
                          <div class="col-lg-4 col-6">
                            <!-- small box -->
                            <a href="<?php echo base_url('user/investment/myinvestment')?>">
                                <div class="dash-small-box small-box-success">
                                  <div class="icon">
                                    <img src="<?php echo base_url('assets/icons/all_inbox.png'); ?>" class="sidebar_iconss" />
                                  </div>
                                  <div class="inner">
                                    <h3 class="dash_card_title1"><?php echo CURRENCY?> <?php if($total_investment){ echo show_number($total_investment);}else{ echo '0.00';}?></h3>
                                    <p><?php echo $this->lang->line('Total Investments');?></p>
                                  </div>
                                </div>
                            </a>
                          </div>
                          <!-- ./col -->
                          <div class="col-lg-4 col-6">
                            <!-- small box -->
                            <a href="<?php echo base_url('user/loan/myloan')?>">
                                <div class="dash-small-box small-box-danger">
                                  <div class="icon">
                                    <img src="<?php echo base_url('assets/icons/loan.png'); ?>" class="sidebar_iconss" />
                                  </div>
                                  <div class="inner">
                                    <h3 class="dash_card_title1"><?php echo CURRENCY?> <?php if($total_loan){ echo show_number($total_loan->amount);}else{?>0.00<?php }?></h3>
                                    <p><?php echo $this->lang->line('Total Loan');?></p>
                                  </div>
                                </div>
                            </a>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-lg-4 col-6">
                              <!-- small box -->
                              <a href="<?php echo base_url('user/interest/earned')?>">
                                  <div class="dash-small-box small-box-danger">
                                    <div class="icon">
                                      <img src="<?php echo base_url('assets/icons/loan.png'); ?>" class="sidebar_iconss" />
                                    </div>
                                    <div class="inner">
                                      <h3 class="dash_card_title1"><?php echo $total_interest?></h3>
                                      <p><?php echo $this->lang->line('Interest Earned');?></p>
                                    </div>
                                  </div>
                              </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                 
            </div> <!--card-body-->
        </div> <!--card-->
       

        
        
        
       
        <div class="card mb-2">
            <div class="card-header">
                <h4 class="text-capitalize mb-0"><?php echo $this->lang->line('Choose Plan');?></h4>
            </div>
            <div class="card-body">
                <div class="row">
                    
                    <div class="col-lg-4 border-right">
                      <a href="<?php echo base_url('user/cash')?>">
                        <h4 class="theme_heading"><?php echo $this->lang->line('Cash');?></h4>
                        <p><?php echo $this->lang->line('Add cash quickly into your account for favorable interest rate.');?></p>
                      </a>
                    </div>
                    
                    <div class="col-lg-4 border-right">
                      <a href="<?php echo base_url('user/investment')?>">
                        <h4 class="theme_heading"><?php echo $this->lang->line('Investment');?></h4>
                        <p><?php echo $this->lang->line('Invest for higher returns, make your money work for you.');?></p>
                      </a>
                    </div>
                    
                    <div class="col-lg-4">
                      <a href="<?php echo base_url('user/loan')?>">
                        <h4 class="theme_heading"><?php echo $this->lang->line('Loan');?></h4>
                        <p><?php echo $this->lang->line('Take a loan to cover personal expenses and make purchases at low rates.');?></p>
                        
                      </a>
                    </div>
                    
                </div>
            </div>
        </div>

        
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
