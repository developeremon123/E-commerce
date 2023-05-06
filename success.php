<?php include "inc/header.php";?>
<?php 
    $login = Session::get('customerlogin');
    if ($login == false) {
        header("Location: login.php");
    }
?>
<style>
    .psuccess{
        width: 500px;
        min-height: 200px;
        text-align: center;
        border: 1px solid #ddd;
        margin: 0 auto;
        padding: 20px;
    }
    .psuccess h2{
        border-bottom: 1px solid #ddd;
        margin-bottom: 20px;
        padding-bottom: 10px;
    }
    .psuccess p{
        color: green;
        line-height: 25px;
    }
</style>
<div class="main">
    <div class="content">
    	<div class="section group">
            <div class="psuccess">
                <h2>Success</h2>
                <?php 
                    $id     = Session::get('customerId');
                    $amount = $ct->payAmount($id);
                    if ($amount){
                        $sum = 0;
                        while ($result = $amount->fetch_assoc()) {
                            $price = $result['price'];
                            $sum   = $sum+$price;
                        }
                    }
                ?>
                <p>Total Amount(Including Vat): $
                    <?php 
                        $vat   = $sum * 0.1;
                        $total = $sum + $vat;
                        echo $total;
                    ?>
                </p>
                <p>Thanks for purchase. Recieve your order successfully. We will contact you as soon as with delivery product.Order details...<a                href="orderdetails.php">Visit Here</a></p>
            </div>
        </div>
 	</div>
</div>
<?php include "inc/footer.php";?>
