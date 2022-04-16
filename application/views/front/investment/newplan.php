<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><img src="<?php echo base_url('assets/icons/all_inboxblack.png'); ?>" class="sidebar_icons" /> <?php echo $this->lang->line('Investment Plan')?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('user/dashboard/index')?>"><?php echo $this->lang->line('Dashboard')?></a></li>
              <li class="breadcrumb-item active"><?php echo $this->lang->line('Investment Plan')?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->

    <section class="content">
      <div class="container-fluid">
         <!-- /.card-body -->
         <?php echo load_alert();?>
         
         
   
            <div class="row">
                <div class="col-8">
                    <h4 class="invest-current theme_heading"><?php echo $this->lang->line('Current Saving')?></h4>
                    <p class="invest-value mb-0 text-success font-weight-bold"><?php echo CURRENCY?> <?php echo ($total_investment)?show_number($total_investment):'0.00';?></p>
                </div>
                <div class="col-sm-4"></div>
            </div>
        
        <hr />
         

        <div class="row">
            <div class="col-12 col-sm-12">
              
            <h4 class="investment-plan mb-3"><?php echo $this->lang->line('Investment Plan')?></h4>
            
            <ul class="nav nav-tabs investment_plan_tabs" id="custom-tabs-one-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">New Plan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Summary</a>
                </li>                  
            </ul>
            
            <div class="tab-content" id="custom-tabs-one-tabContent">
            	<div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
            		<?php foreach($all_investment_plan as $investmentPlan){ ?>
            			<section class="investment-plans">
            			    <div class="row">
            			        <div class="col-lg-8">
            			            <a href="<?php echo base_url('user/investment/createplan/pid/'.$investmentPlan->id)?>">
            			                <div class="font-weight-bold"><?php echo $investmentPlan->name?></div>
            			            </a>
            			            <div class=""><?php echo $investmentPlan->description?></div>
            			            <div class="font-weight-bold mt-3">Payment mode</div>
            			            <div class="">Bank/Cash</div>
            			        </div>
            			        <div class="col-lg-2 text-lg-right">
            			            <div class="font-weight-bold">Duration</div>
									<?php  
										$duration = $this->plan_model->get_plan_type_duration($investmentPlan->id);
										foreach($duration as $dur){
											
									?>
            			            <div class=""><?php echo $dur->label?></div>
									<?php
										} 
									?>
            			            <!-- <div class="mt-3">
            			                <a href="<?php echo base_url('user/investment/createplan/pid/'.$investmentPlan->id)?>" class="mini-card-verify text-success text-center px-2"><?php echo $investmentPlan->name?> Detail</a>
            			            </div> -->
            			        </div>
								<div class="col-lg-2 text-lg-right">
            			            <div class="font-weight-bold">Rate</div>
									<?php  
										$duration = $this->plan_model->get_plan_type_duration($investmentPlan->id);
										foreach($duration as $dur){
											
									?>
            			            <div class=""><?php echo $dur->rate?> %</div>
									<?php
										} 
									?>
            			            <div class="mt-3">
            			                <a href="<?php echo base_url('user/investment/createplan/pid/'.$investmentPlan->id)?>" class="mini-card-verify text-success text-center px-2"><?php echo $investmentPlan->name?> Detail</a>
            			            </div>
            			        </div>
            			    </div>
            			</section>
            			
            		<?php }?>
            	</div>
            	<div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
            		<?php foreach($all_investment_plan as $investmentPlan){ 
            			$invs = $this->investment_model->get_total_investment($investmentPlan->id);
            			
            		?>
            		<!--<div class="row" style="width:500px">-->
            		<!--	<div class="col-sm-12 col-12 investment-plans">-->
            		<!--		<p><?php echo $investmentPlan->name?>: </p>-->
            		<!--		<?php echo isset($invs->amount)?$invs->amount:0;?>-->
            
            		<!--	</div>-->
            		<!--</div>-->
            		
            		<section class="investment-plans">
        			    <div class="row">
        			        <div class="col-lg-9">
        			            <div class="font-weight-bold"><?php echo $investmentPlan->name?></div>
        			            <div class=""><?php echo CURRENCY?> <?php echo isset($invs->amount)?show_number($invs->amount):'0.00';?></div>
        			        </div>
        			        <div class="col-lg-3 text-lg-right">
        			            <div class="mini-card-verify px-2 text-center">
        			                 <?php echo CURRENCY?> <?php echo isset($invs->amount)?show_number($invs->amount):'0.00';?>
        			            </div>
        			        </div>
        			    </div>
        			</section>
            			
            			
            		<?php }?>
            	</div>
            	
            </div>
              
              
            
            </div>  <!--col12-->
        </div> <!--row-->
        
     
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
