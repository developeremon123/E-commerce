<?php include "inc/header.php";?>
<?php 
    $login = Session::get('customerlogin');
    if ($login == false) {
        header("Location: login.php");
    }
?>
<?php 
    $id = Session::get('customerId');
    if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST['save'])) {
        $updateCmrDeltails = $cmr->updateCmrDeltails($_POST,$id);
    }       
?>
<style>
    .tblone{
        box-shadow: 1px 1px 5px 2px;
        border: 2px solid #fff ;
        margin: 0 auto;
        width: 650px;
        
    }
    .tblone tr{
        text-align: center;
    }
    .tblone h2{
        color: #fff;
        background-color: #000;
    }
    .tblone tr input[type=submit]{
        color: #fff;
        background-color: green;
    }
    .tblone tr input[type=text]{
        width: 400px;
        padding: 5px;
        font-size: 18px;
    }
    .tblone tr input[type=email]{
        width: 400px;
        padding: 5px;
        font-size: 18px;
    }
    .tblone tr input[type=submit]:hover{
        color: #000;
    }
</style>
<div class="main">
    <div class="content">
    	<div class="section group">
            <?php 
                $id = Session::get('customerId');
                $getdata = $cmr->getCustomerData($id);
                if ($getdata) {
					while ($result = $getdata->fetch_assoc()) {
            ?>
			<form action="" method="post">
                <table class="tblone">
                    <?php 
                        if (isset($updateCmrDeltails)) {
                            echo '<tr><td colspan="2">'.$updateCmrDeltails."</td></tr>";
                        }
                    ?>
                    <tr>
                        <td colspan="2"><h2>Update Profile Details</h2></td>
                    </tr>
                    <tr>
                        <td width="20%">Name</td>
                        <td><input type="text" name="name" value="<?php echo $result['name']?>"></td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td><input type="text" name="phone" value="<?php echo $result['phone']?>"></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><input type="email" name="email" value="<?php echo $result['email']?>"></td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td><input type="text" name="address" value="<?php echo $result['address']?>"></td>
                    </tr>
                    <tr>
                        <td>City</td>
                        <td><input type="text" name="city" value="<?php echo $result['city']?>"></td>
                    </tr>
                    <tr>
                        <td>Country</td>
                        <td><input type="text" name="country" value="<?php echo $result['country']?>"></td>
                    </tr>
                    <tr>
                        <td>Zip-code</td>
                        <td><input type="text" name="zip" value="<?php echo $result['zip']?>"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" value="Save" name="save"></td>
                    </tr>
                </table>
            </form>
            <?php } }?>
        </div>
 	</div>
</div>
<?php include "inc/footer.php";?>
