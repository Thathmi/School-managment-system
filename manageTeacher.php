<?php
session_start();

require "connection.php"; // connecting database connection file

if (isset($_SESSION["a"])) {  // checking admin is loged in 

?>
  <!DOCTYPE html>
  <html>

  <head>
    <title>Manage Teachers</title>
    <link rel="icon" href="images/logo.jpg" />
    <!--logo-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/fresh-bootstrap-table.css" rel="stylesheet" />
    <link href="demo.css" rel="stylesheet" />
    <link href="fresh-bootstrap-table.css" rel="stylesheet" />
    <link href="fresh-bootstrap-table.css.map" rel="stylesheet" />
    <!-- Fonts and icons -->
    <link href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Roboto:400,700,300" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.20.0/dist/bootstrap-table.min.css">

  </head>

  <body style="background-color:#c08081;">

    <div class="fresh-table full-color-green" style="margin-top:0px;">
      <div class="toolbar toolbar-color-azure fixed-table-header">
        <button id="alertBtn" class="btn btn-default">Back to Dashboard</button>
        <span style="width: 300px;font-size:19px;margin-left:300px;color:beige;font-weight:bold">Teacher Managment</span>
      </div>

      <div>
        <table id="fresh-table" class=" fresh-table.full-screen-table" style="overflow-y:scroll">
          <thead>
            <th style="color: wheat;">Teacher no.</th>
            <th>Name</th>
            <th>Grade Incharge</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>Gender</th>
            <th>Status</th>
            <th>Activation status</th>
            <th>delete</th>
            <th>Managae </th>

          </thead>
          <tbody>
            <?php
            // select all records from teacher table
            $sq = Database::search("SELECT * FROM `teacher`");
            $sn = $sq->num_rows; //no. of rows in resultset

            for ($rr = 0; $rr < $sn; $rr++) { //for loop will run for the no. of rows times
              $sr = $sq->fetch_assoc(); // taking one row of the resultset
              $sid = $sr["status_id"]; // assign the teacher id in that resultset into variable
              // select the status of teacher with aboue status id
              $st = Database::search("SELECT * FROM `status` WHERE `id` = '" . $sid . "'");
              $stt = $st->fetch_assoc();; // taking one row of the resultset

              $ge = $sr["gender_id"]; // assign the teacher gender in that resultset into variable
              // select the gender name of teacher with aboue gender id id
              $g = Database::search("SELECT * FROM `gender` WHERE `id`='" . $ge . "'");
              $gg = $g->fetch_assoc();; // taking one row of the resultset

              // select the activation of teacher
              $g1 = Database::search("SELECT * FROM `activation` WHERE `id`='" . $sr["activation_id"] . "'");
              $gg1 = $g1->fetch_assoc();; // taking one row of the resultset
            ?>
              <tr>
                <!-- data taken from database will inserted into table cells -->
                <td><?php echo $sr["id"]; ?></td>
                <td><?php echo $sr["fname"] . " " . $sr["lname"]; ?></td>
                <td><?php echo $sr["grade_id"]; ?></td>
                <td><?php echo $sr["email"]; ?></td>
                <td>0<?php echo $sr["mobile"]; ?></td>
                <td><?php echo $gg["name"]; ?></td>
                <td><?php echo $stt["name"]; ?></td>
                <td><?php echo $gg1["name"]; ?></td>

                <!-- when click this button, student activation will be deactive -->
                <td><button onclick='deleteTeacher(<?php echo $sr["id"] ?>);' style="background-color:#fd5e53;border:none;border-radius:8px;width:40px;height:25px"><img src="images/ui-delete.svg" alt="" style="width:18px;height:auto"></button></td>

                <?php if ($sr["activation_id"] == 1) {
                  // buton for manage teacher
                ?>
                  <td><button onclick="window.location='manageTeacherContent.php?id=<?php echo $sr['id'] ?>'" style="background-color: green;border:none;border-radius:8px;width:60px;height:25px">Manage</button></td>

                <?php
                } else {
                ?>
                  <td></td>

                <?php
                }
                ?>
              </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>

    <script src="admin.js"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table/dist/bootstrap-table.min.js"></script>
    <script src="demo.js"></script>
    <script src="jquery.sharrre.js"></script>
    <script src="gsdk-switch.js"></script>

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

        $alertBtn.click(function() {
          window.location = "adminHomePage.php";
        })
      })
    </script>
  </body>

  </html>
<?php
} else {
?>
  <script>
    window.location = "admin_login.php";
  </script>
<?Php
}
?>