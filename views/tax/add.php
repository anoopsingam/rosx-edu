<?php
require_once './views/header.php';
$app->setTitle("Add Tax");
includes::crumb("Add Tax ","/AddTax");
?>
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <h5 class="text-primary font-weight-bolder">Add Tax</h5>
        </div>
        <div class="card-body">
            <form action="/TaxController/new/<?=uniqid();?>" method="post">
                <?= set_csrf(); ?>
                <div class="row mb-3">
                    <div class="col-sm"><label for="tax_name">Tax Name</label>
                        <input type="text" class="form-control" id="tax_name" name="tax_name"
                            placeholder="Enter Tax Name">
                    </div>
                    <div class="col-sm">
                        <label for="tax_percentage">Tax Percentage</label>
                        <input type="text" class="form-control" id="tax_per" name="tax_per"
                            placeholder="Enter Tax Percentage">
                    </div>
                    <div class="col-sm">
                        <label for="tax_type">Tax Type</label>
                        <select class="form-control" id="tax_type" name="tax_type">
                            <option value="INCLUSIVE">Inclusive</option>
                            <option value="EXCLUSIVE">Exclusive</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm">
                        <label for="tax_description">Tax Description</label>
                        <textarea class="form-control" id="tax_desc" name="tax_description"
                            placeholder="Enter Tax Description"></textarea>
                    </div>
                    <div class="col-sm p-2">
                        <label for="tax_status">Tax Status</label>
                        <select class="form-control" id="tax_status" name="tax_status">
                            <option value="ACTIVE">ACTIVE</option>
                            <option value="INACTIVE">INACTIVE</option>
                        </select>
                    </div>
                    <div class="col-sm">
                        <label for="">Applicable for </label>
                        <div class="row">
                            <div class="col-sm">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="food" value="TRUE" id="food">
                                    <label class="custom-control-label" for="food">Food</label>
                                </div>
                            </div>
                            <div class="col-sm">
                            <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="room" value="TRUE" id="room">
                                    <label class="custom-control-label" for="room">Room Service</label>
                                </div>
                            </div>
                            <div class="col-sm">
                                
                            <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="store" value="TRUE" id="store">
                                    <label class="custom-control-label" for="store">Store</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary" name="confirm">Submit</button>
            </form>
        </div>
    </div>
</div>
<?php
    require_once './views/footer.php';
?>