<?php
    include_once "common/base.php";
    if(isset($_SESSION['LoggedIn']) && $_SESSION['LoggedIn']==1):
        $pageTitle = "Account";
        include_once "common/header.php";
        include_once 'inc/class.users.inc.php';
        $users = new FocusUsers($db);

        if(isset($_GET['email']) && $_GET['email']=="changed")
        {
            echo "<div class='message good'>Your email address "
                . "has been changed.</div>";
        }
        else if(isset($_GET['email']) && $_GET['email']=="failed")
        {
            echo "<div class='message bad'>There was an error "
                . "changing your email address.</div>";
        }

        if(isset($_GET['password']) && $_GET['password']=="changed")
        {
            echo "<div class='message good'>Your password "
                . "has been changed.</div>";
        }
        elseif(isset($_GET['password']) && $_GET['password']=="nomatch")
        {
            echo "<div class='message bad'>The two passwords "
                . "did not match. Try again!</div>";
        }

        if(isset($_GET['delete']) && $_GET['delete']=="failed")
        {
            echo "<div class='message bad'>There was an error "
                . "deleting your account.</div>";
        }

        list($userID, $v) = $users->retrieveAccountInfo();
?>

        <h2>Account</h2>
        <br /><br />
        <form class="form-horizontal" role="form" method="post" action="db-interaction/users.php">
          <div class="form-group">
            <div class="col-xs-10">
              <input type="hidden" name="userid" value="<?php echo $userID ?>" />
              <input type="hidden" name="action" value="changeemail" />
              <input type="text" class="form-control" id="username" name="username" placeholder="Email" value="">
            </div>
            <div class="col-xs-2">
              <button type="submit" name="change-email-submit" id="change-email-submit" class="btn btn-primary">Change Email Address</button>
            </div>
          </div>
        </form>
        <br /><hr/ class="separator"><br />


        <form class="form-horizontal" role="form" method="post" action="db-interaction/users.php" id="change-password-form">
          <div class="form-group">
            <label for="password" class="control-label col-xs-5">Choose New Password</label>
            <div class="col-xs-5">
              <input type="hidden" name="user-id"
                  value="<?php echo $userID ?>" />
              <input type="hidden" name="v"
                  value="<?php echo $v ?>" />
              <input type="hidden" name="action"
                  value="changepassword" />
              <input type="password" class="form-control" placeholder="New Password" name="p" id="new-password" />
            </div>
          </div>
          <div class="form-group">
            <label for="password" class="control-label col-xs-5">Repeat New Password</label>
            <div class="col-xs-5">
              <input type="password" class="form-control" id="repeat-new-password" name="r" placeholder="Repeat Password" value="">
            </div>
          </div>
          <br />
          <button type="submit" name="change-password-submit" id="change-password-submit" class="btn btn-primary">Change Password</button>
        </form>
        <br /><hr/ class="separator">

        <form class="form-horizontal" method="post" action="deleteaccount.php"
            id="delete-account-form">
            <div>
                <input type="hidden" name="user-id"
                    value="<?php echo $userID ?>" />
                <button type="submit"
                    name="delete-account-submit" id="delete-account-submit"
                    value="Delete Account?" class="btn btn-primary">Delete Account</button>
            </div>
        </form>

<?php
    else:
        header("Location: /");
        exit;
    endif;
?>

<div class="clear"></div>

<?php
    include_once "common/close.php";
?>
