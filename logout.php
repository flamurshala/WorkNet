<?php
session_start();
include("includes/config.php");
$dbh = DBConnectionFactory::createConnection();
$_SESSION['login'] = "";
session_unset();
session_destroy();
?>
<script language="javascript">
    document.location = "index.php";
</script>