<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helper/Formate.php');
?>
<?php 
class Product{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database;
        $this->fm = new Format;
    }
    public function insertproduct($data,$file){
        $productName = mysqli_real_escape_string($this->db->link,$data['productName']);
        $catId       = mysqli_real_escape_string($this->db->link,$data['catId']);
        $brandId     = mysqli_real_escape_string($this->db->link,$data['brandId']);
        $body        = mysqli_real_escape_string($this->db->link,$data['body']);
        $price       = mysqli_real_escape_string($this->db->link,$data['price']);
        $type        = mysqli_real_escape_string($this->db->link,$data['type']);

        $permited  = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $file['image']['name'];
        $file_size = $file['image']['size'];
        $file_temp = $file['image']['tmp_name'];

        $div            = explode('.', $file_name);
        $file_ext       = strtolower(end($div));
        $unique_image   = substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "uploads/".$unique_image;
        
        if ($productName =='' || $catId =='' || $brandId =='' || $body =='' || $price =='' || $file_name =='' || $type =='' ) {
            $sms = "<span class='error'>Fields must not be empty!!</span>";
            return $sms;
        }elseif ($file_size >1048567) {
            echo "<span class='error'>Image Size should be less then 1MB!
            </span>";
        } elseif (in_array($file_ext, $permited) === false) {
            echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
        }else {
            move_uploaded_file($file_temp, $uploaded_image);
            $query         = "INSERT INTO tbl_product(productName,catId,brandId,body,price,image,type) VALUES('$productName','$catId','$brandId','$body','$price','$uploaded_image','$type')";
            $insertproduct = $this->db->insert($query);
            if($insertproduct) {
                $sms = "<span class='success'>Product Inserted Successfully</span>";
                return $sms;
            }else{
            $sms = "<span class='error'>Product Not Inserted!!</span>";
                return $sms;
            }
        }
    }
    public function getAllProduct(){
        $query   = "SELECT tbl_product.*,tbl_category.catName,tbl_brand.brandName
                    FROM tbl_product
                    INNER JOIN tbl_category
                    on tbl_product.catId = tbl_category.catId
                    INNER JOIN tbl_brand
                    on tbl_product.brandId = tbl_brand.brandId
                    ORDER BY tbl_product.productId";
        $showproduct = $this->db->select($query);
        return $showproduct;
    }
    public function getproductbyId($productId){
        $query   = "SELECT * FROM tbl_product WHERE productId = '$productId'";
        $showcat = $this->db->select($query);
        return $showcat;
    }
    public function updateProduct($data,$file,$productId){
        
        $productName = mysqli_real_escape_string($this->db->link,$data['productName']);
        $catId       = mysqli_real_escape_string($this->db->link,$data['catId']);
        $brandId     = mysqli_real_escape_string($this->db->link,$data['brandId']);
        $body        = mysqli_real_escape_string($this->db->link,$data['body']);
        $price       = mysqli_real_escape_string($this->db->link,$data['price']);
        $type        = mysqli_real_escape_string($this->db->link,$data['type']);

        $permited  = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $file['image']['name'];
        $file_size = $file['image']['size'];
        $file_temp = $file['image']['tmp_name'];

        $div            = explode('.', $file_name);
        $file_ext       = strtolower(end($div));
        $unique_image   = substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "uploads/".$unique_image;
        
        if ($productName =='' || $catId =='' || $brandId =='' || $body =='' || $price =='' || $type =='' ) {
            $sms = "<span class='error'>Fields must not be empty!!</span>";
            return $sms;
        }else{
            if (!empty($file_name)) {
                if ($file_size >1048567) {
                    echo "<span class='error'>Image Size should be less then 1MB!
                    </span>";
                } elseif (in_array($file_ext, $permited) === false) {
                    echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
                }else{
                    move_uploaded_file($file_temp, $uploaded_image);
                    $query     = "UPDATE tbl_product 
                    SET 
                          productName = '$productName',
                          catId       = '$catId',
                          brandId     = '$brandId',
                          body        = '$body',
                          price       = '$price',
                          image       = '$uploaded_image',
                          type        = '$type'
                    WHERE productId   = '$productId'" ;
                    $updateProduct = $this->db->update($query);
                    if($updateProduct) {
                        $sms = "<span class='success'>Product Updated Successfully</span>";
                        return $sms;
                    }else{
                    $sms = "<span class='error'>Product Not Updated!!</span>";
                        return $sms;
                    }
                }
            }else{
                $query     = "UPDATE tbl_product 
                SET   
                      productName = '$productName',
                      catId       = '$catId',
                      brandId     = '$brandId',
                      body        = '$body',
                      price       = '$price',
                      type        = '$type'
                WHERE productId   = '$productId'" ;
                $updateProduct = $this->db->update($query);
                if($updateProduct) {
                    $sms = "<span class='success'>Product Updated Successfully</span>";
                    return $sms;
                }else{
                $sms = "<span class='error'>Product Not Updated!!</span>";
                    return $sms;
                }
            }
        }
    }
    public function deletebrand($id){
        $id = mysqli_real_escape_string($this->db->link,$id);

        $query      = "DELETE  FROM tbl_product WHERE productId = '$id'";
        $delproduct = $this->db->delete($query);
        if($delproduct) {
            $sms = "<span class='success'>Product Deleted Successfully</span>";
            return $sms;
            
        }else{
            $sms = "<span class='error'>Product Not Deleted!!</span>";
           
        }
    }
    public function getFeatureProduct(){
        $query          = "SELECT * FROM tbl_product WHERE type = '0' ORDER BY productId DESC LIMIT 4";
        $FeatureProduct = $this->db->select($query);
        return $FeatureProduct;
    }

    public function getNewProduct(){
        $query          = "SELECT * FROM tbl_product ORDER BY productId DESC LIMIT 4";
        $FeatureProduct = $this->db->select($query);
        return $FeatureProduct;
    }
    public function getSingleProduct($pdId){
        $query = "SELECT p.*,c.catName,b.brandName
                    FROM tbl_product as p,tbl_category as c,tbl_brand as b
                    WHERE p.catId = c.catId AND p.brandId = b.brandId AND p.productId = '$pdId'";
        $result = $this->db->select($query);
        return $result;
    }
    public function latestIphone(){
        $query          = "SELECT * FROM tbl_product WHERE brandId ='2' ORDER BY productId DESC LIMIT 1";
        $FeatureProduct = $this->db->select($query);
        return $FeatureProduct;
    }
    public function latestSamsung(){
        $query          = "SELECT * FROM tbl_product WHERE brandId ='3' ORDER BY productId DESC LIMIT 1";
        $FeatureProduct = $this->db->select($query);
        return $FeatureProduct;
    }
    public function latestAcer(){
        $query          = "SELECT * FROM tbl_product WHERE brandId ='4' ORDER BY productId DESC LIMIT 1";
        $FeatureProduct = $this->db->select($query);
        return $FeatureProduct;
    }
    public function latestCanon(){
        $query          = "SELECT * FROM tbl_product WHERE brandId ='5' ORDER BY productId DESC LIMIT 1";
        $FeatureProduct = $this->db->select($query);
        return $FeatureProduct;
    }
    public function productByCat($id){
        $catId        = mysqli_real_escape_string($this->db->link,$id);
        $query          = "SELECT * FROM tbl_product WHERE catId = '$catId'";
        $result = $this->db->select($query);
        return $result;
    }
    public function insertCompareData($cmrId,$cmprId){
        $cmprId        = mysqli_real_escape_string($this->db->link,$cmprId);
        $productId        = mysqli_real_escape_string($this->db->link,$cmrId);
        $cquery    = "SELECT * FROM tbl_compare WHERE customerId = '$cmrId' AND productId = '$productId'";
        $chk = $this->db->select($cquery);
        if ($chk) {
            $sms = "<span class='error'>Already Added!!</span>";
                return $sms;
        }
        $query    = "SELECT * FROM tbl_product WHERE productId = '$productId'";
        $result = $this->db->select($query)->fetch_assoc();
        if ($result) {
                $productId = $result['productId'];
                $productName = $result['productName'];
                $price = $result['price'];
                $image = $result['image'];
            $query         = "INSERT INTO tbl_compare(customerId,productId,productName,price,image) VALUES('$cmrId','$productId','$productName','$price','$image')";
            $insert_row = $this->db->insert($query);
            if($insert_row) {
                $sms = "<span class='success'>Added to Compare</span>";
                return $sms;
                
            }else{
                $sms = "<span class='error'>Not Added!!</span>";
                return $sms;
            }
        }
    }
    public function getcompareData($cmrId){
        $query          = "SELECT * FROM tbl_compare WHERE customerId = '$cmrId'";
        $result = $this->db->select($query);
        return $result;
    }
}



