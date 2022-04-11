<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Nuvest: Customer Login</title>

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
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo ROUTE_STIE_PATH; ?>assets/dist/css/custom.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo base_url('/')?>">Nuvest</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
        <h4 class="login_heading_text">Login to your account</h4>
      <p class="login-box-msg"><?php echo $this->lang->line('Welcome to the future of Saving & Investments');?></p>
      <?php echo load_alert()?>
      <form action="" method="POST" id="adminLogin">
        <div class="input-group mb-3 ">
          <input type="text" name="email" id="email" class="form-control form-control-lg" placeholder="<?php echo $this->lang->line('Email or phone')?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="userPassword" id="userPassword" class="form-control form-control-lg" placeholder="<?php echo $this->lang->line('Password')?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                <?php echo $this->lang->line('Remember Me')?>
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block"><?php echo $this->lang->line('Sign In')?></button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="<?php echo base_url('user/')?>index/forgotpassword"><?php echo $this->lang->line('Forgot Password')?></a>
      </p>
      <p class="mb-1">
        <?php echo $this->lang->line("Do'nt have an account?")?><a href="<?php echo base_url('index/signup')?>"><?php echo $this->lang->line('Sign up')?></a>
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
</body>
</html>
