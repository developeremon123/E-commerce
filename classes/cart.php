<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helper/Formate.php');
?>
<?php 
class Cart{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database;
        $this->fm = new Format;
    }
    public function addToCart($quantity,$pdId){
        $quantity  = $this->fm->validation($quantity);
        $quantity  = mysqli_real_escape_string($this->db->link, $quantity);
        $productId = mysqli_real_escape_string($this->db->link, $pdId);
        $sId       = session_id();

        $squery = "SELECT * FROM tbl_product WHERE productId = '$productId'";
        $result = $this->db->select($squery)->fetch_assoc();
        
        $productName = $result['productName'];
        $price       = $result['price'];
        $image       = $result['image'];
        
        $chkquery = "SELECT * FROM tbl_cart WHERE productId = '$productId' AND sId = '$sId'";
        $getpro   = $this->db->select($chkquery);
        if ($getpro) {
            $sms  = "Product already added!!";
            return $sms;
        }else{
            $query         = "INSERT INTO tbl_cart(sId,productId,productName,price,quantity,image) VALUES('$sId','$productId','$productName','$price','$quantity','$image')";
            $insertproduct = $this->db->insert($query);
            if($insertproduct) {
                header("Location: cart.php");
            }else{
                header("Location: 404.php");
            }
        }
    }
    public function getCartProduct(){
        $sId = session_id();
        $query    = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
        $showcart = $this->db->select($query);
        return $showcart;
    }
    public function updateCart($quantity,$cartId){
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $cartId   = mysqli_real_escape_string($this->db->link, $cartId);

        $query  = "UPDATE tbl_cart SET quantity = '$quantity' WHERE cartId = '$cartId'";
        $update = $this->db->update($query);
        if($update) {
            header("Location: cart.php");
        }else{
            $sms = "<span class='error'>Quantity Not Updated!!</span>";
            return $sms;
        }

    }
    public function deleteCart($delId){
        $deletId = mysqli_real_escape_string($this->db->link, $delId);
        $query   = "DELETE  FROM tbl_cart WHERE cartId = '$deletId'";
        $delproduct = $this->db->delete($query);
        if($delproduct) {
            echo "<script>window.location ='cart.php';</script>";
            
        }else{
            $sms = "<span class='error'>Product Not Deleted!!</span>";
           
        }
    }
    public function checkCartTable(){
        $sId = session_id();
        $query    = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
        $result = $this->db->select($query);
        return $result;
    }
    public function delCusData(){
        $sId = session_id();
        $query    = "DELETE FROM tbl_cart WHERE sId = '$sId'";
        $result = $this->db->delete($query);
        return $result;
    }
    public function orderProduct($cmrid){
        $sId = session_id();
        $query    = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
        $getpro = $this->db->select($query);
        if ($getpro) {
            while ($result = $getpro->fetch_assoc()) {
                $productId = $result['productId'];
                $productName = $result['productName'];
                $quantity = $result['quantity'];
                $price = $result['price'] * $quantity;
                $image = $result['image'];
                $query         = "INSERT INTO tbl_order(customerId,productId,productName,price,quantity,image) VALUES('$cmrid','$productId','$productName','$price','$quantity','$image')";
                $insert_row = $this->db->insert($query);
                
            }
        }
        return true;
    }
    public function payAmount($id){
        $query    = "SELECT * FROM tbl_order WHERE customerId = '$id' AND date = now()";
        $result = $this->db->select($query);
        return $result;
    }
    public function getOrderProduct($id){
        $query    = "SELECT * FROM tbl_order WHERE customerId = '$id' ORDER BY date DESC";
        $result = $this->db->select($query);
        return $result;
    }
    public function checkOrder($cmrId){
        $query    = "SELECT * FROM tbl_order WHERE customerId = '$cmrId'";
        $result = $this->db->select($query);
        return $result;
    }
    public function getAllOrderProduct(){
        $query    = "SELECT * FROM tbl_order ORDER BY date DESC";
        $result = $this->db->select($query);
        return $result;
    }
    public function productShifted($id,$time,$price){
        $id    = mysqli_real_escape_string($this->db->link, $id);
        $time  = mysqli_real_escape_string($this->db->link, $time);
        $price = mysqli_real_escape_string($this->db->link, $price);

        $query  = "UPDATE tbl_order SET status = '1' WHERE customerId = '$id'AND date = '$time'AND price = '$price'";
        $result = $this->db->update($query);
        if($result) {
            $sms = "<span class='success'>Data Updated Successfully</span>";
                return $sms;
            }else{
                $sms = "<span class='error'>Data Not Updated!!</span>";
                return $sms;
        }
    }
    public function delproShifted($id,$time,$price){
        $id    = mysqli_real_escape_string($this->db->link, $id);
        $time  = mysqli_real_escape_string($this->db->link, $time);
        $price = mysqli_real_escape_string($this->db->link, $price);

        $query             = "DELETE  FROM tbl_order WHERE  customerId = '$id'AND date = '$time'AND price = '$price'";
        $delproductShifted = $this->db->delete($query);
        if($delproductShifted) {
            $sms = "<span class='success'>Data Deleted Successfully</span>";
            return $sms;
            
        }else{
            $sms = "<span class='error'>Data Not Deleted!!</span>";
            return $sms;
        }
    }
    public function productShiftConfirm($id,$time,$price){
        $id    = mysqli_real_escape_string($this->db->link, $id);
        $time  = mysqli_real_escape_string($this->db->link, $time);
        $price = mysqli_real_escape_string($this->db->link, $price);

        $query  = "UPDATE tbl_order SET status = '2' WHERE customerId = '$id'AND date = '$time'AND price = '$price'";
        $result = $this->db->update($query);
        if($result) {
        $sms = "<span class='success'>Data Updated Successfully</span>";
            return $sms;
        }else{
            $sms = "<span class='error'>Data Not Updated!!</span>";
            return $sms;
        }
    }
    
}