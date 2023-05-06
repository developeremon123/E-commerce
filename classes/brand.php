<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helper/Formate.php');
?>
<?php 
class Brand{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database;
        $this->fm = new Format;
    }
    public function insertBrand($brandName){
        $brandName = $this->fm->validation($brandName);

        $brandName = mysqli_real_escape_string($this->db->link,$brandName);
        if (empty($brandName)) {
            $sms = "<span class='error'>Brand Name field must not be empty!!</span>";
            return $sms;
        }else {
            $query     = "INSERT INTO tbl_brand (brandName) VALUES('$brandName')";
            $brandinsert = $this->db->insert($query);
            if($brandinsert) {
                $sms = "<span class='success'>Brand Name Inserted Successfully</span>";
                return $sms;
                
            }else{
                $sms = "<span class='error'>Brand Name Not Inserted!!</span>";
                return $sms;
            }
        }
    }
    public function getAllbrand(){
        $query   = "SELECT * FROM tbl_brand ORDER BY brandId DESC";
        $showbrand = $this->db->select($query);
        return $showbrand;
    }
    public function getbrandbyId($id){
        $query   = "SELECT * FROM tbl_brand WHERE brandId = '$id'";
        $showbrand = $this->db->select($query);
        return $showbrand;
    }
    public function updateBrand($brandName,$brandId){
        $brandName = $this->fm->validation($brandName);

        $brandName = mysqli_real_escape_string($this->db->link,$brandName);
        $brandId   = mysqli_real_escape_string($this->db->link,$brandId);

        if (empty($brandName)) {
            $sms = "<span class='error'>Brand Name field must not be empty!!</span>";
            return $sms;
        }else {
            $query  = "UPDATE tbl_brand SET brandName = '$brandName' WHERE brandId = '$brandId'";
            $update = $this->db->update($query);
            if($update) {
                $sms = "<span class='success'>Brand Name Updated Successfully</span>";
                return $sms;
                
            }else{
                $sms = "<span class='error'>Brand Name Not Updated!!</span>";
                return $sms;
            }
        }
    }
    public function deletebrand($brandId){

        $query   = "DELETE  FROM tbl_brand WHERE brandId = '$brandId'";
        $delbrand = $this->db->delete($query);
        if($delbrand) {
            $sms = "<span class='success'>Brand Name Deleted Successfully</span>";
            return $sms;
            
        }else{
            $sms = "<span class='error'>Brand Name Not Deleted!!</span>";
           
        }
    }
}
?>