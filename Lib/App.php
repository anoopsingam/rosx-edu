<?php
class app
{
    public $name = "Shanthinikethan School";
    public $address = "4th Ward Gulur road, Bagepalli";
    public $phone = "+91-7353434241";
    public $email = "shanthinikethanschoolbpl2@gmail.com";
    public $website = "www.shanthinikethanschool.com";
    public $logo = "web_assets/logo.png";
    public $short_name = "SNHS";
    public $currency_symbol = "₹";
    public $city="Bagepalli";
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
  
