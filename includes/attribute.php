<span class="asset_layer">
<?php
require_once($_SERVER['DOCUMENT_ROOT']."/includes/class.endpoint.php");
require_once($_SERVER['DOCUMENT_ROOT']."/includes/class.register.php");

$db = new DB();
if($_REQUEST['register']) {
    $name = $_REQUEST['name'];
    $desc = $_REQUEST['description'];
    $endpoint = $_REQUEST['endpoint'];
    $state = $_REQUEST['current'];

    $register = new Register($_SESSION['aid']);
	$result = $register->attribute($name,$desc,$endpoint,$state);
}
$sql = "SELECT att.*,s.current as current, s.new as new FROM attribute att left join endpoint ep on (att.endpoint_id=ep.id) left join device d on (ep.device_id=d.id) join state s on (att.id=s.attribute_id) WHERE account_id=".$_SESSION['aid'];
$data = $db->db_query_rows($sql);
echo "<form method=POST action='https://www.aatt.me/index.php?a=att'>";
echo "<table class='asset_table'>";
echo "<tr><th class='asset_title'>id</th><th class='asset_title'>name</th><th class='asset_title'>description</th><th class='asset_title'>endpoint</th><th class='asset_title'>state</th><th class='asset_title'>queued</th></tr>";
foreach ($data as $attribute) {
	echo "<tr>";
	echo "<td class='asset_data'>" . $attribute["id"] . "</td>";
	echo "<td class='asset_data'>" . $attribute["name"] . "</td>";
	echo "<td class='asset_data'>" . $attribute["description"] . "</td>";
	echo "<td class='asset_data'>" . $attribute["endpoint_id"] . "</td>";
    echo "<td class='asset_data'>" . $attribute["current"] . "</td>";
    echo "<td class='asset_data'>" . $attribute["new"] . "</td>";
	echo "</tr>";
}
echo "<tr>";
echo "<td></td>";
echo "<td class='asset_data'><input class='reg_input_text' type=text name=name tabindex=1 /></td>";
echo "<td class='asset_data'><input class='reg_input_text' type=text name=description tabindex=2 /></td>";
echo "<td class='asset_data'><select class='reg_select' name='endpoint' tabindex=2>";
$endpoints = new Endpoint($_SESSION['aid']);
foreach ($endpoints->controllers() as $id){
    echo "<option value=$id>$id</option>";
}
echo "</select></td>";
echo "<td class='asset_data'><input class='reg_input_text' type=text name=current tabindex=4 /></td>";
echo "<td></td>";
echo "</tr>";
?>
<input type=submit name=register value=save style="visibility:hidden;" tabindex=5 />
</table>
</span>
