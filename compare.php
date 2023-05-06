<?php include "inc/header.php";?>
<style>
    table .tblone img{
        height: 90px;
        width: 100px;
    }
</style>
<div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
				<h2>Compare</h2>
                <table class="tblone">
                    <tr>
                        <th>SL</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                    <tr>
                        <?php 
                            $cmrId = Session::get('customerId');
                            $getPro = $pd->getcompareData($cmrId);

                            if ($getPro) {
                                $i = 0;
                                while ($result = $getPro->fetch_assoc()) {
                        ?>
                        <td><?php echo $i;?></td>
                        <td><?php echo $result['productName']?></td>
                        <td><?php echo $result['price']?></td>
                        <td><img src="admin/<?php echo $result['image']?>" height="s"/></td>
                        <td><a href="details.php?proid=<?php echo $result['productId'];?>">View</a></td>
                        <?php }}?>
                    </tr>
                </table>
            </div>
            <div class="shopping">
                <div class="shopleft">
                    <a href="index.php"> <img src="images/shop.png" alt="" /></a>
                </div>
            </div>
    	</div>  	
       <div class="clear"></div>
   </div>
</div>
<?php include "inc/footer.php";?>
