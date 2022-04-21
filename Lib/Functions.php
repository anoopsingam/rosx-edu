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
    static function academicYear(string $ay="ay", array $args=array()){
        echo"<select class='form-control m-1' name='$ay'>\n";
        echo"<option value=''>Select Academic Year </option>\n";
        if($args!=null){
            foreach($args as $key=>$value){
            echo "<option value='$key' selected>$value</option>\n";
            }
            }
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
    static function sectionList(string $section, array $args=array()){
        echo "<select class='form-control m-1' name='$section'>\n";
        echo"<option value=''>Select Section </option>\n";
        if($args!=null){
            foreach($args as $key=>$value){
            echo "<option value='$key' selected>$value</option>\n";
            }
            }
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

    /**
     * Function to fetch new Student ID
     * @return string StudentId
     */
    static function getStudentId(){
        $db=new database();
        $conn=$db->conn;
        $app=new app();
        $sql = "SELECT max(studentid) as stud FROM `student_enrollment`";
        $result = mysqli_query($conn,$sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $stu_id = ++$row['stud'];
        } else {
            $stu_id = "SNHS0001";
        }
        return $stu_id;
    }
    
    /**
     * Function to fetch new Enrollment No
     * @return string Enrollment No
     */
    static function getEnrollementNo(){
        $db=new database();
        $conn=$db->conn;
        $app=new app();
        $sql = "SELECT * FROM `student_enrollment` ORDER BY `id` DESC LIMIT 1";
        $result = mysqli_query($conn,$sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $stu_id = ++$row['enrollment_no'];
        } else {
            $stu_id = "ROSXE00001";
        }
        return $stu_id;
    }

    /**
     * Function to fetch new Application No
     * @return string Application No
     */
    static function getApplicationNo(){
        $db=new database();
        $conn=$db->conn;
        $app=new app();
        $sql = "SELECT * FROM `student_enrollment` ORDER BY `id` DESC LIMIT 1";
        $result = mysqli_query($conn,$sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $stu_id = ++$row['app_no'];
        } else {
            $stu_id = "APL00001";
        }
        return $stu_id;
    }

    /**
     *  Function to Fetch Student Details
     * @param string $student_id
     * @return object Student Details
     */
    static function getStudentDetails(string $student_id='', string $status=''){
        $db=new database();
        $conn=$db->conn;
       if($student_id!=null){
        $sql = "SELECT * FROM `student_enrollment` WHERE `studentid`='$student_id' OR `enrollment_no`='$student_id' OR `app_no`='$student_id'";
        if(!empty($status)){
            $sql .= " AND `status`='$status'";
        }
        $result = mysqli_query($conn,$sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_object();
            $student_details = $row;
        } else {
            $student_details = null;
        }
        return $student_details;
       }else{
              return null;
       }
    }


    /**
     *
     * Function to fecth all admin users from database
     *@return html SelectList 
     * 
     */
    static function adminList( string $name="users" ){
        $db=new database();
        $conn=$db->conn;
        $result = mysqli_query($conn,"SELECT * FROM `users` WHERE `user_type`='ADMIN'");
        if ($result->num_rows > 0) {
            echo "<select class='form-control m-1' name='$name'>\n";
            echo"<option value=''>Select User </option>\n";
            while($row = $result->fetch_assoc()){
                echo"<option value='".$row['username']."'>".$row['name']."</option>\n";
            }
            echo "</select>";
        }

    }

    /**
     * Function for student Select List
     * @return html SelectList
     */
     static function studentList(){
        $db=new database();
        $conn=$db->conn;
        $result = mysqli_query($conn,"SELECT * FROM `student_enrollment` WHERE status='APPROVED' ORDER BY `student_name` ASC");
        if ($result->num_rows > 0) {
            echo ' <select data-placeholder="Select Student ID" name="studentid" class="chosen-select-deselect" tabindex="7">
                    <option value=""></option>';
            while($row = $result->fetch_assoc()){
                echo"<option value='".$row['studentid']."'>".$row['student_name']."</option>\n";
            }
            echo "</select>";
        }
     }

     /**
      *  Function for Student Account Data 
      *@param string studentid and string academic_year
      *@return Account Details in Object
      */
        static function studentAccountData(string $studentid, string $academic_year){
            $db=new database();
            $conn=$db->conn;
           if(!empty($studentid) && !empty($academic_year)){
            $result = mysqli_query($conn,"SELECT * FROM `account` WHERE `student_id`='$studentid' AND `acdy`='$academic_year'");
            if ($result->num_rows > 0) {
                $row = $result->fetch_object();
                $student_account = $row;
            } else {
                $student_account = null;
            }
            return $student_account;
           }else{
                return null;
           }
        }

        /**
         * Function to fetch Student Last Payment Details
         * @param string $studentid and string $academic_year
         * @return object Student Payment Details
         */
        static function LastPaymentInfo(string $student_id='',string $academic_year=''){
            $db=new database();
            $conn=$db->conn;
            if(!empty($student_id) && !empty($academic_year)){
            $sql = "SELECT * FROM `fee_transactions` WHERE `student_id`='$student_id' AND `ay`='$academic_year' ORDER BY id DESC";
            $result = mysqli_query($conn,$sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_object();
                $student_account = $row;
            } else {
                $student_account = null;
            }
            return $student_account;
            }else{
                return null;
            }
        }

        /**
         * Function to Fetch the Fee Structure for the academic Year 
         * @param string class and string academic_year
         * @return object Fee Structure
         */
        static function getFeeStructure(string $class, string $academic_year){
            $db=new database();
            $conn=$db->conn;
            if(!empty($class) && !empty($academic_year)){
            $sql = "SELECT * FROM `fee_structure` WHERE `class`='$class' AND `academic_year`='$academic_year'";
            $result = mysqli_query($conn,$sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_object();
                $fee_structure = $row;
            } else {
                $fee_structure = null;
            }
            return $fee_structure;
            }else{
                return null;
            }
        }
        

}