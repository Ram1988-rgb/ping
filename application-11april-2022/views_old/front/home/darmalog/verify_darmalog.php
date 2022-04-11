<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><i class="fas fa-box mini-card-icon"></i> <?php echo $this->lang->line("Verify")?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('user/home')?>"><?php echo $this->lang->line('Home');?></a></li>
              <li class="breadcrumb-item active"><?php echo $this->lang->line("Dermalog")?></li>
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
                      <h4 class="theme_heading mb-0"><?php echo $this->lang->line("Proof of identity")?></h4>
                  </div>
              <div class="card-body">
                <div class="form-group">
                  
				    <div class="alert alert-warning"><i class="fas fa-exclamation-triangle"></i> <?php echo $this->lang->line("In order to completed to your verification Please upload a copy of passport with a clear selfie photo to proof the document holder.")?></div>
				</div> 
                <div class="form-group">
                  <label for="name"><?php echo $this->lang->line("Upload Proof identity")?> <span class="text-danger">*</span></label>
                  <?php 
                  if($userData->verify_dermalog<2){?>
                  <input type="file" name="proof_image" class="form-control" id="proof_image" placeholder="<?php echo $this->lang->line("Upload Proof identity")?>" data-validation="required">
                  <?php }else{?>
                    <a href="<?php echo SHOW_DERMALOG_IMAGE_ORIGINAL.$dermalog->proof_image?>" data-toggle="lightbox" data-title="Upload Receipt/Proof Image" data-gallery="gallery">

                      <img  src="<?php echo SHOW_DERMALOG_IMAGE_ORIGINAL.$dermalog->proof_image?>" alt="tab1" class="img img-fluid" style="max-width:100px">
                    </a>
                  <?php }?>
                    <p class="mt-2"><?php echo $this->lang->line("We accept only Id card, Passport.")?></p>
                </div>    
					 
				</div>
				<div class="card-header">
				    <h4 class="theme_heading mb-0"><?php echo $this->lang->line("A selfie with your identity")?></h4>
				</div>
				<div class="card-body">
                <div class="form-group">
				    <div class="alert alert-warning"><i class="fas fa-exclamation-triangle"></i> <?php echo $this->lang->line("Please make sure that every details of the Id document is clearly visible.")?></div>
				</div> 
					 
                <div class="form-group">
                  <label for="name"><?php echo $this->lang->line("Take a selfie with identity")?> <span class="text-danger">*</span></label>
                  <?php if($userData->verify_dermalog<2){?>
                    <input type="file" name="selfie_image" id="selfie_image" class="form-control" data-validation="required">
                  <?php }else{?>
                    <a href="<?php echo SHOW_DERMALOG_IMAGE_ORIGINAL.$dermalog->selfie_image?>" data-toggle="lightbox" data-title="Upload Receipt/Proof Image" data-gallery="gallery">

                      <img  src="<?php echo SHOW_DERMALOG_IMAGE_THUMB.$dermalog->selfie_image?>" alt="tab1" class="img img-fluid" style="max-width:100px">
                    </a>
                  <?php }?>
                  <p class="mt-2"><?php echo $this->lang->line("Please note Screenshots mobile phone bills and insurance are not accepted.")?></p>
                </div>					                        
                 
              </div>
                <!-- /.card-body -->
              <div class="card-footer">
               <?php if($userData->verify_dermalog<2){?>
                  <button type="submit" class="btn btn-primary"><?php echo $this->lang->line("Get Verified")?></button>
                <?php }?>
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