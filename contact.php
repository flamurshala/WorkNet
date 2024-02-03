<?php
include('includes/config.php');
$dbh = DBConnectionFactory::createConnection();
session_start();
error_reporting(0);
?>
<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>WorkNet-Kontakti</title>
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
    <?php include_once('includes/header.php'); ?>
    <section id="inner-banner">
      <div class="container">
        <h1>Mos hezito na kontakto</h1>
      </div>
    </section>
    <div id="main">
      <section class="contact-section">
        <div class="map-box">
          <div class="contact-form padd-tb">
            <div class="container">
              <div class="row">
                <div class="col-md-9 col-sm-8">
                  <h2>Kontaktet</h2>
                </div>
                <div class="col-md-12 col-sm-12">
                  <div class="address-box">
                    <address>
                      <ul>
                        <?php
                        $sql = "SELECT * from tblpages where PageType='contactus'";
                        $query = $dbh->prepare($sql);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        $cnt = 1;
                        if ($query->rowCount() > 0) {
                          foreach ($results as $row) { ?>
                            <li> <i class="fa fa-phone"></i> <strong>+
                                <?php echo htmlentities($row->MobileNumber); ?>
                              </strong></li>
                            <li> <i class="fa fa-envelope-o"></i> <strong>
                                <?php echo htmlentities($row->Email); ?>
                              </strong> </li>
                            <li> <i class="fa fa-globe"></i> <strong>
                                <?php echo htmlentities($row->PageDescription); ?>
                              </strong> </li>
                            <?php $cnt = $cnt + 1;
                          }
                        } ?>
                      </ul>
                    </address>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
    <?php include_once('includes/footer.php'); ?>
  </div>
  <script src="js/jquery-1.11.3.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.velocity.min.js"></script>
  <script src="js/jquery.kenburnsy.js"></script>
  <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
  <script src="js/custom.js"></script>
</body>

</html>