<?php
session_start();
error_reporting(0);
include('includes/config.php');
$dbh = DBConnectionFactory::createConnection();
if (strlen($_SESSION['jsid'] == 0)) {
  header('location:logout.php');
} else {
  ?>
  <!doctype html>
  <html>

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WorkNet | Shiko historin e aplikimeve </title>
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
          <h1>
            Aplikimi i
            <?php echo htmlentities($_SESSION['jsfname']); ?>-it
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
                    <?php

                    $jobid = $_GET['jobid'];
                    $sql = "SELECT tbljobs.*,tblapplyjob.*,tblemployers.CompnayName,tblemployers.CompnayLogo  from tblapplyjob 
join tbljobs on tblapplyjob.JobId=tbljobs.jobId 
join tblemployers on tblemployers.id=tbljobs.employerId 
where tbljobs.jobId=:jobid";
                    $query = $dbh->prepare($sql);
                    $query->bindParam(':jobid', $jobid, PDO::PARAM_STR);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                    foreach ($results as $result) {
                      ?>
                      <div class="text-box">
                        <h2 style="color: red">Detajet e punës</h2>
                        <table class="table table-bordered table-hover data-tables">
                          <tr>
                            <th colspan="2" style="text-align:center"><img
                                src="employers/employerslogo/<?php echo $result->CompnayLogo; ?>" width="200" height="100"
                                align="center"></th>
                            <th>Emri kompanisë</th>
                            <td>
                              <?php echo $result->CompnayName; ?>
                            </td>
                          </tr>
                          <tr>
                            <th>Emri i punës</th>
                            <td>
                              <?php echo $result->jobTitle; ?>
                            </td>
                            <th>Të ardhurat</th>
                            <td>$
                              <?php echo $result->salaryPackage; ?>
                            </td>
                          </tr>
                          <tr>
                            <th>Përshkrimi i punës</th>
                            <td colspan="3">
                              <?php echo $result->jobDescription; ?>
                            </td>
                          </tr>
                          <tr>
                            <th>Vendi i punës</th>
                            <td>
                              <?php echo $result->jobLocation; ?>
                            </td>
                            <th>Aftësit që kërkohen</th>
                            <td>
                              <?php echo $result->skillsRequired; ?>
                            </td>
                          </tr>
                          <tr>
                            <th>Data aplikimit</th>
                            <td>
                              <?php echo $result->Applydate; ?>
                            </td>
                            <th>Data e fundit</th>
                            <td>
                              <?php echo $result->JobExpdate; ?>
                            </td>
                          </tr>

                          <th>Statusi</th>
                          <td colspan="3">
                            <?php
                            if ($result->Status == "") {
                              echo "Nuk është përgjigjur";
                            } else {
                              echo $pstatus = $result->Status;
                            }
                            ; ?>
                          </td>
                          </tr>
                        </table>
                        <?php $cnt = $cnt + 1;
                    }
} ?>
                  </div>
                </div>

                <?php
                $uid = $_SESSION['jsid'];
                $ret = "select tblmessage.* from tblmessage  where tblmessage.UserID=:uid && tblmessage.JobID=:jobid";
                $query1 = $dbh->prepare($ret);
                $query1->bindParam(':jobid', $jobid, PDO::PARAM_STR);
                $query1->bindParam(':uid', $uid, PDO::PARAM_STR);
                $query1->execute();
                $cnt = 1;
                $results = $query1->fetchAll(PDO::FETCH_OBJ);
                if ($query1->rowCount() > 0) {
                  ?>
                  <div class="summary-box">
                    <h4>Historia e mesazheve</h4>
                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                      style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                      <tr>
                        <th>#</th>
                        <th>Mesazhi</th>
                        <th>Status</th>
                        <th>Koha</th>
                      </tr>
                      <?php
                      foreach ($results as $row1) {
                        ?>
                        <tr>
                          <td>
                            <?php echo $cnt; ?>
                          </td>
                          <td>
                            <?php echo $row1->Message; ?>
                          </td>
                          <td>
                            <?php echo $row1->Status; ?>
                          </td>
                          <td>
                            <?php echo $row1->ResponseDate; ?>
                          </td>
                        </tr>
                        <?php $cnt = $cnt + 1;
                      } ?>
                    </table>
                  </div>
                <?php } ?>
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