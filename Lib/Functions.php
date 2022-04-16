<?php 

class func{

    /**
     * @param string url route
     * returns the project server url with route
     */
    static function href($page){
        echo ($page==null)?url::myurl()."#":url::myurl().$page;
    }

    /**
     * Function to fetch Class list
     * @param string form:name 
     * @param array class_list
     */
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
    static function academicYear(string $ay="ay"){
        echo"<select class='form-control m-1' name='$ay'>\n";
        echo"<option value=''>Select Academic Year </option>\n";
        echo"<option value='2020-2021'>2020-2021</option>\n";
        echo"<option value='2021-2022'>2021-2022</option>\n";
        echo"<option value='2022-2023'>2022-2023</option>\n";
        echo"<option value='2023-2024'>2023-2024</option>\n";
        echo"<option value='2024-2025'>2024-2025</option>\n";
        echo"<option value='2025-2026'>2025-2026</option>\n";
        echo"<option value='2026-2027'>2026-2027</option>\n";
        echo"<option value='2027-2028'>2027-2028</option>\n";
        echo"<option value='2028-2029'>2028-2029</option>\n";
        echo"<option value='2029-2030'>2029-2030</option>\n";
        echo"</select>";
    }
    static function sectionList(){
        echo "<select class='form-control m-1' name='$section'>\n";
        echo"<option value=''>Select Section </option>\n";
        echo"<option value='A'>A</option>\n";
        echo"<option value='B'>B</option>\n";
        echo"<option value='C'>C</option>\n";
        echo"<option value='D'>D</option>\n";
        echo"<option value='E'>E</option>\n";
        echo"<option value='F'>F</option>\n";
        echo"<option value='G'>G</option>\n";
        echo"<option value='H'>H</option>\n";
        echo"<option value='I'>I</option>\n";
        echo"<option value='J'>J</option>\n";
        echo"<option value='K'>K</option>\n";
        echo"<option value='L'>L</option>\n";
        echo"</select>";
    }

}