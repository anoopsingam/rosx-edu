<?php 

class func{

    static function href($page){
        echo ($page==null)?url::myurl()."#":url::myurl().$page;
    }
    static function classlist(String $name='present_class', array $args=array()){
            echo "<select class='form-control m-1' name='".$name."'>\n";
            echo"<option value=''>Select Class </option>\n";
            if($args!=null){
            foreach($args as $key=>$value){
            echo "<option value='$key' selected>$value</option>\n";
            }
            }
            echo"<option value='LKG'>LKG</option>\n";
            echo"<option value='UKG'>UKG</option>\n";
            echo"<option value='1'>1 Std</option>\n";
            echo"<option value='2'>2 Std</option>\n";
            echo"<option value='3'>3 Std</option>\n";
            echo"<option value='4'>4 Std</option>\n";
            echo"<option value='5'>5 Std</option>\n";
            echo"<option value='6'>6 Std</option>\n";
            echo"<option value='7'>7 Std</option>\n";
            echo"<option value='8'>8 Std</option>\n";
            echo"<option value='9'>9 Std</option>\n";
            echo"<option value='10'>10 Std</option>\n";
            echo "</select>";
    }

}