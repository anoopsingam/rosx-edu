<?php
require '././config.php';
$db = new database();
$app = new app();
if (empty($_POST['student_id'])  && empty($_POST['term_fetch']) && empty($_POST['ay'])) {
    js::alert("Please select a student and a term");
    js::redirect('/Dashboard');
} else {
    $id = $_POST['studentid'];
    $term = $_POST['term_fetch'];
    $ay = $_POST['ay'];
    $t = '';
    if ($term == 'term_1') {
        $t = 'TERM -1';
        $parm = "'FA-1','FA-2','SA-1'";
    } else if ($term == 'term_2') {
        $t = 'TERM -2';
        $parm = "'FA-3','FA-4','SA-2'";
    } else {
        $parm = "'FA-1','FA-2','FA-3','FA-4','SA-1','SA-2'";
    }

    $student = func::getStudentDetails($db->conn->real_escape_string($id));
    /* Fetching the data from the database. */
    $sql_smt = mysqli_query($db->conn, "SELECT * from `academics_marks` WHERE res_test IN($parm) AND res_ay='$ay' AND res_student_id='$id'");
    if (mysqli_num_rows($sql_smt) > 0) {
        $data = array();
        while ($row = mysqli_fetch_assoc($sql_smt)) {
            $data[] = $row;
        }
        $sub = func::getSubjects($student->present_class);

        if(empty($data[0]['res_percentage']) || empty($data[1]['res_percentage']) || empty($data[2]['res_percentage'])  || empty($data[3]['res_percentage'])  || empty($data[4]['res_percentage'])  || empty($data[5]['res_percentage'])){
            echo "<h1>Please Enter all FA's & SA's Marks for Analysis </h1>";
        }else{
            function getMarksSub($data, $sub_id, $type)
            {
                if ($type == 'FA') {
                    $arr = ['FA-1', 'FA-2', 'FA-3', 'FA-4'];
                } else {
                    $arr = ['SA-1', 'SA-2'];
                }
                foreach ($data as $su) {
                    if (in_array($su['res_test'], $arr)) {
                        $marks[] = [
                            "label" => $su['res_test'],
                            "y" => $su[$sub_id],
                        ];
                    }
                }
                foreach ($marks as $mark) {
                    $dataPoints[] = $mark;
                }
                return $dataPoints;
            }
    
    
            function getMarks($data, $type)
            {
                foreach ($data as $sys) {
                    if ($type == 'FA') {
                        $arr = ['FA-1', 'FA-2', 'FA-3', 'FA-4'];
                    } else {
                        $arr = ['SA-1', 'SA-2'];
                    }
                    if (in_array($sys['res_test'], $arr)) {
                        $marks[] = [
                            "label" => $sys['res_test'],
                            "y" => $sys['res_percentage'],
                        ];
                    }
                }
                foreach ($marks as $mark) {
                    $dataPoints[] = $mark;
                }
                return $dataPoints;
            }
    
            function learning_curve($data, $sub_id, $type)
            {
                if ($type == 'FA') {
                    $arr = ['FA-1', 'FA-2', 'FA-3', 'FA-4'];
                } else {
                    $arr = ['SA-1', 'SA-2'];
                }
                foreach ($data as $su) {
                        $marks[] = $su[$sub_id];
                }
                return implode(',', $marks);
            }
    
    
    
            function plotGraph($points, $sub_name, $tg_id, $type)
            {
    ?>
                <div id="<?= $tg_id ?>" class="card border border-2 border-dark m-2 text-center m-3" style="height:200px ; width:450px;" class="m-2"></div>
                <script>
                    function <?= $tg_id ?>() {
    
                        var <?= $type ?> = new CanvasJS.Chart("<?= $tg_id ?>", {
                            title: {
                                text: "<?= $sub_name ?>"
                            },
                            axisY: {
                                title: "Marks Obtained"
                            },
                            data: [{
                                type: "line",
                                dataPoints: <?php echo json_encode($points, JSON_NUMERIC_CHECK); ?>
                            }]
                        });
                        <?= $type ?>.render();
    
                    }
                </script>
            <?php
            }

            ?>
            <!DOCTYPE html>
            <html lang="en">
    
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <?= $app->setTitle("Progress Analysis | $ay ") ?>
                <!-- CSS only -->
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
                <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
            </head>
            <style>
                @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Sora:wght@300;400;500;600;700;800&display=swap');
    
                * {
                    margin: 0;
                    padding: 0;
                    box-sizing: border-box;
                    font-family: 'Sora', sans-serif;
                }
    
                /* @page {
                        size: landscape;
                    } */
    
                .break {
                    page-break-after: always;
                }
    
                hr {
                    border: 1px solid #000;
                    width: 100%;
                    margin-bottom: 10px;
                }
    
                table.customTable {
                    width: 100%;
                    background-color: #FFFFFF;
                    border-collapse: collapse;
                    border-width: 2px;
                    border-color: #000000;
                    border-style: solid;
                    color: #000000;
                }
    
                table.customTable td,
                table.customTable th {
                    border-width: 2px;
                    border-color: #000000;
                    border-style: solid;
                    padding: 6px;
                }
    
                /* table.customTable thead {
                    background-color: #D9D9D9;
                } */
    
                @media print {
                    body:before {
                        content: url('<?= url::myurl() . '/' . $app->logo; ?>');
                        position: fixed;
                        top: 0;
                        bottom: 0;
                        left: 0;
                        right: 0;
                        color: #ff0000;
                        font-size: 100px;
                        font-weight: 500px;
                        display: grid;
                        justify-content: center;
                        align-content: center;
                        opacity: 0.1;
                        z-index: 2;
                    }
                }
            </style>
    
            <body>
                <table class="table text-center customTable ">
                    <thead>
                        <th colspan="2">
                            <?= $app->SetLogo('180', '160'); ?>
                            <h3 class="display-5 font-weigth-bolder text-uppercase"><?= $app->name; ?> </h3>
                            <h6 class=""><?= $app->address; ?> </h6>
                            <h6 class=""><?= 'Contact No : ' . $app->phone . '<br>  Email : ' . $app->email; ?> </h6>
                        </th>
                        <tr>
                            <th colspan="2" class="text-uppercase h3">Progress Anlysis </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <b>Student Name:</b> <?= $student->student_name ?>
                            </td>
                            <td>
                                <b>Class:</b> <?= $student->present_class ?>
                            </td>
    
                        </tr>
                        <thead>
                            <th colspan="2" class="text-uppercase h3">
                                FA Analysis Subject Wise
                            </th>
                        </thead>
                        <tr>
                            <td>
                                <?= plotGraph(getMarksSub($data, 'res_sub_1_marks', 'FA'), $sub['acd_sub1'], "A1", 'acd_sub1') ?>
                            </td>
                            <td>
                                <?= plotGraph(getMarksSub($data, 'res_sub_2_marks', 'FA'), $sub['acd_sub2'], "A2", 'acd_sub2') ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?= plotGraph(getMarksSub($data, 'res_sub_3_marks', 'FA'), $sub['acd_sub3'], "A3", 'acd_sub3') ?>
                            </td>
                            <td>
                                <?= plotGraph(getMarksSub($data, 'res_sub_4_marks', 'FA'), $sub['acd_sub4'], "A4", 'acd_sub4') ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?= plotGraph(getMarksSub($data, 'res_sub_5_marks', 'FA'), $sub['acd_sub5'], "A5", 'acd_sub5') ?>
                            </td>
                            <td>
                                <?= plotGraph(getMarksSub($data, 'res_sub_6_marks', 'FA'), $sub['acd_sub6'], "A6", 'acd_sub6') ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <center> <?= plotGraph(getMarksSub($data, 'res_sub_7_marks', 'FA'), $sub['acd_sub7'], "A7", 'acd_sub7') ?></center>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="break"></div>
                <table class="table customTable">
                    <thead>
                        <tr>
                            <td colspan="2" class="text-uppercase h3">
                                SA Analysis Subject Wise
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <?= plotGraph(getMarksSub($data, 'res_sub_1_marks', 'SA'), $sub['acd_sub1'], "A21", 'acd_sub21') ?>
                            </td>
                            <td>
                                <?= plotGraph(getMarksSub($data, 'res_sub_2_marks', 'SA'), $sub['acd_sub2'], "A22", 'acd_sub22') ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?= plotGraph(getMarksSub($data, 'res_sub_3_marks', 'SA'), $sub['acd_sub3'], "A23", 'acd_sub23') ?>
                            </td>
                            <td>
                                <?= plotGraph(getMarksSub($data, 'res_sub_4_marks', 'SA'), $sub['acd_sub4'], "A24", 'acd_sub24') ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?= plotGraph(getMarksSub($data, 'res_sub_5_marks', 'SA'), $sub['acd_sub5'], "A25", 'acd_sub25') ?>
                            </td>
                            <td>
                                <?= plotGraph(getMarksSub($data, 'res_sub_6_marks', 'SA'), $sub['acd_sub6'], "A26", 'acd_sub26') ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <center> <?= plotGraph(getMarksSub($data, 'res_sub_7_marks', 'SA'), $sub['acd_sub7'], "A27", 'acd_sub27') ?></center>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="break"></div>
                <div class=" p-3 mr-2">
                    <table id="res_table" class="table customTable text-center table-sm">
                        <thead>
                            <tr>
                                <th colspan="7" class="text-center">
                                    <h6 class="text-uppercase h3 m-3"> : Marks Details : </h6>
                                </th>
                            </tr>
                            <tr>
                                <th rowspan="2">
                                    <h5>Subjects</h5>
                                    <br>
                                </th>
                                <th colspan="3">
                                    <h6>TERM-1</h6>
                                </th>
                                <th colspan="3">
                                    <h6>TERM-2</h6>
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    <h4>FA-1</h4>
                                </th>
                                <th>
                                    <h4>FA-2</h4>
                                </th>
                                <th>
                                    <h4>SA-1</h4>
                                </th>
                                <th>
                                    <h4>FA-3</h4>
                                </th>
                                <th>
                                    <h4>FA-4</h4>
                                </th>
                                <th>
                                    <h4>SA-2</h4>
                                </th>
    
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            for ($i = 1; $i < 8; $i++) {
                            ?>
                                <tr>
                                    <td><b class="h5"><?= $sub['acd_sub' . $i] ?></b></td>
                                    <?php
                                    foreach ($data as $d) {
                                        echo "<td><h6>" . $d['res_sub_' . $i . '_marks'] . "</h6></td>";
                                    }
                                    ?>
                                </tr>
                            <?php
                            }
                            ?>
                            <tr>
                                <td colspan="7" class="text-center">
                                    <h5>Summary </h5>
                                </td>
                            </tr>
    
                            <tr>
                                <td><b class="h5">Total</b></td>
                                <?php
                                foreach ($data as $d) {
                                    echo "<td>" . $d['res_obtained'] . "</td>";
                                }
                                ?>
                            </tr>
                            <tr>
                                <td><b class="h5">Percentage </b></td>
                                <?php
                                foreach ($data as $d) {
                                    echo "<td>" . $d['res_percentage'] . " % </td>";
                                }
                                ?>
                            </tr>
                            <tr>
                                <td><b class="h5">Grade </b></td>
                                <?php
                                foreach ($data as $d) {
                                    echo "<td>" . $d['res_grade'] . " </td>";
                                }
                                ?>
                            </tr>
                            <tr>
                                <td><b class="h5">Result </b></td>
                                <?php
                                foreach ($data as $d) {
                                    echo "<td><b>" . $d['res_result'] . "</b> </td>";
                                }
                                ?>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <center> <?= plotGraph(getMarks($data, 'FA'), "FORMATIVE ASSESMENTS", "A28", 'acd_sub28') ?></center>
                                </td>
                                <td colspan="3">
                                    <center> <?= plotGraph(getMarks($data, 'SA'), "SUMMATIVE ASSESMENTS", "A29", 'acd_sub29') ?></center>
                                </td>
                            </tr>
                        </tbody>
                    </table>
    
                    <div id="myPlot">
                        <script>
                            function learnig_rate() {
                                var xSum = 0,
                                    ySum = 0,
                                    xxSum = 0,
                                    xySum = 0;
                                var xArray = [];
                                for (var i = 1; i <= yArray.length; i++) {
                                    xArray.push(i);
                                }
                                var count = xArray.length;
                                for (var i = 0, len = count; i < count; i++) {
                                    xSum += xArray[i];
                                    ySum += yArray[i];
                                    xxSum += xArray[i] * xArray[i];
                                    xySum += xArray[i] * yArray[i];
                                }
                                var slope = (count * xySum - xSum * ySum) / (count * xxSum - xSum * xSum);
                                var intercept = (ySum / count) - (slope * xSum) / count;
                                var xValues = [];
                                var yValues = [];
                                for (var x = 0; x < xArray.length; x += 1) {
                                    xValues.push(xArray[x]);
                                    yValues.push(xArray[x] * slope + intercept);
                                }
    
                                function predict(x, slope, intercept) {
                                    var p = x * slope + intercept;
                                    return p;
                                }
                                var pre = predict(xArray.length + 1, slope, intercept);
                                let j = 20;
                                while (pre > 100) {
                                    pre = pre - j;
                                    if (j > 5) {
                                        j = j / 2;
                                    }
                                }
                                var data1 = [{
                                        x: xArray,
                                        y: yArray,
                                        mode: "markers",
                                        name: "student marks"
                                    },
                                    {
                                        x: xValues,
                                        y: yValues,
                                        mode: "line",
                                        name: "Learning curve"
                                    }
                                ];
                                // and take care of sub-"+ [yArray.indexOf(Math.min(...yArray))+1],
                                var layout = {
                                    xaxis: {
                                        range: [0, 1, 15],
                                        title: "FA's and SA's"
                                    },
                                    yaxis: {
                                        range: [0, 120],
                                        title: "percentage"
                                    },
                                    title: "Learning curve (" + pre + "- next value)",
    
                                };
    
                                Plotly.newPlot("myPlot", data1, layout);
                            }
                            var yArray = [<?= learning_curve($data, 'res_percentage', 'FA') . ',' . learning_curve($data, 'res_percentage', 'SA'); ?>];
                            learnig_rate(yArray);
                        </script>
                    </div>
                </div>
                <div class="m-5 text-center">
                    This is a Computer Generated Progress Analysis. <b>RoborosX Omni Tech Solutions LLP</b> is not Responsible for Any Mistakes.
                    <br>
                    <p>Software Designed and Developed by <a style="text-decoration: none;" href="https://starktechlabs.in">RoborosX Omni Tech Solutions LLP</a>, Bengaluru <br> Mail : <a style="text-decoration: none;" href="mailto:support@roborosx.com">support@roborosx.com</a></p>
                </div>
                <script>
                    function initCarts() {
                        <?php
                        for ($i = 1; $i < 8; $i++) {
                            echo "A" . $i . "(); \n";
                        }
                        for ($i = 1; $i < 8; $i++) {
                            echo "A2" . $i . "(); \n";
                        }
                        ?>
                        A28();
                        A29();
                    }
                    window.onload = initCarts;
                </script>
                <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
            </body>
    
            </html>
    <?php



        }
    } else {
        echo $db->conn->error;
        echo '<div class="alert alert-danger" role="alert">No data found</div>';
    }
}
