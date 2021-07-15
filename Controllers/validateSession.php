<?php 

session_start();
//Check if there is an active session
if(isset($_SESSION['lastAccess']) && isset($_SESSION['userid'])){

	//Check if session timestamp is still valid
	$lastAccess = $_SESSION['lastAccess'];
	$now = date("Y-n-j H:i:s");
	$elapsed = strtotime($now) - strtotime($lastAccess);

	//Check elapsed seconds, 30 minutes of inactivity causes logout
	if($elapsed >= 1800) {
		session_unset();
		session_destroy();
		echo "<script>window.location = '/Inventorizer/logout'</script>";
	}
	//Grants access if session timestamp is still valid
	else {
		$_SESSION['lastAccess'] = date("Y-n-j H:i:s");
		echo "<script>console.log('Elapsed time: ".$elapsed."');</script>";
		//echo "<script>window.location = 'home.html'</script>";
	}
}
//Handle forced entry to home, redirect to login.html
else {
	echo "<script>window.location = '/Inventorizer/'</script>";
}

?>