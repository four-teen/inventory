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

    <title>Inventory-POS</title>
  </head>
  <body onload="load_items();load_purchased();load_amounts_x()">
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
            <a class="nav-link" href="#"><i class="ri-calculator-line"></i> OS</a>
          </li>
        </ul>
      </div>
    </nav>   

    <br><br>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
          <div id="referencenum" style="position: absolute;top:10px;left:25px;"><?php echo md5(date("h:i:sa")) ?></div>
          <div id="amounts"></div>
        </div>
    </div>
    <div class="row">
      <div class="col-lg-8">
        <h5>Items</h5>
        <div id="loi">List of items</div>
        <hr>
      </div>
      <div class="col-lg-4">
        <h5>Purchase</h5>
        <hr>
        <div id="purc_items">Purchased items</div>
      </div>
    </div>


  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 style="color:red;">Buy</h4>
        </div>
        <div class="modal-body">

            <div class="form-group">
              <input type="hidden" id="item_id">
              <input type="hidden" id="item_qty">
              <label for="e_qty">Enter Quantity</label>
              <input type="text" class="form-control" id="e_qty" placeholder="0.00">
            </div>
            <hr>
            <h5>Remaining Quantity: <span id="total_q">0</span> </h5>
        </div>
        <div class="modal-footer">

          <button type="submit" class="btn btn-default btn-info" data-dismiss="modal">
            Cancel
          </button>
          <button onclick="purchase_product()" type="submit" class="btn btn-default btn-success" data-dismiss="modal">
            Purchase
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

      function load_amounts_x(){
         $.ajax({
            type: "POST",
            url: "query.php",
            data: {
              "load_mounts_pur": "1"
            },
            success: function (x) {
                $('#amounts').html(x);
            }
          });         
      }



      function load_purchased(){
         $.ajax({
            type: "POST",
            url: "query.php",
            data: {
              "load_products_pur": "1"
            },
            success: function (x) {
                $('#purc_items').html(x);
            }
          }); 
      }


      function purchase_product(){
        var e_qty = $('#e_qty').val();
        var item_id = $('#item_id').val();
        var item_qty = $('#item_qty').val();

        if(e_qty == ''){
          alert('bawal ang walang laman');
        }else{

         $.ajax({
            type: "POST",
            url: "query.php",
            data: {
              "proceed_purch": "1",
              "e_qty" : e_qty,
              "item_id" : item_id,
              "item_qty" : item_qty
            },
            success: function (x) {
                load_purchased();
                load_amounts_x();
                load_items();
            }
          }); 

        }
      }

      function load_payment(x,qty){
        $('#total_q').html(qty);
        $('#item_id').val(x);
        $('#item_qty').val(qty);
        $('#myModal').modal();
      }



      function load_items(){
         $.ajax({
            type: "POST",
            url: "query.php",
            data: {
              "load_products_pos": "1"
            },
            success: function (x) {
                $('#loi').html(x);
            }
          }); 
      }

    </script>

  </body>
</html>