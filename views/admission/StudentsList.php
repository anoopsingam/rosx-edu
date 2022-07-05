<?php
require '././config.php';
$app = new app();
$db = new database();
$class = decrypt($class);

if (isset($class)  && !empty($class)) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?= $app->setTitle("Student List $class ") ?>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Sora:wght@300;400;500;600;700;800&display=swap');

            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: 'Sora', sans-serif;
            }

            @page {
                size: landscape;
            }

            hr {
                border: 1px solid #000;
                width: 100%;
                margin-bottom: 10px;
            }
        </style>
    </head>

    <body>
    <?= includes::Datatables(" Admission Data of $class ", '0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16', 'landscape'); ?>
        <div class="container-fluid ">
            <table class="table table-borderless text-center">
                <tr>
                    <td>
                        <?= $app->SetLogo('120', '120'); ?>
                    </td>
                    <td>
                        <h3 class="display-5 font-weigth-bolder text-uppercase"><?= $app->name; ?> </h3>
                        <h6 class=""><?= $app->address; ?> </h6>
                        <h6 class=""><?= 'Contact No : ' . $app->phone . '   Email : ' . $app->email; ?> </h6>
                        <h4 class="m-3 text-uppercase">Students List of Class <?= $class?> </h4>
                    </td>
                    <td>
                        <img src="../../web_assets/transperent.png" height="110" width="160" alt="">
                        <p>Powered by RosX Edu Soft </p>
                    </td>
                </tr>
            </table>
            <hr>
            <div class="table-responsive">
            <table id="example" class="display table table-striped ">
                <thead>
                    <th>Sl No.</th>
                    <th>Admission No.</th>
                    <th>Admission Type</th>
                    <th>Class-Sec</th>
                    <th>Student Name</th>
                    <th>Father Name</th>
                    <th>Mother Name</th>
                    <th>D.O.B.</th>
                    <th>Address</th>
                    <th>Mobile No.</th>
                    <th>Academic Year</th>
                    <th>Religion</th>
                    <th>Caste</th>
                    <th>Amission Date</th>
                    <th>Sats No.</th>
                    <th>Student Id</th>
                    <th>Application No.</th>
                </thead>
                <tbody>
                    <?php 
                    
                   $str=mysqli_query($db->conn,"SELECT * FROM `student_enrollment` WHERE `present_class`='$class' AND `status`='APPROVED' ORDER BY student_name ASC");
                   if(mysqli_num_rows($str)>0){
                    $i=0;
                        while($row=mysqli_fetch_assoc($str)){
                            echo '<tr>';
                            echo '<td>'.++$i.'</td>';
                            echo '<td>'.$row['admission_no'].'</td>';
                            echo '<td>'.$row['admission_type'].'</td>';
                            echo '<td>'.$row['present_class'].' - '.$row['present_section'].'</td>';
                            echo '<td>'.$row['student_name'].'</td>';
                            echo '<td>'.$row['father_name'].'</td>';
                            echo '<td>'.$row['mother_name'].'</td>';
                            echo '<td>'.$row['dob'].'</td>';
                            echo '<td>'.$row['permanentaddress'].'</td>';
                            echo '<td>'.$row['father_number'].'</td>';
                            echo '<td>'.$row['academic_year'].'</td>';
                            echo '<td>'.$row['religion'].'</td>';
                            echo '<td>'.$row['caste'].'</td>';
                            echo '<td>'.$row['enroll_time'].'</td>';
                            echo '<td>'.$row['sts_no'].'</td>';
                            echo '<td>'.$row['studentid'].'</td>';
                            echo '<td>'.$row['app_no'].'</td>';
                            echo '</tr>';
                        }
                   }else{
                    echo "<tr><td colspan='12' class='text-center'>No Data Found for class $class </td></tr>";
                   }
                    
                    
                    ?>
                </tbody>
            </table>
            </div>
        </div>

    </body>

    </html>
<?php
} else {
    echo "<h1>Please Enter Valid Class to fetch details </h1>";
}
?>