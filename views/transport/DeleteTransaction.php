<?php
require_once './views/header.php';
$app->setTitle("Delete Transport Transaction");
?>
<div class="card shadow-lg m-3">
    <div class="card-header">
        <button class="btn btn-primary">Bill Printing</button>
    </div>
    <div class="card-body">
    <form action="" method="post">
    <?= set_csrf();?>
    <h5 class="text-center text-danger">Please Provide Transaction Id </h5>
     <div class="row">
         <div class="col-md-4">
    
         </div>
         <div class="col-md-4">
             <label for="">Enter Transaction Id (Transport) : </label>
             <input type="text" name="transport_trans_id" class="form-control" placeholder="Enter Transaction Id">
         </div>
         <div class="col-md-4">
    
    </div>
     </div>
            <center>
                <button type="submit" name="del_init" class="btn bg-gradient-primary btn-md rounded-2 m-4">Submit</button>
            </center>
        </form>
    </div>
</div>
<?php 
if(isset($_POST['del_init'])){
    $transport_trans_id=$_POST['transport_trans_id'];
    if(!empty($transport_trans_id)){

    }else{
        js::alert("Please Transaction Id to Delete !!");
    }
}
?>

<?php   
    require_once './views/footer.php';
?>