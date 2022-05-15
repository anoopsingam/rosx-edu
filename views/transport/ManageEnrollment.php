<?php
require_once './views/header.php';
$app->setTitle("Manage Transport Enrollment ");
?>
<div class="card m-2">
    <div class="card-header">
        <div class="row">
            <div class="col-md-3">
                <span class="btn bg-gradient-success btn-lg">Manage Transport Enrollment </span>
            </div>
            <div class="col-md-9 text-right ">
                <p align="right">
                    <button type="button" class="btn btn-primary m-3" data-bs-toggle="modal"
                        data-bs-target="#modal-form_new_ho">New <i class="fa fa-plus-square"
                            aria-hidden="true"></i></button>
                </p>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="modal fade" id="modal-form_new_ho" tabindex="-1" role="dialog" aria-labelledby="modal-form_new_ho"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="card card-plain">
                            <div class="card-header pb-0 text-left">
                                <h3 class="font-weight-bolder text-info text-gradient">New Transport Enrollment </h3>
                            </div>
                            <div class="card-body">
                                <form action="/Transport/EnrollmentController/new/<?= uniqid(); ?>" method="post">
                                    <?= set_csrf();?>
                                    <label for="">Student Id : </label>
                                    <div class="input-group mb-3">
                                        <input type="text" name="student_id" class="form-control"
                                            placeholder="Student Id ..." aria-label="student_id"
                                            aria-describedby="class_details">
                                    </div>
                                    <label for=""> Choose Stage </label>
                                    <div class="input-group mb-3">
                                        <?= func::getStageDetails();?>
                                    </div>
                                    <label for="">Academic Year : </label>
                                    <div class="input-group mb-3">
                                        <?= func::academicYear("academic_year")?>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" name="sub_fee"
                                            class="btn btn-round bg-gradient-info btn-lg w-100 mt-4 mb-0">Add
                                            Enrollment</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
       $sql = 'SELECT * FROM transport_enroll e, transport_stages s, transport_routes t, transport_bus b, student_enrollment z WHERE e.enroll_student_id=z.studentid AND s.stage_route_id=t.route_id AND t.route_bus_id=b.db_id';
       $result = mysqli_query($db->conn, $sql);
    ?>
        <?= includes::Datatables('Transport Enrollment  ', '0,1,2,3,4,5,6,7', 'landscape'); ?>
        <table id="example" class="display" style="width:100%">
            <thead>
                <tr class="bg-dark text-light">
                    <th>#</th>
                    <th>Student Name</th>
                    <th>Class- Section</th>
                    <th>Bus No</th>
                    <th>Route </th>
                    <th>Stage </th>
                    <th>Fare </th>
                    <th>Academic Year</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody style="font-size:small;">
                <?php
                $i = date("Y").'1';
            while ($data = $result->fetch_object()) {
                echo'<tr>';
                echo'<td>'.$i++.'</td>';
                echo'<td>'.$data->student_name.'</td>';
                echo'<td>'.$data->present_class.'-'.$data->present_section.'</td>';
                echo'<td>'.$data->bus_reg_no.'</td>';
                echo'<td>'.$data->route_name.'</td>';
                echo'<td>'.$data->route_stage_name.'</td>';
                echo'<td>'.$data->route_stage_fare.'</td>';
                echo'<td>'.$data->enroll_academic_year.'</td>';
                echo '<td>'; ?>
                <button type="button" class="badge bg-warning mb-3" data-bs-toggle="modal"
                    data-bs-target="#modal-form<?= encrypt($data->route_id) ?>"><i class="fa fa-pencil-square"
                        aria-hidden="true"></i></button>
                <a href="<?= func::href('/Transport/RouteController/delete/'.$data->route_id); ?>"
                    class="badge bg-danger badge-pill"><i class="fa fa-trash" aria-hidden="true"></i></a>
                    <div class="modal fade" id="modal-form<?= encrypt($data->route_id) ?>" tabindex="-1" role="dialog"
                    aria-labelledby="modal-form<?= encrypt($data->route_id) ?>" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-body p-0">
                                <div class="card card-plain">
                                    <div class="card-header pb-0 text-left">
                                        <h3 class="font-weight-bolder text-info text-gradient">Edit Bus Route
                                            <?= $data->route_name ?> </h3>
                                    </div>
                                    <div class="card-body">
                                        <form action="/Transport/RouteController/edit/<?= encrypt($data->route_id); ?>" method="post">
                                            <?= set_csrf();?>
                                            <label for="">Route Name : </label>
                                            <div class="input-group mb-3">
                                                <input type="text" name="route_name" class="form-control"
                                                    placeholder="Bus Route Name ..." aria-label="route_name"
                                                    value="<?= $data->route_name ?>" aria-describedby="class_details">
                                            </div>
                                            <label for=""> Route Statt Point : </label>
                                            <div class="input-group mb-3">
                                                <input type="text" name="route_src" class="form-control"
                                                    placeholder="Bus Route Start Point ..." aria-label="route_src"
                                                    value="<?= $data->route_src ?>" aria-describedby="class_details">
                                            </div>
                                            <label for=""> Route End Point : </label>
                                            <div class="input-group mb-3">
                                                <input type="text" name="route_dest" class="form-control"
                                                    placeholder="Bus Route End Point ..." aria-label="route_dest"
                                                    value="<?= $data->route_dest ?>" aria-describedby="class_details">
                                            </div>
                                            <label for="">Route Bus ID : </label>
                                            <div class="input-group mb-3">
                                                <?= func::getBusList(['db_id'=>$data->route_bus_id,"bus_name"=>$data->bus_reg_no])?>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit"
                                                    class="btn btn-round bg-gradient-warning btn-lg w-100 mt-4 mb-0">Edit
                                                    Route</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                     echo '</td>';
                echo '</tr>';
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
<?php   
    require_once './views/footer.php';
?>