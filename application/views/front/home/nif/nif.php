<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><i class="fas fa-certificate mini-card-icon"></i> <?php echo $this->lang->line("Verify")?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('user/home')?>"><?php echo $this->lang->line('Home');?></a></li>
              <li class="breadcrumb-item active"><?php echo $this->lang->line("Nif")?></li>
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
              <form id="addnif" action="" enctype="multipart/form-data" method="POST">
                  <div class="card-header">
                      <h4 class="theme_heading mb-0"><?php echo $this->lang->line("What do we ask for your NIF")?></h4>
                  </div>
              <div class="card-body">
                <div class="form-group">
                  <div class="alert alert-warning"><i class="fas fa-exclamation-triangle"></i> <?php echo $this->lang->line("To confirm your identity on Nusol you need to connect your nif.This does not give Nuvest any access to tour bank information or balances.This just enables Nuvest confirm your isentity(realname, phone number & date of birth) from your bank.")?></div>
			    </div> 
                <div class="form-group">
                  <label for="name"><?php echo $this->lang->line("Id Name")?> <span class="text-danger">*</span></label>
                  <input type="text" name="name" class="form-control" id="name" placeholder="<?php echo $this->lang->line("Id Name")?>" data-validation="required" value="<?php echo isset($record->name)?$record->name:''?>">
                </div>    
					 
                <div class="form-group">
                  <label for="name"><?php echo $this->lang->line("NIF No.")?> <span class="text-danger">*</span></label>
                  <input type="text" name="nif_number" class="form-control" id="nif_number" placeholder="<?php echo $this->lang->line("NIF No.")?>" data-validation="required" value="<?php echo isset($record->nif_number)?$record->nif_number:''?>">
                </div>
					 
                <div class="form-group">
                  <label for="name"><?php echo $this->lang->line("Add Nif Image")?> <span class="text-danger">*</span></label>
                  <?php 
                  if($userData->verify_nif<2){?>
                   <input type="file" name="nif_image" class="form-control" data-validation="required">
                    <?php }else{
                      $image = isset($record->image)?$record->image:''
                      ?>
                    <a href="<?php echo SHOW_NIF_IMAGE_ORIGINAL.$image?>" data-toggle="lightbox" data-title="Upload Receipt/Proof Image" data-gallery="gallery">

                      <img  src="<?php echo SHOW_NIF_IMAGE_ORIGINAL.$image;?>" alt="tab1" class="img img-fluid" style="max-width:100px">
                    </a>
                    <?php }?>
                </div>					                        
                 
              </div>
                <!-- /.card-body -->
                <?php if($userData->verify_nif<2){?>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary"><?php echo $this->lang->line("Get Verified")?></button>
              </div>
              <?php }?>
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

  <script src="<?php echo base_url('assets')?>/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
  <script>
  $(function () {
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true
      });
    });

   
  })
</script>
