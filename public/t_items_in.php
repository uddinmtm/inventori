<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Inventori - Barang Masuk</title>

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
            <h1 class="h3 mb-0 text-gray-800">Barang Masuk</h1>
          </div>

          <!-- Content Row -->

          <div class="row">
            <div class="col-xl-12 col-lg-12">
               <form id="form">
                  <div class="form-group row">
                    <label for="inputNomor" class="col-sm-2 col-form-label">Nomor</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="inputNomor" name="nomor">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputKeterangan" class="col-sm-2 col-form-label">Keterangan</label>
                    <div class="col-sm-4">
                      <textarea class="form-control" id="inputKeterangan" name="keterangan"></textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputTanggal" class="col-sm-2 col-form-label">Tanggal</label>
                    <div class="col-sm-3">
                      <input type="date" class="form-control" id="inputTanggal" name="tanggal" placeholder="yyyy-mm-dd">
                    </div>
                  </div>
<br>
                    <h5>Barang :</h5>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="selNama" class="col-form-label">Nama</label>
                                <select id="selNama" class="form-control">
                                    <option value="">- Pilih -</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="inputJumlah" class="col-form-label">Jumlah</label>
                                <input type="text" class="form-control" id="inputJumlah">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="btnTambah" class="col-form-label">Aksi</label>
                                <br>
                                <button id="btnTambah" type="button" class="btn btn-info">Tambah</button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-9 table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th width="10%">#</th>
                                        <th width="50%">Nama</th>
                                        <th width="20%">Jumlah</th>
                                        <th width="20%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="listBarang">
                                </tbody>
                            </table>
                        </div>
                        <input type="hidden" id="jsonItems" name="daftar_barang">
                    </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">&nbsp;</label>
                    <div class="col-sm-10">
                        <input type="hidden" id="inputId" name="id">
                        <input type="hidden" id="typeForm" name="is_edit">
                        <input type="submit" id="btnSubmit" class="btn btn-primary" value="Submit">
                    </div>
                  </div>
                </form> 

                <br>

              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Data Barang</h6>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>Nomor</th>
                          <th>Tanggal</th>
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

        <!-- Modal -->
        <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel">Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
               <dl class="row">
                  <dt class="col-sm-3">Nomor</dt>
                  <dd id="labelNomor" class="col-sm-9"></dd>

                  <dt class="col-sm-3">Keterangan</dt>
                  <dd id="labelKeterangan" class="col-sm-9">
                  </dd>

                  <dt class="col-sm-3">Tanggal</dt>
                  <dd id="labelTanggal" class="col-sm-9"></dd>
                </dl> 
                <h5>Barang</h5>
                <table class="table table-border">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>In</th>
                            <th>Out</th>
                        </tr>
                    </thead>
                    <tbody id="labelListBarang">
                    </tbody>
                </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

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

