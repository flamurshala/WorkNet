<?php
session_start();
include('includes/config.php');
error_reporting(0);
if (strlen($_SESSION['jsid']) == 0) {
  header('location:logout.php');
} else {
  if (isset($_POST['submit'])) {
    $quali = $_POST['qualification'];
    $sorcname = $_POST['schorclgname'];
    $yop = $_POST['yop'];
    $stream = $_POST['stream'];
    $per = $_POST['percentage'];
    $cgpa = $_POST['cgpa'];
    $uid = $_SESSION['jsid'];

    $ret = "select Qualification from tbleducation where Qualification=:quali and  UserID=:uid";
    $query = $dbh->prepare($ret);
    $query->bindParam(':quali', $quali, PDO::PARAM_STR);
    $query->bindParam(':uid', $uid, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    $ff = array();
    foreach ($results as $rt) {
      array_push($ff, $rt->Qualification);
    }
    if (in_array($quali, $ff)) {
      echo "<script>alert('Qualification details already exist. Please try again');</script>";
    } else {
      $sql = "insert into tbleducation(UserID,Qualification,ClgorschName,PassingYear,Stream,CGPA,Percentage )values(:uid,:quali,:sorcname,:yop,:stream,:cgpa,:per)";
      $query = $dbh->prepare($sql);

      $query->bindParam(':quali', $quali, PDO::PARAM_STR);
      $query->bindParam(':uid', $uid, PDO::PARAM_STR);
      $query->bindParam(':sorcname', $sorcname, PDO::PARAM_STR);
      $query->bindParam(':yop', $yop, PDO::PARAM_STR);
      $query->bindParam(':stream', $stream, PDO::PARAM_STR);
      $query->bindParam(':per', $per, PDO::PARAM_STR);
      $query->bindParam(':cgpa', $cgpa, PDO::PARAM_STR);
      $query->execute();

      $LastInsertId = $dbh->lastInsertId();
      if ($LastInsertId > 0) {
        echo '<script>alert("Detajet e edukimit jane futur me sukses.")</script>';
        echo "<script>window.location.href ='my-profile.php'</script>";
      } else {
        echo '<script>alert("Dicka shkoj keq. provo perseri")</script>';
      }
    }
  }
  ?>
  <!doctype html>
  <html>

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Perdoruesi | Shto detajet e edukimit</title>
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
          <h1>Detajet e edukimit</h1>
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
                  <label>Kualifikimet</label>
                  <select type="text" name="qualification" required="true" autocomplete="off" value=""
                    class="form-control" />
                  <option value="">Zgjedh kualifikimin</option>
                  <option value="10th std">Student</option>
                  <option value="12th std">Student klasës 12</option>
                  <option value="Graduation">Në Diplomim</option>
                  <option value="Post Graduation">I Diplomuar</option>
                  <option value="Others">Tjera</option>
                  </select>
                </div>
                <div class="col-md-6 col-sm-6">
                  <label>Emri i shkollës/univeristetit</label>
                  <input type="text" name="schorclgname" required="true" autocomplete="off" value="" class="form-control">
                </div>
                <div class="col-md-6 col-sm-6">
                  <label>Viti i përfundimimit</label>
                  <input type="text" name="yop" autocomplete="off" value="" required="true" class="form-control"
                    pattern="[0-9]+" maxlength="4">
                  <label>Drejtimi</label>
                  <input type="text" name="stream" autocomplete="off" value="" class="form-control">
                </div>
                <div class="col-md-6 col-sm-6">
                  <label>Përqindja e perfundimit</label>
                  <input type="text" name="percentage" autocomplete="off" value="" class="form-control" maxlength="5">
                </div>

                <div class="col-md-6 col-sm-6">
                  <label>Nota mesatare</label>
                  <input type="text" name="cgpa" required="true" autocomplete="off" value="" class="form-control"
                    maxlength="2">
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