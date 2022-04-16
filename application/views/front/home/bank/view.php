<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><i class="fas fa-university"></i> <?php echo $this->lang->line('Bank Accounts');?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard')?>"><?php echo $this->lang->line('Home');?></a></li>
              <li class="breadcrumb-item active"><?php echo $this->lang->line('Bank Accounts');?></li>
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
                
          
              <?php echo load_alert();?>
    
                <table class="table table-bordered">
                    <tr>
                        <th colspan="2">
                            <div class="row align-items-center mb-0">
                                <div class="col-8">
                                    <h4 class="theme_heading m-0"><?php echo $this->lang->line("We've found ").count($all_record)?> <?php echo $this->lang->line(" bank accounts belongs to you.");?></h4>
                                </div>
                                <div class="col-4 text-right">
                                    <a href="<?php echo base_url('user/home/add')?>" class="btn btn-primary"><?php echo $this->lang->line("Add New")?> </a>
                                </div>
                            </div>
                        </th>
                    </tr>
                  <?php
                  if($all_record ){
                    foreach ($all_record as $record)
                    {
                    ?>
                        <tr>
                            <td width="100"><img src="<?php echo base_url('assets/Image/bank/bank.jpg')?>" width="50" class="img-fluid rounded"></td>
                            <td>
                                <label><?php echo $record->name?></label>
                                <p>******<?php echo substr($record->account_number, -4);?></p>
                            </td>
                        </tr>
                    <?php 
                      }
                    }
                    ?>
                    
                </table>
             
     
      </div><!-- /.container-fluid -->
    </section>
    
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
