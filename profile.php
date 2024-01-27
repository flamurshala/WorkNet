<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['jsid']) == 0) {
  header('location:logout.php');
} else {
  if (isset($_POST['update'])) {
    $FullName = $_POST['fname'];
    $aboutme = $_POST['aboutme'];
    $skills = $_POST['skills'];
    $uid = $_SESSION['jsid'];
    $sql = "update  tbljobseekers set FullName=:fname,AboutMe=:aboutme,Skills=:skills where id=:uid";
    $query = $dbh->prepare($sql);

    $query->bindParam(':fname', $FullName, PDO::PARAM_STR);
    $query->bindParam(':uid', $uid, PDO::PARAM_STR);
    $query->bindParam(':aboutme', $aboutme, PDO::PARAM_STR);
    $query->bindParam(':skills', $skills, PDO::PARAM_STR);
    $query->execute();

    echo '<script>alert("Account detail has been updated")</script>';
    echo "<script>window.location.href ='profile.php'</script>";

  }
  ?>
  <!doctype html>
  <html>

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User | Përditëso detajet e llogarisë</title>
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
          <h1>Detajet e llogarsë së punëkërkuesit</h1>
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
                <?php
                $uid = $_SESSION['jsid'];
                $sql = "SELECT * from  tbljobseekers  where id=:uid";
                $query = $dbh->prepare($sql);
                $query->bindParam(':uid', $uid, PDO::PARAM_STR);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                if ($query->rowCount() > 0) {
                  foreach ($results as $result) {
                    ?>
                    <div class="col-md-6 col-sm-6">
                      <label>Emri dhe mbiemri</label>
                      <input type="text" name="fname" required autocomplete="off"
                        value="<?php echo htmlentities($result->FullName) ?>" />
                    </div>
                    <div class="col-md-6 col-sm-6">
                      <label>Emaili</label>
                      <input type="email" name="emailid" readonly="true" autocomplete="off"
                        value="<?php echo htmlentities($result->EmailId) ?>">
                    </div>
                    <div class="col-md-6 col-sm-6">
                      <label>Numri telefonit</label>
                      <input type="text" name="contactnumber" autocomplete="off"
                        value="<?php echo htmlentities($result->ContactNumber) ?>" readonly="true">
                      <label>Resume</label>
                      <img src="images/pdf.png" title="Click Here for View Resume"><a
                        href="Jobseekersresumes/<?php echo $result->Resume; ?>" target="_blank">kliko këtu për të parë CV</a>
                      <a href="resume.php?updateid=<?php echo $result->id; ?>"> &nbsp; Përditëso CV</a>
                      <br>
                      <p style="padding-top: 20px"><a href="#"></a></p>
                    </div>
                    <div class="col-md-6 col-sm-6">
                      <label>Data regjistrimit</label>
                      <input type="text" name="regdate" readonly="true" autocomplete="off"
                        value="<?php echo htmlentities($result->RegDate) ?>">
                    </div>
                    <div class="col-md-6 col-sm-6">
                      <label>Rreth meje</label>
                      <input type="text" name="aboutme" required="true" autocomplete="off"
                        value="<?php echo htmlentities($result->AboutMe) ?>">
                    </div>
                    <div class="col-md-6 col-sm-6">
                      <label>Aftësitë</label>
                      <input type="text" name="skills" autocomplete="off" value="<?php echo htmlentities($result->Skills) ?>"
                        class="form-control">
                    </div>
                  </div>
                  <?php
                  }
                }
                ?>
              <div class="col-md-12">
                <div class="btn-col">
                  <input type="submit" name="update" value="Përditëso">
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