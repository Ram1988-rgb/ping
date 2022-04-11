<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><i class="fas fa-address-book"></i> <?php echo $this->lang->line('Verify')?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo base_url('user/dashboard')?>"><?php echo $this->lang->line('Dashboard')?></a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url('user/home')?>"><?php echo $this->lang->line('Profile')?></a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url('user/home/contact')?>"><?php echo $this->lang->line('Contact')?></a></li>
              <li class="breadcrumb-item active"><?php echo $this->lang->line('Verify')?></li>
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
              <form id="verify_contact" action="" method="POST">
                <div class="card-header">
                    <h4 class="theme_heading mb-0"><?php echo $this->lang->line('Please enter the otp sent on your mobile number')?></h4>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <div class="Timer_verify"></div>
                    <label for="name"><?php echo $this->lang->line('Verification Code'); ?>(<?php echo $otpDetail->otp;?>)</label>					
                    <input type="text" name="otp" id="otp" class="form-control" placeholder="<?php echo $this->lang->line('Verification Code')?>" required>
                </div>
                <div class="form-group">
                    <button id="send_again" disabled type="button" class="btn btn-primary" style="float:right"><?php echo $this->lang->line('Send Again')?></button>
                </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary submit_verify_contact"><?php echo $this->lang->line('Get Verified')?></button>
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
  <script>
  let timerOn = true;

function timer(remaining) {
  var m = Math.floor(remaining / 60);
  var s = remaining % 60;
  m = m < 10 ? '0' + m : m;
  s = s < 10 ? '0' + s : s;
  $('.Timer_verify').html(m + ':' + s);
  remaining -= 1;
  
  if(remaining >= 0 && timerOn) {
    setTimeout(function() {
        timer(remaining);
    }, 1000);
    return;
  }

  if(!timerOn) {
    // Do validate stuff here
    return;
  }
  
  // Do timeout stuff here
  $("#otp").attr("disabled",true);
  $("#send_again").removeAttr("disabled");
 // alert('Timeout for otp');
}
$("#send_again").removeAttr("disabled");
var time = "<?php echo $time;?>";
if((120-parseInt(time))>0){
timer(120-parseInt(time));
}else{
  $("#send_again").removeAttr("disabled");
}

$( "#send_again" ).click(function() {
    $.ajax({
        url : baseURL+"/user/home/send_otp",
        type: "POST",
        dataType:"json",
        data : {phone:"<?php echo $phone;?>"}
    }).done(function(response){ 
        if(response.status){
          alert(response.message)
          location.reload();
        }
    });
});

$( "#verify_contact" ).on( "submit", function(e) { 
  
    $.ajax({
        url : baseURL+"/user/home/verify_otp",
        type: "POST",
        dataType:"json",
        data : {otp:$("#otp").val()}
    }).done(function(response){ //
      if(response.status){
        alert(response.message);
        window.location.href="<?php echo base_url('user/home/contact')?>";
      }else{
        alert(response.message);
        window.location.href="<?php echo base_url('user/home/contact')?>";
      }

    });
    e.preventDefault();
});
  </script>
