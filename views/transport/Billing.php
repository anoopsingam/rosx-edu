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
        <button class="btn btn-primary">Transport Service Billing</button>
    </div>
    <div class="card-body">
    <form action="/Transport/Billing/Init/<?= uniqid()?>" method="post">
    <?= set_csrf();?>
     <div class="row">
         <div class="col-md-6">
         <label class="h3">Student Id </label><br>
                <?= func::studentList();?>
         </div>
         <div class="col-md-6">
             <label class="h4">Academic Year</label>
            <?= func::academicYear();?>

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