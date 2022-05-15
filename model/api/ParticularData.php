<?php 
if(isset($_POST['id'])){
    require '././config.php';
    $db=new database();
    $id =mysqli_real_escape_string($db->conn,$_POST['id']);
    $sql = "SELECT * FROM billing_particulars WHERE billing_particular_id  = '$id'";
    $result = mysqli_query($db->conn,$sql);
    if(mysqli_num_rows($result)>0){
        $row = mysqli_fetch_assoc($result);
        echo json_encode(['status'=>'success','data'=>$row]);
    }else{
        echo json_encode(['status'=>'error','message'=>'Particular not found']);
    }
}