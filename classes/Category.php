<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helper/Formate.php');
?>
<?php 
class Category{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database;
        $this->fm = new Format;
    }
    public function insertCat($catName){
        $catName = $this->fm->validation($catName);

        $catName = mysqli_real_escape_string($this->db->link,$catName);
        if (empty($catName)) {
            $sms = "<span class='error'>Category field must not be empty!!</span>";
            return $sms;
        }else {
            $query     = "INSERT INTO tbl_category(catName) VALUES('$catName')";
            $catinsert = $this->db->insert($query);
            if($catinsert) {
                $sms = "<span class='success'>Category Inserted Successfully</span>";
                return $sms;
                
            }else{
                $sms = "<span class='error'>Category Not Inserted!!</span>";
                return $sms;
            }
        }
    }
    public function getAllCat(){
        $query   = "SELECT * FROM tbl_category ORDER BY catId DESC";
        $showcat = $this->db->select($query);
        return $showcat;
    }
    public function getCatbyId($id){
        $query   = "SELECT * FROM tbl_category WHERE catId = '$id'";
        $showcat = $this->db->select($query);
        return $showcat;
    }
    public function updateCat($catName,$catid){
        $catName = $this->fm->validation($catName);

        $catName = mysqli_real_escape_string($this->db->link,$catName);
        $catid   = mysqli_real_escape_string($this->db->link,$catid);

        if (empty($catName)) {
            $sms = "<span class='error'>Category field must not be empty!!</span>";
            return $sms;
        }else {
            $query  = "UPDATE tbl_category SET catName = '$catName' WHERE catId = '$catid'";
            $update = $this->db->update($query);
            if($update) {
                $sms = "<span class='success'>Category Updated Successfully</span>";
                return $sms;
                
            }else{
                $sms = "<span class='error'>Category Not Updated!!</span>";
                return $sms;
            }
        }
    }
    public function deletecat($catid){
        $catid = mysqli_real_escape_string($this->db->link,$catid);

        $query  = "DELETE  FROM tbl_category WHERE catId = '$catid'";
        $delcat = $this->db->delete($query);
        if($delcat) {
            $sms = "<span class='success'>Category Deleted Successfully</span>";
            return $sms;
            
        }else{
            $sms = "<span class='error'>Category Not Deleted!!</span>";
           
        }
    }
}
?>