<?php 

    include 'db.php';
 ?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

    <title>Inventory-Main</title>
  </head>
  <body onload="load_product()">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">KCC Mall</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pos.php"><i class="ri-calculator-line"></i> OS</a>
          </li>
        </ul>
      </div>
    </nav>   

    <br><br>

<div class="container">
    <div class="row">
        <div class="col-lg-12">

<p>

  <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
   <i class="ri-add-box-line"></i> Add New Product
  </button>
</p>
<div class="collapse" id="collapseExample">
  <div class="card card-body">
    <div class="row">
      <div class="col-lg-12">
        <label for="pcode">Product Code</label>
        <input type="text" class="form-control" id="pcode">
      </div>
      <div class="col-lg-12">
        <label for="pdesc">Product Description</label>
        <input type="text" class="form-control" id="pdesc">
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <br>
        <button onclick="save_product()" class="btn btn-success" data-toggle="collapse" data-target="#collapseExample">Save</button>
      </div>
    </div>
  </div>
</div>

        <div class="row">
          <div class="col-lg-12">
            <div id="myproducts">Loading products</div>
          </div>
        </div>
      

        </div>
    </div>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 style="color:red;">Modify</h4>
        </div>
        <div class="modal-body">

            <div class="form-group">
              <input type="hidden" id="auto_n">
              <label for="u_pcode">Product Code</label>
              <input type="text" class="form-control" id="u_pcode" placeholder="Enter product code">
            </div>
            <div class="form-group">
              <label for="u_pdesc">Product Descriptio</label>
              <input type="text" class="form-control" id="u_pdesc" placeholder="Product description">
            </div>
        </div>
        <div class="modal-footer">

          <button type="submit" class="btn btn-default btn-info" data-dismiss="modal">
            Cancel
          </button>
          <button onclick="updating_product()" type="submit" class="btn btn-default btn-success" data-dismiss="modal">
            Save
          </button>          
        </div>
      </div>
    </div>
  </div>

</div>





    <script src="https://code.jquery.com/jquery-3.6.4.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>

      function manage_products(id_autonun){
        window.location = 'manage.php?productid='+id_autonun;
      }

      function updating_product(){
        var u_pcode = $('#u_pcode').val();
        var u_pdesc = $('#u_pdesc').val();
        var auto_n = $('#auto_n').val();

         $.ajax({
            type: "POST",
            url: "query.php",
            data: {
              "update_products": "1",
              "u_pcode" : u_pcode,
              "u_pdesc" : u_pdesc,
              "auto_n" : auto_n
            },
            success: function (response) {
                load_product();
            }
          }); 
      }

      function edit_product(id_autonun, pcode, pdesc){
        $('#auto_n').val(id_autonun);
$('#u_pcode').val(pcode)
$('#u_pdesc').val(pdesc)        
        $("#myModal").modal()
      }

      function remove_products(id_autonun){
        swal({
          title: "Are you sure?",
          text: "Once deleted, you will not be able to recover the file number "+id_autonun+".",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {

       $.ajax({
            type: "POST",
            url: "query.php",
            data: {
              "delete_products": "1",
              "id_autonun" : id_autonun
            },
            success: function (response) {
                load_product();
            }
          }); 

          } else {
            
          }
        });
      }

      function load_product(){
       $.ajax({
            type: "POST",
            url: "query.php",
            data: {
              "load_products": "1"
            },
            success: function (response) {
                $('#myproducts').html(response);
            }
          }); 

      }

      function save_product(){

        var pcode = $('#pcode').val();
        var pdesc = $('#pdesc').val();

         $.ajax({
            type: "POST",
            url: "query.php",
            data: {
              "saving_products": "1",
              "pcode" : pcode,
              "pdesc" : pdesc
            },
            success: function (response) {
                load_product();
            }
          }); 

      }

    </script>

  </body>
</html>