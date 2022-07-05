<?php
require_once './views/header.php';
$app->setTitle("Manage Notifications");
?>
<div class="card m-2">
    <div class="card-header">
        <div class="row">
            <div class="col-md-3">
                <span class="btn btn-danger btn-lg">Manage Notifications</span>
            </div>
            <div class="col-md-9 text-right ">
                <p align="right">
                    <button type="button" class="btn btn-primary m-3" data-bs-toggle="modal" data-bs-target="#modal-form_new_notification_block">New <i class="fa fa-plus-circle" aria-hidden="true"></i> </button>
                </p>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="modal fade" id="modal-form_new_notification_block" tabindex="-1" role="dialog" aria-labelledby="modal-form_new_notification_block" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="card card-plain">
                            <div class="card-header pb-0 text-left">
                                <h3 class="font-weight-bolder text-info text-gradient">New Notification </h3>
                            </div>
                            <div class="card-body">
                                <form action="/Notification/Controller/new/<?= uniqid(); ?>" method="post">
                                    <?= set_csrf(); ?>
                                    <div class="row">
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <label for="no_type">Type : </label>
                                                <select class="form-control" name="no_type" id="no_type">
                                                    <option value="">Select Type</option>
                                                    <option value="GENERAL">GENERAL</option>
                                                    <option value="CIRCULAR">CIRCULAR</option>
                                                    <option value="ANNOUNCEMENT">ANNOUNCEMENT</option>
                                                    <option value="EVENT">EVENT</option>
                                                    <option value="ACADEMICS">ACADEMICS</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <label for="no_heading">Heading : </label>
                                                <input type="text" class="form-control" name="no_heading" id="no_heading" placeholder="Heading">
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <label for="">Send To : </label>
                                                <select class="form-control" name="no_to" id="no_to">
                                                    <option value="">Select Send To</option>
                                                    <option value="ALL CLASSES">ALL CLASSES</option>
                                                    <option value="FACULTY">FACULTY</option>
                                                    <option value="ADMIN">ADMIN</option>
                                                    <option value="LKG">LKG</option>
                                                    <option value="UKG">UKG</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>
                                                    <option value="9">9</option>
                                                    <option value="10">10</option>
                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="no_message">Message : </label>
                                                <textarea class="form-control" name="no_message" id="no_message" rows="3"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <label for="no_date">Date : </label>
                                                <input type="date" class="form-control" min="today" name="no_date" id="no_date" value="<?= date("Y-m-d") ?>">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <label for="no_media_link">Media Link : </label>
                                                <input type="text" class="form-control" name="no_media_link" id="no_media_link" placeholder="Media Link">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" name="sub_fee" class="btn btn-round bg-gradient-info btn-lg w-100 mt-4 mb-0">Send</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $sql = 'SELECT * FROM `app_notifications` ORDER BY no_date DESC';
        $result = mysqli_query($db->conn, $sql);
        ?>
        <?= includes::Datatables('Notifications ', '0,1,2,3,4,5', 'landscape'); ?>
        <table id="example" class="display" style="width:100%">
            <thead>
                <tr class="bg-dark text-light">
                    <th>#</th>
                    <th>Type</th>
                    <th>Heading</th>
                    <th>Message</th>
                    <th>To</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody style="font-size:small;">
                <?php
                $i = '1';
                while ($data = $result->fetch_object()) {
                    echo '<tr>';
                    echo '<td>' . ++$i . '</td>';
                    echo '<td>' . $data->no_type . '</td>';
                    echo '<td>' . $data->no_heading . '</td>';
                    echo '<td>' . $data->no_message . '</td>';
                    echo '<td>' . $data->no_to . '</td>';
                    echo '<td>' . $data->no_date . '</td>';
                    echo '<td>'; ?>
                    <button type="button" class="badge bg-warning mb-3" data-bs-toggle="modal" data-bs-target="#modal-form<?= encrypt($data->no_token) ?>">Edit <i class="fa fa-pencil-square" aria-hidden="true"></i></button>
                    <a onclick="window.open('<?= func::href('/Notification/Controller/delete/' . $data->no_token); ?>','popup','width=1000,height=1000');" class="badge bg-danger badge-pill">Delete<i class="fa fa-trash" aria-hidden="true"></i></a>

                    <div class="modal fade" id="modal-form<?= encrypt($data->no_token) ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form<?= encrypt($data->no_token) ?>" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-body p-0">
                                    <div class="card card-plain">
                                        <div class="card-header pb-0 text-left">
                                            <h3 class="font-weight-bolder text-info text-gradient">Edit Notification <?= $data->no_heading ?> </h3>
                                        </div>
                                        <div class="card-body">
                                            <form action="/Notification/Controller/edit/<?= $data->no_token ?>" method="post">
                                                <?= set_csrf(); ?>
                                                <div class="row">
                                                    <div class="col-sm">
                                                        <div class="form-group">
                                                            <label for="no_type">Type : </label>
                                                            <select class="form-control" name="no_type" id="no_type">
                                                                <option value="<?= $data->no_type ?>" selected><?= $data->no_type ?></option>
                                                                <option value="GENERAL">GENERAL</option>
                                                                <option value="CIRCULAR">CIRCULAR</option>
                                                                <option value="ANNOUNCEMENT">ANNOUNCEMENT</option>
                                                                <option value="EVENT">EVENT</option>
                                                                <option value="ACADEMICS">ACADEMICS</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm">
                                                        <div class="form-group">
                                                            <label for="no_heading">Heading : </label>
                                                            <input type="text" class="form-control" name="no_heading" value="<?= $data->no_heading ?>" id="no_heading" placeholder="Heading">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm">
                                                        <div class="form-group">
                                                            <label for="">Send To : </label>
                                                            <select class="form-control" name="no_to" id="no_to">
                                                                <option value="<?= $data->no_to ?>" selected><?= $data->no_to ?></option>
                                                                <option value="ALL CLASSES">ALL CLASSES</option>
                                                                <option value="FACULTY">FACULTY</option>
                                                                <option value="ADMIN">ADMIN</option>
                                                                <option value="LKG">LKG</option>
                                                                <option value="UKG">UKG</option>
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                                <option value="5">5</option>
                                                                <option value="6">6</option>
                                                                <option value="7">7</option>
                                                                <option value="8">8</option>
                                                                <option value="9">9</option>
                                                                <option value="10">10</option>
                                                            </select>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <label for="no_message">Message : </label>
                                                            <textarea class="form-control" name="no_message" id="no_message" rows="3"><?= $data->no_message ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm">
                                                        <div class="form-group">
                                                            <label for="no_date">Date : </label>
                                                            <input type="date" class="form-control" min="<?= date("Y-m-d") ?>" name="no_date" id="no_date" value="<?= $data->no_date ?>">
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-sm">
                                                        <div class="form-group">
                                                            <label for="no_media_link">Media Link : </label>
                                                            <input type="text" class="form-control" name="no_media_link" id="no_media_link" placeholder="Media Link">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-round bg-gradient-info btn-lg w-100 mt-4 mb-0">Send</button>
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
    var today = new Date().toISOString().split('T')[0];
    document.getElementsByName("no_date")[0].setAttribute('min', today);
</script>
<?php
require_once './views/footer.php';
?>