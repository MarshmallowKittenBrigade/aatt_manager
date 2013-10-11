<span class="asset_layer">
<?php
require_once($_SERVER['DOCUMENT_ROOT']."/includes/class.register.php");

$aid = $_SESSION['aid'];

#echo "<pre>";
#print_r($_REQUEST);
#echo "</pre>";
if($_REQUEST['register']) {
    $name = $_REQUEST['name'];
    $desc = $_REQUEST['description'];

    $register = new Register($aid);
    $result = $register->device($name,$desc);
}

$db = new DB();

$sql = "SELECT id,name,description FROM device WHERE account_id=".$aid;
$data = $db->db_query_rows($sql);
echo "<form method=POST action='https://aatt.me/index.php?a=dev'>";
echo "<table class='asset_table'>";
echo "<tr><th class='asset_title'>id</th><th class='asset_title'>name</th><th class='asset_title'>description</th>";
foreach ($data as $device) {
	echo "<tr>";
	echo "<td class='asset_data'>" . $device["id"] . "</td>";
	echo "<td class='asset_data'>" . $device["name"] . "</td>";
	echo "<td class='asset_data'>" . $device["description"] . "</td>";
	echo "</tr>";
}
echo "<tr>";
echo "<td></td>";
echo "<td class='asset_data'><input class='reg_input_text' type=text name=name tabindex=1 /></td>";
echo "<td class='asset_data'><input class='reg_input_text' type=text name=description tabindex=2 /></td>";
echo "</tr>";
?>
<input type=submit name=register value=save style="visibility:hidden;" tabindex=3 />
</table>
</form>
</span>
