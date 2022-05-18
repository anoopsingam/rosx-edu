<?php 
if(isset($_POST['route_id'])){
    require '././config.php';
    $db=new database();
    $id =mysqli_real_escape_string($db->conn,$_POST['route_id']);
    $sql = "SELECT * FROM transport_stages WHERE stage_route_id  = '$id'";
    $result = mysqli_query($db->conn,$sql);
    if(mysqli_num_rows($result)>0){
       echo "<select class='form-control' name='stage_id' id='stage_id'>";
       echo"<option value=''>Select Stage</option>";
        while($row = mysqli_fetch_assoc($result)){
            echo "<option value='".$row['route_stage_id']."'>".$row['route_stage_name']." [".$row['route_stage_fare']."]</option>";
        }
        echo "</select>";
    }else{
        echo "<select class='form-control' name='stage_id' id='stage_id'>
        <option value='' disable selected>No Stage</option>
        </select>";
    }
}