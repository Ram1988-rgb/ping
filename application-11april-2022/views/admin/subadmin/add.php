<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"><img src="<?php echo base_url('assets/icons/plan-black.png'); ?>" class="sidebar_icons" /> Users</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard')?>">Home</a></li>
            <li class="breadcrumb-item active">Users</li>
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
      <form id="addplanData" action="" method="POST">
        <div class="card">
          <div class="card-body">
            <div class="box-shadow p-2 mb-2">
              <div class="row">
                <div class="col-lg-5">
                  <div class="form-group">
                    <label for="name">Name<span class="validate-star">*</span> </label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter Name" data-validation="required">

                  </div>
                  <div class="form-group">
                    <label for="name">Email<span class="validate-star">*</span> </label>
                    <input type="text" name="email" class="form-control" id="email" placeholder="Enter Name" data-validation="required">
                  </div>

                  <div class="form-group">
                    <label for="name">Mobile<span class="validate-star">*</span> </label>
                    <input type="text" name="mobile" class="form-control allow_only_number" id="mobile" placeholder="Enter Name" data-validation="required, number">

                  </div>
                  <div class="form-group">
                    <label for="name">Password<span class="validate-star">*</span> </label>
                    <input type="text" name="password" class="form-control" id="password" placeholder="Enter Name" data-validation="required">
                  </div>
                </div>
              </div>
            </div>
            <div class="box-shadow p-2 mb-2">
              <div class="row">
                <div class="col-lg-12">
                  <table class="table table-borderd">
                    <thead>
                      <tr>
                        <th> Module</th>
                        <th>Permission</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($all_module as $line){?>
                        <tr>
                          <td><?php echo $line->label?></td>
                          <td><input type="checkbox" name="permission[<?php echo $line->id?>]" value="1"></td>
                        </tr>
                      <?php }?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </div>
      </form>
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
