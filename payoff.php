<?php include "inc/header.php";?>
<?php 
    $login = Session::get('customerlogin');
    if ($login == false) {
        header("Location: login.php");
    }
?>
<?php 
    if (isset($_GET['orderid']) && $_GET['orderid']=='order') {
        $cmrid = Session::get('customerId');
        $orderproduct = $ct->orderProduct($cmrid);
        $delData = $ct->delCusData();
        header('Location: success.php');
    }
?>
<style>
    .tblone{
        box-shadow: 1px 1px 5px 2px;
        border: 2px solid #fff ;
        margin: 0 auto;
        width: 600px;
    }
    
    .tblone h2{
        color: #fff;
        background-color: #000;
    }
    .tblone tr a{
        color: green;
    }
    .tblone tr a:hover{
        color: #000;
    }
    .tbltwo{
        /* float:right; */
        box-shadow: 1px 1px 5px 2px;
        text-align:justify;
        width: 50%;
        margin-left: 300px;
        margin-top: 7px;
        margin-bottom: 7px;
    }
    .tbltwo tr td{
        text-align: justify;

        padding: 5px 10px;
    }
    .ordernow{
        padding-bottom:30px ;
    }
    .ordernow a{
        width: 100px;
        margin: 20px auto 0;
        text-align: center;
        padding: 5px;
        font-size: 25px;
        display: block;
        background-color: #ff0000;
        color: #fff;
        border-radius: 5px;
    }
</style>

<div class="main">
    <div class="content">
    	<div class="section group">
            <div class="division">
                <table class="tblone">
                    <tr>
                        <th>SL</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                    </tr>
                    <?php 
                        $getcart = $ct->getCartProduct();
                        if ($getcart) {
                            $i   = 0;
                            $sum = 0;
                            $qty = 0;
                            while ($result = $getcart->fetch_assoc()) {
                                $i++;
                    ?>
                    <tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo $result['productName']?></td>
                        <td>$<?php echo $result['price']?></td>
                        <td><?php echo $result['quantity']?></td>
                        <td>$
                            <?php 
                            $total = $result['price'] * $result['quantity'];
                            echo '$'.$total;
                            ?>
                        </td>
                    </tr>
                    <?php 
                        $qty = $qty + $result['quantity'];
                        $sum = $sum+$total;
                    ?>
                    <?php }} ?>
				</table>
                <table class="tbltwo" >
                    <tr>
                        <th>Sub Total : </th>
                        <td>$<?php echo $sum;?></td>
                    </tr>
                    <tr>
                        <th>VAT : </th>
                        <td>10%</td>
                    </tr>
                    
                    <tr>
                        <th>Grand Total :</th>
                        <td>
                            <?php 
                                $vat = $sum * 0.1;
                                $gtotal = $sum + $vat;
                                echo $gtotal;
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Quantity : </th>
                        <td><?php echo $qty;?></td>
                    </tr>
                </table>
            </div>
            <div class="division">
                <?php 
                    $id = Session::get('customerId');
                    $getdata = $cmr->getCustomerData($id);
                    if ($getdata) {
                        while ($result = $getdata->fetch_assoc()) {
                ?>
                <table class="tblone">
                    <tr>
                        <td colspan="3"><h2>Your Profile Details</h2></td>
                    </tr>
                    <tr>
                        <td width="20%">Name</td>
                        <td width="5%">:</td>
                        <td><?php echo $result['name']?></td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>:</td>
                        <td><?php echo $result['phone']?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td><?php echo $result['email']?></td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>:</td>
                        <td><?php echo $result['address']?></td>
                    </tr>
                    <tr>
                        <td>City</td>
                        <td>:</td>
                        <td><?php echo $result['city']?></td>
                    </tr>
                    <tr>
                        <td>Country</td>
                        <td>:</td>
                        <td><?php echo $result['country']?></td>
                    </tr>
                    <tr>
                        <td>Zip-code</td>
                        <td>:</td>
                        <td><?php echo $result['zip']?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td><a href="editProfile.php">Update</a></td>
                    </tr>
                </table>
                <?php }} ?>
            </div>
        </div>
 	</div>
    <div class="ordernow"> <a href="?orderid=order">Order</a></div>
</div>
<?php include "inc/footer.php";?>
