<?php
	include_once "common/base.php";
	$pageTitle = "Home";
	include_once "common/header.php";
?>

          <div class="inner cover">
            <h1 class="cover-heading">Focus on yourself.</h1>
            <p class="lead">Start configuring your bots !</p>
						<br/>
<?php
	if(isset($_SESSION['LoggedIn']) && isset($_SESSION['Username'])
		&& $_SESSION['LoggedIn']==1):
?>
						<p class="lead">
							<a href="stylistbot_conf.php" class="btn btn-lg btn-default">@StylistBot</a>
						</p>
						<p  class="lead">
							<a href="#" class="btn btn-lg btn-default">@BouffeBot</a>
						</p>
<?php else: ?>
						<p class="lead">
              <a href="login.php" class="btn btn-lg btn-default">Start</a>
						</p>
<?php endif; ?>
          </div>

<?php
	include_once 'common/close.php';
?>
