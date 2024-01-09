<?php 
session_start();
include '../config/conn.php';
if (isset($_POST['email']) && isset($_POST['password'])) {

	function validate($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	$email = validate($_POST['email']);
	$password = validate($_POST['password']);
	$password = md5($password); // hash password with MD5

	if (empty($email)) {
		header("Location: ../login.php?error=email is required");
		exit();
	}else if(empty($password)){
		header("Location: ../login.php?error=password is required");
		exit();
	}else{
		// echo "Valid Input";
		$sql = "SELECT * FROM members WHERE email = '$email' AND password = '$password'";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
			if($row['email'] === $email && $row['password'] === $password){
				// echo "Logged in!";
				$_SESSION['id'] = $row['id'];
				$_SESSION['email'] = $row['email'];

				header("Location: ../index.php");
				exit();
			}else{
				header("Location: ../login.php?error=Incorect Email Or Password");
				exit();
			}				
		}else{
			header("Location: ../login.php?error=Incorect Email Or Password");
			exit();
		}
	}

}else{
	header("Location: login.php");
	exit();
}

?>