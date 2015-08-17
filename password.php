<?php
    include_once "common/base.php";
    $pageTitle = "Reset Your Password";
    include_once "common/header.php";
?>
        <div class="inner cover">
          <h2>Reset Your Password</h2>
          <p>Enter the email address you signed up with and we'll send
          you a link to reset your password.</p>

          <form class="form-horizontal" role="form" method="post" action="db-interaction/users.php">
            <div class="form-group">
              <div class="col-xs-10">
                <input type="hidden" name="action" value="resetpassword" />
                <input type="text" class="form-control" id="username" name="username" placeholder="Email" value="">
              </div>
              <div class="col-xs-2">
                <button type="submit" name="reset" id="reset" class="btn btn-primary">Reset Password</button>
              </div>
            </div>

          </form>
        </div>
<?php
    include_once "common/close.php";
?>
