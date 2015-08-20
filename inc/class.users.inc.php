<?php

/**
 * Handles user interactions within the app
 *
* PHP version 5
*
* @author Jason Lengstorf
* @author Chris Coyier
* @copyright 2009 Chris Coyier and Jason Lengstorf
* @license   http://www.opensource.org/licenses/mit-license.html  MIT License
*
*/
class FocusUsers
{
  /**
     * The database object
     *
     * @var object
     */
    private $_db;

    /**
     * Checks for a database object and creates one if none is found
     *
     * @param object $db
     * @return void
     */
    public function __construct($db=NULL)
    {
        if(is_object($db))
        {
            $this->_db = $db;
        }
        else
        {
            $dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME;
            $this->_db = new PDO($dsn, DB_USER, DB_PASS);
        }
    }

    /**
     * Checks and inserts a new account email into the database
     *
     * @return string    a message indicating the action status
     */
    public function createAccount()
    {
        $u = trim($_POST['username']);
        $v = sha1(time());

        $sql = "SELECT COUNT(Username) AS theCount
                FROM users
                WHERE Username=:email";
        if($stmt = $this->_db->prepare($sql)) {
            $stmt->bindParam(":email", $u, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch();
            if($row['theCount']!=0) {
                return "<h2> Error </h2>"
                    . "<p> Sorry, that email is already in use. "
                    . "Please try again. </p>";
            }
            if(!$this->sendVerificationEmail($u, $v)) {
                return "<h2> Error </h2>"
                    . "<p> There was an error sending your"
                    . " verification email. Please "
                    . '<a href="mailto:sahbingo@gmail.com">contact '
                    . "us</a> for support. We apologize for the "
                    . "inconvenience. </p>";
            }
            $stmt->closeCursor();
        }

        $sql = "INSERT INTO users(Username, ver_code)
                VALUES(:email, :ver)";
        if($stmt = $this->_db->prepare($sql)) {
            $stmt->bindParam(":email", $u, PDO::PARAM_STR);
            $stmt->bindParam(":ver", $v, PDO::PARAM_STR);
            $stmt->execute();
            $stmt->closeCursor();

            $userID = $this->_db->lastInsertId();

            return "<h2> Success! </h2>"
                . "<p> Your account was successfully "
                . "created with the username <strong>$u</strong>."
                . " Check your email!";
        } else {
            return "<h2> Error </h2><p> Couldn't insert the "
                . "user information into the database. </p>";
        }
    }

    /**
     * Sends an email to a user with a link to verify their new account
     *
     * @param string $email    The user's email address
     * @param string $ver    The random verification code for the user
     * @return boolean        TRUE on successful send and FALSE on failure
     */
    private function sendVerificationEmail($email, $ver)
    {
        $e = sha1($email); // For verification purposes
        $to = trim($email);

        $subject = "[Focus] Please Verify Your Account";

        $headers = <<<MESSAGE
From: Focus <donotreply@focus.com>
Content-Type: text/plain;
MESSAGE;

        $msg = <<<EMAIL
You have a new account at Focus!

To get started, please activate your account and choose a
password by following the link below.

Your Username: $email

Activate your account: http://focus.dev/accountverify.php?v=$ver&e=$e

If you have any questions, please contact sahbingo@gmail.com.

--
Thanks!

Focus Team

EMAIL;

        return mail($to, $subject, $msg, $headers);
    }


    /**
     * Checks credentials and verifies a user account
     *
     * @return array    an array containing a status code and status message
     */
    public function verifyAccount()
    {
        $sql = "SELECT Username
                FROM users
                WHERE ver_code=:ver
                AND SHA1(Username)=:user
                AND verified=0";

        if($stmt = $this->_db->prepare($sql))
        {
            $stmt->bindParam(':ver', $_GET['v'], PDO::PARAM_STR);
            $stmt->bindParam(':user', $_GET['e'], PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch();
            if(isset($row['Username']))
            {
                // Logs the user in if verification is successful
                $_SESSION['Username'] = $row['Username'];
                $_SESSION['LoggedIn'] = 1;
            }
            else
            {
                return array(4, "<h2>Verification Error</h2>"
                    . "<p>This account has already been verified. "
                    . "Did you <a href=\"/password.php\">forget "
                    . "your password?</a>");
            }
            $stmt->closeCursor();

            // No error message is required if verification is successful
            return array(0, NULL);
        }
        else
        {
            return array(2, "<h2>Error</h2>n<p>Database error.</p>");
        }
    }

    /**
     * Checks credentials and logs in the user
     *
     * @return boolean    TRUE on success and FALSE on failure
     */
    public function accountLogin()
    {
        $sql = "SELECT Username
                FROM users
                WHERE Username=:user
                AND Password=MD5(:pass)
                LIMIT 1";
        try
        {
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(':user', $_POST['username'], PDO::PARAM_STR);
            $stmt->bindParam(':pass', $_POST['password'], PDO::PARAM_STR);
            $stmt->execute();
            if($stmt->rowCount()==1)
            {
                $_SESSION['Username'] = htmlentities($_POST['username'], ENT_QUOTES);
                $_SESSION['LoggedIn'] = 1;
                return TRUE;
            }
            else
            {
                return FALSE;
            }
        }
        catch(PDOException $e)
        {
            return FALSE;
        }
    }

    /**
     * Retrieves the ID and verification code for a user
     *
     * @return mixed    an array of info or FALSE on failure
     */
     public function retrieveAccountInfo($user=NULL)
     {
      $user = isset($user) ? $user : $_SESSION['Username'];
      $sql = "SELECT UserID, ver_code
                FROM users
                WHERE Username=:user";
      try
      {
      	$stmt = $this->_db->prepare($sql);
      	$stmt->bindParam(':user', $user, PDO::PARAM_STR);
      	$stmt->execute();
      	$row = $stmt->fetch();
      	$stmt->closeCursor();
      	return array($row['UserID'], $row['ver_code']);
      }
      catch(PDOException $e)
      {
      	return FALSE;
      }
     }

    /**
     * Changes a user's email address
     *
     * @return boolean    TRUE on success and FALSE on failure
     */
    public function updateEmail()
    {
        $sql = "UPDATE users
                SET Username=:email
                WHERE UserID=:user
                LIMIT 1";
        try
        {
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(':email', $_POST['username'], PDO::PARAM_STR);
            $stmt->bindParam(':user', $_POST['userid'], PDO::PARAM_INT);
            $stmt->execute();
            $stmt->closeCursor();

            // Updates the session variable
            $_SESSION['Username'] = htmlentities($_POST['username'], ENT_QUOTES);

            return TRUE;
        }
        catch(PDOException $e)
        {
            return FALSE;
        }
    }

    /**
     * Changes the user's password
     *
     * @return boolean    TRUE on success and FALSE on failure
     */
    public function updatePassword()
    {
        if(isset($_POST['p'])
        && isset($_POST['r'])
        && $_POST['p']==$_POST['r'])
        {
            $sql = "UPDATE users
                    SET Password=MD5(:pass), verified=1
                    WHERE ver_code=:ver
                    LIMIT 1";
            try
            {
                $stmt = $this->_db->prepare($sql);
                $stmt->bindParam(":pass", $_POST['p'], PDO::PARAM_STR);
                $stmt->bindParam(":ver", $_POST['v'], PDO::PARAM_STR);
                $stmt->execute();
                $stmt->closeCursor();

                return TRUE;
            }
            catch(PDOException $e)
            {
                return FALSE;
            }
        }
        else
        {
            return FALSE;
        }
    }

    /**
     * Deletes an account and all associated items
     *
     * @return void
     */
    public function deleteAccount()
    {
        if(isset($_SESSION['LoggedIn']) && $_SESSION['LoggedIn']==1)
        {
            // Delete items
            $sql = "DELETE FROM items
                    WHERE UserID=:user";
            try
            {
                $stmt = $this->_db->prepare($sql);
                $stmt->bindParam(":user", $_POST['user-id'], PDO::PARAM_INT);
                $stmt->execute();
                $stmt->closeCursor();
            }
            catch(PDOException $e)
            {
                die($e->getMessage());
            }

            // Delete the user
            $sql = "DELETE FROM users
                    WHERE UserID=:user
                    AND Username=:email";
            try
            {
                $stmt = $this->_db->prepare($sql);
                $stmt->bindParam(":user", $_POST['user-id'], PDO::PARAM_INT);
                $stmt->bindParam(":email", $_SESSION['Username'], PDO::PARAM_STR);
                $stmt->execute();
                $stmt->closeCursor();
            }
            catch(PDOException $e)
            {
                die($e->getMessage());
            }

            // Destroy the user's session and send to a confirmation page
            unset($_SESSION['LoggedIn'], $_SESSION['Username']);
            header("Location: /gone.php");
            exit;
        }
        else
        {
            header("Location: /account.php?delete=failed");
            exit;
        }
    }

    /**
     * Resets a user's status to unverified and sends them an email
     *
     * @return mixed    TRUE on success and a message on failure
     */
     public function resetPassword()
   	{
   		list($u, $v) = $this->retrieveAccountInfo($_POST['username']);
   		if(!isset($u)) { echo "No account found! <a href=\"/password.php\">Try again.</a>"; return FALSE; }
   		$sql = "UPDATE users
   				SET verified=0
   				WHERE UserID=:user
   				AND ver_code=:ver
   				LIMIT 1";
   		try
   		{
   			$stmt = $this->_db->prepare($sql);
   			$stmt->bindParam(":user", $u, PDO::PARAM_STR);
   			$stmt->bindParam(":ver", $v, PDO::PARAM_STR);
   			$stmt->execute();
   			$stmt->closeCursor();
   		}
   		catch(PDOException $e)
   		{
   			return $e->getMessage();
   		}
   		// Send the reset email
   		if(!$this->sendResetEmail($_POST['username'], $v))
   		{
   			return "Sending the email failed!";
   		}
   		return TRUE;
   	}

    /**
     * Sends a link to a user that lets them reset their password
     *
     * @param string $email    the user's email address
     * @param string $ver    the user's verification code
     * @return boolean        TRUE on success and FALSE on failure
     */
    private function sendResetEmail($email, $ver)
    {
        $e = sha1($email); // For verification purposes
        $to = trim($email);

        $subject = "[Focus] Request to Reset Your Password";

        $headers = <<<MESSAGE
From: Focus <donotreply@focus.com>
Content-Type: text/plain;
MESSAGE;

        $msg = <<<EMAIL
We just heard you forgot your password! To get going again,
head over to the link below and choose a new password.

Follow this link to reset your password:
http://focus.dev/resetpassword.php?v=$ver&e=$e

If you have any questions, please contact sahbingo@gmail.com.

--
Thanks!

Focus Team

EMAIL;

        return mail($to, $subject, $msg, $headers);
    }

}
?>
