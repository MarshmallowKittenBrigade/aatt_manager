<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/class.user.php');
?>

<form action="<?php echo $PHP_SELF ?>" method="post">
<table id=login_table>
<?php 
if(!$_REQUEST || $_REQUEST['cancel']){
?>
<tr>
	<td>
        <button id="login_input_submit" name=register title="register" value="register">register </button>
		<button id="login_input_submit" name=login title="login" value="login">login </button>
	</td>
</tr>

<?php
}else if($_REQUEST['register']){

echo '
<tr>
    <td class="login_row">
        <span class="login_title">username</span>
    </td>
    <td>
        <input class="login_input_text" type=text name=username tabindex=1 />
    </td>
</tr>
<tr>
    <td class="login_row">
        <span class="login_title">password</span>
    </td>
    <td>
        <input class="login_input_text" type=password name=password tabindex=2 />
    </td>
</tr>
<tr>
    <td class="login_row">
        <span class="login_title">verify</span>
    </td>
    <td>
        <input class="login_input_text" type=password name=password2 tabindex=3 />
    </td>
</tr>
<tr>
    <td class="login_row">
        <span class="login_title">email</span>
    </td>
    <td>
        <input class="login_input_text" type=text name=email tabindex=4 />
    </td>
</tr><tr>
    <td class="login_row">
        <span class="login_title">full name</span>
    </td>
    <td>
        <input class="login_input_text" type=text name=fullname tabindex=5 />
    </td>
</tr>
<tr>
    <td colspan=2>
        <button style="{width:45%}" id="login_input_submit" tabindex="7" name=cancel title="cancel" value="cancel">cancel </button>
        <button style="{width:45%}" id="login_input_submit" tabindex="6" name=sendregister title="register" value="sendregister">register</button>
    </td>
</tr>';

}else if($_REQUEST['login']){

echo '
<tr>
    <td class="login_row">
        <span class="login_title">username</span>
    </td>
    <td>
        <input class="login_input_text" type=text name=username tabindex=1 />
    </td>
</tr>
<tr>
    <td class="login_row">
        <span class="login_title">password</span>
    </td>
    <td>
        <input class="login_input_text" type=password name=password tabindex=2 />
    </td>
</tr>
<tr>
    <td colspan=2>
        <button style="{width:45%}" id="login_input_submit" tabindex="4" name=cancel title="cancel" value="cancel">cancel </button>
        <button style="{width:45%}" id="login_input_submit" tabindex="3" name=sendlogin title="login" value="sendlogin">login </button>
	</td>
</tr>';

}else if($_REQUEST['sendlogin']){
	$username = $_REQUEST['username'];
	$password = $_REQUEST['password'];
	$user = new User();
	$_SESSION['aid'] = $user->login($username,$password);  
	header( 'Location: http://www.aatt.me' );

}else if($_REQUEST['sendregister']){
	$username = $_REQUEST['username'];
    $password = $_REQUEST['password'];
	$password2 = $_REQUEST['password2'];
	$fullname	= $_REQUEST['fullname'];
	$email		= $_REQUEST['email'];

	if($password == $password2){
    	$user = new User();
    	$added = $user->register($username,$password,$email,$fullname);
		if($added){
			$_SESSION['aid'] = $user->getId();
			header( 'Location: http://www.aatt.me' );
		}else{
			$error = "USER REGISTRATION FAILED";
		}
	}else{
		$error += ": PASSWORDS DID NOT MATCH";
	}
}
?>
</table>
