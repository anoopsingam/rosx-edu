<?php
require_once './views/header.php';
$app->setTitle("Add New User");
?>
<div class="card shadow-lg m-3 p-3">
    <div class="card-header">
        <h4 class="text-left text-gradient text-primary">Manage User's</h4>
    </div>
    <div class="card-body">
        <?php 
         includes::Datatables("Users Data",'0,1,2,3,4',""); 
        ?>
        <table id="example" class="display table-active" style="width:100%">
        <thead>
        <tr class="bg-dark text-light">
        <td>Sl No.</td>
        <td>Username</td>
        <td>User Type</td>
        <td>Class</td>
        <td>Section</td>
        <td>Action</td>
        </tr>
        </thead>
        <tbody>
        <?php
        $i=1;
        $db = new database();
        $conn = $db->conn;
        $sql = "SELECT * FROM users order by username,user_type asc";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
       
            if($row['username']=="admin"){
                ?>
                <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['user_type']; ?></td>
                <td>-</td>
                <td>-</td>
                <td>
                   No Access To Modify 
                </td>
                </tr>
                <?php
            }else{
                ?>
                <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['user_type']; ?></td>
                <td><?php echo $row['class']; ?></td>
                <td><?php echo $row['section']; ?></td>
                <td>
                    <a href="<?= func::href("/User/EditUser/".encrypt($row['id'])) ?>" class="btn btn-sm btn-primary btn-sm">Edit</a>
                    <a href="<?= func::href("/User/DeleteUser/".encrypt($row['id'])) ?>" class="btn btn-sm btn-danger btn-sm">Delete</a>
                </td>
                </tr>
                <?php
            }
        }
        ?>
        </tbody>
        </table>
    </div>
</div>
<?php   
    require_once './views/footer.php';
?>