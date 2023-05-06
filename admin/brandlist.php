<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php';?>
<?php 
    $brand = new Brand;
if (isset($_GET['deltbrand'])) {
	$brandId = preg_replace('/[^-a-zA-Z0-9_]/','',$_GET['deltbrand']);
    echo "<script>window.location = 'brandlist.php';</script>";
    $delbrand = $brand->deletebrand($brandId);
    }       
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Brand List</h2>
                <div class="block">  
					<?php 
						if (isset($delbrand)) {
							echo $delbrand;
						}
					?>      
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Brand Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$getbrand = $brand->getAllbrand();
							if ($getbrand) {
								$i = 0;
								while ($result = $getbrand->fetch_assoc()) {
								$i++;									
						?>
						<tr class="odd gradeX">
							<td><?php echo $i?>.</td>
							<td><?php echo $result['brandName']; ?></td>
							<td><a href="editbrand.php?editbrand=<?php echo $result['brandId'] ?>">Edit</a> || <a onclick="return confirm('Are you sure to delete!')" href="?deltbrand=<?php echo $result['brandId'] ?>">Delete</a></td>
						</tr>
						<?php } }?>
					</tbody>
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

