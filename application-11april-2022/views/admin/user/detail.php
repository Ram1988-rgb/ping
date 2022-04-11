<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><img src="<?php echo base_url('assets/icons/loan-black.png'); ?>" class="sidebar_icons" /> User Details</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin/user')?>">User</a></li>
              <li class="breadcrumb-item active">User Details</li>
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
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
        
              <?php echo load_alert();?>
              <!-- form start -->
              
                <div class="mb-3">
                     <table class="table table-bordered text-dark">
                        <tr>
                            <th width="150" class="font-weight-bold"> Customer Name</th>
                            <td class="text-capitalize"><?php echo $details->name ? $details->name : 0 ;?></td>
                        </tr>
                        <tr>
                            <th width="150" class="font-weight-bold">Email</th>
                            <td><?php echo $details->email ? $details->email : 0 ;?></td>
                        </tr>
                        <tr>
                            <th width="150" class="font-weight-bold">Phone</th>
                            <td><?php echo $details->phone ? $details->phone : 0 ;?></td>
                        </tr>
                        <tr>
                            <th width="150" class="font-weight-bold">Date of birth</th>
                            <td>
                                <?php echo $details->dob ? $details->dob : '' ;?>
                            </td>
                        </tr>
                        <tr>
                            <th width="150" class="font-weight-bold">Gender</th>
                            <td>
                                <?php echo $details->gender ? $details->gender :'Male' ;?>
                            </td>
                        </tr>
                        <tr>
                            <th width="150" class="font-weight-bold">Address</th>
                            <td>
                                <?php echo $details->address ? $details->address :'' ;?>
                            </td>
                        </tr>

                        <tr>
                            <th width="150" class="font-weight-bold">Verify Phone</th>
                            <td>
                            <span class="mini-card-<?php echo $details->verify_phone ? "verify" : "pending" ;?> text-center px-1"><?php echo $details->verify_phone ? "ACTIVE" : "PENDING" ;?></span>
                           </td>
                        </tr>
                        
                        <tr>
                            <th width="150" class="font-weight-bold">Verify Email</th>
                            <td>
                            <span class="mini-card-<?php echo $details->verify_email ? "verify" : "pending" ;?> text-center px-1"><?php echo $details->verify_email ? "ACTIVE" : "PENDING" ;?></span>
                           </td>
                        </tr>
                        <tr>
                            <th width="150" class="font-weight-bold">Verify Nif</th>
                            <td>
                            <span class="mini-card-<?php echo $details->verify_nif ? "verify" : "pending" ;?> text-center px-1"><?php echo $details->verify_nif ? "ACTIVE" : "PENDING" ;?></span>
                           </td>
                        </tr>
                        
                        <tr>
                            <th width="150" class="font-weight-bold">Status</th>
                            <td>
                                <!--<?php // echo $details->status ? "ACTIVe" : "PENDING" ;?>-->
                                <span class="mini-card-<?php echo $details->status ? "verify" : "pending" ;?> text-center px-1"><?php echo $details->status ? "ACTIVE" : "PENDING" ;?></span>
                            </td>
                        </tr>
                        <tr>
                            <th width="150" class="font-weight-bold">Wallet Ammount</th>
                            <td>
                                <?php echo CURRENCY?> <?php echo show_number($wallet_amount)?>
                            </td>
                        </tr>
                        <?php if($loan_record ){?>
                        <tr>

                            <th  class="font-weight-bold" colspan="2" >
                            <h4>Loan</h4>
                              <table id="" class="table">
                                <tr>
                                  <th>Plan</th>
                                  <th>Amount(<?php echo CURRENCY?>)</th>
                                  <th>Interest Rate(%)</th>
                                  <th>Duration</th>
                                  <th>Details</th>
                                </tr>
                                <?php
                  
                              foreach ($loan_record as $record)
                              {
                                  //print_r($record);
                              ?>
                                <tr>
                                  <td><a href="<?php echo base_url('admin/loan');?>"><?php echo JSON_DECODE($record->plan_data)->name?></a></td>
                                  <td><?php echo $record->amount;?></td>
                                  <td><?php echo $record->interest_rate;?></td>
                                  <td><?php echo JSON_DECODE($record->payment_deuration_data)->label?></td>
                                  <td><a href="<?php echo base_url()?>/admin/loan/view/<?php echo $record->id;?>">
								<button type="button" class="btn btn-block btn-primary btn-sm">Details</button>
							</a></td>
                                </tr>
                            <?php }?>
                              </table>
                            </th>
                            
                        </tr>
                        <?php }?>
                        <?php if($investment_record ){?>
                        <tr>

                            <th  class="font-weight-bold" colspan="2" >
                            <h4>Investment</h4>
                            <table id="example2" class="table table-bordered table-hover">
                                <tr>
                                  <th>Plan</th>
                                  <th>Amount<?php echo CURRENCY;?></th>
                                  <th>Interest Rate(%)</th>
                                  <th>Duration</th>
                                  <th>Details</th>
                                </tr>
                                <?php
                  
                              foreach ($investment_record as $record)
                              {
                                  //print_r($record);
                              ?>
                                <tr>
                                  <td><a href="<?php echo base_url('admin/investment');?>"><?php echo JSON_DECODE($record->plan_data)->name?></a></td>
                                  <td><?php echo $record->amount?></td>
                                  <td><?php echo $record->interest_rate?></td>
                                  <td><?php   if($record->payment_deuration_data!='null'){ echo JSON_DECODE($record->payment_deuration_data)->label;}else{echo '--';}?></td>
                                  <td>
                                    <a href="<?php echo base_url('investment/investment_detail/'.$record->id)?>">
                                      <button type="button" class="btn btn-block btn-primary btn-sm">Details</button>

                                    </a>
                                  </td>
                                </tr>
                                <?php }?>
                              </table>
                            </th>
                            
                        </tr>
                        <?php }?>
                        <tr>
                            <th width="150"></th>
                            <td>
                                <a href="<?php echo base_url('admin/user')?>" class="btn btn-primary">Back </a>
                            </td>
                        </tr>
                    </table>
                   
                </div>                           
        
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
