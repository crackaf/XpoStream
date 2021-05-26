<?php
require 'server.php';
require 'server_lock.php';

$current_page = 'view_subscribers';

$id1 = $conn->real_escape_string($_GET['id'] ?? '');
$id2 = $_SESSION['user_id'];

if ($id1 != $id2) {
  die('Invalid');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
  <title>View Host Subscribers</title>

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
            <h1 class="h3 mb-0 text-gray-800">View Host Subscribers (<?= $_SESSION['name'] ?>)</h1>
          </div>
          <!-- Content Row -->
          <div class="row">
            <div class="col">
              <!-- Collapsable Card Example -->
              <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCard" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCard">
                  <h6 class="m-0 font-weight-bold text-danger">Subscribers List</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCard">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Type</th>
                          </tr>
                        </thead>
                        <tfoot>
                          <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Type</th>
                          </tr>
                        </tfoot>
                        <tbody>
                          <?php
                          $sql2 = "SELECT ul.name, ul.email, ul.reg_type FROM host_subscribers hs JOIN users_list ul ON hs.subscribed_user_id = ul.user_id WHERE hs.host_user_id = $id1";
                          $result2 = runSQLCommand($sql2);
                          while ($row2 = $result2->fetch_assoc()) {
                            $name = $row2['name'];
                            $email = $row2['email'];
                            $type = $row2['reg_type'];

                            echo "<tr> <td>$name</td> <td>$email</td> <td>$type</td></tr>";
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