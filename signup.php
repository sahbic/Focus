<?php
	include_once "common/base.php";
	$pageTitle = "Register";
	include_once "common/header.php";

  if(!empty($_POST['username'])):
      include_once "inc/class.users.inc.php";
      $users = new FocusUsers($db);
      echo $users->createAccount();
  else:
?>

        <div class="inner cover">
          <form class="form-horizontal" role="form" method="post" action="signup.php" id="registerform">
            <div class="form-group">
              <label for="username" class="control-label col-xs-2">Email</label>
              <div class="col-xs-10">
                <input type="text" class="form-control" id="username" name="username" placeholder="Email" value="">
              </div>
            </div>
            <div class="form-group">
              <div class="col-xs-offset-2 col-xs-10">
                <button type="submit" name="register" id="register" class="btn btn-primary">Sign Up</button>
              </div>
            </div>
          </form>
        </div>

<?php
	endif;
	include_once 'common/close.php';
?>
