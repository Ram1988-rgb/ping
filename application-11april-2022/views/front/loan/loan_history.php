<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0"><img src="<?php echo base_url('assets/icons/loan-black.png'); ?>" class="sidebar_icons" /> <?php echo $this->lang->line('Loan History');?></h1>
         </div>
         <!-- /.col -->
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="<?php echo base_url('user/dashboard')?>"><?php echo $this->lang->line('Dashboard');?></a></li>
               <li class="breadcrumb-item active"><?php echo $this->lang->line('Loan History');?></li>
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
    <div class="row align-items-end">
                <div class="col-8">
                   
                </div>
                
            </div>
            
            <hr />
        <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    
                    <th><?php echo $this->lang->line('Amount');?></th>
                    <th><?php echo $this->lang->line('Mode');?></th>
                    <th><?php echo $this->lang->line('Action');?></th>
                    <th><?php echo $this->lang->line('Date');?></th>
                                        
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  if($all_record ){
                    foreach ($all_record as $record)
                    {
                        //print_r($record);
                    ?>
                    <tr id="row-<?php echo $record->id?>">
                      <td><?php echo show_number($record->amount)?></td>
                      <td><?php echo $record->operation=='IN'?'Credit':'Debit' ?></td>
                      <td><?php echo $record->loan_id?'Loan':'Transfer' ?></td>
                      <td><?php echo showDateFormateTime($record->createdAt)?></td>                               
                    </tr>
                  <?php
                    }
                  }
                  ?>
                  
                  </tbody>
                 
                </table>
      
      
      
      
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->