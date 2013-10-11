<span class="asset_layer">
<?php
require_once($_SERVER['DOCUMENT_ROOT']."/includes/class.db.php");

$db = new DB();

$sql = "SELECT name,email,account_code FROM account WHERE id=".$_SESSION['aid'];
$data = $db->db_query_rows($sql);
echo "<table class='asset_table'>";
if($data){
	echo "<tr><th class='asset_title'>name</th><th class='asset_title'>email</th><th class='asset_title'>account</th>";
}else{
	echo "<tr><th class='asset_title'>no account info yet</th></tr>";
}
foreach ($data as $device) {
	echo "<tr>";
	echo "<td class='asset_data'>" . $device["name"] . "</td>";
	echo "<td class='asset_data'>" . $device["email"] . "</td>";
	echo "<td class='asset_data'>" . $device["account_code"] . "</td>";
	echo "</tr>";
}
?>
</table>
</span>
