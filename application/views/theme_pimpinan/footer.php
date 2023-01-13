<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="<?php echo base_url('vendors/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href=" <?php echo base_url('vendors/adminassets/assets/vendors/mdi/css/materialdesignicons.min.css') ?>">
    <link rel="stylesheet" href=" <?php echo base_url('vendors/adminassets/assets/vendors/css/vendor.bundle.base.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('vendors/adminassets/assets/css/style2.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('vendors/table/datatables/dataTables.bootstrap4.min.css') ?>">
    <link href="<?php echo base_url('vendors/swal/dist/sweetalert2.min.css') ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
        <link rel="stylesheet" href="<?php echo base_url('vendors/adminassets/assets/css/customstyle.css') ?>">

    <style>
         .sidebar .nav .nav-item:hover{
            background: #202124!important;

        }

        .sidebar .nav .nav-item.active{
            background: #0277fa !important;
        }

        .sidebar .nav.sub-menu .nav-item .nav-link:before{
            content: "\F054";
            font-family: "Material Design Icons";
            display: block;
            position: absolute;
            left: 0px;
            top: 50%;
            -webkit-transform: translateY(-50%);
            transform: translateY(-50%);
            color: #fff;
            font-size: .75rem;
        }
    </style>
</head>
<body>
</div>

<!-- content-wrapper ends -->
<!-- partial:partials/_footer.html -->
<footer class="footer" style="background: #fff;">
  <div class="d-sm-flex justify-content-center justify-content-sm-between">
    <span class="text-black text-center text-sm-left  d-block d-sm-inline-block " style="font-size:16px;">Copyright © 2022 DPRD JAWA TENGAH</span>
    <span class="float-none float-sm-right d-block d-sm-inline-block"><img src="<?php echo base_url() ?>/assets/uploads/keitoto_main_logo.svg ?>" alt="" class="rounded mb-4" style="width:16; height:16px;"></span>
  </div>
</footer>
 
 


<!-- partial -->
</div>
<!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="<?php echo base_url('vendors/adminassets/assets/vendors/js/vendor.bundle.base.js') ?>"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="<?php echo base_url('vendors/adminassets/assets/vendors/chart.js/Chart.min.js') ?>"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="<?php echo base_url('vendors/adminassets/assets/js/off-canvas.js') ?>"></script>
<script src="<?php echo base_url('vendors/adminassets/assets/js/hoverable-collapse.js') ?>"></script>
<script src="<?php echo base_url('vendors/adminassets/assets/js/misc.js') ?>"></script>
<!-- endinject -->
<!-- Custom js for this page -->
<script src="<?php echo base_url('vendors/adminassets/assets/js/dashboard.js') ?>"></script>
<script src="<?php echo base_url('vendors/adminassets/assets/js/todolist.js') ?>"></script>

<!-- Core plugin JavaScript-->
<script src="<?php echo base_url('vendors/table/jquery-easing/jquery.easing.min.js') ?>"></script>
<script src="<?php echo base_url('vendors/table/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo base_url('vendors/table/datatables/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?php echo base_url('vendors/swal/dist/sweetalert2.min.js') ?>"></script>

<script type="text/javascript">
  $(window).on('load', function() {
    $('#myModal').modal('show');
  });

  $(window).on('load', function() {
    $('#alert').modal('show');
  });

  $(document).ready( function () {
    $('#table').DataTable();
    $('#table2').DataTable();
  } );
</script>

</body>

</html>