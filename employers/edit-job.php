<?php
session_start();
include('includes/config.php');
$dbh = DBConnectionFactory::createConnection();
error_reporting(0);
if (strlen($_SESSION['emplogin']) == 0) {
  header('location:emp-login.php');
} else {
  if (empty($_SESSION['token2'])) {
    $_SESSION['token2'] = bin2hex(random_bytes(32));
  }

  if (isset($_POST['update'])) {
    if (!empty($_POST['csrftoken2'])) {
      if (hash_equals($_SESSION['token2'], $_POST['csrftoken2'])) {

        $jid = intval($_GET['jobid']);
        $empid = $_SESSION['emplogin'];
        $category = $_POST['category'];
        $jontitle = $_POST['jobtitle'];
        $jobtype = $_POST['jobtype'];
        $salpackg = $_POST['salarypackage'];
        $skills = $_POST['skills'];
        $exprnce = $_POST['experience'];
        $joblocation = $_POST['joblocation'];
        $jobdesc = $_POST['description'];
        $jed = $_POST['jed'];
        $isactive = $_POST['status'];

        $sql = "Update tbljobs set jobCategory=:category,jobTitle=:jontitle,jobType=:jobtype,salaryPackage=:salpackg,skillsRequired=:skills,experience=:exprnce,jobLocation=:joblocation,jobDescription=:jobdesc,JobExpdate=:jed,isActive=:isactive where employerId=:eid and jobId=:jid";
        $query = $dbh->prepare($sql);

        $query->bindParam(':category', $category, PDO::PARAM_STR);
        $query->bindParam(':jontitle', $jontitle, PDO::PARAM_STR);
        $query->bindParam(':jobtype', $jobtype, PDO::PARAM_STR);
        $query->bindParam(':salpackg', $salpackg, PDO::PARAM_STR);
        $query->bindParam(':skills', $skills, PDO::PARAM_STR);
        $query->bindParam(':exprnce', $exprnce, PDO::PARAM_STR);
        $query->bindParam(':joblocation', $joblocation, PDO::PARAM_STR);
        $query->bindParam(':jobdesc', $jobdesc, PDO::PARAM_STR);
        $query->bindParam(':jed', $jed, PDO::PARAM_STR);
        $query->bindParam(':isactive', $isactive, PDO::PARAM_STR);
        $query->bindParam(':jid', $jid, PDO::PARAM_STR);
        $query->bindParam(':eid', $empid, PDO::PARAM_STR);
        $query->execute();

        $msg = " Job updated Successfully";
        unset($_SESSION['token2']);

      }
    }
  }
  ?>

  <!doctype html>
  <html>

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Employers | Job Posting</title>
    <link href="../css/custom.css" rel="stylesheet" type="text/css">
    <link href="../css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="../css/color.css" rel="stylesheet" type="text/css">
    <link href="../css/responsive.css" rel="stylesheet" type="text/css">
    <link href="../css/owl.carousel.css" rel="stylesheet" type="text/css">
    <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="../css/editor.css" type="text/css" rel="stylesheet" />
    <link href="../css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,300italic,500,700,900' rel='stylesheet'
      type='text/css'>
    <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
    <script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>

  </head>

  <body class="theme-style-1">
    <div id="wrapper">
      <?php include('includes/header.php'); ?>

      <?php
      $jid = intval($_GET['jobid']);
      $empid = $_SESSION['emplogin'];

      $sql = "SELECT tbljobs.*,tblemployers.CompnayLogo from tbljobs join tblemployers on tblemployers.id=tbljobs.employerId  where tbljobs.employerId=:eid and tbljobs.jobId=:jid";
      $query = $dbh->prepare($sql);
      $query->bindParam(':eid', $empid, PDO::PARAM_STR);
      $query->bindParam(':jid', $jid, PDO::PARAM_STR);
      $query->execute();
      $results = $query->fetchAll(PDO::FETCH_OBJ);
      if ($query->rowCount() > 0) {
        foreach ($results as $result) {
          ?>
          <section id="inner-banner">
            <div class="container">
              <h1> Përditëso
                <?php echo htmlentities($result->jobTitle); ?>
              </h1>
            </div>
          </section>
          <div id="main">
            <form name="empsignup" enctype="multipart/form-data" method="post">
              <input type="hidden" name="csrftoken2" value="<?php echo htmlentities($_SESSION['token2']); ?>" />
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
                      <label>Kategoria</label>
                      <div class="selector">
                        <select name='category' class="full-width">
                          <option value="<?php echo htmlentities($result->jobCategory); ?>">
                            <?php echo htmlentities($result->jobCategory); ?>
                          </option>
                          <?php
                          $sqlt = "SELECT CategoryName FROM tblcategory order by CategoryName asc";
                          $queryt = $dbh->prepare($sqlt);
                          $queryt->execute();
                          $results = $queryt->fetchAll(PDO::FETCH_OBJ);
                          $cnt = 1;
                          if ($queryt->rowCount() > 0) {
                            foreach ($results as $row) { ?>
                              <option value="<?php echo htmlentities($row->CategoryName); ?>">
                                <?php echo htmlentities($row->CategoryName); ?>
                              </option>
                            <?php }
                          } ?>

                        </select>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                      <label>Emri i punës</label>
                      <input type="text" name="jobtitle" required value="<?php echo htmlentities($result->jobTitle); ?>"
                        autocomplete="off">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 col-sm-6">
                      <label>Lloji i punës</label>
                      <div class="selector">
                        <select class="full-width" name="jobtype">
                          <option value="<?php echo htmlentities($result->jobType); ?>">
                            <?php echo htmlentities($result->jobType); ?>
                          </option>
                          <option value="Full Time">Full Time</option>
                          <option value="Part Time">Part Time</option>
                          <option value="Half Time">Half Time</option>
                          <option value="Freelance">Freelance</option>
                          <option value="Contract">Contract</option>
                          <option value="Internship">Internship</option>
                          <option value="Temporary">Temporary</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                      <label>Pagesa</label>
                      <input type="text" value="<?php echo htmlentities($result->salaryPackage); ?>" name="salarypackage"
                        required>
                    </div>
                  </div>
                  <div class="row">

                    <div class="col-md-6 col-sm-6">
                      <label>Aftësitë e kërkuara</label>
                      <input type="text" value="<?php echo htmlentities($result->skillsRequired); ?>" name="skills" required>
                    </div>

                    <div class="col-md-6 col-sm-6">
                      <label>Eksperienca</label>
                      <input type="text" value="<?php echo htmlentities($result->experience); ?>" name="experience" required>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 col-sm-6">
                      <label>Lokacioni i punës</label>
                      <input type="text" value="<?php echo htmlentities($result->jobLocation); ?>" name="joblocation"
                        required>
                    </div>
                    <div class="col-md-6 col-sm-6">
                      <label>Afati i aplikimit</label>
                      <input type="date" name="jed" value="<?php echo htmlentities($result->JobExpdate); ?>" required
                        class="form-control">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <h4>Përshkrimi i punës</h4>
                      <div class="text-editor-box">
                        <textarea name="description" required
                          autocomplete="off"><?php echo htmlentities($result->jobDescription); ?></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 col-sm-6">
                      <label>Statusi i punës</label>
                      <div class="selector">
                        <select class="full-width" name="status">
                          <?php if ($result->isActive == 1): ?>
                            <option value="<?php echo htmlentities($result->isActive); ?>">Active</option>
                            <option value="0">Jo aktive</option>
                            <option value="2">Puna është plotësuar</option>
                          <?php endif; ?>

                          <?php if ($result->isActive == 0): ?>
                            <option value="<?php echo htmlentities($result->isActive); ?>">Active</option>
                            <option value="1"> Aktive</option>
                            <option value="2">Puna është plotësuar</option>
                          <?php endif; ?>

                          <?php if ($result->isActive == 2): ?>
                            <option value="<?php echo htmlentities($result->isActive); ?>">Puna është plotësuar</option>
                            <option value="1"> Aktive</option>
                          <?php endif; ?>
                        </select>
                      </div>
                    </div>
                  </div>
                <?php }
      } ?>
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
    <script src="../js/jquery-1.11.3.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/owl.carousel.min.js"></script>
    <script src="../js/jquery.velocity.min.js"></script>
    <script src="../js/jquery.kenburnsy.js"></script>
    <script src="../js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="../js/editor.js"></script>
    <script src="../js/jquery.accordion.js"></script>
    <script src="../js/jquery.noconflict.js"></script>
    <script src="../js/theme-scripts.js"></script>
    <script src="../js/custom.js"></script>
  </body>

  </html>
<?php } ?>