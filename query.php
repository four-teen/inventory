<?php 
	include 'db.php';

  if(isset($_POST['load_mounts_pur'])){
    echo 
    ''; ?>
    <?php 
              $select = "SELECT 
                tblpurchase.purchaseid,
                tblpurchase.qty,
                tblpurchase.id_autonun,
                tblpurchase.datedtimed,
                tblprod_data.price,
                tblproducts.pdesc,
                (tblprod_data.price * tblpurchase.qty) as t_amount
                FROM `tblpurchase`
                INNER JOIN tblproducts on tblproducts.id_autonun=tblpurchase.id_autonun
                INNER JOIN tblprod_data on tblprod_data.id_autonun=tblpurchase.id_autonun";
              $runselect = mysqli_query($conn, $select);
              $tot_amount = 0;
              while($rowselect = mysqli_fetch_assoc($runselect)){
                $tot_amount = $tot_amount + $rowselect['t_amount'];
              }
              echo 
              '
          <table class="table table-bordered">
            <tbody>
              <tr>
                <td class="text-right" style="font-size: 30px;color:red"><b>'.number_format($tot_amount, 2).'</b></td>
              </tr>
            </tbody>
          </table>

              ';

    ?>


    <?php echo'';
  }

  if(isset($_POST['load_products_pur'])){
    echo 
    '';?>
        <table class="table table-stripped table-sm">
          <thead>
            <tr>
              <th class="text-center">Desc</th>
              <th class="text-center">Qty</th>
              <th class="text-center">Amt</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              $select = "SELECT 
                tblpurchase.purchaseid,
                tblpurchase.qty,
                tblpurchase.id_autonun,
                tblpurchase.datedtimed,
                tblprod_data.price,
                tblproducts.pdesc,
                (tblprod_data.price * tblpurchase.qty) as t_amount
                FROM `tblpurchase`
                INNER JOIN tblproducts on tblproducts.id_autonun=tblpurchase.id_autonun
                INNER JOIN tblprod_data on tblprod_data.id_autonun=tblpurchase.id_autonun";
              $runselect = mysqli_query($conn, $select);
              while($rowselect = mysqli_fetch_assoc($runselect)){
                echo 
                '
                <tr>
                  <td>'.substr($rowselect['pdesc'], 0, 7).'...</td>
                  <td>'.$rowselect['qty'].'</td>
                  <td class="text-right">'.number_format($rowselect['t_amount'],2).'</td>
                </tr>
                ';
              }

            ?>

          </tbody>
        </table>

    <?php echo'

    ';
  }


  if(isset($_POST['proceed_purch'])){
    $e_qty = $_POST['e_qty'];
    $item_id = $_POST['item_id']; 

    //ito yung actual na quantity
    $item_qty = $_POST['item_qty'];

    $insert = "INSERT INTO `tblpurchase` (`id_autonun`, `qty`, `datedtimed`) VALUES ('$item_id', '$e_qty', CURRENT_TIMESTAMP)";
    $runinsert = mysqli_query($conn, $insert);
  
    $new_qty = $item_qty - $e_qty;
    $update_products_qty = "UPDATE tblprod_data SET qty = '$new_qty' WHERE id_autonun='$item_id'";
    $runinsert = mysqli_query($conn, $update_products_qty);


  }

  if(isset($_POST['load_products_pos'])){
        echo
        '
        <table class="table table-sm">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Product Code</th>
              <th scope="col">Product Description</th>
              <th scope="col">Qty</th>
              <th scope="col">Price</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
        '; ?>
        <?php 
            $select="SELECT * FROM `tblprod_data`
              RIGHT JOIN tblproducts on tblproducts.id_autonun=tblprod_data.id_autonun";
            $runselect = mysqli_query($conn, $select);
            $count = 0;
            $totalamount=0;
            while($rowselect = mysqli_fetch_assoc($runselect)){
              $totalamount += $rowselect['price'];
                echo
                '
                    <tr>
                      <th>'.++$count.'.</th>
                      <td>'.$rowselect['pcode'].'</td>
                      <td>'.$rowselect['pdesc'].'</td>
                      <td class="text-right">'.$rowselect['qty'].'</td>
                      <td class="text-right">'.number_format($rowselect['price'],2).'</td>
                      <td width="1%" style="white-space:nowrap">
                        <button onclick="load_payment(\''.$rowselect['id_autonun'].'\',\''.$rowselect['qty'].'\')" type="button" class="btn btn-info btn-sm">
                          Buy <i class="ri-arrow-right-circle-line"></i>
                        </button>
                      </td>
                    </tr>    
                ';
            }

            echo
            '
              <tr>
                <td colspan="4" class="text-right">TOTAL</td>
                <td class="text-right">'.number_format($totalamount,2).'</td>
              </tr>
            ';
        ?>
        <?php echo'
          </tbody>
        </table> 
        ';

  }





  if(isset($_POST['updating_data'])){

    $u_qty = $_POST['u_qty'];
    $u_price = $_POST['u_price'];
    $productid = $_POST['productid'];    

    $update = "UPDATE `tblprod_data` SET  `qty`='$u_qty', `price`='$u_price' WHERE id_autonun='$_POST[productid]'";
    $runupdate = mysqli_query($conn, $update);
  }


  if(isset($_POST['save_data'])){

    $qty = $_POST['qty'];
    $price = $_POST['price'];
    $productid = $_POST['productid'];    

    $insert = "INSERT INTO `tblprod_data` (`id_autonun`, `qty`, `price`) VALUES ('$productid', '$qty', '$price')";
    $runinsert = mysqli_query($conn, $insert);
  }


	if(isset($_POST['load_products'])){
        echo
        '
        <table class="table table-sm">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Product Code</th>
              <th scope="col">Product Description</th>
              <th scope="col">Qty</th>
              <th scope="col">Price</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
        '; ?>
        <?php 
            $select="SELECT * FROM `tblprod_data`
              RIGHT JOIN tblproducts on tblproducts.id_autonun=tblprod_data.id_autonun";
            $runselect = mysqli_query($conn, $select);
            $count = 0;
            $totalamount=0;
            while($rowselect = mysqli_fetch_assoc($runselect)){
              $totalamount += $rowselect['price'];
                echo
                '
                    <tr>
                      <th>'.++$count.'.</th>
                      <td>'.$rowselect['pcode'].'</td>
                      <td>'.$rowselect['pdesc'].'</td>
                      <td class="text-right">'.$rowselect['qty'].'</td>
                      <td class="text-right">'.number_format($rowselect['price'],2).'</td>
                      <td width="1%" style="white-space:nowrap">

                        <button onclick="manage_products(\''.$rowselect['id_autonun'].'\')" type="button" class="btn btn-info btn-sm">
                          <i class="ri-mind-map"></i> Manage
                        </button>
                        <button onclick="edit_product(\''.$rowselect['id_autonun'].'\',\''.$rowselect['pcode'].'\',\''.$rowselect['pdesc'].'\')" type="button" class="btn btn-warning btn-sm">
                          Edit
                        </button>
                        <button onclick="remove_products(\''.$rowselect['id_autonun'].'\')" type="button" class="btn btn-danger btn-sm">
                          Trash
                        </button>
                      </td>
                    </tr>    
                ';
            }

            echo
            '
              <tr>
                <td colspan="4" class="text-right">TOTAL</td>
                <td class="text-right">'.number_format($totalamount,2).'</td>
              </tr>
            ';
        ?>
        <?php echo'
          </tbody>
        </table> 
        ';

	}

  if(isset($_POST['update_products'])){
      $u_pcode = strtoupper($_POST['u_pcode']);
      $u_pdesc = strtoupper($_POST['u_pdesc']); 

        $update="UPDATE `tblproducts` SET `pcode`='$u_pcode', `pdesc`='$u_pdesc' WHERE id_autonun = '$_POST[auto_n]'";
        $runupdate = mysqli_query($conn, $update);    
  }


	if(isset($_POST['saving_products'])){
			$pcode = strtoupper($_POST['pcode']);
			$pdesc = strtoupper($_POST['pdesc']);	
		    $insert="INSERT INTO `tblproducts` (`pcode`, `pdesc`) VALUES ('$pcode', '$pdesc')";
		    $runinsert = mysqli_query($conn, $insert);		
	}


	if(isset($_POST['delete_products'])){
		    $delete="DELETE FROM tblproducts WHERE id_autonun = '$_POST[id_autonun]'";
		    $rundelete = mysqli_query($conn, $delete);	
	}
 ?>