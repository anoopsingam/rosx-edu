<?php
require_once './views/header.php';
$app->setTitle("Manage Head of Accounts");
?>
<div class="card m-2">
    <div class="card-header">
        <div class="row">
            <div class="col-md-3">
            <span class="btn btn-danger btn-lg">Manage Head of Accounts</span>
            </div>
            <div class="col-md-9 text-right ">
                <p align="right">
            <button type="button" class="btn btn-primary m-3" data-bs-toggle="modal"
                    data-bs-target="#modal-form_new_ho">New H.O</button></p>
            </div>
        </div>
    </div>
    <div class="card-body">
    <div class="modal fade" id="modal-form_new_ho" tabindex="-1" role="dialog"
                    aria-labelledby="modal-form_new_ho" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-body p-0">
                                <div class="card card-plain">
                                    <div class="card-header pb-0 text-left">
                                        <h3 class="font-weight-bolder text-info text-gradient">New Head Of Accounts </h3>
                                    </div>
                                    <div class="card-body">
                                    <form action="/Expense/HoController/new/<?= uniqid(); ?>" method="post">
                                            <?= set_csrf();?>
                                            <label for="">Ho Name  : </label>
                                            <div class="input-group mb-3">
                                                <input type="text" name="ho_name" class="form-control" placeholder="Head Of Accounts Name ..."
                                                    aria-label="ho_name"    aria-describedby="class_details">
                                            </div>
                                            <label>Ho Description : </label>
                                            <div class="input-group mb-3">
                                               <textarea name="ho_desc" class="form-control" placeholder="Head Of Accounts Description ..."
                                                    aria-label="ho_description"    aria-describedby="class_details"></textarea>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" name="sub_fee"
                                                    class="btn btn-round bg-gradient-info btn-lg w-100 mt-4 mb-0">Add HO</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
       $sql = 'SELECT * FROM `head_accounts`';
        $result = mysqli_query($db->conn, $sql);
    ?>
        <?= includes::Datatables('Head of Accounts ', '0,1,2,3', 'landscape'); ?>
        <table id="example" class="display" style="width:100%">
            <thead>
                <tr class="bg-dark text-light">
                    <th>#</th>
                    <th>H.O Id</th>
                    <th>H.O Name</th>
                    <th>H.O Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody style="font-size:small;">
                <?php
                $i = date("Y").'1';
            while ($data = $result->fetch_object()) {
                echo'<tr>';
                echo'<td>'.$i++.'</td>';
                echo'<td>'.$data->id.'</td>';
                echo'<td>'.$data->ho_name.'</td>';
                echo'<td>'.$data->ho_desc.'</td>';
                echo '<td>'; ?>
                <button type="button" class="badge bg-warning mb-3" data-bs-toggle="modal"
                    data-bs-target="#modal-form<?= encrypt($data->id) ?>"><i class="fa fa-pencil-square"
                        aria-hidden="true"></i></button>
                <a onclick="window.open('<?= func::href('/Expense/HoController/delete/'.$data->id); ?>','popup','width=1000,height=1000');"
                    class="badge bg-danger badge-pill"><i class="fa fa-trash" aria-hidden="true"></i></a>

                    <div class="modal fade" id="modal-form<?= encrypt($data->id) ?>" tabindex="-1" role="dialog"
                    aria-labelledby="modal-form<?= encrypt($data->id) ?>" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-body p-0">
                                <div class="card card-plain">
                                    <div class="card-header pb-0 text-left">
                                        <h3 class="font-weight-bolder text-info text-gradient">Edit Head Of Accounts <?= $data->ho_name ?> </h3>
                                    </div>
                                    <div class="card-body">
                                    <form action="/Expense/HoController/edit/<?= $data->id ?>" method="post">
                                    <?= set_csrf();?>
                                            <label for="">Ho Name  : </label>
                                            <div class="input-group mb-3">
                                                <input type="text" name="ho_name" class="form-control" placeholder="Head Of Accounts Name ..."
                                                    aria-label="ho_name"  value="<?= $data->ho_name ?>"  aria-describedby="class_details">
                                            </div>
                                            <label>Ho Description : </label>
                                            <div class="input-group mb-3">
                                               <textarea name="ho_desc" class="form-control" placeholder="Head Of Accounts Description ..."
                                                    aria-label="ho_description" aria-describedby="class_details"><?= $data->ho_desc ?></textarea>
                                            </div>
                                            
                                            <div class="text-center">
                                                <button type="submit" 
                                                    class="btn btn-round bg-gradient-warning btn-lg w-100 mt-4 mb-0">Edit HO</button>
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