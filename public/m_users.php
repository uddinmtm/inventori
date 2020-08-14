<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Inventori - Master Users</title>

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
            <h1 class="h3 mb-0 text-gray-800">Master Users</h1>
          </div>

          <!-- Content Row -->

          <div class="row">
            <div class="col-xl-12 col-lg-12">
               <form>
                  <div class="form-group row">
                    <label for="inputNama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="inputNama" name="name">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputUsername" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="inputUsername" name="username">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-4">
                      <input type="password" class="form-control" id="inputPassword" name="password">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputLevel" class="col-sm-2 col-form-label">Level</label>
                    <div class="col-sm-4">
                        <select id="level" class="form-control" name="level">
                            <option value="">Pilih Level</option>
                            <option value="admin">Admin</option>
                            <option value="manager">Manager</option>
                        </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">&nbsp;</label>
                    <div class="col-sm-10">
                      <input type="submit" class="btn btn-primary" value="Submit">
                    </div>
                  </div>
                </form> 

                <br>

              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Daftar Users</h6>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>Nama</th>
                          <th>Username</th>
                          <th>Level</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                    </table>
                  </div>
                </div>
              </div>
            </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php include_once('fragments/footer.php') ?>
      <!-- End of Footer -->

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

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

  <script>
  $(document).ready(function() {
      // init data table
      var table = $("#dataTable").DataTable({
         "ajax": "actions/items.php",
         searching:      true,
         paging:         true,
         "order": [[ 0, 'asc' ]],
         "columns": [
             { "data": "name" },
             { "data": "type" },
             {
                 "data": null,
                 "defaultContent": 
                      '<button class="btn btn-danger btn-sm delete" type="button" data-target="#deleteModal" data-toggle="modal" title="Delete Data"    ><i class="fas fa-trash-alt"></i></button>' +
                      '<button class="btn btn-warning btn-sm edit" type="button" title="Edit Data"><i class="fas fa-pencil-alt"></i></button>'
             }
         ]
      });

      // event delete
      $('#dataTable tbody').on( 'click', 'button.delete', function () {
          var data = table.row( $(this).parents('tr') ).data();
          deleteData(data.id);
      } );
      
      // event edit
      $('#dataTable tbody').on( 'click', 'button.edit', function () {
          var data = table.row( $(this).parents('tr') ).data();
          editData(data.id);
      } );

      function deleteData(id) {
          var conf = confirm("Apakah Anda yakin ingin menghapus?");
          if (conf) {
              $.ajax({
                  url: "../actions/items.php?id=" +id, 
                  method: "DELETE",
                  success: function (res) {
                      table.ajax.url('actions/items.php').load();
                      alert('Success'); 
                  },
                  error: function (err) {
                      alert('Failed'); 
                  }
              });
          }
      }
         
      function editData(id) {
          $.ajax({
              url: "../actions/items.php?id=" +id, 
              success: function (res) {
                  var item = res.data[0];

                  $('#inputNama').val(item.name);
                  $('#inputJenis').val(item.type);
                  $('#inputId').val(item.id);
                  $('#typeForm').val(1);
              },
              error: function (err) {
                  alert('Failed'); 
              }
          });
      }
         
      $('#form').submit(function(e) {
          if ($('#typeForm').val() == 1) {
              // update
              $.ajax({
                  url: 'actions/items.php', 
                  method: 'PUT', 
                  data: $(this).serialize(),
                  success: function(res) {
                      table.ajax.url('actions/items.php').load();
                      alert('Success'); 
                      $('#form')[0].reset();
                  },
                  error: function(res) {
                      alert('Failed'); 
                  }
              });

              return false;
          }

          // add
          $.ajax({
              url: 'actions/items.php', 
              method: 'POST', 
              data: $(this).serialize(),
              success: function(res) {
                  table.ajax.url('actions/items.php').load();
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
