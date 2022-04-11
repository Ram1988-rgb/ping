<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><i class="fas fa-piggy-bank"></i> <?php echo $this->lang->line("nif")?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('user/home')?>"><?php echo $this->lang->line('Home');?></a></li>
              <li class="breadcrumb-item active"><?php echo $this->lang->line("nif")?></li>
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
              <form id="addamount" action="nif" enctype="multipart/form-data" method="POST">
                <div class="card-body">
					<div class="form-group">
						<label for="name"><?php echo $this->lang->line("id_name")?></label>
						<input type="text" name="name" class="form-control" id="name" placeholder="<?php echo $this->lang->line("enter_id_name")?>" required>
					 </div>    
					 
					 <div class="form-group">
						<label for="name"><?php echo $this->lang->line("nif_number")?></label>
						<input type="text" name="nif_number" class="form-control" id="nif_number" placeholder="<?php echo $this->lang->line("enter_nif_number")?>" required>
					 </div>
					 
					 <div class="form-group">
						<label for="name"><?php echo $this->lang->line("add_nif_image")?></label>
						<input type="file" name="nif_image" class="form-control" >
					 </div>					                        
                 
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary"><?php echo $this->lang->line("save")?></button>
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
