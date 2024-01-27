<?php
require_once("includes/config.php");

if (!empty($_POST["email"])) {
	$email = $_POST["email"];
	if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
		echo "error : Shkruani email valid.";
	} else {
		$sql = "SELECT EmpEmail FROM tblemployers WHERE EmpEmail=:email";
		$query = $dbh->prepare($sql);
		$query->bindParam(':email', $email, PDO::PARAM_STR);
		$query->execute();
		$results = $query->fetchAll(PDO::FETCH_OBJ);
		if ($query->rowCount() > 0) {
			echo "<span style='color:red'> Email ekzistonë .</span>";
			echo "<script>$('#submit').prop('disabled',true);</script>";
		} else {
			echo "<span style='color:green'> Email pranohet .</span>";
			echo "<script>$('#submit').prop('disabled',false);</script>";
		}
	}
}
