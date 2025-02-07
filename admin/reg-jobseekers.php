<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
$dbh = DBConnectionFactory::createConnection();
if (empty($_SESSION['jpaid'])) {
    header('location:logout.php');
} else {
    ?>
    <!doctype html>
    <html lang="en" class="no-focus">

    <head>
        <title>WorkNet - Lista e punëkërkuesve</title>
        <link rel="stylesheet" href="assets/js/plugins/datatables/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" id="css-main" href="assets/css/codebase.min.css">
    </head>

    <body>
        <div id="page-container" class="sidebar-o sidebar-inverse side-scroll page-header-fixed main-content-narrow">
            <?php include_once('includes/sidebar.php'); ?>
            <?php include_once('includes/header.php'); ?>
            <main id="main-container">
                <div class="content">
                    <h2 class="content-heading">Lista e punëkërkuesve</h2>
                    <div class="block">
                        <div class="block-header bg-gd-emerald">
                            <h3 class="block-title">Lista e punëkërkuesve</h3>
                        </div>
                        <div class="block-content block-content-full">
                            <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Emri i plotë</th>
                                        <th>Numri telefonit</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th class="d-none d-sm-table-cell">Data e regjistrimit</th>
                                        <th style="width: 25%;">Ndërveprim</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM tbljobseekers";
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
                                                    <?php echo htmlentities($row->ContactNumber); ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlentities($row->EmailId); ?>
                                                </td>
                                                <?php if ($row->IsActive == '1') { ?>
                                                    <td>
                                                        <?php echo "Active"; ?>
                                                    </td>
                                                <?php } else { ?>
                                                    <td>
                                                        <?php echo "Inactive"; ?>
                                                    </td>
                                                <?php } ?>

                                                <td class="d-none d-sm-table-cell">
                                                    <?php echo htmlentities($row->RegDate); ?>
                                                </td>
                                                <td>
                                                    <a href="view-jobseeker-details.php?viewid=<?php echo htmlentities($row->id); ?>"
                                                        class="btn btn-primary btn-sm">Shiko</a>
                                                    <a href="jobsapplied-jobseekers.php?jobsid=<?php echo htmlentities($row->id); ?>&&jsname=<?php echo htmlentities($row->FullName); ?>"
                                                        class="btn btn-warning btn-sm" target="blank">punët e aplikuara</a>
                                                </td>
                                            </tr>
                                            <?php $cnt = $cnt + 1;
                                        }
                                    } ?>
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
<?php } ?>