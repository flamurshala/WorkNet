<?php
include('includes/config.php');
session_start();
error_reporting(0);
?>
<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>WorkNet-Rreth Nesh</title>
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
        <h1>Rreth nesh</h1>
      </div>
    </section>
    <div id="main">
      <section class="contact-section">
        <div class="map-box">
          <div class="contact-form padd-tb">
            <div class="container">
              <div class="row">
                <div class="col-md-12 col-sm-12">
                  <div class="address-box">
                    <address>
                      <ul>
                        <?php
                        $sql = "SELECT * from tblpages where PageType='aboutus'";
                        $query = $dbh->prepare($sql);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);

                        $cnt = 1;
                        if ($query->rowCount() > 0) {
                          foreach ($results as $row) { ?>
                            <strong>
                              <h3 style="text-align: center; color:blue;">
                                <?php echo ($row->PageTitle); ?>
                              </h3>
                            </strong>
                            <p>
                              <?php echo ($row->PageDescription); ?>
                            </p>
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