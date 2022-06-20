<?php
require_once './views/header.php';
$app->setTitle("Manage Test/Exams ");
?>
<div class="card m-2">
    <div class="card-header">
        <div class="row">
            <div class="col-md-3">
                <span class="btn bg-gradient-danger btn-lg">Manage Tests/Exams</span>
            </div>
            <div class="col-md-9 text-right ">
                <p align="right">
                    <button type="button" class="btn btn-primary m-3" data-bs-toggle="modal" data-bs-target="#modal-new-subjects-academics"><i class="fa fa-plus" aria-hidden="true"></i> Add </button>
                </p>
            </div>
            <div class="modal fade" id="modal-new-subjects-academics" tabindex="-1" role="dialog" aria-labelledby="modal-new-subjects-academics" aria-hidden="true">
                <div class="modal-dialog modal-dialog-top modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body p-0">
                            <div class="card card-plain">
                                <div class="card-header pb-0 text-left">
                                    <h3 class="font-weight-bolder text-info text-gradient">Add Subjects </h3>
                                </div>
                                <div class="card-body">
                                    <form action="/Academics/SubjectsController/new/<?= uniqid(); ?>" method="post">
                                        <?= set_csrf(); ?>
                                        <div class="row">
                                            <div class="col-sm">
                                                <label for="">Select Class : </label>
                                                <?= func::getAllClasses(); ?>
                                            </div>
                                            <div class="col-sm">
                                                <label for="">Select Test : </label>
                                                <?= func::getTestList(); ?>
                                            </div>
                                            <div class="col-sm">
                                                <label for="">Month : </label>
                                            </div>
                                        </div>
                                        <div class="form-group text-center">
                                            <button class="btn btn-primary mt-5" type="submit" name="submit">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">




    </div>
</div>
<?php
require_once './views/footer.php';
?>