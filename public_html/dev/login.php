<?php
## THIS SECTION MUST NOT SEND ANY OUTPUT TO THE SCREEN. ##
##      DOING SO WILL CAUSE THE REDIRECTION TO FAIL.    ##
##      THIS INCLUDES ALL USE OF THE debug() METHOD.    ##

error_reporting(E_ALL);
ini_set('display_errors', 'On');
ini_set('session.use_cookies', '1');

require_once('../src/unblocklib.php');
require_once('template.php');

$user = '';
$destination = '';
$errors = '';
$logout = '';
if(isset($_GET['logout'])){
	$logout = true;
}
if(isset($_POST['destination'])){
	$destination = $_POST['destination'];
}
else if(isset($_GET['destination'])){
	$destination = $_GET['destination'];
}
else{
	$destination = getRootURL() . 'home.php';
}

debug('Destination: ' . $destination . '  Logout: ' . $logout . '</br>');

if(isset($_POST['login'])){
	try{
		$db = connectToDB(true);
		// all checks here will be conducted without the use of objects, so as to avoid
		// inadvertent output to the screen
		$user = mysql_real_escape_string($_POST['username']);
		$password = hash('sha512', $_POST['password']);

		debug('User: ' . $user . '  Password hash: ' . $password . '<br/>');

		$query = 'SELECT passwordHash FROM user WHERE username=\'' . $user . '\'';

		$result = mysql_query($query, $db);

		if($result === false){
			$error = mysql_error($db);
			debug('ERROR: ' . $error . '<br/>');
			throw new UTRSDatabaseException($error);
		}

		if(mysql_num_rows($result) == 0){
			throw new UTRSCredentialsException('The username you entered does not exist in our records. '
			. 'You may request an account by clicking the link above.');
		}
		if(mysql_num_rows($result) != 1){
			throw new UTRSDatabaseException('There is more than one record for that username. '
			. 'Please contact a tool developer immediately.');
		}
		else{
			$row = mysql_fetch_assoc($result);

			if(strcmp($password, $row['passwordHash']) === 0){
				debug('Building session, password is a match<br/>');
				session_id('UTRSLogin'. time());
				session_name('UTRSLogin');
				session_start();
				$_SESSION['user'] = $user;
				$_SESSION['passwordHash'] = $password;
				
				// now that the session has been started, we can check access...
				if(!verifyAccess($GLOBALS['APPROVED'])){
					// force logout
					$_SESSION['user'] = null;
					$_SESSION['passwordHash'] = null;
					$params = session_get_cookie_params();
					setcookie(session_name(), '', time() - 42000,
					$params["path"], $params["domain"],
					$params["secure"], $params["httponly"]
					);

					session_destroy();
					// send error message
					throw new UTRSCredentialsException('Your account has not yet been approved. All '
					  . 'accounts must be approved by a tool administator for security reasons. '
					  . 'If you have not yet made an edit to your Wikipedia talk page to confirm '
					  . 'your identity, please do so now.');
				}
				if(!verifyAccess($GLOBALS['ACTIVE'])){
					$userObj = getCurrentUser();
					// force logout
					$_SESSION['user'] = null;
					$_SESSION['passwordHash'] = null;
					$params = session_get_cookie_params();
					setcookie(session_name(), '', time() - 42000,
					$params["path"], $params["domain"],
					$params["secure"], $params["httponly"]
					);

					session_destroy();
					// send error message
					throw new UTRSCredentialsException('Your account is currently listed as inactive. '
					  . 'The reason given for disabling your account is: "' . $userObj->getComments() 
					  . '" Please contact a tool administrator to have your account reactivated.');
				}

				header("Location: " . $destination);
				exit;
			}
			else{
				throw new UTRSCredentialsException('The username and password you provided do not match. ' . 
						'<a href="passReset.php">Click here</a> to reset your password.');
			}
		}
	}
	catch(UTRSException $e){
		$errors = $e->getMessage();
	}
}

skinHeader();
?>

<center><b>Unblock Ticket Request System Login</b></center>

<?php 
if($logout){
	displaySuccess('You have been logged out.');
}
?>

<p>If you do not already have an UTRS account, please <a href="register.php">register here</a>.</p>

<?php 
if($errors){
	displayError($errors);
}
echo '<form name="loginForm" id="loginForm" action="login.php" method="POST">';
echo '<input type="hidden" id="destination" name="destination" value="' . $destination . '" />';
echo '<label for="username" id="usernameLabel">Username: </label> <input type="text" id="username" name="username" value="' . $user . '" /><br />';
echo '<label for="password" id="passwordLabel">Password: </label> <input type="password" id="password" name="password" /><br />';
echo '<input type="submit" id="login" name="login" value="Login" />';
echo '</form>';
?>

<p>You must have cookies enabled in order to log in.</p>

<p><a href="passReset.php">Forgot your password?</a></p>

<?php 
skinFooter();
?>