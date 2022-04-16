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
<!----modal starts here--->
<div id="deleteModal" class="modal fade" role='dialog'>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Delete </h4>
            </div>
            <div class="modal-body">
                <p>Do You Really Want to Delete This ?</p>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<span id= 'deleteButton'></span>
            </div>
			
        </div>
      </div>
  </div>
<!--Modal ends here--->

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

<!--<script src="<?php echo ROUTE_STIE_PATH; ?>assets/admin/jquery.form-validator.js"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script>
  $(function () {
    $('.allow_float_number').keypress(function(event) {
      if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
        event.preventDefault();
      }
    });
    $('.allow_only_number').keypress(function(event) {
      if (event.which !== 8 && event.which !== 0 && event.which < 48 || event.which > 57) {
        event.preventDefault();
      }
    });
    $('.summernote').summernote()
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
      "aaSorting": []
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    // $('#example2').DataTable({
    //   "paging": true,
    //   "lengthChange": false,
    //   "searching": true,
    //   "ordering": true,
    //   "info": true,
    //   "autoWidth": false,
    //   "responsive": true,
    //   "dom": 'Bfrtip',
    //   "buttons": [
    //         'copy', 'csv', 'excel', 'pdf', 'print'
    //     ]
    // });  
    $('#example2').DataTable( {
        dom: 'Bfrtip',
        buttons: [
          'csv', 'excel', 'pdf'
            //'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        "aaSorting": []
    } );  
  });
  //Date picker
  $('#reservationdate').datetimepicker({
        format: 'L',
        minDate:new Date()
    });
    $('#dob').datetimepicker({
        format: 'L'
    });
    $('.alldate').datetimepicker({
        format: 'L'
    });
      
    

    //Date and time picker
    $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });
    manageloanbusiness();
    
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" id="theme-styles">
<script>
  $.validate({
        modules : 'security'
    });
    
    function deleteData(str=''){
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = str;
        }
      })
    }

    function statusData(str=''){
      Swal.fire({
        title: 'Are you sure?',
        text: "You want to change status!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, change it!'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = str;
        }
      })
    }
    
   
</script>
<style>
  .validate-star{
    color: #dc3545!important;
    margin-left: 2px;
  }
  </style>
</body>
</html>

<?php //print_r($this->session->all_userdata());?>
