<?php
session_start();
include('includes/config.php');
$dbh = DBConnectionFactory::createConnection();
error_reporting(0);
if (isset($_POST['signin'])) {
  $uname = $_POST['emailmbile'];
  $password = $_POST['password'];
  $sql = "SELECT id,FullName,Password FROM tbljobseekers WHERE (EmailId=:usname || ContactNumber=:usname)";
  $query = $dbh->prepare($sql);
  $query->bindParam(':usname', $uname, PDO::PARAM_STR);
  $query->execute();
  $results = $query->fetchAll(PDO::FETCH_OBJ);
  if ($query->rowCount() > 0) {
    foreach ($results as $row) {
      $dbhashpass = $row->Password;
      $_SESSION['jsid'] = $row->id;
      $_SESSION['jsfname'] = $row->FullName;
    }
    if (password_verify($password, $dbhashpass)) {
      echo "<script type='text/javascript'> document.location ='my-profile.php'; </script>";
    } else {
      echo "<script>alert('Fjalëkalimi gabim!');</script>";
    }
  } else {
    echo "<script>alert('Punëkërkuesi nuk është i regjisturar');</script>";
  }
}
?>
<!doctype html>
<html>

<head>
  <title>Punëkërkuesi SignIn | WorkNet</title>

  <link href="css/custom.css" rel="stylesheet" type="text/css">
  <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
  <link href="css/color.css" rel="stylesheet" type="text/css">
  <link href="css/responsive.css" rel="stylesheet" type="text/css">
  <link href="css/owl.carousel.css" rel="stylesheet" type="text/css">
  <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,300italic,500,700,900' rel='stylesheet'
    type='text/css'>
</head>

<body class="theme-style-1">
  <div id="wrapper">
    <?php include('includes/header.php'); ?>
    <section id="inner-banner">
      <div class="container">
        <h1>Kyçu në llogari!</h1>
      </div>
    </section>
    <div id="main">
      <section class="signup-section">
        <div class="container">
          <div class="holder">
            <div class="thumb"><img src="images/account.png" alt="img"></div>
            <form method="post" name="emplsignin">
              <div class="input-box"> <i class="fa fa-user"></i>
                <input type="text" placeholder="Email" name="emailmbile" autocomplete="off" required>
              </div>
              <div class="input-box"> <i class="fa fa-unlock"></i>
                <input type="password" class="form-control" name="password" required placeholder="Fjalëkalimi">
              </div>
              <div class="input-box">
                <input type="submit" value="Kyçu" name="signin">
              </div>
              <a href="#" class="login">Keni harruar fjalëkalimin?</a>
              <div class="login-social">
                <em>Nuk keni llogari? <a href="sign-up.php">regjisturohuni tani!</a></em>
              </div>
            </form>
            <a href="index.php"><i class="fa fa-home" aria-hidden="true" style="font-size: 30px;padding-top: 10px"></i>
              Faqja kryesore!</a>
          </div>
        </div>
      </section>
    </div>
    <?php include('includes/footer.php'); ?>
  </div>
  <script src="js/jquery-1.11.3.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.velocity.min.js"></script>
  <script src="js/jquery.kenburnsy.js"></script>
  <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
  <script src="js/jquery.noconflict.js"></script>
  <script src="js/theme-scripts.js"></script>
  <script src="js/form.js"></script>
  <script src="js/custom.js"></script>
</body>

</html>