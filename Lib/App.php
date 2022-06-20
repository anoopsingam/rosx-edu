<?php
class app
{
    public $name = "Sri Sathya Sai Vidya Niketan";
    public $address = "Sri Sathya Sai Nagar, Bagepalli, Chikkaballapura Dist, KA-561207";
    public $phone = "7022537447, 9966930530, 8494961431";
    public $email = "sssvn561207@gmail.com";
    public $website = "www.sssvnbagepalli.in";
    public $logo = "web_assets/logo.png";
    public $short_name = "SSVN";
    public $currency_symbol = "₹";
    public $city="Bagepalli";
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
  
