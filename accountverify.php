<?php
	include_once "common/base.php";
	$pageTitle = "Verify Your Account";
	include_once "common/header.php";

  if(isset($_GET['v']) && isset($_GET['e']))
	{
		include_once "inc/class.users.inc.php";
		$users = new FocusUsers($db);
		$ret = $users->verifyAccount();
	}
	elseif(isset($_POST['v']))
	{
		include_once "inc/class.users.inc.php";
		$users = new FocusUsers($db);
		$ret = $users->updatePassword();
	}
	else
	{
		header("Location: /signup.php");
		exit;
	}
	if(isset($ret[0])):
		echo isset($ret[1]) ? $ret[1] : NULL;
		if($ret[0]<3):
?>

        <div class="inner cover">
          <form class="form-horizontal" role="form" method="post" action="accountverify.php">
            <div class="form-group">
              <label for="p" class="control-label col-xs-2">Password</label>
              <div class="col-xs-10">
                <input type="password" class="form-control" id="p" name="p" placeholder="Password" value="">
              </div>
            </div>
            <div class="form-group">
              <label for="r" class="control-label col-xs-2">Confirm</label>
              <div class="col-xs-10">
                <input type="password" class="form-control" id="r" name="r" placeholder="Password" value="">
              </div>
            </div>
            <input type="hidden" name="v" value="<?php echo $_GET['v'] ?>" />
            <div class="form-group">
              <div class="col-xs-offset-2 col-xs-10">
                <button type="submit" name="verify" id="verify" class="btn btn-primary">Verify Your Account</button>
              </div>
            </div>
          </form>
        </div>

<?php
	endif;
	else:
		echo '<meta http-equiv="refresh" content="0;/">';
	endif;
	include_once 'common/close.php';
?>
