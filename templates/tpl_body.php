<div id="body_wrapper">
<?php
require_once($_SERVER['DOCUMENT_ROOT']."/templates/tpl_tabbar.php");
require_once($_SERVER['DOCUMENT_ROOT']."/includes/class.user.php");
switch($_REQUEST['a']){
	case 'dev':
		include($_SERVER['DOCUMENT_ROOT']."/includes/device.php");
		break;
	case 'ep':
		include($_SERVER['DOCUMENT_ROOT']."/includes/endpoint.php");
		break;
	case 'att':
		include($_SERVER['DOCUMENT_ROOT']."/includes/attribute.php");
		break;
	case 'acct':
		include($_SERVER['DOCUMENT_ROOT']."/includes/account.php");
		break;
	case 'logout':
		session_destroy();
		header( 'Location: https://www.aatt.me' );
		break;
	default:
		include($_SERVER['DOCUMENT_ROOT']."/includes/default.php");
		break;
}
?>
</div>

