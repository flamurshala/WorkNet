<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['jpaid'] == 0)) {
  header('location:logout.php');
} else {
  ?>
  <!doctype html>
  <html lang="en" class="no-focus">

  <head>
    <title>WorkNet - Shiko detajet e punëdhënësit</title>
    <link rel="stylesheet" id="css-main" href="assets/css/codebase.min.css">
  </head>

  <body>
    <div id="page-container" class="sidebar-o sidebar-inverse side-scroll page-header-fixed main-content-narrow">

      <?php include_once('includes/sidebar.php'); ?>

      <?php include_once('includes/header.php'); ?>

      <main id="main-container">
        <div class="content">
          <h2 class="content-heading">Shiko detajet e punëdhënësits</h2>
          <div class="row">
            <div class="col-md-12">
              <div class="block block-themed">
                <div class="block-header bg-gd-emerald">
                  <h3 class="block-title">Shiko detajet e punëdhënësit</h3>
                </div>
                <div class="block-content">
                  <?php
                  $vid = $_GET['viewid'];

                  $sql = "SELECT * from tblemployers where id=:vid";
                  $query = $dbh->prepare($sql);
                  $query->bindParam(':vid', $vid, PDO::PARAM_STR);
                  $query->execute();
                  $results = $query->fetchAll(PDO::FETCH_OBJ);

                  $cnt = 1;
                  if ($query->rowCount() > 0) {
                    foreach ($results as $row) { ?>
                      <table border="1" class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                        <tr>
                          <th>Emri kompanisë</th>
                          <td>
                            <?php echo $row->CompnayName; ?>
                          </td>
                          <th>Logo e kompanisë</th>
                          <td><img src="../employers/employerslogo/<?php echo $row->CompnayLogo; ?>" width="100" height="100">
                          </td>
                          <th>Slogani</th>
                          <td>
                            <?php echo $row->CompanyTagline; ?>
                          </td>
                        </tr>
                        <tr>
                          <th>Emri dhe mbiemri</th>
                          <td>
                            <?php echo $row->ConcernPerson; ?>
                          </td>
                          <th>Email</th>
                          <td>
                            <?php echo $row->EmpEmail; ?>
                          </td>
                          <th>Slogani</th>
                          <td>
                            <?php echo $row->CompanyTagline; ?>
                          </td>
                        </tr>
                        <tr>
                          <th colspan="6" style="text-align: center;color: blue">Përshkrimi</th>
                        </tr>
                        <tr>
                          <td colspan="6">
                            <?php echo $row->CompnayDescription; ?>
                          </td>
                        </tr>
                        <tr>
                          <th>Industria</th>
                          <td>
                            <?php echo $row->industry; ?>
                          </td>
                          <th>Subjekti afarist</th>
                          <td>
                            <?php echo $row->typeBusinessEntity; ?>
                          </td>
                          <th>Lokacioni</th>
                          <td>
                            <?php echo $row->lcation; ?>
                          </td>
                        </tr>
                        <tr>
                          <th>URL e kompanisë</th>
                          <td>
                            <?php echo $row->CompanyUrl; ?>
                          </td>
                          <th>Numri i puntorëve</th>
                          <td>
                            <?php echo $row->noOfEmployee; ?>
                          </td>
                          <th>Data e themelimit</th>
                          <td>
                            <?php echo $row->establishedIn; ?>
                          </td>
                        </tr>
                        <?php $cnt = $cnt + 1;
                    }
                  } ?>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
      <?php include_once('includes/footer.php'); ?>
    </div>

    <script src="assets/js/core/jquery.min.js"></script>
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
    <script src="assets/js/core/jquery.slimscroll.min.js"></script>
    <script src="assets/js/core/jquery.scrollLock.min.js"></script>
    <script src="assets/js/core/jquery.appear.min.js"></script>
    <script src="assets/js/core/jquery.countTo.min.js"></script>
    <script src="assets/js/core/js.cookie.min.js"></script>
    <script src="assets/js/codebase.js"></script>
  </body>

  </html>
<?php } ?>