<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><img src="<?php echo base_url('assets/icons/funding-black.png'); ?>" class="sidebar_icons" /> <?php echo $this->lang->line('Fund');?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('agent/dashboard')?>"><?php echo $this->lang->line('Dashboard');?></a></li>
              <li class="breadcrumb-item active">Fund Request</li>
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
                        <h4 class="theme_heading"><?php echo $this->lang->line('Total Avilable Fund');?></h4>
                        <p class="mb-0 text-success font-weight-bold"><?php if($total_fund){echo "HTG ". $total_fund;}?></p>
                    </div>
                </div>
                
            </div>
            
            <hr />
                    
            <table id="example2" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th><?php echo $this->lang->line('Name');?></th>  
                <th><?php echo $this->lang->line('Email');?></th>  
                <th><?php echo $this->lang->line('Phone');?></th>   
                <th><?php echo $this->lang->line('Amount');?></th>
                <th><?php echo $this->lang->line('Status');?></th>
                <th><?php echo $this->lang->line('Date');?></th>
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
                  <td><?php echo $record->email?></td>
                  <td><?php echo $record->phone?></td>
                  <td><?php echo $record->amount?></td>  
                  <td id="status-<?php echo $record->id;?>">
                        <?php if($record->status == 1){ ?>
                          <a  class="mini-card-verify px-3">Active </a> 
                          <?php }else{ ?>
                            <a onclick="changeStatus('<?php echo TBL_AGENTFUND;?>', '<?php echo $record->id;?>','agentfund')" class="mini-card-pending px-3">Inactive </a> 
                        <?php } ?>                     
					           </td>
                  <td><?php echo showDateFormateTime($record->createdAt);?></td>                                    
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
