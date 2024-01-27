<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['jpaid'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $adminid = $_SESSION['jpaid'];
        $AName = $_POST['adminname'];
        $mobno = $_POST['mobilenumber'];
        $email = $_POST['email'];
        $sql = "update tbladmin set AdminName=:adminname,MobileNumber=:mobilenumber,Email=:email where ID=:aid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':adminname', $AName, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':mobilenumber', $mobno, PDO::PARAM_STR);
        $query->bindParam(':aid', $adminid, PDO::PARAM_STR);
        $query->execute();

        echo '<script>alert("Profili u përditësua")</script>';
    }
    ?>
    <!doctype html>
    <html lang="en" class="no-focus">

    <head>
        <title>WorkNet - Profili Admin</title>
        <link rel="stylesheet" id="css-main" href="assets/css/codebase.min.css">
    </head>

    <body>
        <div id="page-container" class="sidebar-o sidebar-inverse side-scroll page-header-fixed main-content-narrow">

            <?php include_once('includes/sidebar.php'); ?>

            <?php include_once('includes/header.php'); ?>

            <main id="main-container">
                <div class="content">
                    <h2 class="content-heading">Profili Admin</h2>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="block block-themed">
                                <div class="block-header bg-gd-emerald">
                                    <h3 class="block-title">Profili Admin</h3>
                                </div>
                                <div class="block-content">
                                    <?php
                                    $sql = "SELECT * from  tbladmin";
                                    $query = $dbh->prepare($sql);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt = 1;
                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $row) { ?>
                                            <form method="post">
                                                <div class="form-group row">
                                                    <label class="col-12" for="register1-username">Emri i adminit:</label>
                                                    <div class="col-12">
                                                        <input type="text" class="form-control" name="adminname"
                                                            value="<?php echo $row->AdminName; ?>" required='true'>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-12" for="register1-email">Emri përdoruesit:</label>
                                                    <div class="col-12">
                                                        <input type="text" class="form-control" name="username"
                                                            value="<?php echo $row->UserName; ?>" readonly="true">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-12" for="register1-password">Email:</label>
                                                    <div class="col-12">
                                                        <input type="email" class="form-control" name="email"
                                                            value="<?php echo $row->Email; ?>" required='true'>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-12" for="register1-password">Numri telefonit:</label>
                                                    <div class="col-12">
                                                        <input type="text" class="form-control" name="mobilenumber"
                                                            value="<?php echo $row->MobileNumber; ?>" required='true'
                                                            maxlength='11'>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-12" for="register1-password">Data e regjistrimit:</label>
                                                    <div class="col-12">
                                                        <input type="text" class="form-control" id="email2" name=""
                                                            value="<?php echo $row->AdminRegdate; ?>" readonly="true">
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