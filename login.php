<?php
    include_once "common/base.php";
    $pageTitle = "Home";
    include_once "common/header.php";

    if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Username'])):
?>

        <p>You are currently <strong>logged in.</strong></p>
        <p><a href="/logout.php">Log out</a></p>

<?php
    elseif(!empty($_POST['username']) && !empty($_POST['password'])):
        include_once 'inc/class.users.inc.php';
        $users = new FocusUsers($db);
        if($users->accountLogin()===TRUE):
            echo "<meta http-equiv='refresh' content='0;/'>";
            exit;
        else:
?>
        <div class="inner cover">
          <h4>Login Failed - Try Again?</h4>
          <br/>
          <br/>
          <form class="form-horizontal" role="form" method="post" action="login.php" name="loginform" id="loginform">
            <div class="col-md-6 col-md-offset-3">
              <div class="form-group">
                <input type="text" class="form-control" id="username" name="username" placeholder="Email" value="">
              </div>
              <div class="form-group">
                <input class="form-control" type="password" name="password" id="password" placeholder="Password" value="">
              </div>
              <div class="form-group">
                <button type="submit" name="login" id="login" value="Login" class="btn btn-primary">Log In</button>
                <p class="discrete"><a href="/password.php">Did you forget your password?</a></p>
              </div>
            </div>
          </form>
        </div>

<?php
        endif;
    else:
?>

        <div class="inner cover">
          <form class="form-horizontal" role="form" method="post" action="login.php" name="loginform" id="loginform">
            <div class="col-md-6 col-md-offset-3">
              <div class="form-group">
                <input type="text" class="form-control" id="username" name="username" placeholder="Email" value="">
              </div>
              <div class="form-group">
                <input class="form-control" type="password" name="password" id="password" placeholder="Password" value="">
              </div>
              <div class="form-group">
                <button type="submit" name="login" id="login" value="Login" class="btn btn-primary btn-block">Log In</button>
              </br>
                <p class="discrete"><a href="/password.php">Did you forget your password?</a></p>
              </div>
            </div>
          </form>
        </div>
<?php
    endif;
?>

        <div style="clear: both;"></div>
<?php
    include_once "common/close.php";
?>
