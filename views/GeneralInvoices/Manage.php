<?php
require_once './views/header.php';
$app->setTitle("Manage Billing Particulars");
?>
<div class="card m-2">
    <div class="card-header">
        <div class="row">
            <div class="col-md-3">
            <span class="btn btn-danger btn-lg">Manage UBS Particulars</span>
            </div>
            <div class="col-md-9 text-right ">
                <p align="right">
            <button type="button" class="btn btn-primary m-3" data-bs-toggle="modal"
                    data-bs-target="#modal-form_new_ho">New UBS Particular</button></p>
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
                                        <h3 class="font-weight-bolder text-info text-gradient">New Billing Particulars </h3>
                                    </div>
                                    <div class="card-body">
                                    <form action="/GeneralInvoices/ParticularsController/new/<?= uniqid(); ?>" method="post">
                                            <?= set_csrf();?>
                                            <label for="">Particulars Name  : </label>
                                            <div class="input-group mb-3">
                                                <input type="text" name="particular_name" class="form-control" placeholder="Billing Particulars Name ..."
                                                    aria-label="ho_name"    aria-describedby="class_details">
                                            </div>
                                            <label>Particulars Charges : </label>
                                            <div class="input-group mb-3">
                                                <input type="number" name="charges" class="form-control" placeholder="Billing Particulars Charges ..."
                                                    aria-label="charges"    aria-describedby="class_details">       
                                        </div>
                                            <div class="text-center">
                                                <button type="submit" name="sub_fee"
                                                    class="btn btn-round bg-gradient-info btn-lg w-100 mt-4 mb-0">Add </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
       $sql = 'SELECT * FROM `billing_particulars`';
        $result = mysqli_query($db->conn, $sql);
    ?>
        <?= includes::Datatables('Billing Particulars ', '0,1,2,3', 'landscape'); ?>
        <table id="example" class="display" style="width:100%">
            <thead>
                <tr class="bg-dark text-light">
                    <th>#</th>
                    <th>Particular Id</th>
                    <th>Particulars Name</th>
                    <th>Particulars Charges ₹</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody style="font-size:small;">
                <?php
                $i = date("Y").'1';
            while ($data = $result->fetch_object()) {
                echo'<tr>';
                echo'<td>'.$i++.'</td>';
                echo'<td>'.$data->billing_particular_id .'</td>';
                echo'<td>'.$data->particular_name .'</td>';
                echo'<td>'.$data->charges.'</td>';
                echo '<td>'; ?>
                <button type="button" class="badge bg-warning mb-3" data-bs-toggle="modal"
                    data-bs-target="#modal-form<?= encrypt($data->billing_particular_id ) ?>"><i class="fa fa-pencil-square"
                        aria-hidden="true"></i></button>
                <a onclick="window.open('<?= func::href('/GeneralInvoices/ParticularsController/delete/'.$data->billing_particular_id ); ?>','popup','width=1000,height=1000');"
                    class="badge bg-danger badge-pill"><i class="fa fa-trash" aria-hidden="true"></i></a>

                    <div class="modal fade" id="modal-form<?= encrypt($data->billing_particular_id ) ?>" tabindex="-1" role="dialog"
                    aria-labelledby="modal-form<?= encrypt($data->billing_particular_id ) ?>" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-body p-0">
                                <div class="card card-plain">
                                    <div class="card-header pb-0 text-left">
                                        <h3 class="font-weight-bolder text-info text-gradient">Edit Billing Particulars <?= $data->particular_name ?> </h3>
                                    </div>
                                    <div class="card-body">
                                    <form action="/GeneralInvoices/ParticularsController/edit/<?= $data->billing_particular_id  ?>" method="post">
                                    <?= set_csrf();?>
                                            <label for="">Particulars Name  : </label>
                                            <div class="input-group mb-3">
                                                <input type="text" name="particular_name" class="form-control" placeholder="Billing Particulars Name ..."
                                                    aria-label="particular_name"  value="<?= $data->particular_name ?>"  aria-describedby="class_details">
                                            </div>
                                            <label>Particulars Charges : </label>
                                            <div class="input-group mb-3">
                                                <input type="number" name="charges" class="form-control" placeholder="Billing Particulars Charges ..."
                                                    aria-label="charges"  value="<?= $data->charges ?>"  aria-describedby="class_details">   
                                            </div>
                                            
                                            <div class="text-center">
                                                <button type="submit" 
                                                    class="btn btn-round bg-gradient-warning btn-lg w-100 mt-4 mb-0">Edit Particular</button>
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