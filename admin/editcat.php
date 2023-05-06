<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Category.php';?>
<?php 
if (!isset($_GET['editcat']) || $_GET['editcat'] == NULL) {
    echo "<script>window.location = 'catlist.php';</script>";
}else {
    $catid = preg_replace('/[^-a-zA-Z0-9_]/','',$_GET['editcat']);
}
    $cat = new Category;
    if ($_SERVER["REQUEST_METHOD"] == 'POST') {
        $catName = $_POST['catName'];
        $updateCat = $cat->updateCat($catName,$catid);
    }       
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Category</h2>
        <div class="block copyblock"> 
            <?php 
            if (isset($updateCat)) {
               echo $updateCat;
            }
            ?>
            <form action="" method="post">
                <table class="form">
                <?php 
                    $getcat = $cat->getCatbyId($catid);
                    if ($getcat) {
                        while ($result = $getcat->fetch_assoc()) {
						?>					
                    <tr>
                        <td>
                            <input type="text" name='catName' value="<?php echo $result['catName']; ?>"  class="medium" />
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