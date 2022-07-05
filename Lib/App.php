<?php
class app
{   
    // public $name = "MWA School";
    // public $address = "K R Extension , Chintamani, Chikkaballapura Dist, Karnataka INDIA-563125";
    // public $phone = "08154250007";
    // public $email = "mwaschoolca0176@gmail.com";
    // public $website = "www.mwa.starktechlabs.in";
    // public $short_name = "MWAS";
    // public $city="Chintamani";


    // public $name = "Shanthinikethan School";
    // public $address = "4th Ward Gulur road, Bagepalli";
    // public $phone = "+91-7353934341,+91-7337755266";
    // public $email = "shanthinikethanschoolbpl2@gmail.com";
    // public $website = "www.shanthinikethanschool.com";
    // public $short_name = "SNHS";
    // public $city="Bagepalli";


    public $name = "Sri Sathya Sai Vidya Niketan";
    public $address = "Sri Sathya Sai Nagar, Bagepalli, Chikkaballapura Dist, KA-561207";
    public $phone = "7022537447, 9966930530, 8494961431";
    public $email = "sssvn561207@gmail.com";
    public $website = "www.sssvnbagepalli.in";
    public $short_name = "SSVN";
    public $city="Bagepalli";



    public $logo = "web_assets/logo.png";
    public $currency_symbol = "₹";
    public $quotation="Quotation"; 
    public function name()
    {
        echo $this->name;
    }
    public function address()
    {
        echo $this->address;
    }
    public function phone()
    {
        echo $this->phone;
    }
    public function email()
    {
        echo $this->email;
    }
    public function website()
    {
        echo $this->website;
    }
    public function logo()
    {
        echo $this->logo;
    }
    public function short()
    {
        $this->short_name;
    }
    public function setTitle($title)
    {
        echo "<title> $title | " . $this->short_name . "</title>";
    }
    public  function SetLogo(string $height='80',string $width='80',string $class="img-fluid")
    {
        echo "<img src='" . url::myurl() . "/" . $this->logo . "' height='$height' width='$width' class='$class' alt='{$this->name}'>";
    }
    

}
  
