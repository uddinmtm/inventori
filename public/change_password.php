<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Inventori - Ubah Kata Sandi</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <?php include_once('fragments/sidebar.php') ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <?php include_once('fragments/topbar.php') ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Ubah Kata Sandi</h1>
          </div>

          <!-- Content Row -->

          <div class="row">
            <div class="col-xl-12 col-lg-12">
               <form id="form">
                  <div class="form-group row">
                    <label for="inputSandiLama" class="col-sm-2 col-form-label">Kata sandi lama</label>
                    <div class="col-sm-4">
                      <input type="password" class="form-control" id="inputSandiLama" name="sandi_lama">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputSandiBaru" class="col-sm-2 col-form-label">Kata sandi baru</label>
                    <div class="col-sm-4">
                      <input type="password" class="form-control" id="inputSandiBaru" name="sandi_baru">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">&nbsp;</label>
                    <div class="col-sm-10">
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </div>
                  </div>
                </form> 

              </div>
            </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <?php include_once('fragments/footer.php') ?>

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>
<script src="js/app.js"></script>

<script>
$(document).ready(function() {
    $('#form').submit(function(e) {
        // add
        $.ajax({
            url: 'actions/change_password.php', 
            method: 'POST', 
            data: $(this).serialize(),
            success: function(res) {
                alert('Success'); 
                $('#form')[0].reset();
            },
            error: function(res) {
                alert('Failed'); 
            }
        });

        e.preventDefault();
    });
});
</script>
</body>

</html>
