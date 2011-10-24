<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<link rel="stylesheet" href="unblock_styles.css">
<title>Unblock Ticket Request System</title>

<script type="text/javascript">
var accountNameInput = "<label id=\"accountNameLabel\" for=\"accountName\" class=\"required\">What is the name of your account?</label> <input id=\"accountName\" type=\"text\" name=\"accountName\" value=\"\"/><br />";
var autoBlockInput = "<label id=\"autoBlockLabel\" for=\"autoBlock\" class=\"required\">What has been blocked?</label> &#09; <input id=\"autoBlockN\" type=\"radio\" name=\"autoBlock\" value=\"false\" /> My account &#09; <input id=\"autoBlockY\" type=\"radio\" name=\"autoBlock\" value=\"true\" /> My IP address (my account is not blocked)<br />"
var desiredAccountInput = "<label id=\"desiredAccountNameLabel\" for=\"desiredAccountName\">We may be able to create an account for you which you can use to avoid problems like this in the future. If you would like for us to make an account for you, please enter the username you'd like to use here.</label><br/><input id=\"desiredAccountName\" type=\"text\" name=\"desiredAccountName\" value=\"\"/><br />";

function hasAccount(){
	var span = document.getElementById("variableQuestionSection");
	span.innerHTML = accountNameInput + "\n" + autoBlockInput;
}

function noAccount() {
	var span = document.getElementById("variableQuestionSection");
	span.innerHTML = desiredAccountInput;
}
</script>
</head>
<body>
<div id="header">
English Wikipedia<br />
Unblock Ticket Request System
</div>
<div id="subheader">
<table class="subheader_content">
<tr>
<td>
<a id="GAB" href="http://en.wikipedia.org/wiki/Wikipedia:Guide_to_appealing_blocks">Guide to Appealing Blocks</a>
</td>
<td>
<a id="loginLink" href="login.php">Admins: Log in to review requests</a>
</td>
<td>
<a id="loginLink" href="register.php">Admins: Request an account</a>
</td>
</tr>
</table>
</div>
<div id="main">
<center><b>Welcome to the Unblock Ticket Request System.</b></center>

<p>If you are presently blocked from editing on Wikipedia (which you may verify by 
clicking <a href="http://en.wikipedia.org/w/index.php?title=Wikipedia:Sandbox?action=edit">here</a>), you may fill out
the form below to have an administrator review your block. Please complete all fields labelled in 
<span class="required">red text</span>, as these are required in order for us to complete a full review of your block.</p>

<p>If you are having trouble editing a particular page or making a particular edit, but are able to edit the page
linked in the previous paragraph, you may not be blocked, but instead could be having difficulty with 
<a href="http://en.wikipedia.org/wiki/Wikipedia:Protection policy">page protection</a> or the 
<a href="http://en.wikipedia.org/wiki/Wikipedia:Edit filter">edit filter</a>. For more information, and instructions on
how to receive assistance, please see those links.</p>

<p><b>For assistance with a block, please complete the form below:</b></p>

<form name="unblockAppeal" id="unblockAppeal" action="index.php" method="POST">
<label id="emailLabel" for="accountName" class="required">What is your email address? We will need this to respond to your appeal.</label> <input id="email" type="text" name="email" value=""/><br />
<label id="registeredLabel" for="registered" class="required">Do you have an account on Wikipedia?</label> &#09; <input id="registeredY" type="radio" name="registered" value="true" onClick="hasAccount()" /> Yes &#09; <input id="registeredN" type="radio" name="registered" value="false" onClick="noAccount()" /> No<br />
<span id="variableQuestionSection"></span>
<label id="appealLabel" for="appeal" class="required">Why do you believe you should be unblocked?</label><br />
<textarea id="appeal" name="appeal" rows="5" cols="50"> </textarea><br />
<label id="editsLabel" for="edits" class="required">If you are unblocked, what articles to you intend to edit?</label><br />
<textarea id="edits" name="edits" rows="5" cols="50"> </textarea><br />
<label id="otherInfoLabel" for="otherInfo">Is there anything else you would like us to consider when reviewing your block?</label><br />
<textarea id="otherInfo" name="otherInfo" rows="3" cols="50"> </textarea><br />


CAPTCHA GOES HERE

<input type="submit" value="Submit Appeal"/>
</form>

<p>Please remember that Wikipedia adminstrators are volunteers; it may take some time for your appeal to be reviewed, and a courteous appeal will meet with a courteous response. If you feel it is taking too long for your appeal to be reviewed, you can usually appeal your block on your user talk page (<a href="http://en.wikipedia.org/wiki/Special:Mytalk">located here</a>) by copying this text and pasting it in a new section on the bottom of your page. Be sure to replace "your reason here" with your appeal: <b><tt>{{unblock|1=your reason here}}</tt></b></p>
</div>
<div id="footer">
The Unblock Ticket Request System is a project hosted on the Wikimedia Toolserver intended to assist
users with the unblock process on the English Wikipedia. <br />
This project is licensed under the 
<a id="GPL" href="http://www.gnu.org/copyleft/gpl.html">GNU General Public License Version 3 or Later.</a><br />
For questions or assistance with the Unblock Ticket Request System, please email our development team at 
<a href="mailto:unblock@toolserver.org">unblock AT toolserver DOT org</a><br />
</div>
</body>
</html>