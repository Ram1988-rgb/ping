<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0"><img src="<?php echo base_url('assets/icons/person_black.png'); ?>" class="sidebar_icons" /> <?php echo $this->lang->line('Profile');?></h1>
         </div>
         <!-- /.col -->
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="<?php echo base_url('user/dashboard')?>"><?php echo $this->lang->line('Dashboard');?></a></li>
               <li class="breadcrumb-item active"><?php echo $this->lang->line('Profile');?></li>
            </ol>
         </div>
         <!-- /.col -->
      </div>
      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<section class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-6">
            <div class="p-2 px-3 border rounded mb-2">
            <a href="<?php echo base_url('/user/fund')?>">
                <div class="row align-items-center">
                    <div class="col-2 col-lg-1">
                        <i class="fas fa-wallet fa-2x"></i>
                    </div>
                    <div class="col-10 col-lg-11">
                        <label for="name" class="mb-0"><?php echo $this->lang->line('current_balance');?>: </label>
                        <P class="m-0"><?php echo CURRENCY;?> <?php echo show_number(getCurrentBalence($this->session->userdata('CUSTOMERID')))?></P>
                    </div>
                </div>
                </a>
            </div>
            <div class="p-2 px-3 border rounded mb-2">
            <a href="<?php echo base_url('/user/investment/myinvestment')?>">
                <div class="row align-items-center">
                    <div class="col-2 col-lg-1">
                        <i class="fas fa-wallet fa-2x"></i>
                    </div>
                    <div class="col-10 col-lg-11">
                        <label for="name" class="mb-0"><?php echo $this->lang->line('total_investment');?>: </label>
                        <P class="m-0"><?php echo CURRENCY;?> <?php echo show_number($this->investment_model->get_investment_saving($this->session->userdata('CUSTOMERID')));?></P>
                    </div>
                </div>
                </a>
            </div>
            <div class="p-2 px-3 border rounded mb-2">
            <a href="<?php echo base_url('/user/loan/myloan')?>">
                <div class="row align-items-center">
                    <div class="col-2 col-lg-1">
                        <i class="fas fa-wallet fa-2x"></i>
                    </div>
                    <div class="col-10 col-lg-11">
                        <label for="name" class="mb-0"><?php echo $this->lang->line('total_loan');?>: </label>
                        <P class="m-0"><?php echo CURRENCY;?> <?php echo show_number(get_total_loan($this->session->userdata('CUSTOMERID')))?></P>
                    </div>
                </div>
            </div>
            </a>
         </div>
         <div class="col-md-6">
            <div class="p-2 px-3 border rounded mb-2">
               <div class="row">
                   <div class="col-8">
                       <label for="name"><img src="<?php if($this->session->userdata('CUSTOMERIMAGE')) { echo SHOW_USER_IMAGE_THUMB.$this->session->userdata('CUSTOMERIMAGE');}else{echo SHOW_AVATAR_IMAGE;}?>"></label>
                   </div>
                   <div class="col-4 text-right">
                       <a href="<?php echo base_url('user/home/edit_profile')?>">
                        <button type="button" class="btn border rounded text-capitalize"><i class="far fa-edit"></i> <?php // echo $this->lang->line('Edit Profile');?></button>
                       </a>
                   </div>
               </div>
            </div>
            <div class="p-2 px-3 border rounded mb-2">
               <label for="name" class="text-capitalize">Name: <?php echo $this->session->userdata('CUSTOMERNAME')?> </label> <br/>
            
                
               <label for="name">Email: <?php echo $this->session->userdata('CUSTOMEREMAIL')?></label>   <br/>
            
                
               <label for="name">Phone: <?php echo $this->session->userdata('CUSTOMERPHONE')?></label>   <br/>
            </div>
            <!--<div class="p-2 px-3 border rounded mb-2"> -->
            <!--   <a href="<?php echo base_url('user/home/edit_profile')?>">-->
            <!--   <button type="button" class="btn border rounded text-capitalize"><i class="far fa-edit"></i> <?php echo $this->lang->line('Edit Profile');?></button>-->
            <!--   </a>-->
            <!--</div>-->
         </div>
      </div>
     
     
      <div class="container-fluid px-0">
         <!-- Small boxes (Stat box) -->
         <?php echo load_alert();?>
         
        <!--My Bank-->
        <a href="<?php echo base_url('/')?>user/home/bank">
            <div class="mini-card">
                <div>
                    <strong><i class="fas fa-university mini-card-icon"></i></strong> 
                    <span class="mini-card-divider">|</span> <?php echo $this->lang->line('my_bank');?>
                </div>
                <!-- <div>
                    <span class="mini-card-divider">|</span>
                    <div class="mini-card-verify">
                        <i class="far fa-check-circle mini-card-icon"></i> Verified
                    </div>
                </div> -->
            </div>
        </a>
         
        <!--Verify Contact Number-->
        <a style="cursor:pointer" <?php if($userData->verify_phone){?>onclick="verifymessage()"<?php }else{?>href="<?php echo base_url('/')?>user/home/contact"<?php }?>>
            <div class="mini-card">
                <div>
                    <?php if($userData->verify_phone){?>
                        <strong><i class="fas fa-address-book mini-card-icon"></i></strong>
                    <?php }?>
                    <span>
                        <span class="mini-card-divider">|</span> <?php echo $this->lang->line('verify_contact_number');?>
                    </span>
                </div>
                <div>
                    <span class="mini-card-divider">|</span>
                    <div class="mini-card-verify">
                        <i class="far fa-check-circle mini-card-icon"></i> Verified
                    </div>
                </div>
            </div>
        </a>
         
        <!--Verify Email-->
        <a style="cursor:pointer" <?php if($userData->verify_email){?>onclick="verifymessage()"<?php }else{?> href="<?php echo base_url('/')?>user/home/verify_email"<?php }?>>
            <div class="mini-card">
                <div>
                    <?php if($userData->verify_email){?>
                        <strong><i class="far fa-envelope mini-card-icon"></i></strong>
                    <?php }?>
                    <span>
                        <span class="mini-card-divider">|</span> <?php echo $this->lang->line('verify_email_address');?>
                    </span>
                </div>
                <div>
                    <span class="mini-card-divider">|</span>
                    <div class="mini-card-verify">
                        <i class="far fa-check-circle mini-card-icon"></i> Verified
                    </div>
                </div>
            </div>
        </a>
        
        <!--Verify NIF-->
        <a style="cursor:pointer"  <?php if($userData->verify_nif !=2){?> href="<?php echo base_url('/')?>user/home/nif"<?php }else{?>onclick="verifymessage()"<?php }?>>
            <div class="mini-card">
                <div>
                    <strong><i class="fas fa-certificate mini-card-icon"></i></strong>
                    <span>
                        <span class="mini-card-divider">|</span> <?php echo $this->lang->line('verify_nif');?>
                    </span>
                    <?php if($userData->verify_nif ==1){?>
                        <p>Note* Please upload document again for verify.</p>
                        <?php }?>
                </div>
                <div>
                <span class="mini-card-divider">|</span> 
                    <?php if($userData->verify_nif ==2){?>
                        <div class="mini-card-verify">
                            <i class="far fa-check-circle mini-card-icon"></i> Verified
                        </div>
                    <?}else if($userData->verify_nif ==1){?>
                        <div class="mini-card-pendind">
                            <i class="far fa-check-circle mini-card-icon"></i> Refused
                        </div>
                    <?php }
                    else if($userData->verify_nif==3){
                    ?>
                    <div class="mini-card-pendind">
                            <i class="far fa-check-circle mini-card-icon"></i> Requested
                        </div>
                    <?php }else{?>
                        <div class="mini-card-pending">
                        <i class="far fa-times-circle mini-card-icon"></i> Pending
                    </div>
                    <?php }?>
                </div>
            </div>
        </a>
        
        <!--Pending-->
        <!-- <a href="<?php echo base_url('/')?>user/home/">
            <div class="mini-card">
                <div>
                    <strong><i class="fas fa-info-circle mini-card-icon"></i></strong>
                    <span>
                        <span class="mini-card-divider">|</span> Pending
                    </span>
                </div>
                <div>
                    <span class="mini-card-divider">|</span>
                    <div class="mini-card-pending">
                        <i class="far fa-times-circle mini-card-icon"></i> Pending
                    </div>
                </div>
            </div>
        </a> -->
        
        <!--Verify_dermalog-->
        <a style="cursor:pointer" <?php if($userData->verify_dermalog !=2){?>href="<?php echo base_url('/')?>user/home/verify_dermalog" <?php }else{?>onclick="verifymessage()"<?php }?>>
            <div class="mini-card">
                <div>
                    <strong><i class="fas fa-box mini-card-icon"></i></strong>
                    <span>
                        <span class="mini-card-divider">|</span> <?php echo $this->lang->line('verify_dermalog');?>
                        
                    </span>
                    <?php if($userData->verify_dermalog ==1){?>
                        <p>Note* Please upload document again for verify.</p>
                        <?php }?>
                </div>
                <div>
                    <span class="mini-card-divider">|</span> 
                    <?php if($userData->verify_dermalog ==2){?>
                        <div class="mini-card-verify">
                            <i class="far fa-check-circle mini-card-icon"></i> Verified
                        </div>
                    <?}else if($userData->verify_dermalog ==1){?>
                        <div class="mini-card-pendind">
                            <i class="far fa-check-circle mini-card-icon"></i> Refused
                        </div>
                    <?php }
                    else if($userData->verify_dermalog==3){
                    ?>
                    <div class="mini-card-pendind">
                            <i class="far fa-check-circle mini-card-icon"></i> Requested
                        </div>
                    <?php }else{?>
                        <div class="mini-card-pending">
                        <i class="far fa-times-circle mini-card-icon"></i> Pending
                    </div>
                    <?php }?>
                </div>
            </div>
        </a>
        
        <!--Add 2FA-->
       
            <div class="mini-card">
                <div>
                    <strong><i class="fas fa-folder-plus mini-card-icon"></i></strong>
                    <span>
                        <span class="mini-card-divider">|</span> Add 2FA
                    </span>
                </div>
                <div class="custom-control custom-switch">
                      <input type="checkbox" name="tofa" value="1" class="custom-control-input tofa" id="customSwitch1" <?php if($userData->tofa){?>checked="checked" <?php }?> onchange="changetofa()">
                      <label class="custom-control-label" for="customSwitch1"></label>
                    </div>
            </div>
        
        
        
        
        
            
            
            
        
         <!-- Main row -->
         <!-- /.row (main row) -->
      </div>
      <!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>
 function changetofa(){
     let tofa = 0;
    if ($('.tofa').is(":checked"))
    {
        tofa = 1;
    }
    $.ajax({
        type: "POST",
        url: baseURL+"user/home/tofa",
        data: {tofa: tofa},
        success: function(loanform) {
            
        }
    });
    
 }
 function verifymessage(){
    Swal.fire('Already Verified')
 }
</script>