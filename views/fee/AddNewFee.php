<?php
require_once './views/header.php';
$app->setTitle("Add Fee Structure");
?>
<div class="card shadow-lg m-3">
    <div class="card-header">
        <button class="btn btn-primary">Add Fee Structure</button>
    </div>
    <div class="card-body">
    <form action="/FeeStructureController/new/<?= uniqid()?>" method="post">
    <?= set_csrf();?>
    <div class="row">
                <div class="col-sm">
                    <label for="">Class : </label>
                    <?=func::classlist("class");?>
                </div>
                <div class="col-sm">
                    <label for="">Academic Year</label>
                <?= func::academicYear("academic_year")?>
                </div>
                <div class="col-sm">
                    <label for="tution_fee">Tution Fee : </label><input class="form-control" type="number" name="tution_fee" id="tution_fee" />
                </div>
            </div>
            <div class="row" hidden>
                <div class="col-sm">
                    <label for="token_id">Token Id : </label><input class="form-control" readonly value="<?= uniqid()?>" type="text" name="token_id" id="token_id" />
                    <br class="clear" />
                </div>
            </div>
            <center>
                <button type="submit" name="sub_fee" class="btn bg-gradient-warning btn-md rounded-2 m-4">Add Fee</button>
            </center>
        </form>
    </div>
</div>
<?php   
    require_once './views/footer.php';
?>