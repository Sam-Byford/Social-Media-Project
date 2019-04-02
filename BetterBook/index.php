<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
	<title>Index Page | BetterBook</title>
	<link rel="icon" type="image/png" href="assets/favicon.png">
	<link href="https://getbootstrap.com/docs/4.3/examples/jumbotron/" rel="canonical">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	<link rel="stylesheet" href="css/index.css?version=1">
</head>
<body>
	<?php include 'Header.php';?>
	<main role="main">
		<div class="jumbotron">
			<div class="container">
				<?php 
					if(isset($_SESSION['user_online'])){
						echo '<h1 class="display-3" id="EmailHeader">hey ' . $_SESSION['user_online'] . '</h1>';
						echo '<p class="lead">Below are some course related forum chats, why not join in? </p>';
					} else {
						echo '<h5 class="display-3">You will have to <a href="login.php">login</a> to access these cool chats!</h5>';
					}
				?>
			</div>
		</div>
		<?php 
			if(isset($_SESSION['user_online'])){
				echo '
					<div class="container">
						<div class="row">
							<div class="col-md-4">
								<h2>CompSci <i class="fas fa-terminal"></i></h2>
								<p>A public chat room dedicated to computer science related talk!</p>
								<p><a class="btn btn-success" href="subject_chat_room.php?subject=compsci" role="button">View details &raquo;</a></p>
							</div>
							<div class="col-md-4">
								<h2>GameComp <i class="fas fa-gamepad"></i></h2>
								<p>A public chat room dedicated to games computing related talk!</p>
								<p><a class="btn btn-warning" href="subject_chat_room.php?subject=gamecomp" role="button">View details &raquo;</a></p>
							</div>
							<div class="col-md-4">
								<h2>Art <i class="fas fa-paint-brush"></i></h2>
								<p>A public chat room dedicated to art related talk!</p>
								<p><a class="btn btn-danger" href="subject_chat_room.php?subject=art" role="button">View details &raquo;</a></p>
							</div>
						</div>
						<hr>
					</div>';
			} else {
			    echo '
					<div class="container">
						<div class="row">
							<div class="col-md-4">
								<h2>CompSci <i class="fas fa-terminal"></i></h2>
								<p>A public chat room dedicated to computer science related talk!</p>
								<p><a class="btn btn-success disabled" href="#" role="button">View details &raquo;</a></p>
							</div>
							<div class="col-md-4">
								<h2>GameComp <i class="fas fa-gamepad"></i></h2>
								<p>A public chat room dedicated to games computing related talk!</p>
								<p><a class="btn btn-warning disabled" href="#" role="button">View details &raquo;</a></p>
							</div>
							<div class="col-md-4">
								<h2>Art <i class="fas fa-paint-brush"></i></h2>
								<p>A public chat room dedicated to art related talk!</p>
								<p><a class="btn btn-danger disabled" href="#" role="button">View details &raquo;</a></p>
							</div>
						</div>
						<hr>
					</div>';
			}
		?>
		
	</main>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</body>
</html>