<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><img src="<?php echo base_url('assets/icons/mask_group_46_black.png'); ?>" class="sidebar_icons" /> Agent Fund Details</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin/agentfund')?>">Agent Fund</a></li>
              <li class="breadcrumb-item active">Agent Fund Details</li>
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
              
                <div class="card-body">
				
				 <div class="form-group">
                    <label for="name">Agent Name</label> ::
                    <label for="name"><?php echo $details->name ? $details->name : '' ;?></label>
                  </div>
                  <div class="form-group">
                    <label for="name">Email</label> ::
                    <label for="name"><?php echo $details->email ? $details->email : '' ;?></label>
                  </div>
                  <div class="form-group">
                    <label for="name">Phone</label> ::
                    <label for="name"><?php echo $details->phone ? $details->phone: '' ;?></label>
                  </div>
                  <div class="form-group">
                    <label for="name">Amount</label> ::
                    <label for="name"><?php echo CURRENCY.$details->amount ;?></label>
                  </div>
                  <div class="form-group">
                    <label for="name">Remark</label> ::
                    <label for="name"><?php echo $details->remark ? $details->remark: '' ;?></label>
                  </div>
                  <div class="form-group">
                    <label for="name">Document</label> ::
                    <label for="name">
                      <a href="<?php echo SHOW_AGENTFUND_IMAGE_ORIGINAL?><?php echo $details->document_name ? $details->document_name: '' ;?>" data-toggle="lightbox" data-title="Document" data-gallery="gallery">
                    
                      <img src="<?php echo SHOW_AGENTFUND_IMAGE_THUMB?><?php echo $details->document_name ? $details->document_name: '' ;?>" width="50" height="50">
                   </a>
                    </label>
                  </div>
                  
                  <div class="form-group">
                    <label for="name">Fund Date</label> ::
                    <label for="name"><?php echo showDateFormate($details->fund_date) ? showDateFormate($details->createdAt) : '' ;?></label>
                  </div>
                   
                </div>
                
                <div class="card-footer">
                  <a href="<?php echo base_url('admin/agentfund/index')?>"><button class="btn btn-primary">Back</button></a>
                </div>   
                <!-- /.card-body -->
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