<?php
session_start();
include('includes/config.php');
error_reporting(0);
if (strlen($_SESSION['emplogin']) == 0) {
  header('location:logout.php');
} else {
  if (isset($_POST['submit'])) {
    $jobid = $_GET['jobid'];
    $jsid = $_GET['jsid'];
    $status = $_POST['status'];
    $msg = $_POST['message'];

    $sql = "insert into tblmessage(JobID,UserID,Message,Status) value(:jobid,:jsid,:msg,:status)";

    $query = $dbh->prepare($sql);
    $query->bindParam(':jobid', $jobid, PDO::PARAM_STR);
    $query->bindParam(':jsid', $jsid, PDO::PARAM_STR);
    $query->bindParam(':msg', $msg, PDO::PARAM_STR);
    $query->bindParam(':status', $status, PDO::PARAM_STR);
    $query->execute();
    $sql1 = "update tblapplyjob set Status=:status where JobId=:jobid and UserId=:jsid";

    $query1 = $dbh->prepare($sql1);
    $query1->bindParam(':jobid', $jobid, PDO::PARAM_STR);
    $query1->bindParam(':jsid', $jsid, PDO::PARAM_STR);
    $query1->bindParam(':status', $status, PDO::PARAM_STR);

    $query1->execute();
    echo '<script>alert("Statusi është përditësuar")</script>';
    echo "<script>window.location.href ='candidates-listings.php'</script>";
  }
  ?>
  <!doctype html>
  <html>

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jobseekers | Profile </title>
    <link href="../css/custom.css" rel="stylesheet" type="text/css">
    <link href="../css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="../css/color.css" rel="stylesheet" type="text/css">
    <link href="../css/responsive.css" rel="stylesheet" type="text/css">
    <link href="../css/owl.carousel.css" rel="stylesheet" type="text/css">
    <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="../css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css">
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
            Aplikimi i
            <?php echo htmlentities($_GET['name']); ?>
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
                    $name = $_GET['name'];
                    $jsid = $_GET['jsid'];
                    $sql = "SELECT tbljobs.*,tblapplyjob.*  from tblapplyjob join tbljobs on tblapplyjob.JobId=tbljobs.jobId  where tbljobs.jobId=:jobid and tblapplyjob.UserId=:jsid";
                    $query = $dbh->prepare($sql);
                    $query->bindParam(':jobid', $jobid, PDO::PARAM_STR);
                    $query->bindParam(':jsid', $jsid, PDO::PARAM_STR);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                    foreach ($results as $result) {
                      ?>
                      <div class="text-box">
                        <h2 style="color: red">Detajet e punës</h2>
                        <table class="table table-bordered table-hover data-tables">
                          <tr>
                            <th>Emri i punës</th>
                            <td>
                              <?php echo $result->jobTitle; ?>
                            </td>
                            <th>Pagesa</th>
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
                            <th>lokacioni</th>
                            <td>
                              <?php echo $result->jobLocation; ?>
                            </td>
                            <th>Aftësitë e kërkuara</th>
                            <td>
                              <?php echo $result->skillsRequired; ?>
                            </td>
                          </tr>
                          <tr>
                            <th>Data e aplikimit</th>
                            <td>
                              <?php echo $result->Applydate; ?>
                            </td>
                            <th>Data e fundit</th>
                            <td>
                              <?php echo $result->JobExpdate; ?>
                            </td>
                          </tr>
                          <th>Status</th>
                          <td colspan="3">
                            <?php
                            if ($result->Status == "") {
                              echo "Nuk është përgjigjur!";
                            } else {
                              echo $pstatus = $result->Status;
                            }
                            ; ?>
                          </td>
                          </tr>
                        </table>
                      </div>
                    </div>
                    <?php if ($result->Status != '') {
                      $ret = "select tblmessage.* from tblmessage  where tblmessage.JobID=:jobid order by tblmessage.ID desc";
                      $query1 = $dbh->prepare($ret);
                      $query1->bindParam(':jobid', $jobid, PDO::PARAM_STR);
                      $query1->execute();
                      $cnt = 1;
                      $results = $query1->fetchAll(PDO::FETCH_OBJ);
                      ?>
                      <div class="summary-box">
                        <h4>Historia e mesazheve</h4>
                        <table id="datatable" class="table table-bordered dt-responsive nowrap"
                          style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                          <tr>
                            <th>#</th>
                            <th>Mesazhi</th>
                            <th>Status</th>
                            <th>koha</th>
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
                      <?php }
                    if ($result->Status == "" || $result->Status == "Sort Listed") {
                      ?>
                      </div>
                      <div class="summary-box">
                        <p align="center">
                          <button class="btn btn-primary waves-effect waves-light w-lg" data-toggle="modal"
                            data-target="#myModal">Take Action</button>
                        </p>
                      <?php }
                    } ?>
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                      aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Merr vendim</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <table class="table table-bordered table-hover data-tables">
                              <form method="post" name="submit">
                                <tr>
                                  <th>Mesazhi :</th>
                                  <td>
                                    <textarea name="message" rows="12" cols="14" class="form-control wd-450"
                                      required="true"></textarea>
                                  </td>
                                </tr>
                                <tr>
                                  <th>Status :</th>
                                  <td>
                                    <select name="status" class="form-control wd-450" required="true">
                                      <option value="">Zgjedh opsionin</option>
                                      <?php if ($result->Status == ""): ?>
                                        <option value="Sort Listed">Lista</option>
                                        <option value="Hired">Punësuar</option>
                                        <option value="Rejected">Refuzuar</option>
                                      <?php elseif ($result->Status == "Sort Listed"): ?>
                                        <option value="Hired">Punësuar</option>
                                        <option value="Rejected">Refuzuar</option>
                                      <?php endif; ?>
                                    </select>
                                  </td>
                                </tr>
                            </table>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Mbylle</button>
                            <button type="submit" name="submit" class="btn btn-primary">Përditëso</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
        </section>
      </div>
      <?php include('includes/footer.php'); ?>
      <script src="../js/jquery-1.11.3.min.js"></script>
      <script src="../js/bootstrap.min.js"></script>
      <script src="../js/owl.carousel.min.js"></script>
      <script src="../js/jquery.velocity.min.js"></script>
      <script src="../js/jquery.kenburnsy.js"></script>
      <script src="../js/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="../js/form.js"></script>
      <script src="../js/custom.js"></script>
  </body>

  </html>
<?php } ?>