<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<script>
$(document).ready(function() {
    // init sel barang
    $.ajax({
        url: 'actions/items.php',
        dataType: 'json',
        success: function(res) {
            var items = res.data;
            items.forEach(function(item) {
                var opt = '<option value="'+ item.id +'|'+ item.name +' - '+ item.type +'">'+ item.name +' - '+ item.type +'</option>';
                $('#selNama').append(opt);
            });  
        },
        error: function(res) {
            console.log(res);
        }
    });

    // init data table
    var table = $("#dataTable").DataTable({
       "ajax": "actions/items_in.php",
       searching:      true,
       paging:         true,
       "order": [[ 0, 'asc' ]],
       "columns": [
           { "data": "transaction_code" },
           { "data": "transaction_date" },
           {
               "data": null,
               "defaultContent": 
                    '<button class="btn btn-danger btn-sm delete" type="button" data-target="#deleteModal" data-toggle="modal" title="Delete Data"    ><i class="fas fa-trash-alt"></i></button>' +
                    '<button class="btn btn-warning btn-sm edit" type="button" title="Edit Data"><i class="fas fa-pencil-alt"></i></button>' +
                    '<button class="btn btn-info btn-sm view" type="button" title="View Data"><i class="fas fa-eye"></i></button>' 
           }
       ]
    });

    // event delete
    $('#dataTable tbody').on( 'click', 'button.delete', function () {
        var data = table.row( $(this).parents('tr') ).data();
        deleteData(data.transaction_code);
    } );
    
    // event edit
    $('#dataTable tbody').on( 'click', 'button.edit', function () {
        var data = table.row( $(this).parents('tr') ).data();
        editData(data.transaction_code);
    } );

    // event view
    $('#dataTable tbody').on( 'click', 'button.view', function () {
        var data = table.row( $(this).parents('tr') ).data();
        viewData(data.transaction_code);
    } );

    function deleteData(id) {
        var conf = confirm("Apakah Anda yakin ingin menghapus?");
        if (conf) {
            $.ajax({
                url: "../actions/items_in.php?id=" +id, 
                method: "DELETE",
                success: function (res) {
                    table.ajax.url('actions/items_in.php').load();
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
            url: "../actions/items_in.php?id=" +id, 
            success: function (res) {
                var data = res.data[0];

                $('#inputNomor').val(data.transaction_code);
                $('#inputKeterangan').val(data.description);
                $('#inputTanggal').val(data.transaction_date);

                listItems = [];
                (data.detail).forEach(function (item, key) {
                    listItems.push({
                        "id": item.item_id,
                        "name": item.name,
                        "qty": item.stock_in
                    });
                });
                generateListItems(listItems);

                $('#inputId').val(data.transaction_code);
                $('#typeForm').val(1);
            },
            error: function (err) {
                alert('Failed'); 
            }
        });
    }

    function viewData(id) {
        $.ajax({
            url: "../actions/items_in.php?id=" +id, 
            success: function (res) {
                var data = res.data[0];
                $('#labelNomor').html(data.transaction_code);
                $('#labelKeterangan').html('<p>' + data.description + '</p>');
                $('#labelTanggal').html(data.transaction_date);

                // generate rows
                $('#labelListBarang').empty();
                (data.detail).forEach(function (item, key) {
                    var row = '<tr>' +
                        '<td>'+ (key+1) +'</td>' +
                        '<td>'+ item.name +'</td>' +
                        '<td>'+ item.stock_in +'</td>' +
                        '<td>'+ item.stock_out +'</td>' +
                    '</tr>'; 
                    $('#labelListBarang').append(row);
                });
                $('#viewModal').modal('show');
            },
            error: function (err) {
                alert('Failed'); 
            }
        });
        
    }
       
    $('#form').submit(function(e) {
        $('#btnSubmit').attr('disabled', true);
        var jsonItems = JSON.stringify(listItems);
        $('#jsonItems').val(jsonItems);
        $('#btnSubmit').attr('disabled', false);

        if ($('#typeForm').val() == 1) {
            // update
            $.ajax({
                url: 'actions/items_in.php', 
                method: 'PUT', 
                data: $(this).serialize(),
                success: function(res) {
                    table.ajax.url('actions/items_in.php').load();
                    alert('Success'); 
                    $('#form')[0].reset();
                    $('#listBarang').empty();
                },
                error: function(res) {
                    var data = res.responseJSON;
                    alert('Failed: '+ data.message); 
                }
            });

            return false;
        }

        // add
        $.ajax({
            url: 'actions/items_in.php', 
            method: 'POST', 
            data: $(this).serialize(),
            success: function(res) {
                table.ajax.url('actions/items_in.php').load();
                alert('Success'); 
                $('#form')[0].reset();
                $('#listBarang').empty();
            },
            error: function(res) {
                var data = res.responseJSON;
                alert('Failed: '+ data.message); 
            }
        });

        $('#btnSubmit').attr('disabled', false);
        e.preventDefault();
    });

    // add detail
    var listItems = [];
    $('#btnTambah').on('click', function() {
        var item = ($('#selNama').val()).split('|'); 
        var jumlah = $('#inputJumlah').val(); 
        listItems.push({
            "id": item[0],
            "name": item[1],
            "qty": jumlah,
        });

        generateListItems(listItems);
    });

    function generateListItems(items) {
        $('#listBarang').empty();
        items.forEach(function(item, i) {
            var row = '<tr>' +
                '<td>'+ (i + 1) +'</td>' +
                '<td>'+ item.name +'</td>' +
                '<td>'+ item.qty +'</td>' +
                '<td><button type="button" class="btn-remove btn btn-small btn-danger" data-id="'+ i +'"><i class="fas fa-trash"></i></button></td>' +
            '</tr>';
            $('#listBarang').append(row);
        });

        $('.btn-remove').on('click', function(e) {
            var index = $(this).attr('data-id');
            listItems.splice(index, 1);
            generateListItems(listItems);
        });
    }

});

</script>
</body>

</html>
