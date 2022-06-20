<?php

class func
{

    /**
     * @param string url route
     * returns the project server url with route
     */
    static function href($page)
    {
        echo ($page == null) ? url::myurl() . "#" : url::myurl() . $page;
    }

    /**
     * Function to display all the test 
     * @return html select 
     */
    static function getTestList(string $test_name = 'test_name', array $arrgs = [])
    {
        echo "<select name='$test_name' class='form-control'>";
        if (!empty($arrgs)) {
            foreach ($arrgs as $key => $value) {
                echo "<option value='$key'>$value</option>";
            }
        }
        echo '<option value="">Select Test</option>
            <option value="FA-1">FA-1</option>
            <option value="FA-2">FA-2</option>
            <option value="FA-3">FA-3</option>
            <option value="FA-4">FA-4</option>
            <option value="SA-1">SA-1</option>
            <option value="SA-2">SA-2</option>';
        echo "</select>";
    }

    /**
     * Function for Admission Type
     * @return html select
     */

    static function getAdmissionType(string $admission_type = 'admission_type', array $arrgs = [])
    {
        echo "<select name='admission_type' class='form-control'>";
        if (!empty($arrgs)) {
            foreach ($arrgs as $key => $value) {
                echo "<option value='$key'>$value</option>";
            }
        }
        echo '<option value="">Select Admission Type</option>
            <option value="PAID">PAID</option>
            <option value="FREE">FREE/SPONSORED</option>
            <option value="STAFF">STAFF</option>
            <option value="RTE">RTE</option>';
        echo "</select>";
    }


    /**
     * Function to fetch Class list
     * @param string form:name 
     * @param array class_list
     */
    static function classlist(String $name = 'present_class', array $args = array())
    {
        echo "<select class='form-control m-1' name='" . $name . "'>\n";
        echo "<option value=''>Select Class </option>\n";
        if ($args != null) {
            foreach ($args as $key => $value) {
                echo "<option value='$key' selected>$value</option>\n";
            }
        }
        echo "<option value='LKG'>LKG</option>\n";
        echo "<option value='UKG'>UKG</option>\n";
        echo "<option value='1'>1 Std</option>\n";
        echo "<option value='2'>2 Std</option>\n";
        echo "<option value='3'>3 Std</option>\n";
        echo "<option value='4'>4 Std</option>\n";
        echo "<option value='5'>5 Std</option>\n";
        echo "<option value='6'>6 Std</option>\n";
        echo "<option value='7'>7 Std</option>\n";
        echo "<option value='8'>8 Std</option>\n";
        echo "<option value='9'>9 Std</option>\n";
        echo "<option value='10'>10 Std</option>\n";
        echo "</select>";
    }
    static function academicYear(string $ay = "ay", array $args = array())
    {
        echo "<select class='form-control m-1' name='$ay'>\n";
        echo "<option value=''>Select Academic Year </option>\n";
        if ($args != null) {
            foreach ($args as $key => $value) {
                echo "<option value='$key' selected>$value</option>\n";
            }
        }
        echo "<option value='2020-2021'>2020-2021</option>\n";
        echo "<option value='2021-2022'>2021-2022</option>\n";
        echo "<option value='2022-2023' selected>2022-2023</option>\n";
        echo "<option value='2023-2024'>2023-2024</option>\n";
        echo "<option value='2024-2025'>2024-2025</option>\n";
        echo "<option value='2025-2026'>2025-2026</option>\n";
        echo "<option value='2026-2027'>2026-2027</option>\n";
        echo "<option value='2027-2028'>2027-2028</option>\n";
        echo "<option value='2028-2029'>2028-2029</option>\n";
        echo "<option value='2029-2030'>2029-2030</option>\n";
        echo "</select>";
    }
    static function sectionList(string $section, array $args = array())
    {
        echo "<select class='form-control m-1' name='$section'>\n";
        echo "<option value=''>Select Section </option>\n";
        if ($args != null) {
            foreach ($args as $key => $value) {
                echo "<option value='$key' selected>$value</option>\n";
            }
        }
        echo "<option value='A'>A</option>\n";
        echo "<option value='B'>B</option>\n";
        echo "<option value='C'>C</option>\n";
        echo "<option value='D'>D</option>\n";
        echo "<option value='E'>E</option>\n";
        echo "<option value='F'>F</option>\n";
        echo "<option value='G'>G</option>\n";
        echo "<option value='H'>H</option>\n";
        echo "<option value='I'>I</option>\n";
        echo "<option value='J'>J</option>\n";
        echo "<option value='K'>K</option>\n";
        echo "<option value='L'>L</option>\n";
        echo "</select>";
    }

