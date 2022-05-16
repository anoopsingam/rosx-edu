<?php
require_once './views/header.php';
$app->setTitle("Transport Billing");
?>
<script>
        $(function() {
          $('.chosen-select').chosen();
          $('.chosen-select-deselect').chosen({ allow_single_deselect: true });
        });
      </script>
<div class="card shadow-lg m-3">
    <div class="card-header">
        <button class="btn btn-primary">Bill Printing</button>
    </div>
    <div class="card-body">
    <form action="/Transport/Billing/BillPrint" method="post">
    <?= set_csrf();?>
    <h5 class="text-center text-danger">Please Provide Transaction Id of Same Student to Print.</h5>
     <div class="row">
         <div class="col-md-6">
         <label for="">Enter Transaction Id (Fee) : </label>
                <input type="text" name="fee_trans_id" class="form-control" placeholder="Enter Transaction Id">
         </div>
         <div class="col-md-6">
             <label for="">Enter Transaction Id (Transport) : </label>
             <input type="text" name="transport_trans_id" class="form-control" placeholder="Enter Transaction Id">
         </div>
     </div>
            <center>
                <button type="submit" name="add_new_transa" class="btn bg-gradient-primary btn-md rounded-2 m-4">Submit</button>
            </center>
        </form>
    </div>
</div>
<?php   
    require_once './views/footer.php';
?>