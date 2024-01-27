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
    <title>Punëkërkuesi | Profili </title>
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
                    <div class="frame"><a href="#"><img src="images/resumes/resumes-img-1.jpg" alt="img"></a></div>
                    <?php
                    $jsid = $_SESSION['jsid'];
                    $sql = "SELECT * from  tbljobseekers  where id=:jid";
                    $query = $dbh->prepare($sql);
                    $query->bindParam(':jid', $jsid, PDO::PARAM_STR);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                    foreach ($results as $result) {
                      ?>
                      <div class="text-box">
                        <h2><a href="#">
                            <?php echo htmlentities($_SESSION['jsfname']); ?>
                          </a></h2>
                        <h4>Reg Date:
                          <?php echo htmlentities($result->RegDate); ?>
                        </h4>
                        <div class="clearfix"> <strong><i class="fa fa-envelope"></i>
                            <?php echo htmlentities($result->EmailId); ?>
                          </strong> <strong>
                            <i class="fa fa-phone"></i><a href="#">
                              <?php echo htmlentities($result->ContactNumber); ?>
                            </a></strong> </div>
                        <div class="btn-row"> <a href="Jobseekersresumes/<?php echo htmlentities($result->Resume); ?>"
                            class="resume" target="_blank"><i class="fa fa-file-text-o"></i>CV</a> <a href="#"
                            class="login">Përditëso profilin</a> </div>
                      </div>
                    <?php } ?>
                  </div>
                  <div class="summary-box">
                    <h4>Rreth meje</h4>
                    <form name="add_name" id="add_name">
                      <div class="table-responsive">
                        <table class="table table-bordered" id="dynamic_field">
                          <tr>
                            <td><input type="text" name="name[]" placeholder="Shkruaj kualifikimet"
                                class="form-control name_list" /></td>
                            <td><input type="text" name="fromyear[]" placeholder="Prej vitit"
                                class="form-control name_list" /></td>
                            <td><input type="text" name="toyear[]" placeholder="Deri në vitin"
                                class="form-control name_list" />
                            </td>
                            <td><input type="text" name="toyear[]" placeholder="Emri i shkollës / Universitetit"
                                class="form-control name_list" />
                            <td><input type="text" name="percentage[]" placeholder="Përqindja e përfundimit"
                                class="form-control name_list" /></td>
                            </td>
                          </tr>
                        </table>
                        <input type="button" name="submit" id="submit" class="btn btn-info" value="Ruaj" />
                      </div>
                    </form>
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
    <script>
      $(document).ready(function () {
        var i = 1;
        $('#add').click(function () {
          i++;
          $('#dynamic_field').append('<tr id="row' + i + '"><td><input type="text" name="name[]" placeholder="Enter Qualification Name" class="form-control name_list" /></td><td><input type="text" name="fromyear[]" placeholder="From year" class="form-control name_list" /></td><td><input type="text" name="toyear[]" placeholder="To year" class="form-control name_list" /></td>      <td><input type="text" name="toyear[]" placeholder="School / College name" class="form-control name_list" /></td><td><input type="text" name="percentage[]" placeholder="Percentage" class="form-control name_list" /></td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></td></tr>');
        });
        $(document).on('click', '.btn_remove', function () {
          var button_id = $(this).attr("id");
          $('#row' + button_id + '').remove();
        });
        $('#submit').click(function () {
          $.ajax({
            url: "name.php",
            method: "POST",
            data: $('#add_name').serialize(),
            success: function (data) {
              alert(data);
              $('#add_name')[0].reset();
            }
          });
        });
      });
    </script>
  </body>

  </html>
<?php } ?>