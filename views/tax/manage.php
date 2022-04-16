<?php
require_once './views/header.php';
$app->setTitle("Manage Taxes");
includes::crumb("Manage Taxes","/ManageTax");
?>
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">

            <div class="row">
                <div class="col-lg-10">
                    <h5 class="text-primary font-weight-bolder">Manage Tax</h5>
                </div>
            </div>
        </div>
        <div class="card-body" style="overflow:scroll;">
            <table id="basic-btn" class="table table-bordered table-sm ">
                <thead class='bg-dark text-light'>
                    <tr>
                        <th scope="col">Tax Id</th>
                        <th scope="col">Tax Name</th>
                        <th scope="col">Tax Percentage</th>
                        <th scope="col">Tax Type</th>
                        <th scope="col">Description</th>
                        <th scope="col">Status </th>
                        <th scope="col">Food</th>
                        <th scope="col">Room</th>
                        <th scope="col">Store</th>
                        <th scope="col">Added On </th>
                        <th scope="col">Added By </th>
                        <th scope="col" class='not-export-col'>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
              
                $db->select("tax", "*",'');
                $result = $db->sql;
                try{
                    if($result){
                if (mysqli_num_rows($result) > 0) {
                    while ($r = mysqli_fetch_object($result)) {
                        echo '<tr>';
                        echo '<td>' . $r->tax_id . '</td>';
                        echo '<td>' . $r->tax_name . '</td>';
                        echo '<td>' . $r->tax_per . '% </td>';
                        echo '<td>' . $r->tax_type . '</td>';
                        echo '<td>' . $r->tax_desc. '</td>';
                        echo '<td>' . $r->tax_status . '</td>';
                        echo '<td>' . $r->food . '</td>';
                        echo '<td>' . $r->room . '</td>';
                        echo '<td>' . $r->store . '</td>';
                        echo '<td>' . $r->created_on . '</td>';
                        echo '<td>' . $r->login_id . '</td>';
                        echo '<td>
                            <a href="/EditTax/' . encrypt($r->tax_id ). '" class="btn btn-sm btn-primary">Edit</a>
                            <a href="/TaxController/delete/' . encrypt($r->tax_id) . '" class="btn btn-sm btn-danger">Delete</a>
                        </td>';

                        echo '</tr>';
                    }
                }else{
                    echo '<tr>';
                    echo '<td colspan="12" align="center">No Data Found</td>';
                    echo '</tr>';
                }
            }else{
                error_loger($db->conn->error, __FILE__, "Cant able to Process the request for fetching the data of Tax ",$user['username']);
                throw new Exception('Error Processing Request');
            }  
        }
        catch(Exception $e){
            echo '<tr>';
            echo '<td colspan="12" align="center">'.$e->getMessage().'</td>';
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