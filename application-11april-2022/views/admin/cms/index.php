<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><img src="<?php echo base_url('assets/icons/cms-black.png'); ?>" class="sidebar_icons" /> CMS</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard')?>">Home</a></li>
              <li class="breadcrumb-item active">CMS</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
         
          <?php echo load_alert()?>
          
            <div class="card">
              
              <!-- /.card-header -->
              <div class="card-body">
              <form id="" action="" method="POST">
                <div class="card-body">
                <div class="form-group">
                    <label for="name">Name</label>
                    <select name="page"class="form-control" onchange="pageRedirect(this.value)">
                      <option value="">Select Page</option>
                      <?php 
                        foreach($allPages as $line){
                      ?>
                      <option value="<?php echo $line->id?>" <?php if(isset($record) && $record->id==$line->id ){?>selected="selected"<?php }?>><?php echo $line->page?></option>
                      <?php }?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="name">Title</label>
                    <input type="text" name="title" value="<?php echo isset($record)?$record->title:''?>" class="form-control" id="title" placeholder="Enter Name" data-validation="required">
                  </div>
                  <div class="form-group">
                    <label for="name">Content</label>
                    <textarea name="content" class="form-control summernote"><?php echo isset($record)?$record->content:''?></textarea>
                  </div>
                  <div class="form-group">
                    <label for="name">Meta title</label>
                    <input type="text" name="meta_title" class="form-control" value="<?php echo isset($record)?$record->meta_title:''?>" id="title" placeholder="Enter Name" >
                  </div>
                  <div class="form-group">
                  <label for="name">Meta Key</label>
                    <textarea name="meta_key" style="width:100%" class="form-control"><?php echo isset($record)?$record->meta_key:''?></textarea>
                  </div>
                  <div class="form-group">
                    <label for="name">Meta Description</label>
                    <textarea name="meta_desc" style="width:100%" class="form-control"><?php echo isset($record)?$record->meta_desc:''?></textarea>
                  </div>
                </div> 
                
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

           
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script>
  function pageRedirect(id){
      window.location.href="<?php echo base_url('admin/cms/index/')?>"+id;
    }
  </script>
  
