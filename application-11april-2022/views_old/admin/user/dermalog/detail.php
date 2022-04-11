<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dermalog</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard')?>">Home</a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin/user')?>">User</a></li>
              <li class="breadcrumb-item active">Dermalog</li>
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
              <form id="adduser" action="<?php echo base_url('admin/user/status_dermalog/')?>/<?php echo $userDetail->id;?>" method="POST" onsubmit="return dermalag_verify()">
                <div class="card-body">
                <div class="form-group">
                <label for="name">Verified Status</label>
                <select name="verify_dermalog" id="verify_dermalog" class="form-control" onchange="">
                  <option value="3" <?php if($userDetail->verify_dermalog == 3){?>selected="selected"<?php }?>>Requested</option>
                  <option value="1" <?php if($userDetail->verify_dermalog == 1){?>selected="selected"<?php }?>>Refused</option>
                  <option value="2" <?php if($userDetail->verify_dermalog == 2){?>selected="selected"<?php }?>>Verified</option>
                </select>
                </div>
                  <div class="form-group">
                    <label for="name">Name</label>
                    <?php echo $userDetail->name;?>
                    </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <?php echo $userDetail->email;?>
                 </div>
                  <div class="form-group">
                    <label for="phone">Phone</label>
                    <?php echo $userDetail->phone;?>
                 </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Proof Image</label>
                        <div>
                        <a href="<?php echo SHOW_DERMALOG_IMAGE_ORIGINAL.$dermalog->proof_image?>" data-toggle="lightbox" data-title="Upload Receipt/Proof Image" data-gallery="gallery">

                      <img  src="<?php echo SHOW_DERMALOG_IMAGE_ORIGINAL.$dermalog->proof_image?>" alt="tab1" class="img img-fluid" style="max-width:100px">
                    </a>
                        </div>
                    </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Selfie Image</label>
                    <div>
                    <a href="<?php echo SHOW_DERMALOG_IMAGE_ORIGINAL.$dermalog->selfie_image?>" data-toggle="lightbox" data-title="Upload Receipt/Proof Image" data-gallery="gallery">

<img  src="<?php echo SHOW_DERMALOG_IMAGE_THUMB.$dermalog->selfie_image?>" alt="tab1" class="img img-fluid" style="max-width:100px">
</a>
                    </div>
                   </div>
                   <div class="form-group">
                      <table class="table">
                      <tr>
                        <td>Mode</td>
                        <td>Date</td>
                        <td>verified By</td>
                      </tr>
                      <?php foreach($dermalog_detail as $line){?>
                        <tr>
                          <td><?php 
                          if($line->status ==3){
                            echo 'Requested';
                          }
                          else if($line->status ==2){
                            echo 'Verified';
                          }
                          else if($line->status ==1){
                            echo 'Refused';
                          }else{
                            echo 'Pending';
                          }
                          ?></td>
                          <td><?php echo showDateFormateTime($line->date)?></td>
                          <td>
                          <?php 
                          $CI=& get_instance();
                          if($line->verified_by){
                            $CI->load->model('admin_model');
                            $admin_detail = $CI->admin_model->get_record($line->verified_by);
                            if($admin_detail && $admin_detail->first_name){
                              echo $admin_detail->first_name.' '.$admin_detail->last_name;
                            }
                          }else{ echo "-";}
                          ?>
                          </td>
                      </tr>
                      <?php }?>
                      </table>
                  </div>
                    </div>
                    <?php if($userDetail->verify_dermalog !=2){?>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <?php }?>
                  
                <!-- /.card-body -->
           
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
  function dermalag_verify(){
    const str =$("#dermalag_verify").val();
    window.location.href ="<?php echo base_url('admin/user/status_dermalog/'.$userDetail->id)?>?status="+str;
  }
  $(function () {
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true
      });
    });

   
  })
  </script>