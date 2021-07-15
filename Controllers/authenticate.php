<?php

if(!empty(session_id())){
	session_unset();
	session_destroy();
}

//Check that parameters are set to URL
if(isset($_GET['username']) && isset($_GET['pwd'])){
	$read_req = json_decode(file_get_contents('http://'.$_SERVER['HTTP_HOST'].'/Inventorizer/Controllers/readUser.php?username='.$_GET['username']),true);
	//The user data is correctly retrieved
	if(count($read_req) == 1){
		if(count($read_req[0]) != 1){
			//Correct passwords have access granted, even with forced entry (needs to be ciphered though)
			if($_GET['pwd'] == $read_req[0]['password']){
				session_start();
				$_SESSION['userid'] = $read_req[0]['id'];
				$_SESSION['username'] = $read_req[0]['username'];
				$_SESSION['displayid'] = $read_req[0]['displayname'];
				$_SESSION['emailreg'] = $read_req[0]['email'];
				$_SESSION['ciphpass'] = $read_req[0]['password'];
				$_SESSION['lastAccess'] = date("Y-n-j H:i:s");
				echo "<script>window.location = '/Inventorizer/home'</script>";
			}
			//Incorrect passwords are redirected to login (only for forced entry)
			else {
				echo "<script>window.location = '/Inventorizer/'</script>";
			}
		}
		//There was no user found
		else {
			echo "<script>window.location = '/Inventorizer/'</script>";
		}
	}
	//Only the logged error message is retrieved in case a forced entry with wrong params is done
	else {
		echo "<script>window.location = '/Inventorizer/'</script>";
	}
}
//No parameters means an entry through URL was forced
else {
	echo "<script>window.location = '/Inventorizer/'</script>";
}


?>