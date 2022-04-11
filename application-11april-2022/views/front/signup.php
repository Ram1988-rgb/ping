<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Nuvest: Customer Signup</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo ROUTE_STIE_PATH; ?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo ROUTE_STIE_PATH; ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo ROUTE_STIE_PATH; ?>assets/dist/css/adminlte.min.css">
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
  
  <link rel="stylesheet" href="<?php echo ROUTE_STIE_PATH; ?>assets/dist/css/custom.css">
</head>
<body class="hold-transition register-page login-page">
<div class="register-box login-box">
  <div class="register-logo login-logo">
    <a href="<?php echo base_url('/')?>"><?php echo $this->lang->line('Nuvest')?></a>
  </div>

  <div class="card">
    <div class="card-body register-card-body login-card-body">
      <h4 class="login_heading_text mb-2"><?php echo $this->lang->line('Create a Secure Account')?></h4>
        <?php echo load_alert();?>
      <form action="" method="post" id="createAccount">
        <div class="input-group mb-3">
          <input type="text" name="name" id="name" class="form-control form-control-lg" placeholder="<?php echo $this->lang->line('Full Name')?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" name="email" id="email" class="form-control form-control-lg" placeholder="<?php echo $this->lang->line('Email')?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" name="phone" id="phone" class="form-control allow_only_number form-control-lg" placeholder="+509">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-phone"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" id="password" class="form-control form-control-lg" placeholder="<?php echo $this->lang->line('Password')?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        
        <div class="input-group mb-3">
          <input type="text" name="refer_friend" id="refer_friend" class="form-control form-control-lg" placeholder="<?php echo $this->lang->line('Refer Friend/add promo (optional)')?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-promo"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" name="hear_about_us" id="hear_about_us" class="form-control form-control-lg" placeholder="<?php echo $this->lang->line('How hear about us? (optional)')?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-hear"></span>
            </div>
          </div>
        </div>
        <div class="row">
          
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block"><?php echo $this->lang->line('Create')?></button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="my-2">
      <?php echo $this->lang->line('Already have an account?')?>
      <a href="<?php echo base_url()?>" ><?php echo $this->lang->line('Sign in')?></a>
      </p>
      
      
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="<?php echo ROUTE_STIE_PATH; ?>assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo ROUTE_STIE_PATH; ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="<?php echo ROUTE_STIE_PATH; ?>assets/dist/js/adminlte.min.js"></script>
<!--validation -->
<script src="<?php echo ROUTE_STIE_PATH; ?>assets/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?php echo ROUTE_STIE_PATH; ?>assets/plugins/jquery-validation/additional-methods.min.js"></script>
<script src="<?php echo ROUTE_STIE_PATH; ?>assets/front/validation.js"></script>

</body>
</html>
