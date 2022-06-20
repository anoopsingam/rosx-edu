<?php

class includes
{
    public static function barcodeJs()
    {
        echo "<script src='".url::myurl().'/web_assets/brcd.js'."'></script>";
    }

    public static function insertJS(string $url){
        echo "<script src='".url::myurl().'/assets/js/'.$url."'></script>";
    }


    public static function barcode(string $id = '', string $display = 'true', string $size = '50')
    {
        echo '<img src="'.url::myurl().'/barcode/'.$size.'/'.$id.'/'.$display.'" alt="'.$id.'">';
    }

    public static function css()
    {
        $files = [
            'nucleo-icons.css',
            'nucleo-svg.css',
            'soft-ui-dashboard.min.css?v=1.0.8',
            'bt_picker.css',
        ];
        foreach ($files as $file) {
            echo "<link rel='stylesheet' href='".url::myurl().'/assets/css/'.$file."'>\n";
        }
        echo "<script src='".url::myurl().'/assets/js/plugins/Bt_picker.js'."'></script>\n";
    }

    public static function LoginCss()
    {
        $files = [
            'nucleo-icons.css',
            'nucleo-svg.css',
            'soft-ui-dashboard.min.css?v=1.0.8',
        ];
        foreach ($files as $file) {
            echo "<link rel='stylesheet' href='".url::myurl().'/assets/css/'.$file."'>";
        }
        echo' <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>';
    }

    public static function LoginJs()
    {
        $files = [
            'core/popper.min.js',
            'core/bootstrap.min.js',
            'plugins/perfect-scrollbar.min.js',
            'plugins/smooth-scrollbar.min.js',
            'plugins/dragula/dragula.min.js',
            'plugins/jkanban/jkanban.js',
            'soft-ui-dashboard.min.js?v=1.0.8',
        ];
        foreach ($files as $file) {
            echo "<script src='".url::myurl().'/assets/js/'.$file."'></script>\n";
        }
    }

    public static function js()
    {
        $files = [
           'core/popper.min.js',
           'core/bootstrap.min.js',
           'plugins/perfect-scrollbar.min.js',
           'plugins/smooth-scrollbar.min.js',
           'plugins/dragula/dragula.min.js',
           'plugins/jkanban/jkanban.js',
           'plugins/threejs.js',
           'plugins/orbit-controls.js',
        ];
        foreach ($files as $file) {
            echo "<script src='".url::myurl().'/assets/js/'.$file."'></script>\n";
        }
    }

    //datalist
    public static function DataList()
    {
        echo '<datalist id="student_id">';
        $db = new database();
        $conn = $db->conn;
        $sql = 'SELECT * FROM student_enrollment WHERE status="APPROVED" ';
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<option value='".$row['studentid']."'>".$row['student_name'].'-'.$row['usn'].'</option>';
            }
        }
        echo '</datalist>';
    }

    public static function Datatables(string $title, string $ex_exp, string $ornt)
    {
        $ort = (empty($ornt)) ? 'portrait' : $ornt;
        $cin = new app();
        $shn = $cin->name;
        echo '
        <link rel="stylesheet" type="text/css" href="'.url::myurl().'/web_assets/datatables/tables.css">
        <link rel="stylesheet" type="text/css" href="'.url::myurl().'/web_assets/datatables/button.css">
        <script type="text/javascript" language="javascript" src="'.url::myurl().'/web_assets/datatables/jquery.js"></script>
        <script type="text/javascript" language="javascript" src="'.url::myurl().'/web_assets/datatables/jquery2.js"></script>
        <script type="text/javascript" language="javascript" src="'.url::myurl().'/web_assets/datatables/Buttons.js"></script>
        <script type="text/javascript" language="javascript" src="'.url::myurl().'/web_assets/datatables/jszip.js"></script>
        <script type="text/javascript" language="javascript" src="'.url::myurl().'/web_assets/datatables/pdfmake.js"></script>
        <script type="text/javascript" language="javascript" src="'.url::myurl().'/web_assets/datatables/pdfmakeF.js"></script>
        <script type="text/javascript" language="javascript" src="'.url::myurl().'/web_assets/datatables/exportBt.js"></script>
        <script type="text/javascript" language="javascript" src="'.url::myurl().'/web_assets/datatables/print.js"></script>';
        echo "<script>$(document).ready(function() {
            $('#example').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        className: 'badge bg-success',
                        text: 'Excel',
                        title: '$shn $title',
                        footer: true,
                        exportOptions: {
                            columns: [ $ex_exp ]
                        },
                    }, {
                        extend: 'pdfHtml5',
                        className: 'badge bg-danger',
                        text: 'Pdf',
                        title: '$shn $title',
                        orientation: '$ort',
                        footer: true,
                        exportOptions: {
                            columns: [ $ex_exp ]
                        },
                    },
                    {
                        extend: 'print',
                        className: 'badge bg-warning',
                        text: 'Print',
                        title: '$shn $title',
                        footer: true,
                        orientation: '$ort',
                        exportOptions: {
                            columns: [ $ex_exp ]
                        },
                    },
                    {
                        extend: 'csvHtml5',
                        className: 'badge bg-info',
                        text: 'Csv',
                        title: '$shn $title',
                        footer: true,
                        exportOptions: {
                            columns: [ $ex_exp ]
                        },
                    },
                    {
                        extend: 'copyHtml5',
                        className: 'badge bg-secondary',
                        text: 'Copy',
                        title: '$title',
                        footer: true,
                    },
                ]
            });
        });</script>";
    }
}
