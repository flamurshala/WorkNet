<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['jpaid'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {

        $jpaid = $_SESSION['jpaid'];
        $pagetitle = $_POST['pagetitle'];
        $pagedes = $_POST['pagedes'];
        $mobnum = $_POST['mobnum'];
        $email = $_POST['email'];
        $sql = "update tblpages set PageTitle=:pagetitle,PageDescription=:pagedes,Email=:email,MobileNumber=:mobnum where  PageType='contactus'";
        $query = $dbh->prepare($sql);
        $query->bindParam(':pagetitle', $pagetitle, PDO::PARAM_STR);
        $query->bindParam(':pagedes', $pagedes, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':mobnum', $mobnum, PDO::PARAM_STR);
        $query->execute();
        echo '<script>alert("Contact us has been updated")</script>';

    }
    ?>
    <!doctype html>
    <html lang="en" class="no-focus">

    <head>
        <title>WorkNet - Përditëso kontaktin</title>
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
                    <h2 class="content-heading">Përditëso kontaktin</h2>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Bootstrap Register -->
                            <div class="block block-themed">
                                <div class="block-header bg-gd-emerald">
                                    <h3 class="block-title">Përditëso kontaktin</h3>
                                </div>
                                <div class="block-content">
                                    <form method="post">

                                        <?php
                                        $sql = "SELECT * from  tblpages where PageType='contactus'";
                                        $query = $dbh->prepare($sql);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        $cnt = 1;
                                        if ($query->rowCount() > 0) {
                                            foreach ($results as $row) { ?>
                                                <div class="form-group row">
                                                    <label class="col-12" for="register1-email">Emri faqes:</label>
                                                    <div class="col-12">
                                                        <input type="text" name="pagetitle" id="pagetitle" required="true"
                                                            value="<?php echo $row->PageTitle; ?>" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-12" for="register1-email">Email:</label>
                                                    <div class="col-12">
                                                        <input type="text" name="email" id="email" required="true"
                                                            value="<?php echo $row->Email; ?>" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-12" for="register1-email">Numri telefonit:</label>
                                                    <div class="col-12">
                                                        <input type="text" name="mobnum" id="mobnum" required="true"
                                                            value="<?php echo $row->MobileNumber; ?>" class="form-control"
                                                            maxlength="11" pattern="[0-9]+">
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