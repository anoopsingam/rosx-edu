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
                                        <input type="text" name="student_id" list="student_list" class="form-control"
                                            placeholder="Student Id ..." aria-label="student_id"
                                            aria-describedby="class_details">

                                    </div>
                                    <label for=""> Choose Route </label>
                                    <div class="input-group mb-3">
                                        <?= func::getRouteListApi();?>
                                    </div>
                                    <label for=""> Choose Stage </label>
                                    <div class="input-group mb-3" id="stage_id">

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
       $sql = 'SELECT * FROM transport_enroll e 
       LEFT JOIN student_enrollment s ON e.enroll_student_id=s.studentid
        LEFT JOIN transport_stages t ON e.enroll_stage_id=t.route_stage_id 
        LEFT JOIN transport_routes r ON t.stage_route_id =r.route_id 
        LEFT JOIN transport_bus b ON r.route_bus_id = b.db_id';
       $result = mysqli_query($db->conn, $sql);
    ?>
        <?= includes::Datatables('Transport Enrollment  ', '0,1,2,3,4,5,6,7,8', 'landscape'); ?>
        <table id="example" class="display" style="width:100%">
            <thead>
                <tr class="bg-dark text-light">
                    <th>#</th>
                    <th>Student ID </th>
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
                echo'<td>'.$data->studentid.'</td>';
                echo'<td>'.$data->student_name.'</td>';
                echo'<td>'.$data->present_class.'-'.$data->present_section.'</td>';
                echo'<td>'.$data->bus_reg_no.'</td>';
                echo'<td>'.$data->route_name.'</td>';
                echo'<td>'.$data->route_stage_name.'</td>';
                echo'<td>'.$data->route_stage_fare.'</td>';
                echo'<td>'.$data->enroll_academic_year.'</td>';
                echo '<td>'; ?>
                <button type="button" class="badge bg-warning mb-3" data-bs-toggle="modal"
                    data-bs-target="#modal-form<?= encrypt($data->enroll_id) ?>"><i class="fa fa-pencil-square"
                        aria-hidden="true"></i></button>
                <a href="<?= func::href('/Transport/EnrollmentController/delete/'.encrypt($data->enroll_id)); ?>"
                    class="badge bg-danger badge-pill"><i class="fa fa-trash" aria-hidden="true"></i></a>
                <div class="modal fade" id="modal-form<?= encrypt($data->enroll_id) ?>" tabindex="-1" role="dialog"
                    aria-labelledby="modal-form<?= encrypt($data->enroll_id) ?>" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-body p-0">
                                <div class="card card-plain">
                                    <div class="card-header pb-0 text-left">
                                        <h3 class="font-weight-bolder text-info text-gradient">Edit Bus Enrollment
                                            <?= $data->student_name ?> </h3>
                                    </div>
                                    <div class="card-body">
                                        <form
                                            action="/Transport/EnrollmentController/edit/<?= encrypt($data->enroll_id ); ?>"
                                            method="post">
                                            <?= set_csrf();?>
                                            <label for="">Student Id : </label>
                                            <div class="input-group mb-3">
                                                <input type="text" name="student_id" list="student_list"
                                                    class="form-control" placeholder="Student Id ..."
                                                    aria-label="student_id" aria-describedby="class_details"
                                                    value="<?= $data->enroll_student_id ?>" readonly>
                                            </div>
                                            <label for=""> Choose Route </label>
                                            <div class="input-group mb-3">
                                                <?= func::getRouteListApi($data->enroll_student_id ,"UpdateStage".$data->enroll_student_id."()");?>
                                            </div>
                                            <label for=""> Choose Stage </label>
                                            <div class="input-group mb-3" id="stage_id<?= $data->enroll_student_id ?>">

                                            </div>
                                            <script>
                                            function UpdateStage<?= $data->enroll_student_id ?>() {
                                                var route_id = $('#<?= $data->enroll_student_id ?>').val();
                                                $.ajax({
                                                    url: '<?= func::href("/Api/GetStageList")?>',
                                                    type: 'POST',
                                                    data: {
                                                        route_id: route_id
                                                    },
                                                    success: function(response) {
                                                        $('#stage_id<?= $data->enroll_student_id ?>').html(response);
                                                    }
                                                });
                                            }
                                            </script>
                                            <label for="">Academic Year : </label>
                                            <div class="input-group mb-3">
                                                <?= func::academicYear("academic_year",
                                                [$data->enroll_academic_year=>$data->enroll_academic_year]);?>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" name="sub_fee"
                                                    class="btn btn-round bg-gradient-info btn-lg w-100 mt-4 mb-0">Edit
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
                     echo '</td>';
                echo '</tr>';
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
<script>
function GetStages() {
    var route_id = $('#route_id').val();
    $.ajax({
        url: '<?= func::href("/Api/GetStageList")?>',
        type: 'POST',
        data: {
            route_id: route_id
        },
        success: function(response) {
            $('#stage_id').html(response);
        }
    });
}
</script>

<?= func::EnrollTransportSearch();?>
<?php   
    require_once './views/footer.php';
?>