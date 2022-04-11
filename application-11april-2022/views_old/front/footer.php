<footer class="main-footer">
    <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="https://www.sarasolutions.in" target="_blank">www.sarasolutions.in</a>.</strong>
    All rights reserved.
    <!--<div class="float-right d-none d-sm-inline-block">-->
    <!--  <b>Version</b> 3.1.0-->
    <!--</div>-->
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php if($this->router->fetch_class()!='1'){?>
<!-- jQuery -->

<!-- jQuery UI 1.11.4 -->
<script src="<?php echo ROUTE_STIE_PATH; ?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo ROUTE_STIE_PATH; ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo ROUTE_STIE_PATH; ?>assets/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo ROUTE_STIE_PATH; ?>assets/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<!--<script src="<?php echo ROUTE_STIE_PATH; ?>assets/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?php echo ROUTE_STIE_PATH; ?>assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
 jQuery Knob Chart -->
<script src="<?php echo ROUTE_STIE_PATH; ?>assets/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo ROUTE_STIE_PATH; ?>assets/plugins/moment/moment.min.js"></script>
<script src="<?php echo ROUTE_STIE_PATH; ?>assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo ROUTE_STIE_PATH; ?>assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?php echo ROUTE_STIE_PATH; ?>assets/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo ROUTE_STIE_PATH; ?>assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo ROUTE_STIE_PATH; ?>assets/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo ROUTE_STIE_PATH; ?>assets/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) 
<script src="<?php echo ROUTE_STIE_PATH; ?>assets/dist/js/pages/dashboard.js"></script>-->
<?php }?>
<!-- DataTables  & Plugins -->

<script src="<?php echo ROUTE_STIE_PATH; ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo ROUTE_STIE_PATH; ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo ROUTE_STIE_PATH; ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo ROUTE_STIE_PATH; ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo ROUTE_STIE_PATH; ?>assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo ROUTE_STIE_PATH; ?>assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo ROUTE_STIE_PATH; ?>assets/plugins/jszip/jszip.min.js"></script>
<script src="<?php echo ROUTE_STIE_PATH; ?>assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo ROUTE_STIE_PATH; ?>assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo ROUTE_STIE_PATH; ?>assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo ROUTE_STIE_PATH; ?>assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo ROUTE_STIE_PATH; ?>assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- jquery-validation -->
<script src="<?php echo ROUTE_STIE_PATH; ?>assets/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?php echo ROUTE_STIE_PATH; ?>assets/plugins/jquery-validation/additional-methods.min.js"></script>
<script src="<?php echo ROUTE_STIE_PATH; ?>assets/admin/validation.js"></script>
<script src="<?php echo ROUTE_STIE_PATH; ?>assets/plugins/daterangepicker/daterangepicker.js"></script>

<script src="<?php echo ROUTE_STIE_PATH; ?>assets/admin/jquery.form-validator.js"></script>

<script>
  $(function () {
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });    
  });
  //Date picker
  $('#reservationdate').datetimepicker({
        format: 'L',
        minDate:new Date()
    });
    $('#dob').datetimepicker({
        format: 'L'
    });

    //Date and time picker
    $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });
    manageloanbusiness();
    
</script>
<script>
  $.validate({
        modules : ''
    });
   
</script>
</body>
</html>

<?php //print_r($this->session->all_userdata());?>