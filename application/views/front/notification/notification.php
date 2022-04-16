<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><img src="<?php echo base_url('assets/icons/mask_group_noti_black.png'); ?>" class="sidebar_icons" /> Notifications</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('user/dashboard')?>"><?php echo $this->lang->line('Dashboard');?></a></li>
              <li class="breadcrumb-item active">Notifications</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
          
        <ul class="noti">
            <table style="width:100%">
                <?php if($all_record){foreach($all_record as $line){?>
                <tr>
                    <td>
                        <li>
                            <div class="noti_left">
                                <div class="noti_icon">
                                    <i class="far fa-credit-card"></i>
                                </div>
                                <div class="noti_content">
                                    <div class="font-weight-bold"><?php echo $line->title?></div>
                                    <div class=""><?php echo $line->message?></div>
                                </div>
                            </div>
                            <div class="noti_time"><?php echo  time_diff_hours($line->createdAt, date('Y-m-d H:i:s'),true)?></div>
                        </li>
                    </td>
                </tr>
                <?php }}?>
                
            </table> 
        </ul>          
      </div><!--container-fluid-->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
