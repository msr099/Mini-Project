<?php include ( "inc/connect.inc.php" ); ?>
<?php
ob_start();
session_start();
if (!isset($_SESSION['user_login'])) {
	$user = "";
}
else {
	$user = $_SESSION['user_login'];
	$result = mysqli_query($link,"SELECT * FROM user WHERE id='$user'");
		$get_user_email = mysqli_fetch_assoc($result);
			$uname_db = $get_user_email['firstName'];
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Vasavi e_Corner</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
    integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
		<link rel="stylesheet" href="css/index_css.css">
	</head>
	<body style="min-width: 980px; background: linear-gradient(rgba(255,255,255,0.5),rgba(255,255,255,0.5)),url(image/bg2.jpg) no-repeat center fixed; background-size: cover;">
		<div class="homepageheader" style="position:relative; background-color:#e6525d">
			<div class="signinButton loginButton">
				<div class="uiloginbutton signinButton loginButton" style="margin-right: 40px;">
					<?php
						if ($user!="") {
							echo '<a style="text-decoration: none; color: #fff;" href="logout.php">LOG OUT</a>';
						}
						else {
							echo '<a style="color: #fff; text-decoration: none;" href="signin.php"> USER SIGN UP</a>';
						}
					 ?>

				</div>
				<div class="uiloginbutton signinButton loginButton" style="">
					<?php
						$adminButtonDisplay="";
						if ($user!="") {
							echo '<a style="text-decoration: none; color: #fff;" href="profile.php?uid='.$user.'">Hi '.$uname_db.'</a>';
							$adminButtonDisplay="style='display:none;'";
						}
						else {
							echo '<a style="text-decoration: none; color: #fff;" href="login.php">USER LOG IN</a>';
						}
					 ?>
				</div>
				<div class="uiloginbutton signinButton loginButton" <?php echo $adminButtonDisplay; ?>>
					<?php
						if ($user=="") {
							echo '<a style="text-decoration: none; color: #fff;" href="./admin/index.php">ADMIN</a> ';
						}
					?>
				</div>

			<!-- </div> -->
			<div style="float: left; margin: 1em;">
				<a href="index.php">
					<img style=" height: 60px; width: 130px;" src="image/cart.png">
				</a>
			</div>

			<div class="uiloginbutton signinButton loginButton" style="float: left;">
					<a style="text-decoration: none; color: #fff;" href="#aboutus">About Us</a>
				</div>
			<div class="uiloginbutton signinButton loginButton" style="float: left;">
				<a style="text-decoration: none; color: #fff;" href="#contactus">Contact Us</a>
			</div>
			</div>

		</div>
		<div class="home-welcome">
			<div class="home-welcome-text">
				<div style="padding-top: 0;">
					<div style=" background-color: #dadbe6;">
						<h1 style="margin: 0px; margin-right:2.3em;">Vasavi e-Corner</h1>
					</div>
				</div>
			</div>
		</div>
		<div class="home-prodlist">

			<div id="canteencontainer" class="container">
      <div class="row align-items-center">
        <div class="col-md-6">
          <img class="img-fluid" id="canteen" src="image/cafe_index.jpg" alt="Canteen">
        </div>
        <div class="col-md-6">
          <section id="canteeninfo">
            <h3 style="text-align: right; color: #e63946;">Cafeteria</h3>
            <p>Our college cafeteria provides us with a wide variety of beverages and dishes. Hit the below link to explore more..!!</p>
            <center>
			<form action="OurProducts/cafeteria.php" method="get">
			<button type="submit" class="btn btn-outline-danger">
				Click Here!
			</button>
			</form>
			</center>
          </section>
        </div>
      </div>
    </div>


	<div id="stationerycontainer" class="container">
      <div class="row align-items-center">
        <div class="col-md-6">
          <section id="stationeryinfo">
            <h3 style="text-align: left; color: #1d3557;">Stationery</h3>
            <p>Our college stationery is the go-to-place for all the basic materialistic requirements of students and staff. Check out the products available by clicking the link below..!!</p>
            <center>
			<form action="OurProducts/stationery.php" method="get">
			<button type="submit" class="btn btn-outline-primary" onclick="clickEvent2()">
				Click Here!
			</button>
			</form>
			</center>
          </section>
        </div>
        <div class="col-md-6">
          <img class="img-fluid" id="stationery" src="image/st-img.jpg" alt="Stationery">
        </div>
      </div>
    </div>


	<div id="aboutus">
      <h2 >About Us</h2>
      <p>
	  <h5 style="font-weight:490;">
        Vasavi e-Corner is an online portal for accessing basic facilities provided by Vasavi college of engineering such as food and stationery. This application enables users to explore wide range of products offered and order them in a single click!
		</h5>
      </p>
    </div>

    <div id="contactus">
      <h2 >Contact Us</h2>
      <h5>Email : </h5>
	  <h5 style="font-weight:490;">
      <p>1602-18-733-096@vce.ac.in</p>
      <p>1602-18-733-098@vce.ac.in</p>
	  </h5>
    </div>
		</div>
	</body>
</html>