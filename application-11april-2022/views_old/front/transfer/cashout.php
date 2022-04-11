<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><img src="<?php echo base_url('assets/icons/ocal_offer_sale black.png'); ?>" class="sidebar_icons" /> <?php echo $this->lang->line("Cashout")?> <?php // echo $this->lang->line("Refer a Friend")?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('user/dashboard')?>"><?php echo $this->lang->line("Dashboard")?></a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url('user/transfer')?>"><?php echo $this->lang->line("Transfer")?></a></li>
              <li class="breadcrumb-item active"><?php echo $this->lang->line("cashout")?></li>
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
            <div class="card card-primary">              
              <!-- /.card-header -->
              <?php echo load_alert();?>
              <!-- form start -->
              <form id="" action="" method="POST">
                <div class="card-body">
                    <div class="form-group">
                        <label for="name"><?php echo $this->lang->line("Select Type")?></label><span class="validate-star">*</span> 
                    
                        <?php foreach($cashouttype as $cline){?>
                            <input type="radio" name="cashout_type_id" value="<?php echo $cline->id?>" class="form-control" id="cashouttype" <?php if($cline->id =="1"){?>checked="checked"<?php }?>  data-validation="required" onchange="cashoutShow()"> <?php echo $cline->name;?>
                        <?php }?>        
                    </div>

                    <div class="form-group" style="text-align:center">
                        <div>
                            <label for="name"><?php echo CURRENCY?> <?php echo show_number($current_balance);?></label> 
                        </div>
                        <div>
                            <label for="name">Total Available Cash to Withdraw</label>
                        </div>
                    </div>
                    <div class="form-group" >
                        <label for="name"><?php echo $this->lang->line("Enter Amount")?></label><span class="validate-star">*</span> 
                        <input type="text" name="amount" class="form-control" id="amount" placeholder="Enter Amount" data-validation="required, number, server" data-validation-allowing="float" data-validation-url="<?php echo base_url('user/transfer/check_amount')?>">
                      </div>
                    <div class="form-group" id="bank_deposite" style="display:none">
                        <label for="name">Select Your Bank</label> 
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                            
                                
                                    <?php foreach( $all_bank as $bank){?>
                                                <tr>
                                    <td width="100"><img src="<?php echo base_url('/assets/Image/bank/bank.jpg');?>" width="50" class="img-fluid rounded"></td>
                                    <td>
                                        <label><?php echo $bank->name;?></label>
                                        <p>******<?php echo substr($bank->account_number, -4);?>
                                    </td>
                                    <td>
                                        <input type="radio" name="bank_id" id="bank-<?php $bank->id?>" value="<?php echo $bank->id?>" data-validation="required">
                                    </td>
                                </tr>
                                <?php }?>
                                            
                            </tbody>
                        </table>
                    </div>

                    <div class="form-group" id="mobile_wallet" style="display:none">
                        <label for="name">Select Mobile Wallet</label> 
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                            
                                
                                    <?php foreach( $all_wallet as $wallet){?>
                                                <tr>
                                    <td width="100"><img src="<?php echo base_url('/assets/Image/bank/bank.jpg');?>" width="50" class="img-fluid rounded"></td>
                                    <td>
                                        <label><?php echo $wallet->name;?></label>
                                    </td>
                                    <td>
                                        <input type="radio" name="wallet_id" id="wallet-<?php $wallet->id?>" value="<?php echo $wallet->id?>" data-validation="required">
                                    </td>
                                </tr>
                                <?php }?>
                                            
                            </tbody>
                        </table>
                    </div>
                    <div id="mobile_agent" style="display:none">
                        <h4>Enter Agent mobile</h4>
                  
                      <div class="form-group" >
                        <label for="name"><?php echo $this->lang->line("Contact Number")?></label><span class="validate-star">*</span> 
                        <input type="text" name="agent_mobile" class="form-control" id="agent_mobile" placeholder="Contact Number" data-validation="required,number">
                      </div>
                      <div class="form-group">
                        <label for="name"><?php echo $this->lang->line("Agent Code")?></label><span class="validate-star">*</span> 
                        <input type="text" name="agent_code" class="form-control" id="agent_code" placeholder="Agent Code" data-validation="required, server" data-validation-url="<?php echo base_url('user/transfer/check_agent_code')?>">
                      </div>  
                    </div>                   
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Withdrawal</button>
                </div>
              </form>
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
  <script>
  cashoutShow();
  function cashoutShow(){
    
    if($("input[name='cashout_type_id']:checked").val()==1){
      $("#bank_deposite").show();
      $("#mobile_wallet").hide();
      $("#mobile_agent").hide();
    }
    if($("input[name='cashout_type_id']:checked").val()==2){
      $("#bank_deposite").hide();
      $("#mobile_wallet").show();
      $("#mobile_agent").hide();

    }
    if($("input[name='cashout_type_id']:checked").val()==3){
      $("#bank_deposite").hide();
      $("#mobile_wallet").hide();
      $("#mobile_agent").show();
    }
  }
  </script>