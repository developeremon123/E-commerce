<?php include "inc/header.php";?>
<?php 
    $login = Session::get('customerlogin');
    if ($login == false) {
        header("Location: login.php");
    }
?>
<style>
    .tblone{
        box-shadow: 1px 1px 5px 2px;
        border: 2px solid #fff ;
        margin: 0 auto;
        width: 650px;
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
            <?php } }?>
        </div>
 	</div>
</div>
<?php include "inc/footer.php";?>
