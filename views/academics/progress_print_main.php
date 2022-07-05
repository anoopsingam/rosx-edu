<?php
require_once './views/header.php';
$app->setTitle("Progress Card Print ");
?>
<script>
    $(function() {
        $('.chosen-select').chosen();
        $('.chosen-select-deselect').chosen({
            allow_single_deselect: true
        });
    });
</script>
<div class="card">
    <div class="card-header">
        <span class="btn bg-gradient-info btn-lg">Progress Card Print </span>
    </div>
    <div class="card-body">
      <form action="/Academics/ViewProgressPrint" method="post" target="_blank">
        <?= set_csrf();?>
      <div class="row">
            <div class="col-md-4">
                <label class="h3">Student Id :</label><br>
                <?= func::studentList(); ?>
            </div>
            <div class="col-md-4">
                <label class="h4">Select Term : </label><br>
                <select name="term_fetch" class="form-control mt-1" id="">
                    <option selected disabled>Select Term</option>
                    <option value="term_1">Term 1</option>
                    <option value="term_2">Term 2</option>
                    <option value="full">FULL</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="h4">Academic Year :</label>
                <?= func::academicYear(); ?>
            </div>
        </div>
        <center>
            <button type="submit" name="view_progress_print" class="btn bg-gradient-primary btn-md rounded-3 m-4">Submit</button>
        </center>
      </form>
    </div>
</div>
<?php
require_once './views/footer.php';
?>