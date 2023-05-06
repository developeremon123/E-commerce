<?php include "inc/header.php";?>
<?php 
    $login = Session::get('customerlogin');
    if ($login == false) {
        header("Location: login.php");
    }
?>
<style>
    .payment{
        width: 500px;
        min-height: 200px;
        text-align: center;
        border: 1px solid #ddd;
        margin: 0 auto;
        padding: 50px;
    }
    .payment h2{
        border-bottom: 1px solid #ddd;
        margin-bottom: 70px;
        padding-bottom: 10px;
    }
    .payment a{
        background: green ;
        border-radius: 3px;
        color: #fff;
        font-size: 25px;
        padding: 5px 30px;
    }
    .back a{
        width: 160px;
        margin: 5px auto 0;
        padding: 6px 0px;
        font-size: 20px;
        text-align: center;
        display: block;
        background: #555;
        border-radius: 3px;
        border: 1px solid #333;
        color: #fff;
    }
</style>
<div class="main">
    <div class="content">
    	<div class="section group">
            <div class="payment">
                <h2>Choose Payment Option</h2>
                <a href="payoff.php">Offline payment</a>
                <a href="payon.php">Online payment</a>
            </div>
            <div class="back">
                <a href="cart.php">Go Back</a>
            </div>
        </div>
 	</div>
</div>
<?php include "inc/footer.php";?>
