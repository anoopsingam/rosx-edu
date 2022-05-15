<?php
require_once './views/header.php';
$app->setTitle("Manage Bus & Driver");
?>
<div class="card m-2">
    <div class="card-header">
        <div class="row">
            <div class="col-md-3">
            <span class="btn btn-danger btn-lg">Manage Bus & Driver</span>
            </div>
            <div class="col-md-9 text-right ">
                <p align="right">
            <button type="button" class="btn btn-primary m-3" data-bs-toggle="modal"
                    data-bs-target="#modal-form_new_ho">New <i class="fa fa-plus-circle" aria-hidden="true"></i></button></p>
            </div>
        </div>
    </div>
    <div class="card-body">
    <div class="modal fade" id="modal-form_new_ho" tabindex="-1" role="dialog"
                    aria-labelledby="modal-form_new_ho" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-body p-0">
                                <div class="card card-plain">
                                    <div class="card-header pb-0 text-left">
                                        <h3 class="font-weight-bolder text-info text-gradient">New Bus & Driver </h3>
                                    </div>
                                    <div class="card-body">
                                    <form action="/Transport/BusController/new/<?= uniqid(); ?>" method="post">
                                            <?= set_csrf();?>
                                            <label for="">Driver Name  : </label>
                                            <div class="input-group mb-3">
                                                <input type="text" name="driver_name" class="form-control" placeholder="Driver Name ..."
                                                    aria-label="driver_name"    aria-describedby="class_details">
                                            </div>
                                            <label for="">Driver Number</label>
                                            <div class="input-group mb-3">
                                                <input type="text" name="driver_number" class="form-control" placeholder="Driver Number ..."
                                                    aria-label="driver_number"    aria-describedby="class_details">
                                            </div>
                                        <label for="">Driver Address : </label>
                                            <div class="input-group mb-3">
                                            <textarea name="driver_address" class="form-control" placeholder="Driver Address ..."
                                                    aria-label="driver_address"    aria-describedby="class_details"></textarea>        
                                        </div>
                                            <label for="">Bus Reg No : </label>
                                            <div class="input-group mb-3">
                                                <input type="text" name="bus_reg_no" class="form-control" placeholder="Bus Reg No ..."
                                                    aria-label="bus_reg_no"    aria-describedby="class_details">
                                            </div>
                                            <label for="">Bus Name : </label>
                                            <div class="input-group mb-3">
                                                <input type="text" name="bus_name" class="form-control" placeholder="Bus Name ..."
                                                    aria-label="bus_name"    aria-describedby="class_details">
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" name="sub_driver"
                                                    class="btn btn-round bg-gradient-info btn-lg w-100 mt-4 mb-0">Add Bus</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
       $sql = 'SELECT * FROM `transport_bus`';
        $result = mysqli_query($db->conn, $sql);
    ?>
        <?= includes::Datatables('Bus & Driver Data ', '0,1,2,3,4,5', 'landscape'); ?>
        <table id="example" class="display" style="width:100%">
            <thead>
                <tr class="bg-dark text-light">
                    <th>#</th>
                    <th>Driver Name</th>
                    <th>Driver Number</th>
                    <th>Driver Address</th>
                    <th>Bus Reg No</th>
                    <th>Bus Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody style="font-size:small;">
                <?php
                $i = date("Y").'1';
            while ($data = $result->fetch_object()) {
                echo'<tr>';
                echo'<td>'.++$i.'</td>';
                echo'<td>'.$data->driver_name.'</td>';
                echo'<td>'.$data->driver_number.'</td>';
                echo'<td>'.$data->driver_address.'</td>';
                echo'<td>'.$data->bus_reg_no.'</td>';
                echo'<td>'.$data->bus_name.'</td>';
                echo '<td>'; ?>
                <button type="button" class="badge bg-warning mb-3" data-bs-toggle="modal"
                    data-bs-target="#modal-form<?= encrypt($data->db_id) ?>"><i class="fa fa-pencil-square"
                        aria-hidden="true"></i></button>
                <a href="<?= func::href('/Transport/BusController/delete/'.$data->db_id); ?>"
                    class="badge bg-danger badge-pill"><i class="fa fa-trash" aria-hidden="true"></i></a>

                    <div class="modal fade" id="modal-form<?= encrypt($data->db_id) ?>" tabindex="-1" role="dialog"
                    aria-labelledby="modal-form<?= encrypt($data->db_id) ?>" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-body p-0">
                                <div class="card card-plain">
                                    <div class="card-header pb-0 text-left">
                                        <h3 class="font-weight-bolder text-info text-gradient">Edit Bus & Driver <?= $data->bus_reg_no ?> </h3>
                                    </div>
                                    <div class="card-body">
                                    <form action="/Transport/BusController/edit/<?= encrypt($data->db_id) ?>" method="post">
                                    <?= set_csrf();?>
                                            <label for="">Driver Name  : </label>
                                            <div class="input-group mb-3">
                                                <input type="text" name="driver_name" class="form-control" placeholder="Driver Name ..."
                                                    aria-label="driver_name" value="<?= $data->driver_name ?>"   aria-describedby="class_details">
                                            </div>
                                            <label for="">Driver Number</label>
                                            <div class="input-group mb-3">
                                                <input type="text" name="driver_number" class="form-control" placeholder="Driver Number ..."
                                                    aria-label="driver_number" value="<?= $data->driver_number ?>"   aria-describedby="class_details">
                                            </div>
                                        <label for="">Driver Address : </label>
                                            <div class="input-group mb-3">
                                            <textarea name="driver_address" class="form-control" placeholder="Driver Address ..."
                                                    aria-label="driver_address"   aria-describedby="class_details"><?= $data->driver_address ?></textarea>
                                        </div>
                                            <label for="">Bus Reg No : </label>
                                            <div class="input-group mb-3">
                                                <input type="text" name="bus_reg_no" class="form-control" placeholder="Bus Reg No ..."
                                                    aria-label="bus_reg_no" value="<?= $data->bus_reg_no ?>"   aria-describedby="class_details">
                                            </div>
                                            <label for="">Bus Name : </label>
                                            <div class="input-group mb-3">
                                                <input type="text" name="bus_name" class="form-control" placeholder="Bus Name ..."
                                                    aria-label="bus_name" value="<?= $data->bus_name ?>"   aria-describedby="class_details">
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" name="sub_driver"
                                                    class="btn btn-round bg-gradient-warning btn-lg w-100 mt-4 mb-0">Edit Bus</button>
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