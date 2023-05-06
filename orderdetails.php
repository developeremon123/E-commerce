<?php include "inc/header.php";?>
<?php 
    $login = Session::get('customerlogin');
    if ($login == false) {
        header("Location: login.php");
    }
?>
<?php 
    if (isset($_GET['confirmid'])) {
		$id = $_GET['confirmid'];
		$time = $_GET['time'];
		$price = $_GET['price'];
		$confirm = $ct->productShiftConfirm($id,$time,$price);
	}
?>
<style>
    
</style>
 <div class="main">
    <div class="content">
        <div class="section group">
            <div class="order">
                <h2>Your ordered details</h2>
                <table class="tblone">
                    <tr>
                        <th>SL</th>
                        <th>Product Name</th>
                        <th>Image</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    <?php 
                        $cusid = Session::get('customerId');
                        $getorder = $ct->getOrderProduct($cusid);
                        if ($getorder) {
                            $i = 0;
                            while ($result = $getorder->fetch_assoc()) {
                                $i++;
                    ?>
                    <tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo $result['productName']?></td>
                        <td><img src="admin/<?php echo $result['image']?>" height="s"/></td>
                        <td><?php echo $result['quantity']?></td>
                        <td><?php echo $result['price'];?></td>
                        <td><?php echo $fm->formatDate($result['date']); ?></td>
                        <td>
                            <?php 
                                if ($result['status'] == '0') {
                                    echo 'Pending';
                                }elseif($result['status'] == '1'){
                                    echo 'Shifted';
                                }else{
                                    echo 'OK';
                                }
                            ?>
                        </td>
                        <?php 
                            if ($result['status'] == '1') { ?>
                                <td><a href = "?confirmid=<?php echo $cusid;?> & price=<?php echo $result['price'];?> ?> & time=<?php echo $result['date']?>">Confrim</a></td>
                            <?php }elseif($result['status'] == '2'){ ?>
                                <td>OK</td>
                            <?php } elseif($result['status'] == '0'){?>
                                <td>N/A</td>
                            <?php } ?>
                    </tr>
                    <?php }} ?>
                </table>
            </div>
        </div>	
        <div class="clear"></div>
    </div>
 </div>

<?php include "inc/footer.php";?>