    /**
     * Function to fetch new Student ID
     * @return string StudentId
     */
    static function getStudentId()
    {
        $db = new database();
        $conn = $db->conn;
        $app = new app();
        $sql = "SELECT max(studentid) as stud FROM `student_enrollment`";
        $result = mysqli_query($conn, $sql);
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
    static function getEnrollementNo()
    {
        $db = new database();
        $conn = $db->conn;
        $app = new app();
        $sql = "SELECT * FROM `student_enrollment` ORDER BY `id` DESC LIMIT 1";
        $result = mysqli_query($conn, $sql);
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
    static function getApplicationNo()
    {
        $db = new database();
        $conn = $db->conn;
        $app = new app();
        $sql = "SELECT * FROM `student_enrollment` ORDER BY `id` DESC LIMIT 1";
        $result = mysqli_query($conn, $sql);
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
    static function getStudentDetails(string $student_id = '', string $status = '')
    {
        $db = new database();
        $conn = $db->conn;
        if ($student_id != null) {
            $sql = "SELECT * FROM `student_enrollment` WHERE `studentid`='$student_id' OR `enrollment_no`='$student_id' OR `app_no`='$student_id'";
            if (!empty($status)) {
                $sql .= " AND `status`='$status'";
            }
            $result = mysqli_query($conn, $sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_object();
                $student_details = $row;
            } else {
                $student_details = null;
            }
            return $student_details;
        } else {
            return null;
        }
    }


    /**
     *
     * Function to fecth all admin users from database
     *@return html SelectList 
     * 
     */
    static function adminList(string $name = "users")
    {
        $db = new database();
        $conn = $db->conn;
        $result = mysqli_query($conn, "SELECT * FROM `users` WHERE `user_type`='ADMIN'");
        if ($result->num_rows > 0) {
            echo "<select class='form-control m-1' name='$name'>\n";
            echo "<option value=''>Select User </option>\n";
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['username'] . "'>" . $row['name'] . "</option>\n";
            }
            echo "</select>";
        }
    }

    /**
     * Function for student Select List
     * @return html SelectList
     */
    static function studentList()
    {
        $db = new database();
        $conn = $db->conn;
        $result = mysqli_query($conn, "SELECT * FROM `student_enrollment` WHERE status='APPROVED' ORDER BY `student_name` ASC");
        if ($result->num_rows > 0) {
            echo ' <select data-placeholder="Select Student ID" name="studentid" class="chosen-select-deselect" tabindex="7">
                    <option value=""></option>';
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['studentid'] . "'>" . $row['student_name'] . " [" . $row['present_class'] . "-" . $row['present_section'] . "]</option>\n";
            }
            echo "</select>";
        }
    }

    /**
     *  Function for Student Account Data 
     *@param string studentid and string academic_year
     *@return Account Details in Object
     */
    static function studentAccountData(string $studentid, string $academic_year)
    {
        $db = new database();
        $conn = $db->conn;
        if (!empty($studentid) && !empty($academic_year)) {
            $result = mysqli_query($conn, "SELECT * FROM `account` WHERE `student_id`='$studentid' AND `acdy`='$academic_year'");
            if ($result->num_rows > 0) {
                $row = $result->fetch_object();
                $student_account = $row;
            } else {
                $student_account = null;
            }
            return $student_account;
        } else {
            return null;
        }
    }

    /**
     * Function to fetch Student Last Payment Details
     * @param string $studentid and string $academic_year
     * @return object Student Payment Details
     */
    static function LastPaymentInfo(string $student_id = '', string $academic_year = '')
    {
        $db = new database();
        $conn = $db->conn;
        if (!empty($student_id) && !empty($academic_year)) {
            $sql = "SELECT * FROM `fee_transactions` WHERE `student_id`='$student_id' AND `ay`='$academic_year' ORDER BY id DESC";
            $result = mysqli_query($conn, $sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_object();
                $student_account = $row;
            } else {
                $student_account = null;
            }
            return $student_account;
        } else {
            return null;
        }
    }

    /**
     * Function to fetch fee_transactions Details
     * @param string $transaction_id
     * @return array
     */
    static function getFeeTransactionDetails(string $transaction_id = '')
    {
        $db = new database();
        $conn = $db->conn;
        if (!empty($transaction_id)) {
            $sql = "SELECT `fee_transactions`.*, `student_enrollment`.* FROM `fee_transactions` 
            LEFT JOIN `student_enrollment` ON `fee_transactions`.`student_id` = `student_enrollment`.`studentid`
             WHERE `fee_transactions`.`tid` ='$transaction_id'";
            $result = mysqli_query($conn, $sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $student_account = $row;
            } else {
                $student_account = null;
            }
            return $student_account;
        } else {
            return null;
        }
    }

    /**
     * Function to Fetch the Fee Structure for the academic Year 
     * @param string class and string academic_year
     * @return object Fee Structure
     */
    static function getFeeStructure(string $class, string $academic_year)
    {
        $db = new database();
        $conn = $db->conn;
        if (!empty($class) && !empty($academic_year)) {
            $sql = "SELECT * FROM `fee_structure` WHERE `class`='$class' AND `academic_year`='$academic_year'";
            $result = mysqli_query($conn, $sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_object();
                $fee_structure = $row;
            } else {
                $fee_structure = null;
            }
            return $fee_structure;
        } else {
            return null;
        }
    }


    /**
     *  Function to Fetch the count of students in a class in Approved Status
     */
    static function getStudentCount(string $class, string $academic_year)
    {
        $db = new database();
        $conn = $db->conn;
        if (!empty($class) && !empty($academic_year)) {
            $sql = "SELECT COUNT(studentid) as total  FROM `student_enrollment` WHERE `present_class`='$class' AND `status`='APPROVED'";
            $result = mysqli_query($conn, $sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_object();
                $student_count = $row->total;
            } else {
                $student_count = 0;
            }
            return $student_count;
        } else {
            return 0;
        }
    }

    /**
     * Function to convert the given integer value to indian money format.
     */
    static function FormatMoney($amount)
    {
        return preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $amount);
    }

