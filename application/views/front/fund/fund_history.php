<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><i class="fas fa-history"></i> History</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('user/dashboard')?>"><?php echo $this->lang->line('Dashboard');?></a></li>
              <li class="breadcrumb-item active">History Summary</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <div class="search-container">
        <form action="" method="post">
          <div class="row">
            <h5>Search History</h5>
          </div>
          <div class="row">
            <div class='col-sm-3'>
              <label>From Date</label>
              <input type='text' class="form-control alldate" value="<?php echo $this->input->get_post('fromdate');?>" name="fromdate" id="fromdate" />
            </div>
            <div class='col-sm-3'>
              <label>To Date</label>
              <input type='text' class="form-control alldate" name="todate" id="todate" value="<?php echo $this->input->get_post('todate');?>"  />
            </div>
            <div class='col-sm-3'>
              <label>Plan</label>
              <select name="plan" id="plan" class="form-control">
                <option value="">Select</option>
                <option value="Fund" <?php if($this->input->get_post('plan') =="Fund"){?>selected<?php }?>>Fund</option>
                <!-- <option value="Cash" <?php if($this->input->get_post('plan') =="Cash"){?>selected<?php }?>>CASH</option> -->
                <option value="Investment" <?php if($this->input->get_post('plan') =="Investment"){?>selected<?php }?>>Investment</option>
                <option value="Loan" <?php if($this->input->get_post('plan') =="Loan"){?>selected<?php }?>>Loan</option>
               
              </select>
            </div>
            <div class='col-sm-3'>
            
              <input type="submit" name="submit" value="Search" class="btn btn-primary" style="margin-top:30px;" >
              <a href="<?php echo base_url('user/fund/fund_history')?>"><input type="button" value="Clear" class="btn btn-primary" style="margin-top:30px;" ></a>
            </div>
          </div>
          </form>
        </div>
      
          
        <ul class="list-unstyled">
            <!--1-->
            <?php foreach($details as $line){?>
            
                <li class="card mb-2">
                    
                    <div class="card-body">
                        <div class="row">
                         <div class="col-lg-10">
                            <b><?php echo showDateFormate($line['date']);?></b>
                         </div>
                        </div>
                        <?php 
                        foreach($line['detail'] as $inline){
                        ?>
                        <div class="row">
                            <div class="col-lg-10">
                                <div class="font-weight-bold"><?php echo $inline['title']?></div>
                                <div><?php echo $inline['message']?></div>
                            </div>
                            <div class="col-lg-2 text-right">
                                <strong class="text-success">
                                
                                <?php echo $inline['sign'].CURRENCY.' '.$inline['amount']?></strong>
                            </div>
                        </div>
                        <div class="dropdown-divider my-3"></div>
                        <?php }?>
                       
                    </div>
                </li>
            <?php }?>
            <!--2-->
           
        </ul>
        
        
        
        
        
          
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<style>
  .search-container {
    box-shadow: none;
    border: 1px solid rgb(207, 219, 224);
    border-radius: 5px;
    padding: 20px;
    margin-bottom:10px;
}
</style>