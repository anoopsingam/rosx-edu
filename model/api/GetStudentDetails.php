<?php 
if(isset($_POST['string'])){
    require '././config.php';
    $db=new database();
    $string =mysqli_real_escape_string($db->conn,$_POST['string']);
    $sql = "SELECT * FROM student_enrollment WHERE CONCAT(studentid,student_name,father_number,mother_number,enrollment_no,app_no) LIKE '%$string%'";
    $result = mysqli_query($db->conn,$sql);
    if(mysqli_num_rows($result)>0){
       while($row = mysqli_fetch_assoc($result)){
           $data[] = $row;
         }
        echo json_encode(['status'=>'success','data'=>$data]);
    }else{
        echo json_encode(['status'=>'error','message'=>'Particular not found']);
    }
}