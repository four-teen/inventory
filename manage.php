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

    <title>Inventory-Manage</title>
  </head>
  <body onload="load_product()">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">Navbar</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Features</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Pricing</a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled">Disabled</a>
          </li>
        </ul>
      </div>
    </nav>   

    <br><br>

<div class="container">
    <div class="row">
        <div class="col-lg-12">


<?php 
  $select = "SELECT * FROM tblproducts WHERE id_autonun='$_GET[productid]'";
  $runselect = mysqli_query($conn, $select);
  $rowselect = mysqli_fetch_assoc($runselect);

?>
          Product Name: <b><?php echo $rowselect['pdesc'] ?></b>
          <hr>
          <div class="row">
            <div class="col-lg-12">
              <h1>test</h1>

<?php 
    $select="SELECT * FROM `tblprod_data` WHERE id_autonun='$_GET[productid]'";
    $runselect = mysqli_query($conn, $select);
    $rowmyselect = mysqli_fetch_assoc($runselect);
    if(mysqli_num_rows($runselect)>=1){
      echo '
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text">Quantity</span>
  </div>
  <input type="text" class="form-control" placeholder="enter quantity" aria-label="quantity" aria-describedby="basic-addon1" id="u_qty" value="'.$rowmyselect['qty'].'">
</div>

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text">Price</span>
  </div>
  <input type="text" class="form-control" placeholder="enter price" aria-label="price" aria-describedby="basic-addon1" id="u_price" value="'.$rowmyselect['price'].'">
</div>
<br>
      <button onclick="update_data()" class="btn btn-warning">Update</button>
      ';
    }else{
      echo '
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text">Quantity</span>
  </div>
  <input type="text" class="form-control" placeholder="enter quantity" aria-label="quantity" aria-describedby="basic-addon1" id="qty">
</div>

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text">Price</span>
  </div>
  <input type="text" class="form-control" placeholder="enter price" aria-label="price" aria-describedby="basic-addon1" id="price">
</div>
<br>
      <button onclick="saving_data()" class="btn btn-success">Save</button>';
    }    
?>
  

<div id="test">test</div>
            </div>
          </div>
        </div>
    </div>


</div>





    <script src="https://code.jquery.com/jquery-3.6.4.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>

      function update_data(){

        var u_qty = $('#u_qty').val();
        var u_price = $('#u_price').val();
        var productid = '<?php echo $_GET['productid'] ?>';

        $.ajax({
            type: "POST",
            url: "query.php",
            data: {
              "updating_data": "1",
              "u_qty" : u_qty,
              "u_price" : u_price,
              "productid" : productid              
            },
            success: function (response) {
              swal("Success!", "You updated the data!", "success");
            }
          });
      }


      function saving_data(){

        var qty = $('#qty').val();
        var price = $('#price').val();
        var productid = '<?php echo $_GET['productid'] ?>';

        $.ajax({
            type: "POST",
            url: "query.php",
            data: {
              "save_data": "1",
              "qty" : qty,
              "price" : price,
              "productid" : productid              
            },
            success: function (response) {
            swal("Success!", "You updated the data!", "success");
            }
          });
      }

    </script>

  </body>
</html>