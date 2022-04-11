<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Nuvest | Customer 2FA OTP</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo ROUTE_STIE_PATH; ?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo ROUTE_STIE_PATH; ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo ROUTE_STIE_PATH; ?>assets/dist/css/adminlte.min.css">
  <!--Custom CSS-->
  <link rel="stylesheet" href="<?php echo ROUTE_STIE_PATH; ?>assets/dist/css/custom.css">
  </head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="">Nuvests 2FA </a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
     
      <form action="" method="post">
        <?php echo load_alert();?>
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Enter Otp" name="otp" id="otp" data-validation="required, server">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Submit</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mt-3 mb-1">
        <a href="<?php echo base_url('')?>">Login</a>
      </p>
      
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?php echo ROUTE_STIE_PATH; ?>assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo ROUTE_STIE_PATH; ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="<?php echo ROUTE_STIE_PATH; ?>assets/dist/js/adminlte.min.js"></script>
<script src="<?php echo ROUTE_STIE_PATH; ?>assets/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?php echo ROUTE_STIE_PATH; ?>assets/plugins/jquery-validation/additional-methods.min.js"></script>
<script src="<?php echo ROUTE_STIE_PATH; ?>assets/admin/validation.js"></script>
<script src="<?php echo ROUTE_STIE_PATH; ?>assets/plugins/daterangepicker/daterangepicker.js"></script>

<script src="<?php echo ROUTE_STIE_PATH; ?>assets/admin/jquery.form-validator.js"></script>

<script>
  $.validate({
        modules : ''
    });
   
</script>
</body>
</html>
