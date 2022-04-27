<?php
require_once './views/header.php';
$app->setTitle("Manage Payee");
?>
<div class="card m-2">
    <div class="card-header">
        <div class="row">
            <div class="col-md-3">
            <span class="btn btn-danger btn-lg">Manage Payee's</span>
            </div>
            <div class="col-md-9 text-right ">
                <p align="right">
            <button type="button" class="btn btn-primary m-3" data-bs-toggle="modal"
                    data-bs-target="#modal-form-new-payee">New Payee</button></p>
            </div>
        </div>
    </div>
    <div class="card-body">
    <div class="modal fade" id="modal-form-new-payee" tabindex="-1" role="dialog"
                    aria-labelledby="modal-form-new-payee" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-body p-0">
                                <div class="card card-plain">
                                    <div class="card-header pb-0 text-left">
                                        <h3 class="font-weight-bolder text-info text-gradient">New Payee </h3>
                                    </div>
                                    <div class="card-body">
                                    <form action="/Expense/PayeeController/new/<?= uniqid(); ?>" method="post">
                                            <?= set_csrf();?>
                                            <label for="">Payee Name  : </label>
                                            <div class="input-group mb-3">
                                                <input type="text" name="payee_name" class="form-control" placeholder="Payee Name ..."
                                                    aria-label="payee_name"    aria-describedby="class_details">
                                            </div>
                                            <label>Payee Description : </label>
                                            <div class="input-group mb-3">
                                               <textarea name="payee_desc" class="form-control" placeholder="Payee Description ..."
                                                    aria-label="payee_desc"    aria-describedby="payee_desc"></textarea>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit"
                                                    class="btn btn-round bg-gradient-success btn-lg w-100 mt-4 mb-0">Add Payee</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
       $sql = 'SELECT * FROM `payee_details`';
        $result = mysqli_query($db->conn, $sql);
    ?>
        <?= includes::Datatables('Payee Details ', '0,1,2,3', 'landscape'); ?>
        <table id="example" class="display" style="width:100%">
            <thead>
                <tr class="bg-dark text-light">
                    <th>#</th>
                    <th>Payee Id</th>
                    <th>Payee Name</th>
                    <th>Payee Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody style="font-size:small;">
                <?php
                $i = date("Y").'1';
            while ($data = $result->fetch_object()) {
                echo'<tr>';
                echo'<td>'.$i++.'</td>';
                echo'<td>'.$data->payee_id.'</td>';
                echo'<td>'.$data->payee_name.'</td>';
                echo'<td>'.$data->payee_desc.'</td>';
                echo '<td>'; ?>
                <button type="button" class="badge bg-warning mb-3" data-bs-toggle="modal"
                    data-bs-target="#modal-form<?= encrypt($data->payee_id) ?>"><i class="fa fa-pencil-square"
                        aria-hidden="true"></i></button>
                <a onclick="window.open('<?= func::href('/Expense/PayeeController/delete/'.$data->payee_id); ?>','popup','width=1000,height=1000');"
                    class="badge bg-danger badge-pill"><i class="fa fa-trash" aria-hidden="true"></i></a>

                    <div class="modal fade" id="modal-form<?= encrypt($data->payee_id) ?>" tabindex="-1" role="dialog"
                    aria-labelledby="modal-form<?= encrypt($data->payee_id) ?>" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-body p-0">
                                <div class="card card-plain">
                                    <div class="card-header pb-0 text-left">
                                        <h3 class="font-weight-bolder text-info text-gradient">Edit Payee- <?= $data->payee_name ?> </h3>
                                    </div>
                                    <div class="card-body">
                                    <form action="/Expense/PayeeController/edit/<?= $data->payee_id ?>" method="post">
                                    <?= set_csrf();?>
                                            <label for="">Ho Name  : </label>
                                            <div class="input-group mb-3">
                                                <input type="text" name="payee_name" class="form-control" placeholder="Payee Name ..."
                                                    aria-label="payee_name"  value="<?= $data->payee_name ?>"  aria-describedby="class_details">
                                            </div>
                                            <label>Ho Description : </label>
                                            <div class="input-group mb-3">
                                               <textarea name="payee_desc" class="form-control" placeholder="Payee Description ..."
                                                    aria-label="payee_desc" aria-describedby="payee_desc"><?= $data->payee_desc ?></textarea>
                                            </div>
                                            
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-round bg-gradient-warning btn-lg w-100 mt-4 mb-0">Edit Payee</button>
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