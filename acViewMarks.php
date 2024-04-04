<!-- academic officer views marks -->

<?php
session_start();
require "connection.php"; //connecting the dtabase connection file

if (isset($_SESSION["ac"])) { //chech officer is lohhed in

$aid = $_GET["aid"]; //assign the assignment id comint from viewMarks.php file throught GET method to a variable

?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Marks page</title>
        <!-- Style -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet" />
        <link href="assets/css/fresh-bootstrap-table.css" rel="stylesheet" />
        <link rel="icon" href="images/logo.jpg" /> <!--logo-->
        <link href="mainPage.css" rel="stylesheet" />
        <link href="demo.css" rel="stylesheet" />
        <link href="fresh-bootstrap-table.css" rel="stylesheet" />
        <link href="fresh-bootstrap-table.css.map" rel="stylesheet" />
        <!-- Fonts and icons -->
        <link href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" rel="stylesheet">
        <link href="http://fonts.googleapis.com/css?family=Roboto:400,700,300" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.20.0/dist/bootstrap-table.min.css">
    </head>

    <body style="background-color: #bc8f8f;">
        <div id="wish"></div>
        <div class="fresh-table full-color-red" style="margin-top:0px;">
            <div class="toolbar toolbar-color-red fixed-table-header">
                <button  onclick="window.location='viewMarks.php'" id="alertBtn" class="btn btn-default">Back</button>
            </div>
            <div>
                <table id="fresh-table" class=" fresh-table.full-screen-table" style="overflow-y:scroll">
                    <thead>
                        <th>#</th>
                        <th>Student Index No.</th>
                        <th>Student Name</th>
                        <th>Marks</th>
                    </thead>
                    <tbody style="font-size: 16px;">
                        <!-- search for assigment marks sent by teacher -->
                        <?php
                        // select all marks relevant to given asignment id
                        $sq = Database::search("SELECT * FROM `marks` WHERE `assigments_id`='" . $aid. "'");
                        $sn = $sq->num_rows; //no. of rows in resultset

                        for ($rr = 0; $rr < $sn; $rr++) {
                            $sr = $sq->fetch_assoc();
                        //   select the students which are active and relevant to selected marks
                            $g = Database::search("SELECT * FROM `student` WHERE `id`='" . $sr["student_id"] . "' AND `activation_id`='1'");
                            $gg = $g->fetch_assoc();
                        ?>
                            <tr>
                                <!--add row number-->
                                <td><?php echo $rr + 1 ?></td>
                                <!--add assigment id from database-->
                                <td><?php echo $gg["id"]; ?></td>
                                <!--add student name from database-->
                                <td><?php echo $gg["fname"] . " " . $gg["lname"]; ?></td>
                                <!-- add marks for the relevant student -->
                                <td><?php echo $sr["marks"]; ?>%</td>
                            </tr>
                        <?php
                        }
                        ?>

                    </tbody>
                </table>
            </div>
            <!-- when click the button , sendAnswer function will run. when click it send the assigment id to the function -->
            <button style="background-color: red;color:white;border:none;border-radius:8px;margin-left:20px" onclick="sendAnswer(<?php echo $aid?>);" style="background-color: yellowgreen;">Release marks to students</button>
        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="https://unpkg.com/bootstrap-table/dist/bootstrap-table.min.js"></script>
        <script src="demo.js"></script>
        <script src="jquery.sharrre.js"></script>
        <script src="gsdk-switch.js"></script>
        <script src="acOfficer.js"></script>

        <script type="text/javascript">
            var $table = $('#fresh-table')
            var $alertBtn = $('#alertBtn')

            window.operateEvents = {
                'click .like': function(e, value, row, index) {
                    alert('You click like icon, row: ' + JSON.stringify(row))
                    console.log(value, row, index)
                },
                'click .edit': function(e, value, row, index) {
                    alert('You click edit icon, row: ' + JSON.stringify(row))
                    console.log(value, row, index)
                },
                'click .remove': function(e, value, row, index) {
                    $table.bootstrapTable('remove', {
                        field: 'id',
                        values: [row.id]
                    })
                }
            }

            function operateFormatter(value, row, index) {
                return [
                    '<a rel="tooltip" title="Like" class="table-action like" href="javascript:void(0)" title="Like">',
                    '<i class="fa fa-heart"></i>',
                    '</a>',
                    '<a rel="tooltip" title="Edit" class="table-action edit" href="javascript:void(0)" title="Edit">',
                    '<i class="fa fa-edit"></i>',
                    '</a>',
                    '<a rel="tooltip" title="Remove" class="table-action remove" href="javascript:void(0)" title="Remove">',
                    '<i class="fa fa-remove"></i>',
                    '</a>'
                ].join('')
            }

            $(function() {
                $table.bootstrapTable({
                    classes: 'table table-hover table-striped',
                    toolbar: '.toolbar',

                    search: true,
                    showRefresh: true,
                    showToggle: true,
                    showColumns: true,
                    pagination: true,
                    striped: true,
                    sortable: true,
                    pageSize: 8,
                    pageList: [8, 10, 25, 50, 100],

                    formatShowingRows: function(pageFrom, pageTo, totalRows) {
                        return ''
                    },
                    formatRecordsPerPage: function(pageNumber) {
                        return pageNumber + ' rows visible'
                    }
                })

               
            })
        </script>
    </body>

    </html>
<?php
} else {
?>
    <script>
        window.location = "academic_officer_login.php";
    </script>
<?Php
}
?>