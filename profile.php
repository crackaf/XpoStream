<?php
require 'server.php';
require 'server_lock.php';

$current_page = 'profile';

$profile_id = $conn->real_escape_string($_GET['id'] ?? '');
if ($profile_id == '') die('Error');
$sql = "SELECT * FROM users_list WHERE reg_type = 'host' AND user_id = $profile_id";
$result = runSQLCommand($sql);
if ($result->num_rows == 0) {
  die('Invalid.');
};
$profile_row = $result->fetch_assoc();

$id1 = $profile_row['user_id'];
$id2 = $_SESSION['user_id'];

$is_subscribed = false;
if ($id1 != $id2) {
  $sql = "SELECT * FROM host_subscribers WHERE host_user_id = $id1 AND subscribed_user_id = $id2";
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
  <title>Profile</title>

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
            <h1 class="h3 mb-0 text-gray-800">Profile (<?= $profile_row['name'] ?>)</h1>
            <?php if ($id1 != $id2) { ?>
              <?php if (!$is_subscribed) { ?>
                <a href="subscribe.php?id=<?= $id1 ?>" type="button" class="btn btn-danger btn-sm">Subscribe</a>
              <?php } else { ?>
                <a href="unsubscribe.php?id=<?= $id1 ?>" type="button" class="btn btn-danger btn-sm">Unsubscribe</a>
              <?php };
            } else { ?>
              <a href="view_subscribers.php?id=<?= $id2 ?>" type="button" class="btn btn-danger btn-sm">View Subscribers</a>
            <?php }; ?>
          </div>
          <!-- Content Row -->
          <div class="row">
            <div class="col">
              <!-- Collapsable Card Example -->
              <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCard" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCard">
                  <h6 class="m-0 font-weight-bold text-danger">Streams List</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCard">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Time</th>
                            <th>Type</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tfoot>
                          <tr>
                            <th>Name</th>
                            <th>Time</th>
                            <th>Type</th>
                            <th>Action</th>
                          </tr>
                        </tfoot>
                        <tbody>
                          <?php
                          $sql2 = "SELECT * FROM host_streams hs JOIN stream_slots ss ON ss.slot_id = hs.stream_slot JOIN users_list ul ON ul.user_id = hs.user_id ORDER BY ss.timestamp DESC";
                          $result2 = runSQLCommand($sql2);
                          while ($row2 = $result2->fetch_assoc()) {
                            $id = $row2['stream_id'];
                            $type = $row2['stream_type'];
                            $streamName = $row2['stream_name'];
                            $time = $row2['timestamp'];

                            echo "<tr> <td>$streamName</td> <td>$time</td> <td>$type</td>";

                            if ($type == 'paid' and $row2['user_id'] != $_SESSION['user_id']) {
                              echo "<td><a href='#' type='button' class='btn btn-danger btn-sm'>Purchase Ticket</a></td>";
                            } else {
                              echo "<td><a href='view_stream.php?id=$id' type='button' class='btn btn-danger btn-sm'>View Stream</a></td>";
                            }

                            echo "</tr>";
                          }
                          ?>
                        </tbody>
                      </table>
                    </div>
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