    /**
     * Function to create a dropdown of all Ho Accounts in Select Menu
     * 
     */
    static function HoAccountList(array $args = [])
    {
        $db = new database();
        $conn = $db->conn;
        $result = mysqli_query($conn, "SELECT * FROM `head_accounts` ORDER BY `ho_name` ASC ");
        echo ' <select  name="ho_id" class="form-control" >
            <option value="">Select Ho Account</option>';
        if (!empty($args)) {
            echo "<option value='" . $args['id'] . "' selected>" . $args['ho_name'] . "</option>\n";
        }
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['id'] . "'>" . $row['ho_name'] . "</option>\n";
            }
        }
        echo "</select>";
    }

    /**
     * Function to Create a dropdown for all payee accounts in select menu
     */
    static function PayeeAccountList(array $args = [])
    {
        $db = new database();
        $conn = $db->conn;
        $result = mysqli_query($conn, "SELECT * FROM `payee_details` ORDER BY `payee_name` ASC ");
        echo ' <select  name="payee__id" class="form-control" >
            <option value="">Select Payee Account</option>';
        if (!empty($args)) {
            echo "<option value='" . $args['payee_id'] . "' selected>" . $args['payee_name'] . "</option>\n";
        }
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['payee_id'] . "'>" . $row['payee_name'] . "</option>\n";
            }
        }
        echo "</select>";
    }
    /**
     * Get the Payee Details for the given Payee ID
     * @param string $payee_id
     * @return object Payee Details
     */
    static function getPayeeDetails(string $payee_id)
    {
        $db = new database();
        $conn = $db->conn;
        if (!empty($payee_id)) {
            $sql = "SELECT * FROM `payee_details` WHERE `payee_id`='$payee_id'";
            $result = mysqli_query($conn, $sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_object();
                $payee_details = $row;
            } else {
                $payee_details = null;
            }
            return $payee_details;
        } else {
            return null;
        }
    }
    /**
     * Get the Head Account Details for the given Head Account ID
     */
    static function getHeadAccountDetails(string $ho_id)
    {
        $db = new database();
        $conn = $db->conn;
        if (!empty($ho_id)) {
            $sql = "SELECT * FROM `head_accounts` WHERE `id`='$ho_id'";
            $result = mysqli_query($conn, $sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_object();
                $head_account_details = $row;
            } else {
                $head_account_details = null;
            }
            return $head_account_details;
        } else {
            return null;
        }
    }
    /**
     * Function to return totoal no of students in school
     */
    static function getTotalStudents()
    {
        $db = new database();
        $conn = $db->conn;
        $sql = "SELECT COUNT(studentid) as total  FROM `student_enrollment` WHERE status='APPROVED'";
        $result = mysqli_query($conn, $sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_object();
            $total_students = $row->total;
        } else {
            $total_students = 0;
        }
        return $total_students;
    }
    /**
     * Function to return total no of students based on gender
     */
    static function getStudentCountGender(string $gender = '')
    {
        $db = new database();
        $conn = $db->conn;
        $sql = "SELECT COUNT(studentid) as total  FROM `student_enrollment` WHERE gender='$gender' AND status='APPROVED' ";
        $result = mysqli_query($conn, $sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_object();
            $total_students = $row->total;
        } else {
            $total_students = 0;
        }
        return $total_students;
    }
    /**
     * Funtion to fetch total no of students absent today
     */
    static function getTotalAbsentToday()
    {
        $db = new database();
        $conn = $db->conn;
        $sql = "SELECT COUNT(reg_no) as total  FROM `student_attendance` WHERE `attendance_date`=CURDATE() AND `attendance`='ABSENT'";
        $result = mysqli_query($conn, $sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_object();
            $total_absent = $row->total;
        } else {
            $total_absent = 0;
        }
        return $total_absent;
    }

    /**
     * Function for all Bus Details 
     * @return html Select 
     */
    static function getBusList(array $args = [])
    {
        $db = new database();
        $conn = $db->conn;
        $result = mysqli_query($conn, "SELECT * FROM `transport_bus` ORDER BY `bus_name` ASC ");
        echo ' <select  name="route_bus_id" class="form-control" >
            <option value="">Select Bus</option>';
        if (!empty($args)) {
            echo "<option value='" . $args['db_id'] . "' selected>" . $args['bus_name'] . "</option>\n";
        }
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['db_id'] . "'>" . $row['bus_reg_no'] . " [" . $row['bus_name'] . "]</option>\n";
            }
        }
        echo "</select>";
    }

    /**
     * Function to Fetch all Routes
     * @return Html Select
     */
    static function getRouteList(array $args = [])
    {
        $db = new database();
        $conn = $db->conn;
        $result = mysqli_query($conn, "SELECT * FROM `transport_routes` ORDER BY `route_name` ASC ");
        echo ' <select  name="stage_route_id" class="form-control" >
            <option value="">Select Route</option>';
        if (!empty($args)) {
            echo "<option value='" . $args['route_id'] . "' selected>" . $args['route_name'] . "</option>\n";
        }
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['route_id'] . "'>" . $row['route_name'] . "</option>\n";
            }
        }
        echo "</select>";
    }

    static function getStageDetails(array $args = [])
    {
        $db = new database();
        $conn = $db->conn;
        $result = mysqli_query($conn, "SELECT * FROM transport_stages s, transport_routes t, transport_bus b WHERE s.stage_route_id=t.route_id AND t.route_bus_id=b.db_id ORDER BY t.route_name,s.route_stage_name ASC ");
        echo ' <select  name="stage_id" class="form-control" >
            <option value="">Select Stage</option>';
        if (!empty($args)) {
            echo "<option value='" . $args['stage_id'] . "' selected>" . $args['stage_name'] . "</option>\n";
        }
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['route_stage_id'] . "'>" . $row['route_stage_name'] . "- ₹" . $row['route_stage_fare'] . " [" . $row['route_name'] . "/ " . $row['bus_reg_no'] . "] </option>\n";
            }
        }
        echo "</select>";
    }


    /**
     * Function for Fetching Transport Transaction Details
     * @return JSON
     */
    static function getTransportTransactionDetails(string $transaction_id = '')
    {
        $db = new database();
        $conn = $db->conn;
        if (empty($transaction_id)) {
            return $transaction_details = null;
        } else {
            $sql = "SELECT * FROM `transport_transaction` 
                LEFT JOIN `student_enrollment` ON `transport_transaction`.`trans_student_id` = `student_enrollment`.`studentid`
                    WHERE `transport_transaction`.`trans_gen_id` = '$transaction_id' ";
            $result = mysqli_query($conn, $sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $transaction_details = $row;
            } else {
                $transaction_details = null;
            }
        }
        return $transaction_details;
    }

    /**
     * Function for Fetching unified Transport Transaction and transort Account details
     * @return
     */
    static function UnifiedTransportTransInfo(string $transaction_id = '')
    {
        $db = new database();
        $conn = $db->conn;
        if (empty($transaction_id)) {
            return $transaction_details = null;
        } else {
            $sql = "SELECT * FROM transport_transaction tr, transport_account ac, transport_enroll en, transport_stages st ,transport_routes rt
            WHERE en.enroll_student_id=tr.trans_student_id AND ac.acc_student_id=tr.trans_student_id AND ac.acc_academic_year=en.enroll_academic_year 
            AND st.route_stage_id=en.enroll_stage_id AND st.stage_route_id=rt.route_id  AND tr.trans_gen_id='$transaction_id' ";
            $result = mysqli_query($conn, $sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $transaction_details = $row;
            } else {
                $transaction_details = null;
            }
        }
        return $transaction_details;
    }

    /**
     * Function to Fetch Transport Account Details
     * @return JSON
     */
    static function getTransAccountDetails(string $student_id = '', string $ay = '')
    {
        $db = new database();
        $conn = $db->conn;
        if (empty($student_id) || empty($ay)) {
            return $transaction_details = null;
        } else {
            $sql = "SELECT * FROM `transport_account` WHERE `acc_student_id`='$student_id' AND `acc_academic_year`='$ay'";
            $result = mysqli_query($conn, $sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_object();
                $transaction_details = $row;
            } else {
                $transaction_details = null;
            }
        }
        return $transaction_details;
    }


    /**
     * Function to check user Access
     * @return boolean 
     */
    static function CheckAccess2($user_id, $page_name)
    {
        $db = new database();
        $conn = $db->conn;
        $sql = mysqli_query($conn, "SELECT * FROM users where id='$user_id'");
        $row = mysqli_fetch_assoc($sql);
        $v = json_decode($row['accesss']);
        if ($v->$page_name == "access") {
            return true;
        } else {
            return false;
        }
    }
    static function CheckAccess($user_id, $page_name)
    {
        $db = new database();
        $conn = $db->conn;
        $sql = mysqli_query($conn, "SELECT * FROM users where id='$user_id'");
        $row = mysqli_fetch_assoc($sql);
        $v = json_decode($row['accesss']);
        if ($v->$page_name == "access") {
            return true;
        } else {
            js::alert('You are not allowed to access this page.');
            js::redirect(func::href("/Dashboard"));
        }
    }

    /**
     * Function for Student Datalist Search
     * @return HTML Datalist
     */
    static function EnrollTransportSearch()
    {
        $db = new database();
        $conn = $db->conn;
        $result = mysqli_query($conn, "SELECT * FROM `student_enrollment` WHERE `status`='APPROVED' ORDER BY `student_name` ASC");
        echo ' <datalist id="student_list">';
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['studentid'] . "'>" . $row['student_name'] . " [" . $row['present_class'] . "-" . $row['present_section'] . "]</option>\n";
            }
        }
        echo "</datalist>";
    }

    /**
     * Function for all Route List
     * @return route select list
     */
    static function getRouteListApi(string $id_name = 'route_id', string $event = 'GetStages()')
    {
        $db = new database();
        $conn = $db->conn;
        $result = mysqli_query($conn, "SELECT * FROM `transport_routes` ORDER BY `route_name` ASC ");
        echo ' <select  id="' . $id_name . '" onchange="' . $event . '"  class="form-control" >
        <option value="">Select Route</option>';
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['route_id'] . "'>" . $row['route_name'] . "</option>\n";
            }
        }
        echo "</select>";
    }


    public static function convert_number($number)
    {
        $decimal = round($number - ($no = floor($number)), 2) * 100;
        $hundred = null;
        $digits_length = strlen($no);
        $i = 0;
        $str = array();
        $words = array(
            0 => '', 1 => 'One', 2 => 'Two',
            3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
            7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
            10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
            13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
            16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
            19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
            40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
            70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety'
        );
        $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
        while ($i < $digits_length) {
            $divider = ($i == 2) ? 10 : 100;
            $number = floor($no % $divider);
            $no = floor($no / $divider);
            $i += $divider == 10 ? 1 : 2;
            if ($number) {
                $plural = (($counter = count($str)) && $number > 9) ? null : null;
                $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                $str[] = ($number < 21) ? $words[$number] . ' ' . $digits[$counter] . $plural . ' ' . $hundred : $words[floor($number / 10) * 10] . ' ' . $words[$number % 10] . ' ' . $digits[$counter] . $plural . ' ' . $hundred;
            } else $str[] = null;
        }
        $Rupees = implode('', array_reverse($str));
        $paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
        return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise;
    }



    public static function getAllClasses(string $name = 'test_class')
    {
        $db = new database();
        $conn = $db->conn;
        $result = mysqli_query($conn, "SELECT * FROM `academic_subjects_info` ORDER BY `acd_class` ASC ");
        echo ' <select  id="class_id" name="' . $name . '"  class="form-control" >
        <option value="">Select Class</option>';
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['acd_id'] . "'>" . $row['acd_class'] . "</option>\n";
            }
        }
        echo "</select>";
    }


    public function getAcdDetails($id)
    {
        $db = new database();
        $conn = $db->conn;
        if (!empty($id)) {
            $result = mysqli_query($conn, "SELECT * FROM `academic_subjects_info` WHERE `acd_id`='$id' ");
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return $row;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function getMarksEntryDetails(string $student_id = '', string $test, string $academic_year = '')
    {
        $db = new database();
        $conn = $db->conn;
        if (!empty($student_id) && !empty($test) && !empty($academic_year)) {
            $result = mysqli_query($conn, "SELECT * FROM `academics_marks` WHERE `res_student_id`='$student_id' AND `res_test`='$test' AND `res_ay`='$academic_year' ");
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return $row;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }


    public static function getSubjects(string $class)
    {
        $db = new database();
        $conn = $db->conn;
        if (!empty($class)) {
            $result = mysqli_query($conn, "SELECT * FROM `academic_subjects_info` WHERE `acd_class`='$class' ");
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return $row;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }


    public static function TodaysAttendance(string $class, string $attendace)
    {
        $db = new database();
        $result = mysqli_query($db->conn, "SELECT COUNT(reg_no) as total FROM `student_attendance` WHERE attendance_date='" . date('Y-m-d') . "' AND student_class='$class' AND attendance='$attendace'");
        if ($result->num_rows > 0) {
            $data = '';
            while ($row = $result->fetch_assoc()) {
                $data = $row['total'];
            }
            return $data;
        } else {
            return 0;
        }
    }


    public static function getTodaysFeeCollection(string $type = '')
    {
        $db = new database();
        $sql = '';
        switch ($type) {
            case 'tuition':
                $sql = "SELECT SUM(paid_amount) AS fee_collected FROM fee_transactions WHERE billing_date=CURDATE()";
                break;
            case 'transport':
                $sql = "SELECT SUM(trans_paid_amount) AS fee_collected FROM transport_transaction WHERE trans_date=CURDATE()";
                break;
            case 'ubs':
                $sql = "SELECT SUM(total_amount) AS fee_collected FROM general_invoice WHERE invoice_date=CURDATE()";
                break;
            default:
                $sql = "SELECT SUM(paid_amount) AS fee_collected FROM fee_transactions WHERE billing_date=CURDATE()";
                break;
        }
        $result = mysqli_query($db->conn, $sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['fee_collected'];
        } else {
            return 0;
        }
    }

    public static function getTotalStudentsByGenderClass(string $class, string $gender)
    {
        $db = new database();
        if (!empty($class) && !empty($gender)) {
            $exec_query = mysqli_query($db->conn, "SELECT COUNT(studentid) as total FROM student_enrollment WHERE gender='$gender' AND present_class='$class' AND status='APPROVED' ");
            if ($exec_query->num_rows > 0) {
                $row = $exec_query->fetch_assoc();
                return $row['total'];
            } else {
                return 0;
            }
        }
    }


    public static function searchStudent(string $str)
    {
        $db = new database();
        $sql = "SELECT * FROM student_enrollment WHERE CONCAT(studentid,student_name,father_number,enrollment_no,app_no) LIKE '%$str%' ";
        $result = mysqli_query($db->conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
?>
                <div class="card m-3 bg-gradient-dark text-light">
                    <div class="card-header bg-gradient-dark ">
                        <div class="row">
                            <div class="col-md-6">
                                <b class="card-title"><?php echo $row['student_name']; ?></b>
                            </div>
                            <div class="col-md-6">
                                <b class="card-title"><?php echo $row['studentid']; ?></b>
                            </div>
                        </div>
                    </div>
                    <div class="card-body text-light ">
                        <div class="row">
                            <div class="col-sm">
                                <b>Father name : </b> <?php echo $row['father_name']; ?>
                            </div>
                            <div class="col-sm">
                                <b>Mother name : </b> <?php echo $row['mother_name']; ?>
                            </div>
                            <div class="col-sm">
                                <b>Guardian Name : </b> <?php echo $row['guardian_name']; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm">
                                <b>Father number : </b> <?php echo $row['father_number']; ?>
                            </div>
                            <div class="col-sm">
                                <b>Mother number : </b> <?php echo $row['mother_number']; ?>
                            </div>
                            <div class="col-sm">
                                <b> Present Class -Section : </b> <?php echo $row['present_class'] . '-' . $row['present_section']; ?>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <div class="row">
                            <div class="col-sm">
                                <a onclick="window.open('<?= func::href('/Admission/View/' . encrypt($row['enrollment_no'])); ?>','popup','width=1000,height=1000');" class="btn bg-gradient-success btn-md">View <i class="fa fa-eye" aria-hidden="true"></i></a>
                            </div>
                            <div class="col-sm">
                                <a onclick="window.open('<?= func::href('/Admission/Edit/' . encrypt($row['enrollment_no'])); ?>','popup','width=1000,height=1000');" class="btn bg-gradient-warning btn-md">Edit <i class="fa fa-pencil-square" aria-hidden="true"></i></a>

                            </div>
                        </div>
                    </div>
                </div>
<?php
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Particular not found']);
        }
    }
}
