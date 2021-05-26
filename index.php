<?php
require 'server.php';
require 'server_lock.php';

$current_page = 'index';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
  <title>Dashboard</title>

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
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
          </div>

          <div class="row">
            <div class="col-md-8">
              <div class="row">
                <div class="col-md">
                  <div class="card shadow mb-4">
                    <div class="card-header py-3">
                      <h6 class="m-0 font-weight-bold text-danger">Announcement</h6>
                    </div>
                    <div class="card-body">
                      <p>Hello everyone!
                        <br><br>
                        This is a demonstration for XpoStream website. Viewers can watch the strem. Hosts can create the streams.
                        <br><br>
                        This is just a rough quick demo to share the idea of our system.
                      </p>
                    </div>
                  </div>
                </div>
                <div class="col-md">
                  <div class="card shadow mb-4">
                    <div class="card-header py-3">
                      <h6 class="m-0 font-weight-bold text-danger">Events Subscription</h6>
                    </div>
                    <div class="card-body">
                      <ul class="list-group">
                        <?php
                        $sql = "SELECT hs.stream_id, hs.stream_name FROM stream_subscriptions ss JOIN host_streams hs ON ss.stream_id = hs.stream_id WHERE ss.user_id = " . $_SESSION['user_id'];
                        $result = runSQLCommand($sql);
                        while ($row = $result->fetch_assoc()) {
                          $id = $row['stream_id'];
                          $name = $row['stream_name'];
                          echo "<li><a href='view_stream.php?id=$id'>$name</a></li>";
                        }
                        ?>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>

            </div>
            <div class="col-md-4">

              <div class="row mb-3">
                <div class="col">
                  <div class="card shadow mb-4">
                    <div class="card-header py-3">
                      <h6 class="m-0 font-weight-bold text-danger">Host Subscriptions</h6>
                    </div>
                    <div class="card-body">
                      <ul class="list-group">
                        <?php
                        $sql = "SELECT host_user_id FROM host_subscribers WHERE subscribed_user_id = " . $_SESSION['user_id'];
                        $result = runSQLCommand($sql);
                        while ($row = $result->fetch_assoc()) {
                          $id = $row['host_user_id'];
                          $sql2 = "SELECT * FROM users_list WHERE user_id = " . $id;
                          $result2 = runSQLCommand($sql2);
                          $row2 = $result2->fetch_assoc();
                          $name = $row2['name'];
                          echo "<li><a href='profile.php?id=$id'>$name</a></li>";
                        }
                        ?>
                      </ul>
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