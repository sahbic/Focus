<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Focus | <?php echo $pageTitle ?></title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-colorpicker.min.css" rel="stylesheet">
    <link href="css/slider.css" rel="stylesheet">
    <link href="css/cover.css" rel="stylesheet">
  </head>
  <body>

    <div class="site-wrapper">

      <div class="site-wrapper-inner">

        <div class="cover-container">

          <div class="masthead clearfix">
            <div class="inner">
              <h3 class="masthead-brand"><a href="/index.php">Focus</a></h3>
              <nav>
                <ul class="nav masthead-nav">
                  <li><a href="contact.php">Contact</a></li>

<?php
	if(isset($_SESSION['LoggedIn']) && isset($_SESSION['Username'])
		&& $_SESSION['LoggedIn']==1):
?>
                  <li><a href="/logout.php">Log out</a></li>
                  <li><a href="/account.php">Account</a></li>
<?php else: ?>
                  <li><a href="/signup.php">Sign Up</a></li>
                  <li><a href="/login.php">Log In</a></li>
<?php endif; ?>

                </ul>
              </nav>
            </div>
          </div>
