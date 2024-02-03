<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
$dbh = DBConnectionFactory::createConnection();
if (strlen($_SESSION['jpaid']) == 0) {
    header('location:logout.php');
} else {
    ?>
    <!DOCTYPE html>
    <html lang="en" class="no-focus">

    <head>
        <title>WorkNet - Listimi i punëve të aplikuara</title>
        <link rel="stylesheet" href="assets/js/plugins/datatables/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" id="css-main" href="assets/css/codebase.min.css">
    </head>

    <body>
        <div id="page-container" class="sidebar-o sidebar-inverse side-scroll page-header-fixed main-content-narrow">
            <?php include_once('includes/sidebar.php'); ?>
            <?php include_once('includes/header.php'); ?>

            <main id="main-container">
                <div class="content">
                    <h2 class="content-heading">Punët e aplikuara nga
                        <?php echo $_GET['jsname']; ?>
                    </h2>
                    <div class="block">
                        <div class="block-header bg-gd-emerald">
                            <h3 class="block-title">Lista e punëve të aplikuara</h3>
                        </div>
                        <div class="block-content block-content-full">
                            <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Emri i plotë</th>
                                        <th>Emri i punës</th>
                                        <th>Kategoria</th>
                                        <th>Emri kompanis</th>
                                        <th>Data e aplikimit</th>
                                        <th class="d-none d-sm-table-cell">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $jsid = intval($_GET['jobsid']);
                                    $sql = "SELECT tbljobseekers.FullName,tbljobs.jobTitle,tbljobs.jobCategory,tblapplyjob.Applydate,tblapplyjob.Status,tblemployers.CompnayName 
                                        FROM tblapplyjob
                                        JOIN tbljobseekers ON tbljobseekers.id=tblapplyjob.UserId
                                        JOIN tbljobs ON tbljobs.jobId=tblapplyjob.JobId
                                        JOIN tblemployers ON tblemployers.id=tbljobs.employerId
                                        WHERE tblapplyjob.UserId='$jsid'";
                                    $query = $dbh->prepare($sql);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);

                                    $cnt = 1;
                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $row) {
                                            ?>
                                            <tr>
                                                <td class="text-center">
                                                    <?php echo htmlentities($cnt); ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlentities($row->FullName); ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlentities($row->jobTitle); ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlentities($row->jobCategory); ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlentities($row->CompnayName); ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlentities($row->Applydate); ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlentities($row->Status); ?>
                                                </td>
                                            </tr>
                                            <?php
                                            $cnt = $cnt + 1;
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
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
        <script src="assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="assets/js/plugins/datatables/dataTables.bootstrap4.min.js"></script>
        <script src="assets/js/pages/be_tables_datatables.js"></script>
    </body>

    </html>
    <?php
}
?>