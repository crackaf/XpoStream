<?php
include_once 'server.php';
session_start();

$redirect_url = BASE_URL;

$is_login = false;
$error_message = "Incorrect login credentials.";

if (isset($_SESSION['user_id'])) {
  $is_login = true;
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = $conn->real_escape_string($_POST['email'] ?? null);
  $pass = $conn->real_escape_string($_POST['password'] ?? null);

  if (!empty($email) && !empty($pass)) {
    $sql = "SELECT * FROM users_list WHERE (email = '$email') AND password = '$pass'";
    $result = runSQLCommand($sql);
    if ($result->num_rows == 1) {
      $row = $result->fetch_assoc();
      foreach ($row as $key => $value) {
        $_SESSION[$key] = $value;
      }
      $is_login = true;
    }
  };
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">

  <title>Login</title>

  <link rel="stylesheet" href="resource/css/bootstrap.min.css">
  <script src="resource/js/jquery-3.5.1.slim.min.js"></script>
  <script src="resource/js/bootstrap.bundle.min.js"></script>

  <style>
    html,
    body {
      height: 100%;
    }

    body {
      display: -ms-flexbox;
      display: -webkit-box;
      display: flex;
      -ms-flex-align: center;
      -ms-flex-pack: center;
      -webkit-box-align: center;
      align-items: center;
      -webkit-box-pack: center;
      justify-content: center;
      padding-top: 40px;
      padding-bottom: 40px;
      background-color: #f5f5f5;
    }

    .form-signin {
      width: 100%;
      max-width: 330px;
      padding: 15px;
      margin: 0 auto;
    }

    .form-signin .checkbox {
      font-weight: 400;
    }

    .form-signin .form-control {
      position: relative;
      box-sizing: border-box;
      height: auto;
      padding: 10px;
      font-size: 16px;
    }

    .form-signin .form-control:focus {
      z-index: 2;
    }

    .form-signin input[type="email"] {
      margin-bottom: -1px;
      border-bottom-right-radius: 0;
      border-bottom-left-radius: 0;
    }

    .form-signin input[type="password"] {
      margin-bottom: 10px;
      border-top-left-radius: 0;
      border-top-right-radius: 0;
    }
  </style>
</head>

<body class="text-center">
  <?php if (!$is_login) { ?>
    <form class="form-signin" action="" method="post">
      <img class="mb-4 rounded-circle" src="resource/img/hayasaka.webp" alt="" width="132" height="auto">

      <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' and !$is_login) { ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Error!</strong> <?= $error_message ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php } ?>

      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
      <div class="form-group">
        <label for="inputEmail" class="sr-only">Email address</label>
        <input name="email" type="text" id="inputEmail" class="form-control" placeholder="Email address or username" pattern="[^\s]+" required autofocus>
      </div>
      <div class="form-group">
        <label for="inputPassword" class="sr-only">Password</label>
        <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" pattern="[^\s]+" required>
      </div>
      <div class="form-group">
        <div class="checkbox mb-3">
          <label>
            <a href="register.php">Register</a>
          </label>
        </div>
      </div>
      <button class="btn btn-lg btn-danger btn-block" type="submit">Sign in</button>
      <p class="mt-5 mb-3 text-muted">© 2021 XpoStream All Rights Reserved</p>
    </form>
  <?php } else { ?>
    <form class="form-signin">
      <img class="mb-4 rounded-circle" src="resource/img/hayasaka.webp" alt="" width="132" height="auto">

      <h1 class="h3 mb-3 font-weight-normal">Loading</h1>
      <div class="form-group">
        <div class="spinner-border text-danger" role="status">
          <span class="sr-only">Loading...</span>
        </div>
      </div>

      <p class="mt-5 mb-3 text-muted">© 2021 XpoStream All Rights Reserved</p>
    </form>

    <script>
      setTimeout(function() {
        window.location = "<?= $redirect_url ?>";
      }, 2000);
    </script>
  <?php } ?>
</body>

</html>