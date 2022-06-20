<?php
require_once './views/header.php';
$app->setTitle("Manage Subjects");
?>
<div class="card m-2">
    <div class="card-header">
        <div class="row">
            <div class="col-md-3">
                <span class="btn bg-gradient-danger btn-lg">Manage Subjects</span>
            </div>
            <div class="col-md-9 text-right ">
                <p align="right">
                    <button type="button" class="btn btn-primary m-3" data-bs-toggle="modal" data-bs-target="#modal-new-subjects-academics"><i class="fa fa-plus" aria-hidden="true"></i> Add </button>
                </p>
            </div>
        </div>
    </div>
    <div class="card-body">
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
                                    <div class="row mb-3">
                                        <div class="col-sm">
                                            <label for="acd_id">Acd Id : </label><input readonly value="<?= rand(10000, 999999) ?>" class="form-control" type="text" name="acd_id" id="acd_id" />
                                        </div>
                                        <div class="col-sm">
                                            <label for="acd_class">Select Class : </label>
                                            <?= func::classlist("acd_class"); ?>
                                        </div>
                                        <div class="col-sm">
                                            <label for="acd_ay">Academic Year : </label>
                                            <?= func::academicYear("acd_ay") ?>
                                        </div>
                                    </div>
                                    <h4 class="mt-4">
                                        Subject :
                                    </h4>
                                    <div class="row mb-3">
                                        <div class="col-sm">
                                            <label for="acd_sub1">Subject 1 : </label><input class="form-control" type="text" name="acd_sub1" id="acd_sub1" />
                                        </div>
                                        <div class="col-sm">
                                            <label for="acd_sub2">Subject 2 : </label><input class="form-control" type="text" name="acd_sub2" id="acd_sub2" />
                                        </div>
                                        <div class="col-sm">
                                            <label for="acd_sub3">Subject 3 : </label><input class="form-control" type="text" name="acd_sub3" id="acd_sub3" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm">
                                            <label for="acd_sub4">Subject 4 : </label><input class="form-control" type="text" name="acd_sub4" id="acd_sub4" />
                                        </div>
                                        <div class="col-sm">
                                            <label for="acd_sub5">Subject 5 : </label><input class="form-control" type="text" name="acd_sub5" id="acd_sub5" />
                                        </div>
                                        <div class="col-sm">
                                            <label for="acd_sub6">Subject 6 : </label><input class="form-control" type="text" name="acd_sub6" id="acd_sub6" />
                                        </div>
                                        <div class="col-sm">
                                            <label for="acd_sub7">Subject 7 : </label><input class="form-control" type="text" name="acd_sub7" id="acd_sub7" />
                                        </div>
                                    </div>
                                    <h4>
                                        Monthly Test (FA) Max Marks :
                                    </h4>
                                    <div class="row mt-1 mb-3">
                                        <div class="col-sm">
                                            <label for="subject1_m_max">Subject 1 Max : </label><input class="form-control" type="number" name="subject1_m_max" id="subject1_m_max" />
                                        </div>
                                        <div class="col-sm">
                                            <label for="subject2_m_max">Subject 2 Max : </label><input class="form-control" type="number" name="subject2_m_max" id="subject2_m_max" />
                                        </div>
                                        <div class="col-sm">
                                            <label for="subject3_m_max">Subject 3 Max : </label><input class="form-control" type="number" name="subject3_m_max" id="subject3_m_max" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm">
                                            <label for="subject4_m_max">Subject 4 Max : </label><input class="form-control" type="number" name="subject4_m_max" id="subject4_m_max" />
                                        </div>
                                        <div class="col-sm">
                                            <label for="subject5_m_max">Subject 5 Max : </label><input class="form-control" type="number" name="subject5_m_max" id="subject5_m_max" />
                                        </div>
                                        <div class="col-sm">
                                            <label for="subject6_m_max">Subject 6 Max : </label><input class="form-control" type="number" name="subject6_m_max" id="subject6_m_max" />
                                        </div>
                                        <div class="col-sm">
                                            <label for="subject7_m_max">Subject 7 Max : </label><input class="form-control" type="number" name="subject7_m_max" id="subject7_m_max" />
                                        </div>
                                    </div>
                                    <h4>
                                        Semester End Exam (SA) Max Marks :
                                    </h4>
                                    <div class="row mb-3 mt-1">
                                        <div class="col-sm">
                                            <label for="subject1_e_max">Subject 1 Max : </label><input class="form-control" type="number" name="subject1_e_max" id="subject1_e_max" />
                                        </div>
                                        <div class="col-sm">
                                            <label for="subject2_e_max">Subject 2 Max : </label><input class="form-control" type="number" name="subject2_e_max" id="subject2_e_max" />
                                        </div>
                                        <div class="col-sm">
                                            <label for="subject3_e_max">Subject 3 Max : </label><input class="form-control" type="number" name="subject3_e_max" id="subject3_e_max" />
                                        </div>
                                    </div>

                                    <div class="row mb-0">
                                        <div class="col-sm">
                                            <label for="subject4_e_max">Subject 4 Max : </label><input class="form-control" type="number" name="subject4_e_max" id="subject4_e_max" />
                                        </div>
                                        <div class="col-sm">
                                            <label for="subject5_e_max">Subject 5 Max : </label><input class="form-control" type="number" name="subject5_e_max" id="subject5_e_max" />
                                        </div>
                                        <div class="col-sm">
                                            <label for="subject6_e_max">Subject 6 Max : </label><input class="form-control" type="number" name="subject6_e_max" id="subject6_e_max" />
                                        </div>
                                        <div class="col-sm">
                                            <label for="subject7_e_max">Subject 7 Max : </label><input class="form-control" type="number" name="subject7_e_max" id="subject7_e_max" />
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
        <?php
        $sql = 'SELECT * FROM `academic_subjects_info` ORDER BY acd_class ASC';
        $result = mysqli_query($db->conn, $sql);
        ?>
        <?= includes::Datatables('Subjects Info', '0,1,2,3,4,5,6,7,8,9', 'landscape'); ?>
        <div class="table-responsive">
        <table id="example" class="table display table-responsive-xl" style="width:100%">
            <thead>
                <tr class="bg-dark text-light">
                    <th>Acd Id </th>
                    <th>Class</th>
                    <th>Academic Year</th>
                    <th>Subject 1 </th>
                    <th>Subject 2 </th>
                    <th>Subject 3 </th>
                    <th>Subject 4 </th>
                    <th>Subject 5 </th>
                    <th>Subject 6 </th>
                    <th>Subject 7 </th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody style="font-size:small;">
                <?php
                while ($data = $result->fetch_object()) {
                ?>
                    <tr>
                        <td><?= $data->acd_id; ?></td>
                        <td><?= $data->acd_class; ?></td>
                        <td><?= $data->acd_ay; ?></td>
                        <td><?= $data->acd_sub1; ?></td>
                        <td><?= $data->acd_sub2; ?></td>
                        <td><?= $data->acd_sub3; ?></td>
                        <td><?= $data->acd_sub4; ?></td>
                        <td><?= $data->acd_sub5; ?></td>
                        <td><?= $data->acd_sub6; ?></td>
                        <td><?= $data->acd_sub7; ?></td>
                        <td>
                            <button type="button" class="btn btn-warning btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#modal-form<?= encrypt($data->acd_id) ?>"><i class="fa fa-pencil-square" aria-hidden="true"></i></button>
                            <div class="modal fade" id="modal-form<?= encrypt($data->acd_id) ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form<?= encrypt($data->acd_id) ?>" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-top modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body p-0">
                                            <div class="card card-plain">
                                                <div class="card-header pb-0 text-left">
                                                    <h3 class="font-weight-bolder text-info text-gradient">Edit Subjects for <?= $data->acd_class ?></h3>
                                                </div>
                                                <div class="card-body">
                                                    <form action="/Academics/SubjectsController/edit/<?= encrypt($data->acd_id); ?>" method="post">
                                                        <?= set_csrf(); ?>
                                                        <div class="row mb-3">
                                                            <div class="col-sm">
                                                                <label for="acd_class">Select Class : </label>
                                                                <?= func::classlist("acd_class", [$data->acd_class => $data->acd_class]); ?>
                                                            </div>
                                                            <div class="col-sm">
                                                                <label for="acd_ay">Academic Year : </label>
                                                                <?= func::academicYear("acd_ay", [$data->acd_ay, $data->acd_ay]) ?>
                                                            </div>
                                                        </div>
                                                        <h4 class="mt-4">
                                                            Subject :
                                                        </h4>
                                                        <div class="row mb-3">
                                                            <div class="col-sm">
                                                                <label for="acd_sub1">Subject 1 : </label><input class="form-control" type="text" name="acd_sub1" value="<?= $data->acd_sub1 ?>" id="acd_sub1" />
                                                            </div>
                                                            <div class="col-sm">
                                                                <label for="acd_sub2">Subject 2 : </label><input class="form-control" type="text" name="acd_sub2" value="<?= $data->acd_sub2 ?>" id="acd_sub2" />
                                                            </div>
                                                            <div class="col-sm">
                                                                <label for="acd_sub3">Subject 3 : </label><input class="form-control" type="text" name="acd_sub3" value="<?= $data->acd_sub3 ?>" id="acd_sub3" />
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-sm">
                                                                <label for="acd_sub4">Subject 4 : </label><input class="form-control" type="text" name="acd_sub4" value="<?= $data->acd_sub4 ?>" id="acd_sub4" />
                                                            </div>
                                                            <div class="col-sm">
                                                                <label for="acd_sub5">Subject 5 : </label><input class="form-control" type="text" name="acd_sub5" value="<?= $data->acd_sub5 ?>" id="acd_sub5" />
                                                            </div>
                                                            <div class="col-sm">
                                                                <label for="acd_sub6">Subject 6 : </label><input class="form-control" type="text" name="acd_sub6" value="<?= $data->acd_sub6 ?>" id="acd_sub6" />
                                                            </div>
                                                            <div class="col-sm">
                                                                <label for="acd_sub7">Subject 7 : </label><input class="form-control" type="text" name="acd_sub7" value="<?= $data->acd_sub7 ?>" id="acd_sub7" />
                                                            </div>
                                                        </div>
                                                        <h4>
                                                            Monthly Test (FA) Max Marks :
                                                        </h4>
                                                        <div class="row mt-1 mb-3">
                                                            <div class="col-sm">
                                                                <label for="subject1_m_max">Subject 1 Max : </label><input class="form-control" type="number" name="subject1_m_max" value="<?= $data->subject1_m_max ?>" id="subject1_m_max" />
                                                            </div>
                                                            <div class="col-sm">
                                                                <label for="subject2_m_max">Subject 2 Max : </label><input class="form-control" type="number" name="subject2_m_max" value="<?= $data->subject2_m_max ?>" id="subject2_m_max" />
                                                            </div>
                                                            <div class="col-sm">
                                                                <label for="subject3_m_max">Subject 3 Max : </label><input class="form-control" type="number" name="subject3_m_max" value="<?= $data->subject3_m_max ?>" id="subject3_m_max" />
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-sm">
                                                                <label for="subject4_m_max">Subject 4 Max : </label><input class="form-control" type="number" name="subject4_m_max" value="<?= $data->subject4_m_max ?>" id="subject4_m_max" />
                                                            </div>
                                                            <div class="col-sm">
                                                                <label for="subject5_m_max">Subject 5 Max : </label><input class="form-control" type="number" name="subject5_m_max" value="<?= $data->subject5_m_max ?>" id="subject5_m_max" />
                                                            </div>
                                                            <div class="col-sm">
                                                                <label for="subject6_m_max">Subject 6 Max : </label><input class="form-control" type="number" name="subject6_m_max" value="<?= $data->subject6_m_max ?>" id="subject6_m_max" />
                                                            </div>
                                                            <div class="col-sm">
                                                                <label for="subject7_m_max">Subject 7 Max : </label><input class="form-control" type="number" name="subject7_m_max" value="<?= $data->subject7_m_max ?>" id="subject7_m_max" />
                                                            </div>
                                                        </div>
                                                        <h4>
                                                            Semester End Exam (SA) Max Marks :
                                                        </h4>
                                                        <div class="row mb-3 mt-1">
                                                            <div class="col-sm">
                                                                <label for="subject1_e_max">Subject 1 Max : </label><input class="form-control" type="number" name="subject1_e_max" value="<?= $data->subject1_e_max; ?>" id="subject1_e_max" />
                                                            </div>
                                                            <div class="col-sm">
                                                                <label for="subject2_e_max">Subject 2 Max : </label><input class="form-control" type="number" name="subject2_e_max" value="<?= $data->subject2_e_max; ?>" id="subject2_e_max" />
                                                            </div>
                                                            <div class="col-sm">
                                                                <label for="subject3_e_max">Subject 3 Max : </label><input class="form-control" type="number" name="subject3_e_max" value="<?= $data->subject3_e_max; ?>" id="subject3_e_max" />
                                                            </div>
                                                        </div>

                                                        <div class="row mb-0">
                                                            <div class="col-sm">
                                                                <label for="subject4_e_max">Subject 4 Max : </label><input class="form-control" type="number" name="subject4_e_max" value="<?= $data->subject4_e_max; ?>" id="subject4_e_max" />
                                                            </div>
                                                            <div class="col-sm">
                                                                <label for="subject5_e_max">Subject 5 Max : </label><input class="form-control" type="number" name="subject5_e_max" value="<?= $data->subject5_e_max; ?>" id="subject5_e_max" />
                                                            </div>
                                                            <div class="col-sm">
                                                                <label for="subject6_e_max">Subject 6 Max : </label><input class="form-control" type="number" name="subject6_e_max" value="<?= $data->subject6_e_max; ?>" id="subject6_e_max" />
                                                            </div>
                                                            <div class="col-sm">
                                                                <label for="subject7_e_max">Subject 7 Max : </label><input class="form-control" type="number" name="subject7_e_max" value="<?= $data->subject7_e_max; ?>" id="subject7_e_max" />
                                                            </div>
                                                        </div>
                                                        <div class="form-group text-center">
                                                            <button class="btn btn-primary mt-5" type="submit" name="update">Update</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="/Academics/SubjectsController/delete/<?= encrypt($data->acd_id); ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        </div>
    </div>
</div>
<?php
require_once './views/footer.php';
?>