<?php
require_once("includes/config.php");

if (!empty($_POST["emailid"])) {
	echo $email = $_POST["emailid"];
	exit();
	if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {

		echo "error : Shkruaj një email valid.";
	} else {
		$sql = "SELECT EmailId FROM tbljobseekers WHERE EmailId=:email";
		$query = $dbh->prepare($sql);
		$query->bindParam(':email', $email, PDO::PARAM_STR);
		$query->execute();
		$results = $query->fetchAll(PDO::FETCH_OBJ);
		if ($query->rowCount() > 0) {
			echo "<span style='color:red'> Emaili është i regjistruar .</span>";
			echo "<script>$('#submit').prop('disabled',true);</script>";
		} else {

			echo "<span style='color:green'> Email është në rregull .</span>";
			echo "<script>$('#submit').prop('disabled',false);</script>";
		}
	}
}
