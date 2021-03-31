 <!-- footer content -->
 <footer>
  <div class="pull-left">
    Hecho por <a href="https://klopez.valdez14@gmail.com" target="_blank">K.J</a>
  </div>
  <div class="pull-right">
    <p class="footer">Pagina generada en <strong>{elapsed_time}</strong> segundos. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
  </div>
  <div class="clearfix"></div>
  <!-- /footer content -->

  <!-- Bootstrap -->
  <script src="<?php echo base_url();?>assets/template/bootstrap/js/bootstrap.min.js"></script>
  <!-- FastClick -->
  <script src="<?php echo base_url();?>assets/template/fastclick/lib/fastclick.js"></script>
  <!-- NProgress -->
  <script src="<?php echo base_url();?>assets/template/nprogress/nprogress.js"></script>



    <!-- iCheck 
    <script src="<?php echo base_url();?>assets/template/iCheck/icheck.min.js"></script>
  -->
  <!-- DataTables -->
  <!-- <script src="<?php echo base_url();?>assets/template/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>assets/template/datatables/dataTables.bootstrap.min.js"></script> -->
    <script src="<?php echo base_url();?>assets/template/data/dataTables.min.js"></script>
    <script src="<?php echo base_url();?>assets/template/data/Buttons-1.6.1/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url();?>assets/template/data/Buttons-1.6.1/js/buttons.flash.min.js"></script>
    <script src="<?php echo base_url();?>assets/template/data/JSZip-2.5.0/jszip.min.js"></script>
    <script src="<?php echo base_url();?>assets/template/data/pdfmake-0.1.36/pdfmake.min.js"></script> 
    <script src="<?php echo base_url();?>assets/template/data/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script src="<?php echo base_url();?>assets/template/data/Buttons-1.6.1/js/buttons.html5.min.js"></script>
    <script src="<?php echo base_url();?>assets/template/data/Buttons-1.6.1/js/buttons.print.min.js"></script>
    <!-- <script src="<?php echo base_url();?>assets/template/data/.bootstrap.min.js"></script> -->
    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url();?>assets/template/build/js/custom.min.js"></script>
    <!-- <script src="<?php echo base_url();?>assets/template/buttons/js/dataTables.buttons.min.js"></script> -->
    <!-- <script src="<?php echo base_url();?>assets/template/buttons/js/buttons.print.min.js"></script> -->

    <!-- PNotify 
    <script src="<?php echo base_url();?>assets/template/pnotify/dist/pnotify.js"></script>
    <script src="<?php echo base_url();?>assets/template/pnotify/dist/pnotify.buttons.js"></script>
    <script src="<?php echo base_url();?>assets/template/switchery/dist/switchery.min.js"></script>
  -->
  <script src="<?php echo base_url();?>assets/js/select2.full.min.js"></script>
  
  <script src="<?php echo base_url();?>assets/icheck.min.js"></script>

  <!-- </div> -->

  <script>

    $('#example2').DataTable({
      orderCellsTop: true,
      fixedHeader: true,
      "language": {
       "lengthMenu": "Mostrar _MENU_ registros por pagina",
       "zeroRecords": "No se encontraron Resultados!",
       "searchPlaceholder": "Buscar registros",
       "info": "Mostrando registros de _START_ al _END_ de un total de _TOTAL_ registros",
       "infoEmpty": "No existen registros",
       "infoFiltered": "(Filtrado de un total de _MAX_ registros)",
       "search": "Buscar:",
       "paginate": {
         "first": "Primero",
         "last" : "Ultimo",
         "next" : "Siguiente",
         "previous" : "Anterior"
       },
     }
   })
    
    function launchFullScreen(element) {
      if(element.requestFullScreen) {
        element.requestFullScreen();
      } else if(element.mozRequestFullScreen) {
        element.mozRequestFullScreen();
      } else if(element.webkitRequestFullScreen) {
        element.webkitRequestFullScreen();
      }
    }
  </script>
  <script>
    $(function () {
    //Initialize Select2 Elements
    $('.select2').select2();
  }); 
</script>

<style type="text/css">
  thead input {
    width: 120%;
    align-content: left;
  }
  /*table.dataTable thead > tr > th{
    padding-right: 6px; 
  }*/
  .x_panel {
    /*position: relative;*/
    width: 100%;
    margin-bottom: 10px;
    padding: 10px 17px;
    display: inline-block;
    background: #fff;
    /*border: 1px solid red;*/
    -webkit-column-break-inside: avoid;
    -moz-column-break-inside: avoid;
    column-break-inside: avoid;
    opacity: 1;
    transition: all .2s ease
  }
</style>
</footer>
</body>

</html>