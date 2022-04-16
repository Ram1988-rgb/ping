<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><img src="<?php echo base_url('assets/icons/funding-black.png'); ?>" class="sidebar_icons" /> <?php echo $this->lang->line('Interest Earned');?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard')?>"><?php echo $this->lang->line('Dashboard');?></a></li>
              <li class="breadcrumb-item active"><?php echo $this->lang->line('Interest Earned');?></li>
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
          <div class="row align-items-end">
                <div class="col-8">
                    <div class="bg-white">
                        <h4 class="theme_heading"><?php echo $this->lang->line('Total Earned Interest');?></h4>
                        <p class="mb-0 text-success font-weight-bold"><?php echo CURRENCY.' '.show_number(get_total_interest($this->session->userdata('CUSTOMERID')));?></p>
                    </div>
                </div>
                
            </div>
            
            <hr />
                    
            <table id="example2" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th><?php echo $this->lang->line('Plan');?></th>  
                <th><?php echo $this->lang->line('Amount');?></th>
                <th><?php echo $this->lang->line('Interest Rate');?>(%)</th>
                <th><?php echo $this->lang->line('Interest Amount');?>(<?php echo CURRENCY;?>)</th>
                <th><?php echo $this->lang->line('Date');?></th>
                <th><?php echo $this->lang->line('Details');?></th>
              </tr>
              </thead>
              <tbody>
              <?php
              if($all_record ){
                foreach ($all_record as $record)
                {
                  $CI=& get_instance();
                  $CI->load->model('interest_model');
                  $plan_name = $CI->interest_model->get_plan($record);
                  $module ="Cash";
                  if($record->investment_id){
                    $module = "Investment";
                  }
                  if($record->loan_id){
                    $module = "Loan";
                  }
                  
                ?>
                <tr id="row-<?php echo $record->id?>">
                  <td><?php echo $plan_name; ?>(<?php echo $module;?>)</td>
                  <td><?php echo show_number($record->amount)?></td>  
                  <td><?php echo $record->interest_rate?></td>  
                  <td><?php if($record->module =="LOAN"){ echo "-";}?> <?php echo show_number($record->interest_amount);?></td>  
                  <td><?php echo showDateFormateTime($record->createdAt);?></td> 
                  <td>
                  <?php
                    $detail_url ="#";
                    if($record->module == "Loan" || $record->module == "LOAN"){
                      $detail_url = base_url('user/loan/loan_detail/'.$record->loan_id);
                    }
                    if($record->module == "Investment"){
                      $detail_url = base_url('user/investment/investment_detail/'.$record->investment_id);
                    }
                    if($record->module == "Cash"){
                      $detail_url = base_url('user/cash/cash_detail/'.$record->cash_id);
                    }
                  ?>
                    <a href="<?php echo $detail_url;?>">
                      <button type="button" class="btn btn-block btn-primary btn-sm">Details</button>
                    </a>
                  </td>                  
                </tr>
              <?php
                }
              }
              ?>
              
              </tbody>
             
            </table>

           
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
