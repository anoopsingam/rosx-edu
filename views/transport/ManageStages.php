<?php
require_once './views/header.php';
$app->setTitle("Manage Stages & Fares ");
?>
<div class="card m-2">
    <div class="card-header">
        <div class="row">
            <div class="col-md-3">
                <span class="btn bg-gradient-success btn-lg">Manage Stages & Fares </span>
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
                                <h3 class="font-weight-bolder text-info text-gradient">New Stages & Fares </h3>
                            </div>
                            <div class="card-body">
                                <form action="/Transport/StageController/new/<?= uniqid(); ?>" method="post">
                                    <?= set_csrf();?>
                                    <label for="">Route Stage Name : </label>
                                    <div class="input-group mb-3">
                                        <input type="text" name="route_stage_name" class="form-control"
                                            placeholder="Bus Route Stage Name ..." aria-label="route_stage_name"
                                            aria-describedby="class_details">
                                    </div>
                                    <label for="">Fare <i class="fa fa-money" aria-hidden="true"></i></label>
                                    <div class="input-group mb-3">
                                        <input type="number" name="route_stage_fare" class="form-control"
                                            placeholder="Bus Route Stage Fare ..." aria-label="route_stage_fare"
                                            aria-describedby="class_details">
                                    </div>
                                    <label for="">Route : </label>
                                    <div class="input-group mb-3">
                                        <?= func::getRouteList()?>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" name="sub_fee"
                                            class="btn btn-round bg-gradient-info btn-lg w-100 mt-4 mb-0">Add
                                            Stage</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
       $sql = 'SELECT * FROM transport_stages s, transport_routes t, transport_bus b WHERE s.stage_route_id=t.route_id AND t.route_bus_id=b.db_id';
        $result = mysqli_query($db->conn, $sql);
    ?>
        <?= includes::Datatables('Stages & Fares  ', '0,1,2,3,4', 'landscape'); ?>
        <table id="example" class="display" style="width:100%">
            <thead>
                <tr class="bg-dark text-light">
                    <th>#</th>
                    <th>Bus No </th>
                    <th>Route Name</th>
                    <th>Stage Name </th>
                    <th>Fare </th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody style="font-size:small;">
                <?php
                $i = date("Y").'1';
            while ($data = $result->fetch_object()) {
                echo'<tr>';
                echo'<td>'.$i++.'</td>';
                echo'<td>'.$data->bus_reg_no.'</td>';
                echo'<td>'.$data->route_name.'</td>';
                echo'<td>'.$data->route_stage_name.'</td>';
                echo'<td>'.$data->route_stage_fare.'</td>';
                echo '<td>'; ?>
                <button type="button" class="badge bg-warning mb-3" data-bs-toggle="modal"
                    data-bs-target="#modal-form<?= encrypt($data->route_stage_id) ?>"><i class="fa fa-pencil-square"
                        aria-hidden="true"></i></button>
                <a href="<?= func::href('/Transport/StageController/delete/'.encrypt($data->route_stage_id)); ?>"
                    class="badge bg-danger badge-pill"><i class="fa fa-trash" aria-hidden="true"></i></a>

                <div class="modal fade" id="modal-form<?= encrypt($data->route_stage_id) ?>" tabindex="-1" role="dialog"
                    aria-labelledby="modal-form<?= encrypt($data->route_stage_id) ?>" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-body p-0">
                                <div class="card card-plain">
                                    <div class="card-header pb-0 text-left">
                                        <h3 class="font-weight-bolder text-info text-gradient">Edit Stages & Fares
                                            <?= $data->route_name ?> </h3>
                                    </div>
                                    <div class="card-body">
                                        <form
                                            action="/Transport/StageController/edit/<?= encrypt($data->route_stage_id); ?>"
                                            method="post">
                                            <?= set_csrf();?>
                                            <label for="">Route Stage Name : </label>
                                            <div class="input-group mb-3">
                                                <input type="text" name="route_stage_name" class="form-control" value="<?= $data->route_stage_name?>"
                                                    placeholder="Bus Route Stage Name ..." aria-label="route_stage_name"
                                                    aria-describedby="class_details">
                                            </div>
                                            <label for="">Fare <i class="fa fa-money" aria-hidden="true"></i></label>
                                            <div class="input-group mb-3">
                                                <input type="number" name="route_stage_fare" class="form-control" value="<?= $data->route_stage_fare?>"
                                                    placeholder="Bus Route Stage Fare ..." aria-label="route_stage_fare"
                                                    aria-describedby="class_details">
                                            </div>
                                            <label for="">Route : </label>
                                            <div class="input-group mb-3">
                                                <?= func::getRouteList(["route_id"=>$data->route_id,"route_name"=>$data->route_name])?>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit"
                                                    class="btn btn-round bg-gradient-warning btn-lg w-100 mt-4 mb-0">Edit
                                                    Stage</button>
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