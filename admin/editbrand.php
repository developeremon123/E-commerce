<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php';?>
<?php 
if (!isset($_GET['editbrand']) || $_GET['editbrand'] == NULL) {
    echo "<script>window.location = 'brandlist.php';</script>";
}else {
    $brandId = preg_replace('/[^-a-zA-Z0-9_]/','',$_GET['editbrand']);
}
    $brand = new Brand;
    if ($_SERVER["REQUEST_METHOD"] == 'POST') {
        $brandName = $_POST['brandName'];
        $updateBrand = $brand->updateBrand($brandName,$brandId);
    }       
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Brand</h2>
        <div class="block copyblock"> 
            <?php 
            if (isset($updateBrand)) {
               echo $updateBrand;
            }
            ?>
            <form action="" method="post">
                <table class="form">
                <?php 
                    $getBrand = $brand->getbrandbyId($brandId);
                    if ($getBrand) {
                        while ($result = $getBrand->fetch_assoc()) {
						?>					
                    <tr>
                        <td>
                            <input type="text" name='brandName' value="<?php echo $result['brandName']; ?>"  class="medium" />
                        </td>
                    </tr>
                    <tr> 
                        <td>
                            <input type="submit" name="submit" Value="Save" />
                        </td>
                    </tr>
                    <?php }}?>
                </table>
            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>