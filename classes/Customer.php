<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helper/Formate.php');
?>
<?php 
class Customer{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database;
        $this->fm = new Format;
    }
    public function cmr_reg($data){
        $name     = mysqli_real_escape_string($this->db->link,$data['name']);
        $address  = mysqli_real_escape_string($this->db->link,$data['address']);
        $city     = mysqli_real_escape_string($this->db->link,$data['city']);
        $country  = mysqli_real_escape_string($this->db->link,$data['country']);
        $zip      = mysqli_real_escape_string($this->db->link,$data['zip']);
        $phone    = mysqli_real_escape_string($this->db->link,$data['phone']);
        $email    = mysqli_real_escape_string($this->db->link,$data['email']);
        $Password = mysqli_real_escape_string($this->db->link,$data['password']);

        if ($name =='' || $address =='' || $city =='' || $country =='' || $zip =='' || $phone =='' || $email =='' || $Password =='' ) {
            $sms = "<span class='error'>Fields must not be empty!!</span>";
            return $sms;
        }
        $mailquery = "SELECT * FROM tbl_customer WHERE email = '$email' LIMIT 1";
        $mailchk = $this->db->select($mailquery);
        if ($mailchk !=false) {
            $sms = "<span class='error'>This email address already exist!!</span>";
            return $sms;
        }else {
            $query = "INSERT INTO tbl_customer(name,address,city,country,zip,phone,email,Password) VALUES('$name','$address','$city','$country','$zip','$phone','$email','$Password')";
            $customerData = $this->db->insert($query);
            if($customerData) {
                $sms = "<span class='success'>Customer Data Inserted Successfully.</span>";
                return $sms;
            }else{
            $sms = "<span class='error'>Customer Data Not Inserted!!</span>";
                return $sms;
            }
        }
    }
    public function cmr_log($data){
        $email    = mysqli_real_escape_string($this->db->link,$data['email']);
        $Password = mysqli_real_escape_string($this->db->link,$data['password']);

        if (empty($email) || empty($Password) ) {
            $sms = "<span class='error'>Fields must not be empty!!</span>";
            return $sms;
        }

        $query = "SELECT * FROM tbl_customer WHERE email = '$email' AND password ='$Password'";
        $result = $this->db->select($query);
        if ($result != false) {
            $value = $result->fetch_assoc();
            Session::set("customerlogin", true);
            Session::set("customerId", $value['customerId']);
            Session::set("name", $value['name']);
            header("Location: index.php");
        }else{
            $sms = "<span class='error'>Email or Password not match!!</span>";
            return $sms;
        }
    }
    public function getCustomerData($id){
        $query    = "SELECT * FROM tbl_customer WHERE customerId = '$id'";
        $result = $this->db->select($query);
        return $result;
    }
    public function updateCmrDeltails($data,$id){
        $name     = mysqli_real_escape_string($this->db->link,$data['name']);
        $address  = mysqli_real_escape_string($this->db->link,$data['address']);
        $city     = mysqli_real_escape_string($this->db->link,$data['city']);
        $country  = mysqli_real_escape_string($this->db->link,$data['country']);
        $zip      = mysqli_real_escape_string($this->db->link,$data['zip']);
        $phone    = mysqli_real_escape_string($this->db->link,$data['phone']);
        $email    = mysqli_real_escape_string($this->db->link,$data['email']);

        if ($name =='' || $address =='' || $city =='' || $country =='' || $zip =='' || $phone =='' || $email =='' ) {
            $sms = "<span class='error'>Fields must not be empty!!</span>";
            return $sms;
        }else {
            // $query = "UPDATE tbl_customer(name,address,city,country,zip,phone,email) VALUES('$name','$address','$city','$country','$zip','$phone','$email')";
            $query  = "UPDATE tbl_customer SET name = '$name',address = '$address',city = '$city',country = '$country',zip = '$zip',phone = '$phone',email = '$email' WHERE customerId = '$id'";
            $update = $this->db->update($query);
            if($update) {
                $sms = "<span class='success'>Customer Data Updated Successfully</span>";
                return $sms;
                
            }else{
                $sms = "<span class='error'>Customer Data Not Updated!!</span>";
                return $sms;
            }
        }
    }
   
}