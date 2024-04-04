<?php
session_start();

require "connection.php"; // connecting database connection file

if (isset($_SESSION["a"])) {  // checking admin is loged in 
?>
  <!DOCTYPE html>
  <html>

  <head>
    <title>Manage Academic officers</title>
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

  <body style="background-color: #3ab09e;">

    <div class="fresh-table full-color-orange" style="margin-top:0px;">

      <div class="toolbar toolbar-color-azure fixed-table-header">
        <button id="alertBtn" class="btn btn-default">Back to Dashboard</button>
        <span style="width: 300px;font-size:19px;margin-left:300px;color:beige;font-weight:bold"> Academic oficerManagment</span>
      </div>

      <div>
        <table id="fresh-table" class=" fresh-table.full-screen-table" style="overflow-y:scroll">
          <thead>
            <th style="color: wheat;">No.</th>
            <th>Name</th>
            <th>Task</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>Gender</th>
            <th>Status</th>
            <th>Activation status</th>
            <th>delete</th>
          </thead>
          <tbody>
            <?php
            // select all records from  ac_officer table
            $sq = Database::search("SELECT * FROM `ac_officer` ");
            $sn = $sq->num_rows; //no. of rows in resultset

            for ($rr = 0; $rr < $sn; $rr++) { //for loop will run for the no. of rows times
              $sr = $sq->fetch_assoc(); // taking one row of the resultset

              $sid = $sr["status_id"]; // assign the  officer id in that resultset into variable
              // select the status of  officer with aboue status id
              $st = Database::search("SELECT * FROM `status` WHERE `id` = '" . $sid . "'");
              $stt = $st->fetch_assoc();; // taking one row of the resultset

              $ge = $sr["gender_id"]; // assign the  officer gender in that resultset into variable
              // select the gender name of  officer with aboue gender id id
              $g = Database::search("SELECT * FROM `gender` WHERE `id`='" . $ge . "'");
              $gg = $g->fetch_assoc();; // taking one row of the resultset

              // select the activation of  officer
              $g1 = Database::search("SELECT * FROM `activation` WHERE `id`='" . $sr["activation_id"] . "'");
              $gg1 = $g1->fetch_assoc();; // taking one row of the resultset
            ?>
              <tr>
                <!-- data taken from database will inserted into table cells -->
                <td><?php echo $sr["id"]; ?></td>
                <td><?php echo $sr["fname"] . " " . $sr["lname"]; ?></td>

                <?php
                // search the task for relevant officer
                $t = Database::search("SELECT `task` FROM `ac_task` WHERE `id` = (SELECT `task_id` FROM `ac_has_task` WHERE `ac_id`='" . $sr["id"] . "');");
                $tn = $t->num_rows;
                if ($tn == 0) { // if there is no task for officer
                ?>
                  <td>-</td>
                <?php
                } else { //if there is a task for officer
                  $tr = $t->fetch_assoc();
                ?>
                  <td><?php echo $tr["task"]; ?></td>
                <?php
                }

                ?>
                <td><?php echo $sr["email"]; ?></td>
                <td>0<?php echo $sr["mobile"]; ?></td>
                <td><?php echo $gg["name"]; ?></td>
                <td><?php echo $stt["name"]; ?></td>
                <td><?php echo $gg1["name"]; ?></td>

                <!-- when click this button, officer activation will be deactive -->
                <td><button onclick='deleteAc(<?php echo $sr["id"] ?>);' style="background-color:#fd5e53;border:none;border-radius:8px;width:40px;height:25px"><img src="images/ui-delete.svg" alt="" style="width:18px;height:auto"></button></td>
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