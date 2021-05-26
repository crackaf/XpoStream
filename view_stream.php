<?php
require 'server.php';
require 'server_lock.php';

$current_page = 'view_stream';

$stream_id = $conn->real_escape_string($_GET['id'] ?? '');
if ($stream_id == '') die('Error');
$sql = "SELECT * FROM host_streams WHERE stream_id = $stream_id";
$result = runSQLCommand($sql);
if ($result->num_rows == 0) {
  die('Invalid.');
};
$stream_row = $result->fetch_assoc();

$id1 = $stream_row['user_id'];
$id2 = $_SESSION['user_id'];
$is_subscribed = false;
if ($id1 != $id2) {
  $sql = "SELECT * FROM stream_subscriptions WHERE stream_id = $stream_id AND user_id = $id2";
  $result = runSQLCommand($sql);
  if ($result->num_rows > 0) {
    $is_subscribed = true;
  };
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
  <title>View Stream</title>

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
            <h1 class="h3 mb-0 text-gray-800">Viewing Stream</h1>
          </div>

          <div class="row">
            <div class="col-md-8">

              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-danger"><?= strtoupper($stream_row['stream_name']) ?></h6>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>Slot</th>
                          <th>Type</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th>Slot</th>
                          <th>Type</th>
                        </tr>
                      </tfoot>
                      <tbody>
                        <td><?= $stream_row['stream_slot'] ?></td>
                        <td><?= $stream_row['stream_type'] ?></td>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-danger">Functions</h6>
                </div>
                <div class="card-body">
                  <button type="button" class="btn btn-default btn-sm w-100 bg-danger mb-3" onclick="delete_btn_click(this)">
                    <?php if ($id1 != $id2) { ?>
                      <?php if (!$is_subscribed) { ?>
                        <a href="subscribe_stream.php?id=<?= $id1 ?>" type="button" class="btn btn-danger btn-sm">Subscribe</a>
                      <?php } else { ?>
                        <a href="unsubscribe_stream.php?id=<?= $id1 ?>" type="button" class="btn btn-danger btn-sm">Unsubscribe</a>
                      <?php };
                    } else { ?>
                      <a href="view_subscribers_event.php?id=<?= $stream_id ?>" type="button" class="btn btn-danger btn-sm">View Subscriptions</a>
                    <?php }; ?>
                  </button>
                </div>
              </div>
            </div>
          </div>


          <div class="row">

            <div class="col-md-6">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-danger">Video Player</h6>
                </div>
                <div class="card-body">
                  <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="<?= $stream_row['stream_link'] ?>" allowfullscreen></iframe>
                  </div>
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