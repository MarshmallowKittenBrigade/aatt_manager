<span class="asset_layer">
<?php
require_once($_SERVER['DOCUMENT_ROOT']."/includes/class.register.php");
require_once($_SERVER['DOCUMENT_ROOT']."/includes/class.device.php");


$db = new DB();
if($_REQUEST['register']) {
    $name = $_REQUEST['name'];
    $desc = $_REQUEST['description'];
	$type = $_REQUEST['type'];
	$deviceId = $_REQUEST['device'];

    $register = new Register($_SESSION['aid']);
    $result = $register->endpoint($name,$desc,$type,$deviceId);
}
$sql = "SELECT ep.* from endpoint ep left join device d on (ep.device_id=d.id) WHERE account_id=".$_SESSION['aid'];
$data = $db->db_query_rows($sql);
echo "<form method=POST action='https://www.aatt.me/index.php?a=ep'>";
echo "<table class='asset_table'>";
echo "<tr><th class='asset_title'>id</th><th class='asset_title'>type</th><th class='asset_title'>device</th><th class='asset_title'>name</th><th class='asset_title'>description</th></tr>";
foreach ($data as $endpoint) {
	if($endpoint['collector'] != 0 && $endpoint['controller'] ==0){
		$type = "collector";
	}else if ($endpoint['controller'] != 0 && $endpoint['collector'] == 0){
		$type = "controller";
	}else{
		$type = "botj";
	}
	echo "<tr>";
    echo "<td class='asset_data'>" . $endpoint["id"] . "</td>";
	echo "<td class='asset_data'>" . $type . "</td>";
	echo "<td class='asset_data'>" . $endpoint['device_id'] . "</td>";
	echo "<td class='asset_data'>" . $endpoint["name"] . "</td>";
    echo "<td class='asset_data'>" . $endpoint["description"] . "</td>";
	echo "</tr>";
}
echo "<tr>";
echo "<td></td>";
echo "<td class='asset_data'><select class='reg_select' name='type' tabindex=1><option value='collector'>collector</option><option value='controller'>controller</option></select></td>";
echo "<td class='asset_data'><select class='reg_select' name='device' tabindex=2>";
$devices = new Device($_SESSION['aid']);
foreach ($devices->all() as $id){
	echo "<option value=$id>$id</option>";
}
echo "</select></td>";
echo "<td class='asset_data'><input class='reg_input_text' type=text name=name tabindex=3 /></td>";
echo "<td class='asset_data'><input class='reg_input_text' type=text name=description tabindex=4 /></td>";
echo "</tr>";
?>
<input type=submit name=register value=save style="visibility:hidden;" tabindex=5 />
</table>
</span>
