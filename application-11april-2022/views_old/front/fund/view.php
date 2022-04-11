<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><img src="<?php echo base_url('assets/icons/funding-black.png'); ?>" class="sidebar_icons" /> <?php echo $this->lang->line('Wallet');?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard')?>"><?php echo $this->lang->line('Dashboard');?></a></li>
              <li class="breadcrumb-item active"><?php echo $this->lang->line('Wallet');?></li>
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
                        <h4 class="theme_heading"><?php echo $this->lang->line('Total Wallet Amount');?></h4>
                        <p class="mb-0 text-success font-weight-bold"><?php if($total_fund){echo "HTG ". show_number($total_fund);}?></p>
                    </div>
                </div>
                <div class="col-4 text-right">
                    <a href="<?php echo base_url('/')?>user/fund/add"><button type="button" class="btn btn-primary"><?php echo $this->lang->line('Add Wallet Amount');?></button></a>
                </div>
            </div>
            
            <hr />
                    
            <table id="example2" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th><?php echo $this->lang->line('Type');?></th>  
                <th><?php echo $this->lang->line('Amount');?>(<?php echo CURRENCY;?>)</th>
                <th><?php echo $this->lang->line('Status');?></th>
                <th><?php echo $this->lang->line('Date');?></th>
                <th><?php echo $this->lang->line('Details');?></th>
              </tr>
              </thead>
              <tbody>
              <?php
              if($all_record ){
                foreach ($all_record as $record)
                {
                ?>
                <tr id="row-<?php echo $record->id?>">
                  <td><?php echo $record->name?></td>
                  <td><?php echo show_number($record->amount);?></td>  
                  <td><?php if($record->status){?>Active<?php }else{?>Pending<?php }?></td>  
                  <td><?php echo showDateFormateTime($record->createdAt);?></td> 
                  <td>
                    <a href="<?php echo site_url('user')?>/fund/detail/<?php echo $record->id?>">
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
