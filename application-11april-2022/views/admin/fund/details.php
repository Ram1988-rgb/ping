<!-- Content Wrapper. Contains page content -->
<link rel="stylesheet" href="<?php echo base_url('assets')?>plugins/ekko-lightbox/ekko-lightbox.css">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><img src="<?php echo base_url('assets/icons/funding-black.png'); ?>" class="sidebar_icons" /> Fund Details</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin/cash')?>">Cash</a></li>
              <li class="breadcrumb-item active">Fund Details</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

   <!-- Main content -->
   <section class="content">
      <div class="container-fluid">
                   
            
            <?php echo load_alert();?>
            <!-- form start -->
            <?php $user_detail = get_user_detail($details->user_id);?>
              
            <table class="table table-bordered">
                <tr>
                    <th class="font-weight-bold" width="200">Customer Name </th>
                    <td><?php echo $user_detail->name?></td>
                </tr>
                <tr>
                    <th class="font-weight-bold" width="200">Email </th>
                    <td><?php echo $user_detail->email?></td>
                </tr>
                <tr>
                    <th class="font-weight-bold" width="200">Phone </th>
                    <td><?php echo $user_detail->phone?></td>
                </tr>
                <tr>
                    <th class="font-weight-bold" width="200">Type </th>
                    <td><?php echo $details->name ? $details->name : '' ;?></td>
                </tr>
                <tr>
                    <th class="font-weight-bold" width="200">Total Deposit Amount </th>
                    <td><?php echo CURRENCY?><?php echo $details->amount ? show_number($details->amount) : 0 ;?></td>
                </tr>
                
                <?php if($details->fundtype_id == 1){ ?>
                <tr>
                    <th class="font-weight-bold" width="200">Upload Receipt/Proof Image </th>
                    <td>
                    <a href="<?php echo SHOW_FUND_IMAGE_ORIGINAL.$details->bankdeposite_upload;?>" data-toggle="lightbox" data-title="Upload Receipt/Proof Image" data-gallery="gallery">
                    
                    <img width="100" height="100" src="<?php echo SHOW_FUND_IMAGE_THUMB.$details->bankdeposite_upload;?>" alt="tab1" class="img img-fluid" style="max-width:100"></td>
                </a>
                </tr>
                <?php } ?>
                
                <?php if($details->fundtype_id == 2){ ?>
                <tr>
                    <th class="font-weight-bold" width="200">Upload Check Image</th>
                    <td>
                        <div class="row">
                            <div class="col-lg-6">
        						<label for="exampleInputEmail1" class="mb-0">Front Side</label> :: <hr/>
                    <a href="<?php echo SHOW_FUND_IMAGE_ORIGINAL.$details->check_front_upload;?>" data-toggle="lightbox" data-title="Front Side" data-gallery="gallery">
                    
        						<img width="100" height="100" src="<?php echo SHOW_FUND_IMAGE_THUMB.$details->check_front_upload;?>" alt="tab1" class="img img-fluid" style="max-width:100px"> 					
                         </a>
                            </div>
                            <div class="col-lg-6 border-left">
        						<label for="exampleInputEmail1" class="mb-0">Back Side</label> :: <hr/>
                    <a href="<?php echo SHOW_FUND_IMAGE_ORIGINAL.$details->check_back_upload;?>" data-toggle="lightbox" data-title="Back Side" data-gallery="gallery">
                    
        						<img width="100" height="100" src="<?php echo SHOW_FUND_IMAGE_THUMB.$details->check_back_upload;?>" alt="tab1" class="img img-fluid" style="max-width:100px"> 
                     </a>       </div>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($details->fundtype_id == 3){ ?>
                <tr>
                    <th class="font-weight-bold" width="200">Special Code </th>
                    <td><?php echo $details->agent_special_code ? $details->agent_special_code : '' ;?></td>
                </tr>
                <?php } ?>
                <tr>
                    <th class="font-weight-bold" width="200"></th>
                    <!--<td><a href="<?php // echo base_url('admin/cash')?>" class="btn btn-primary">Back </a></td>-->
                    <td><a href="<?php echo base_url('admin/fund')?>" class="btn btn-primary">Back </a></td>
                </tr>
            </table>
              
              
           
   
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

    $('.filter-container').filterizr({gutterPixels: 3});
    $('.btn[data-filter]').on('click', function() {
      $('.btn[data-filter]').removeClass('active');
      $(this).addClass('active');
    });
  })
</script>