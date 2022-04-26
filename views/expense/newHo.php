<?php
require_once './views/header.php';
$app->setTitle("New H.O");
?>
<div class="card m-2">
    <div class="card-header">
        <div class="row">
            <div class="col-md-3">
            <span class="btn btn-danger btn-lg">Manage Head of Accounts</span>
            </div>
            <div class="col-md-9 text-left">
            <button type="button" class="badge bg-primary m-3" data-bs-toggle="modal"
                    data-bs-target="#modal-form-new">New H.O</button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <?php
       $sql = 'SELECT * FROM `head_acc`';
        $result = mysqli_query($db->conn, $sql);
    ?>
        <?= includes::Datatables('Head of Accounts ', '0,1,2,3,4', 'landscape'); ?>
        <table id="example" class="display" style="width:100%">
            <thead>
                <tr class="bg-dark text-light">
                    <th>#</th>
                    <th>H.O Id</th>
                    <th>Fee ₹</th>
                    <th>Academic Year</th>
                    <th>Added On</th>
                    <th>Updated On</th>
                    <th>Added By</th>
                    <th>Updated By</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody style="font-size:small;">
                <?php
            while ($data = $result->fetch_object()) {
                echo'<tr>';
                echo'<td>'.$data->id.'</td>';
                echo'<td>'.$data->class.'</td>';
                echo'<td>'.$data->tution_fee.'</td>';
                echo'<td>'.$data->academic_year.'</td>';
                echo'<td>'.$data->added_on.'</td>';
                echo'<td>'.$data->updated_on.'</td>';
                echo'<td>'.$data->login_id.'</td>';
                echo'<td>'.$data->updated_by.'</td>';
                echo '<td>'; ?>
                <button type="button" class="badge bg-warning mb-3" data-bs-toggle="modal"
                    data-bs-target="#modal-form<?= encrypt($data->id) ?>"><i class="fa fa-pencil-square"
                        aria-hidden="true"></i></button>
                <a onclick="window.open('<?= func::href('/FeeStructureController/delete/'.$data->token_id); ?>','popup','width=1000,height=1000');"
                    class="badge bg-danger badge-pill"><i class="fa fa-trash" aria-hidden="true"></i></a>

                <div class="modal fade" id="modal-form<?= encrypt($data->id) ?>" tabindex="-1" role="dialog"
                    aria-labelledby="modal-form<?= encrypt($data->id) ?>" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-body p-0">
                                <div class="card card-plain">
                                    <div class="card-header pb-0 text-left">
                                        <h3 class="font-weight-bolder text-info text-gradient">Edit Fee Structure <?= $data->class ?></h3>
                                    </div>
                                    <div class="card-body">
                                    <form action="/FeeStructureController/edit/<?= $data->token_id ?>" method="post">
                                    <?= set_csrf();?>
                                    <label for="">Class : </label>
                                            <div class="input-group mb-3">
                                                <input type="text" name="class" class="form-control" placeholder="Class"
                                                    aria-label="Class" value="<?= $data->class ?>" readonly  aria-describedby="class_details">
                                            </div>
                                            <label>Academic Year</label>
                                            <div class="input-group mb-3">
                                                <input type="text" name="academic_year" class="form-control" placeholder="academic_year"
                                                    aria-label="academic_year" value="<?= $data->academic_year ?>"  readonly aria-describedby="ay">
                                            </div>
                                            <label>Total Fee</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="tution_fee" placeholder="tution_fee"
                                                    aria-label="tution_fee" value="<?= $data->tution_fee ?>"   aria-describedby="tf">
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" name="sub_fee"
                                                    class="btn btn-round bg-gradient-info btn-lg w-100 mt-4 mb-0">Update Fee</button>
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