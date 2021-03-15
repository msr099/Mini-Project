<?php include ( "inc/connect.inc.php" ); ?>

<?php
ob_start();
session_start();
if (!isset($_SESSION['user_login'])) {
}
else {
	header("location: index.php");
}
$emails = "";
$passs = "";
if (isset($_POST['login'])) {
	if (isset($_POST['email']) && isset($_POST['password'])) {
		$user_login = $_POST['email'];
		$user_login = mb_convert_case($user_login, MB_CASE_LOWER, "UTF-8");
		$password_login = $_POST['password'];
		$num = 0;
		$password_login_md5 = md5($password_login);
		$result = mysqli_query($link,"SELECT * FROM user WHERE (email='$user_login') AND password='$password_login_md5'");
		$num = mysqli_num_rows($result);
		$get_user_email = mysqli_fetch_assoc($result);
			// $get_user_uname_db = $get_user_email['id'];
			$get_user_uname_db = isset($get_user_email['id'])?($get_user_email['id']):0;
		if ($num>0) {
			$_SESSION['user_login'] = $get_user_uname_db;
			setcookie('user_login', $user_login, time() + (365 * 24 * 60 * 60), "/");

			if (isset($_REQUEST['ono'])) {
				$ono = $_REQUEST['ono'];
				header("location: orderform.php?poid=".$ono."");
			}else {
				header('location: index.php');
			}
			exit();
		}
		else {
			$result1 = mysqli_query($link,"SELECT * FROM user WHERE (email='$user_login') AND password='$password_login_md5'");
		$num1 = mysqli_num_rows($result1);
		$get_user_email1 = mysqli_fetch_assoc($result1);
			// $get_user_uname_db1 = $get_user_email1['id'];
			$get_user_uname_db1 = isset($get_user_email1['id'])?($get_user_email1['id']):0;
		if ($num1>0) {
			$emails = $user_login;
			$activacc ='';
		}else {
			$emails = $user_login;
			$passs = $password_login;
			$error_message = '<br><br>
				<div class="maincontent_text" style="text-align: center; font-size: 18px;">
				<font face="bookman">Email or Password incorrect.<br>
				</font></div>';
		}

		}
	}

}
// $acemails = "";
// $acccode = "";
// if(isset($_POST['activate'])){
// 	if(isset($_POST['actcode'])){
// 		$user_login = $_POST['acemail'];
// 		$user_login = mb_convert_case($user_login, MB_CASE_LOWER, "UTF-8");
// 		$user_acccode = $_POST['actcode'];
// 		$result2 = mysqli_query($link,"SELECT * FROM user WHERE (email='$user_login') AND confirmCode='$user_acccode'");
// 		$num3 = mysqli_num_rows($result2);
// 		echo $user_login;
// 		if ($num3>0) {
// 			$get_user_email = mysqli_fetch_assoc($result2);
// 			$get_user_uname_db = $get_user_email['id'];
// 			$_SESSION['user_login'] = $get_user_uname_db;
// 			setcookie('user_login', $user_login, time() + (365 * 24 * 60 * 60), "/");
// 			mysqli_query($link,"UPDATE user SET confirmCode='0', activation='yes' WHERE email='$user_login'");
// 			if (isset($_REQUEST['ono'])) {
// 				$ono = $_REQUEST['ono'];
// 				header("location: orderform.php?poid=".$ono."");
// 			}else {
// 				header('location: index.php');
// 			}
// 			exit();
// 		}else {
// 			$emails = $user_login;
// 			$error_message = '<br><br>
// 				<div class="maincontent_text" style="text-align: center; font-size: 18px;">
// 				<font face="bookman">Code not matched!<br>
// 				</font></div>';
// 		}
// 	}else {
// 		$error_message = '<br><br>
// 				<div class="maincontent_text" style="text-align: center; font-size: 18px;">
// 				<font face="bookman">Activation code not matched!<br>
// 				</font></div>';
// 	}

// }

?>

<!doctype html>
<html>
	<head>
		<title>Vasavi e-Corner</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body class="home-welcome-text" style="min-width: 980px; background: linear-gradient(rgba(255,255,255,0.5),rgba(255,255,255,0.5)),url(image/bg2.jpg) no-repeat center fixed; background-size: cover;">
		<div class="homepageheader">
			<div class="signinButton loginButton">
				<div class="uiloginbutton signinButton loginButton" style="margin-right: 40px;">
					<a style="text-decoration: none; color: #fff;" href="signin.php">SIGN UP</a>
				</div>
				<div class="uiloginbutton signinButton loginButton" style="">
					<a style="text-decoration: none; color: #fff;" href="login.php">LOG IN</a>
				</div>
			</div>
			<div style="float: left; margin: 5px 0px 0px 23px;">
				<a href="index.php">
					<img style=" height: 75px; width: 130px;" src="image/cart.png">
				</a>
			</div>
		</div>
		<div class="holecontainer" style="float: right; margin-right: 36%; padding-top: 110px;">
			<div class="container">
				<div>
					<div>
						<div class="signupform_content">
							<?php
							 	if (isset($activacc)){
							 		echo '<h2>Activation Form</h2>';
							 	}else {
							 		echo '<h2>Login Form</h2>';
							 	}
							?>
							<div class="signupform_text"></div>
							<div>
								<form action="" method="POST" class="registration">
									<div class="signup_form">
										<?php
											if (isset($activacc)) {

												echo '
													<div class="signup_error_msg">
														<div class="maincontent_text" style="text-align: center; font-size: 18px;">
													<font face="bookman">Check your email!<br>
													</font></div>
													</div>
													<div>
														<td>
															<input name="acemail" placeholder="Enter Your Email" required="required" class="email signupbox" type="email" size="30" value="'.$emails.'">
														</td>
													</div>
													<div>
														<td>
															<input name="actcode" placeholder="Activation Code" required="required" class="email signupbox" type="text" size="30" value="'.$acccode.'">
														</td>
													</div>
													<div>
														<input name="activate" class="uisignupbutton signupbutton" type="submit" value="Active Account">
													</div>
													';
											}else{
												echo '
										<div>
											<td>
												<input name="email" placeholder="Enter Your Email" required="required" class="email signupbox" type="email" size="30" value="'.$emails.'">
											</td>
										</div>
										<div>
											<td>
												<input name="password" id="password-1" required="required"  placeholder="Enter Password" class="password signupbox " type="password" size="30" value="'.$passs.'">
											</td>
										</div>
										<div>
											<input name="login" class="uisignupbutton signupbutton" type="submit" style="color:#1d3557" value="Log In">
										</div>
										';
											}
										  ?>
										<div class="signup_error_msg">
											<?php
												if (isset($error_message)) {echo $error_message;}

											?>
										</div>
									</div>
								</form>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>