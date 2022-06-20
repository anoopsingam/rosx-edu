<?php
require_once './views/header.php';
$app->setTitle("Marks Entry");
?>
<div class="card m-2">
    <div class="card-header">
        <span class="btn bg-gradient-info btn-lg">Marks Entry </span>
    </div>
    <div class="card-body">
        <form action="<?= func::href('/Academics/ViewList') ?>" method="post">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Select Test : </label>
                        <?= func::getTestList(); ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Select Class : </label>
                        <?= func::classlist("class_list"); ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Select Academic Year : </label>
                        <?= func::academicYear(); ?>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">View List</button>
        </form>
    </div>
</div>
<?php
require_once './views/footer.php';
?>