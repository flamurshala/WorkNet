<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
$dbh = DBConnectionFactory::createConnection();
if (strlen($_SESSION['jpaid'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {

        $jpaid = $_SESSION['jpaid'];
        $pagetitle = $_POST['pagetitle'];
        $pagedes = $_POST['pagedes'];
        $sql = "update tblpages set PageTitle=:pagetitle,PageDescription=:pagedes where  PageType='aboutus'";
        $query = $dbh->prepare($sql);
        $query->bindParam(':pagetitle', $pagetitle, PDO::PARAM_STR);
        $query->bindParam(':pagedes', $pagedes, PDO::PARAM_STR);

        $query->execute();
        echo '<script>alert("About us has been updated")</script>';

    }
    ?>
    <!doctype html>
    <html lang="en" class="no-focus">

    <head>
        <title>WorkNet|| rreth nesh</title>
        <link rel="stylesheet" id="css-main" href="assets/css/codebase.min.css">
        <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
        <script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
    </head>

    <body>
        <div id="page-container" class="sidebar-o sidebar-inverse side-scroll page-header-fixed main-content-narrow">

            <?php include_once('includes/sidebar.php'); ?>

            <?php include_once('includes/header.php'); ?>

            <main id="main-container">
                <div class="content">
                    <h2 class="content-heading">Përditëso faqen rreth nesh</h2>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="block block-themed">
                                <div class="block-header bg-gd-emerald">
                                    <h3 class="block-title">Përditëso Rreth Nesh</h3>
                                </div>
                                <div class="block-content">
                                    <form method="post">
                                        <?php

                                        $sql = "SELECT * from  tblpages where PageType='aboutus'";
                                        $query = $dbh->prepare($sql);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        $cnt = 1;
                                        if ($query->rowCount() > 0) {
                                            foreach ($results as $row) { ?>
                                                <div class="form-group row">
                                                    <label class="col-12" for="register1-email">Tituli:</label>
                                                    <div class="col-12">
                                                        <input type="text" name="pagetitle" value="<?php echo $row->PageTitle; ?>"
                                                            class="form-control" required='true'>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-12" for="register1-email">Përshkrimi:</label>
                                                    <div class="col-12">
                                                        <textarea type="text" name="pagedes" class="form-control"
                                                            required='true'><?php echo $row->PageDescription; ?></textarea>
                                                    </div>
                                                </div>
                                                <?php $cnt = $cnt + 1;
                                            }
                                        } ?>
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-alt-success" name="submit">
                                                    <i class="fa fa-plus mr-5"></i> Përditëso
                                                </button>
                                            </div>
                                        </div>
                                    </form>
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