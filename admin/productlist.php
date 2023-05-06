<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/product.php';?>
<?php include_once "../helper/Formate.php";?>
<?php
$pd = new Product;
$fm = new Format;
if (isset($_GET['delProduct'])) {
	$id = preg_replace('/[^-a-zA-Z0-9_]/','',$_GET['delProduct']);
    echo "<script>window.location = 'productlist.php';</script>";
    $delProduct = $pd->deletebrand($id);
    }       
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <div class="block">  
			<?php 
				if (isset($delProduct)) {
					echo $delProduct;
				}
			?>
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>SL</th>
					<th>Productname</th>
					<th>Category</th>
					<th>Brand</th>
					<th>Description</th>
					<th>Price</th>
					<th>Image</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				$getproduct = $pd->getAllProduct();
				if ($getproduct) {
					$i = 0;
					while ($result = $getproduct->fetch_assoc()) {
					$i++;									
			?>
				<tr class="odd gradeX">
					<td><?php echo $i;?></td>
					<td><?php echo $result['productName'];?></td>
					<td><?php echo $result['catName'];?></td>
					<td><?php echo $result['brandName'];?></td>
					<td><?php echo $fm->textShorten($result['body'],50);?></td>
					<td>$<?php echo $result['price'];?></td>
					<td><img src="<?php echo $result['price'];?>" height="40px" width="60px"></td>
					<td>
						<?php
						 if ($result['type'] == 0){
							echo 'Featured';
						 }else{
							echo 'General';
						}
						?>
					</td>
					<td><a href="editProduct.php?editProduct=<?php echo $result['productId'] ?>">Edit</a> || <a onclick="return confirm('Are you sure to delete!')" href="?delProduct=<?php echo $result['productId'] ?>">Delete</a></td>
				</tr>
			</tbody>
			<?php }}?>
		</table>

       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
