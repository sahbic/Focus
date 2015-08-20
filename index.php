<?php
	include_once "common/base.php";
	$pageTitle = "Home";
	include_once "common/header.php";
?>

          <div class="inner cover">
            <h1 class="cover-heading">Focus on yourself.</h1>

<?php
	if(isset($_SESSION['LoggedIn']) && isset($_SESSION['Username'])
		&& $_SESSION['LoggedIn']==1):
?>
						<p class="lead">Start configuring your bot !</p>
						</br>
						<div class="col-md-4 col-md-offset-4">
							<a href="closet.php" class="btn btn-default btn-lg btn-block" role="button">Closet</a>
							<a href="#" class="btn btn-default btn-lg btn-block" role="button">Book of Recipes</a>
						</div>
<?php else: ?>
						<p class="lead">Focus is an AI which purpose is to take over your daily boring decsions to help you focus on what really matters for you</p>
						<br/>
						<p class="lead">
              <a href="login.php" class="btn btn-lg btn-default">Start</a>
						</p>
<?php endif; ?>
          </div>

<?php
	include_once 'common/close.php';
?>
