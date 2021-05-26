<?php
require 'server.php';
require 'server_lock.php';

$current_page = 'create_stream';

if ($_SESSION['reg_type'] != 'host') {
  die('Access Restricted');
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_SESSION['user_id'];
  $name = $conn->real_escape_string($_POST['name'] ?? null);
  $slot = $conn->real_escape_string($_POST['slot_id'] ?? null);
  $type = $conn->real_escape_string($_POST['type'] ?? null);
  $link = $conn->real_escape_string($_POST['link'] ?? null);

  $sql = "SELECT * FROM stream_slots WHERE slot_id = $slot";
  $result = runSQLCommand($sql);
  if ($result->num_rows == 1) {
    $sql = "SELECT * FROM host_streams WHERE stream_slot = $slot";
    $result = runSQLCommand($sql);
    if ($result->num_rows == 1) {
      $error = 'Stream slot id has been used by someoene else already.';
    } else {
      $sql = "INSERT INTO host_streams(user_id,stream_name,stream_link,stream_slot,stream_type) VALUES($id,'$name','$link',$slot,'$type')";
      runSQLCommand($sql);
    };
  } else {
    $error = 'Stream slot id is invalid and does not exist in the database.';
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
  <title>Create Stream</title>

  <!-- Custom fonts for this template-->
  <?php include 'module/theme_files.php'; ?>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <?php include 'module/nav_sidebar.php'; ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <?php include 'module/nav_topbar.php'; ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Create Stream</h1>
          </div>

          <?php
          if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($error)) {
              echo "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
  <strong>Success!</strong> Your stream has been created.
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
    <span aria-hidden=\"true\">&times;</span>
  </button>
</div>";
            } else {
              echo "<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">
  <strong>Error!</strong> $error
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
    <span aria-hidden=\"true\">&times;</span>
  </button>
</div>";
            }
          }
          ?>

          <div class="row">

            <div class="col-md-9">
              <!-- Table Starts -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-danger">Create Stream</h6>
                </div>
                <div class="card-body table-responsive">
                  <form action="" method="post">
                    <!-- Name  -->
                    <div class="form-group">
                      <label for="inputFullName">Stream Name</label>
                      <input name="name" type="text" id="inputFullName" class="form-control" required>
                    </div>

                    <!-- Slot  -->
                    <div class="form-group">
                      <label for="inputSlot">Stream Slot ID</label>
                      <input name="slot_id" type="number" id="inputSlot" class="form-control" required>
                    </div>

                    <!-- Type -->
                    <div class="form-group">
                      <label for="inputType">Stream Type</label><br>
                      <input type="radio" id="free" name="type" value="free" <?php if (strtolower($_SESSION['type'] ?? '') == 'free') echo 'checked'; ?>>
                      <label for="free">Free</label><br>
                      <input type="radio" id="paid" name="type" value="paid" <?php if (strtolower($_SESSION['type'] ?? '') == 'paid') echo 'checked'; ?>>
                      <label for="paid">Paid</label><br>

                    </div>

                    <!-- Stream Link  -->
                    <div class="form-group">
                      <label for="inputlink">Stream Link</label>
                      <input name="link" type="url" id="inputlink" class="form-control" pattern="[^\s]+">
                    </div>

                    <button type="submit" class="btn btn-danger btn-block">Submit</button>
                  </form>
                </div>
              </div>
              <!-- Table Ends -->
            </div>

            <div class="col-md-3">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-danger">Free Slots</h6>
                </div>
                <div class="card-body">
                  <?php
                  $sql = "SELECT * FROM stream_slots ss WHERE ss.slot_id NOT IN (SELECT stream_slot FROM host_streams WHERE stream_slot = ss.slot_id)";
                  $result = runSQLCommand($sql);
                  while ($row = $result->fetch_assoc()) {
                    $id = $row['slot_id'];
                    $time = $row['timestamp'];
                    echo "<li>Slot ID: $id<br>Slot Time: $time</a></li>";
                  }
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php include 'module/page_footer.php'; ?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <?php include 'module/theme_files_bottom.php' ?>
</body>

</html>