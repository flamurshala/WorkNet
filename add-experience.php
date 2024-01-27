<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['jsid']) == 0) {
  header('location:logout.php');
} else {
  if (isset($_POST['submit'])) {
    $employername = $_POST['employername'];
    $toe = $_POST['toe'];
    $desi = $_POST['designation'];
    $ctc = $_POST['ctc'];
    $fdate = $_POST['fdate'];
    $tdate = $_POST['tdate'];
    $skills = $_POST['skills'];
    $uid = $_SESSION['jsid'];
    $sql = "insert into tblexperience(UserID,EmployerName,EmployementType,Designation,Ctc,FromDate,ToDate)values(:uid,:employername,:toe,:desi,:ctc,:fdate,:tdate)";
    $query = $dbh->prepare($sql);

    $query->bindParam(':employername', $employername, PDO::PARAM_STR);
    $query->bindParam(':uid', $uid, PDO::PARAM_STR);
    $query->bindParam(':toe', $toe, PDO::PARAM_STR);
    $query->bindParam(':desi', $desi, PDO::PARAM_STR);
    $query->bindParam(':ctc', $ctc, PDO::PARAM_STR);
    $query->bindParam(':fdate', $fdate, PDO::PARAM_STR);
    $query->bindParam(':tdate', $tdate, PDO::PARAM_STR);

    $query->execute();

    $LastInsertId = $dbh->lastInsertId();
    if ($LastInsertId > 0) {
      echo '<script>alert("Eksperienca u shtua.")</script>';
      echo "<script>window.location.href ='my-profile.php'</script>";
    } else {
      echo '<script>alert("Diqka shkoj keq. Te lutem provo perseri")</script>';
    }
  }
  ?>
  <!doctype html>
  <html>

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>punekerkuesi | Shto eksperencen</title>
    <link href="css/custom.css" rel="stylesheet" type="text/css">
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="css/color.css" rel="stylesheet" type="text/css">
    <link href="css/responsive.css" rel="stylesheet" type="text/css">
    <link href="css/owl.carousel.css" rel="stylesheet" type="text/css">
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="css/editor.css" type="text/css" rel="stylesheet" />
    <link href="css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,300italic,500,700,900' rel='stylesheet'
      type='text/css'>
    <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
    <script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
  </head>

  <body class="theme-style-1">
    <div id="wrapper">
      <?php include('includes/header.php'); ?>
      <section id="inner-banner">
        <div class="container">
          <h1>Detajet e eksperiences se punëkërkuesit</h1>
        </div>
      </section>

      <div id="main">
        <form name="" enctype="multipart/form-data" method="post">
          <section class="resum-form padd-tb">
            <div class="container">
              <?php if (@$error) { ?>
                <div class="errorWrap">
                  <strong>ERROR</strong> :
                  <?php echo htmlentities($error); ?>
                </div>
              <?php } ?>

              <?php if (@$msg) { ?>
                <div class="succMsg">
                  <strong>Success</strong> :
                  <?php echo htmlentities($msg); ?>
                </div>
              <?php } ?>

              <div class="row">
                <div class="col-md-6 col-sm-6">
                  <label>Emri punëdhënësit </label>
                  <input type="text" name="employername" required="true" autocomplete="off" value="" class="form-control">
                </div>

                <div class="col-md-6 col-sm-6">
                  <label>Lloji i punës</label>
                  <input type="text" name="toe" required="true" autocomplete="off" value="" class="form-control">
                </div>

                <div class="col-md-6 col-sm-6">
                  <label>Pozita</label>
                  <input type="text" name="designation" autocomplete="off" value="" required="true" class="form-control">
                  <label>Paga për muaj</label>
                  <input type="text" name="ctc" autocomplete="off" placeholder="Enter CTC" value="" class="form-control"
                    pattern="[0-9]+">
                </div>

                <div class="col-md-6 col-sm-6">
                  <label>Nga data</label>
                  <input type="date" name="fdate" autocomplete="off" value="" class="form-control">
                </div>

                <div class="col-md-6 col-sm-6">
                  <label>Deri me datë</label>
                  <input type="date" name="tdate" autocomplete="off" value="" class="form-control">
                </div>
              </div>
              <div class="col-md-12">
                <div class="btn-col">
                  <input type="submit" name="submit" value="Shto">
                </div>
              </div>
            </div>
      </div>
      </section>
      </form>
    </div>
    <?php include('includes/footer.php'); ?>
    </div>

    <script src="js/jquery-1.11.3.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.velocity.min.js"></script>
    <script src="js/jquery.kenburnsy.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/editor.js"></script>
    <script src="js/jquery.accordion.js"></script>
    <script src="js/jquery.noconflict.js"></script>
    <script src="js/theme-scripts.js"></script>
    <script src="js/custom.js"></script>
  </body>

  </html>
<?php }
?>