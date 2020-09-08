<?php
if (isset($_POST['send-submit'])) {
	
	require 'dbh.inc.php';

	$category = $_POST['place-go'];
	$workname = $_POST['work'];
	$placename = $_POST['place'];
	$tripstart = $_POST['trip-start'];
	$tripend = $_POST['trip-end'];
	$timestart = $_POST['time-start'];
	$timeend = $_POST['time-end'];
	$pegawai = $_POST['officer'];


	if (empty($category) || empty($workname) || empty($placename) || empty($tripstart)|| empty($tripend) || empty($timestart)|| empty($timeend) || empty($pegawai)) {
		header("Location: ../form.php?error=emptyfields&uid=".$placego."&place=");
		exit();
	}
	else{
		$sql = "SELECT destinationId FROM destination WHERE destinationId=?";
		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt,$sql)){
			header("Location: ../form.php?error=sqlerror");
			exit();
		}
		else{
			$sql = "INSERT INTO destination (category,workname,placename,tripstart,tripend,timestart,timeend,replaceofficer) VALUES (?,?,?,?,?,?,?,?)";
				$stmt = mysqli_stmt_init($conn);
				if(!mysqli_stmt_prepare($stmt,$sql)){
			     header("Location: ../form.php?error=sqlerror");
			     exit();
				}
				 else{
					mysqli_stmt_bind_param($stmt, "ssssssss",$category,$workname,$placename,$tripstart,$tripend,$timestart,$timeend,$pegawai);
			        mysqli_stmt_execute($stmt);
			        header("Location: ../form.php?form=success");
			        exit();
				}
		    
		    }
	    }

	mysqli_stmt_close($stmt);
	mysql_close($conn);


}
else{
header("Location: ../form.php?form=success");
exit();
}

