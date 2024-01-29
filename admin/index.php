<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $sql = "SELECT ID FROM tbladmin WHERE UserName=:username and Password=:password";
    $query = $dbh->prepare($sql);
    $query->bindParam(':username', $username, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {
        foreach ($results as $result) {
            $_SESSION['jpaid'] = $result->ID;
        }

        if (!empty($_POST["remember"])) {
            setcookie("user_login", $_POST["username"], time() + (10 * 365 * 24 * 60 * 60));
            setcookie("userpassword", $_POST["password"], time() + (10 * 365 * 24 * 60 * 60));
        } else {
            if (isset($_COOKIE["user_login"])) {
                setcookie("user_login", "");
                if (isset($_COOKIE["userpassword"])) {
                    setcookie("userpassword", "");
                }
            }
        }
        $_SESSION['login'] = $_POST['username'];
        echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";
    } else {
        echo "<script>alert('Invalid Details');</script>";
    }
}
?>
<!doctype html>
<html lang="en" class="no-focus">

<head>
    <title>WorkNet - Admin Kyçu</title>
    <link rel="stylesheet" id="css-main" href="assets/css/codebase.min.css">
</head>

<body>
    <div id="page-container" class="main-content-boxed">
        <main id="main-container">
            <div class="bg-image" style="background-image: url('assets/img/photos/photo5@2x.jpg');">
                <div class="row mx-0 bg-black-op">
                    <div class="hero-static col-md-6 col-xl-6 d-none d-md-flex align-items-md-end">
                        <div class="p-30 invisible" data-toggle="appear">
                            <p class="font-size-h3 font-w600 text-white">
                                WorkNet.
                            </p>
                        </div>
                    </div>
                    <div class="hero-static col-md-6 col-xl-6 d-flex align-items-center bg-white invisible"
                        data-toggle="appear" data-class="animated fadeInRight">
                        <div class="content content-full">
                            <!-- Header -->
                            <div class="px-30 py-10">
                                <h1 class="h3 font-w700 mt-30 mb-10">Mirë se erdhe në dashboard Admin</h1>
                                <h2 class="h5 font-w400 text-muted mb-0">Ju lutem kyçuni</h2>
                            </div>
                            <form class="js-validation-signin px-30" method="post">
                                <div class="form-group row">
                                    <div class="col-12">
                                        <div class="form-material floating">
                                            <input type="text" class="form-control" required="true" name="username"
                                                value="<?php if (isset($_COOKIE["user_login"])) {
                                                    echo $_COOKIE["user_login"];
                                                } ?>">
                                            <label for="login-username">Emri përdoruesit</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <div class="form-material floating">
                                            <input type="password" class="form-control" name="password" required="true"
                                                value="<?php if (isset($_COOKIE["userpassword"])) {
                                                    echo $_COOKIE["userpassword"];
                                                } ?>">
                                            <label for="login-password">Fjalëkalimi</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-sm btn-hero btn-alt-primary" name="login">
                                        <i class="si si-login mr-10"></i> kyçuni
                                    </button>
                                    <div class="mt-30">

                                        <a class="link-effect text-muted mr-10 mb-5 d-inline-block" href="#">
                                            <i class="fa fa-warning mr-5"></i> Keni harruar fjalëkalimin
                                        </a>
                                        <a href="../index.php">Faqja kryesore!!</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
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
    <script src="assets/js/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="assets/js/pages/op_auth_signin.js"></script>
</body>

</html>