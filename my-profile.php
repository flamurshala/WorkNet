<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['jsid']) == 0) {
  header('location:logout.php');
} else { ?>
  <!doctype html>
  <html>

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jobseekers | Profile </title>
    <link href="css/custom.css" rel="stylesheet" type="text/css">
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="css/color.css" rel="stylesheet" type="text/css">
    <link href="css/responsive.css" rel="stylesheet" type="text/css">
    <link href="css/owl.carousel.css" rel="stylesheet" type="text/css">
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,300italic,500,700,900' rel='stylesheet'
      type='text/css'>
  </head>

  <body class="theme-style-1">
    <div id="wrapper">
      <?php include('includes/header.php'); ?>
      <section id="inner-banner">
        <div class="container">
          <h1>
            Profili i
            <?php echo htmlentities($_SESSION['jsfname']); ?>
          </h1>
        </div>
      </section>
      <div id="main">
        <section class="resumes-section padd-tb">
          <div class="container">
            <div class="row">
              <div class="col-md-12 col-sm-8">
                <div class="resumes-content">
                  <div class="box">
                    <div class="frame">
                      <?php
                      $jsid = $_SESSION['jsid'];
                      $sql = "SELECT * from  tbljobseekers  where id=:jid";
                      $query = $dbh->prepare($sql);
                      $query->bindParam(':jid', $jsid, PDO::PARAM_STR);
                      $query->execute();
                      $results = $query->fetchAll(PDO::FETCH_OBJ);
                      foreach ($results as $result) {
                        ?><a href="#">
                          <?php if ($row->ProfilePic == ''): ?>
                            <img src="images/account.png" width="60" height="60">
                          <?php else: ?>
                            <img src="images/<?php echo $row->ProfilePic; ?>" width="100" height="100">
                          <?php endif; ?>
                        </a>
                      </div>
                      <div class="text-box">
                        <h2><a href="#">
                            <?php echo htmlentities($_SESSION['jsfname']); ?>
                          </a></h2>
                        <h4>Data e regjistrimit:
                          <?php echo htmlentities($result->RegDate); ?>
                        </h4>
                        <div class="clearfix"> <strong><i class="fa fa-envelope"></i>
                            <?php echo htmlentities($result->EmailId); ?>
                          </strong> <strong>
                            <i class="fa fa-phone"></i><a href="#">
                              <?php echo htmlentities($result->ContactNumber); ?>
                            </a></strong> </div>
                        <div class="btn-row"> <a href="Jobseekersresumes/<?php echo htmlentities($result->Resume); ?>"
                            class="resume" target="_blank"><i class="fa fa-file-text-o"></i>CV</a> <a href="profile.php"
                            class="login">Përditëso profilin</a> <a href="add-education.php" class="login">Shto
                            edukimin</a><a href="add-experience.php" class="login">Shto eksperiencën</a></div>
                      </div>
                    </div>
                    <div class="summary-box">
                      <h4>Rreth meje</h4>
                      <p>
                        <?php echo htmlentities($result->AboutMe); ?>.
                      </p>
                    </div>
                  <?php } ?>
                  <div class="summary-box">
                    <h4>Kualifikimet</h4>
                    <?php
                    $uid = $_SESSION['jsid'];
                    $sql = "SELECT * from  tbleducation  where UserID=:uid";
                    $query = $dbh->prepare($sql);
                    $query->bindParam(':uid', $uid, PDO::PARAM_STR);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                    foreach ($results as $result) {
                      ?>
                      <div class="outer"> <strong class="title">
                          <?php echo htmlentities($result->Qualification); ?>
                        </strong>
                        <div class="col"> <span>
                            <?php echo htmlentities($result->PassingYear); ?>
                          </span>
                          <p><strong style="color: blue">Emri i shkollës/universitetit</strong>:
                            <?php echo htmlentities($result->ClgorschName); ?>
                          </p>
                          <p><strong style="color: blue">Drejtimi</strong>:
                            <?php echo htmlentities($result->Stream); ?>
                          </p>
                          <p><strong style="color: blue">Nota mesatare</strong>:
                            <?php echo htmlentities($result->CGPA); ?>
                          </p>
                          <p><strong style="color: blue">Përqindja e përfundimit</strong>:
                            <?php
                            if ($result->Percentage == '0'):
                              echo 'NA';
                            else:
                              echo htmlentities($result->Percentage);
                            endif;
                            ?>
                          </p>
                        </div>
                      </div>
                    <?php } ?>
                  </div>
                  <div class="summary-box">
                    <h4>Eksperienca e punës</h4>
                    <?php
                    $uid = $_SESSION['jsid'];
                    $sql = "SELECT * from  tblexperience  where UserID=:uid";
                    $query = $dbh->prepare($sql);
                    $query->bindParam(':uid', $uid, PDO::PARAM_STR);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                    foreach ($results as $result) {
                      ?>
                      <div class="outer"> <strong class="title">
                          <?php echo htmlentities($result->Designation); ?> at <b>(
                            <?php echo htmlentities($result->EmployerName); ?>)
                          </b>
                        </strong>
                        <div class="col"> <span>
                            <?php echo htmlentities($result->FromDate); ?> -
                            <?php echo htmlentities($result->ToDate); ?>
                          </span>
                          <p><strong style="color: blue">Lloji i punës: </strong>:
                            <?php echo htmlentities($result->EmployementType); ?>
                          </p>
                          <p><strong style="color: blue">Pagesa: </strong>:
                            <?php echo htmlentities($result->Ctc); ?>(për muaj)
                          </p>
                          <!-- <p><strong style="color: blue">Skills: </strong>: <?php echo htmlentities($result->Skills); ?></p> -->
                        </div>
                      </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
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
    <script src="js/form.js"></script>
    <script src="js/custom.js"></script>
  </body>

  </html>
<?php } ?>