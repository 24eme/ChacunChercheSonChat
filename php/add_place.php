<?php

$file = $_GET['place'];
if (!file) {
        header("Location: list_files.php");
        exit;
}
if ($_POST['localization']) {
	file_put_contents($file.".localization", "localization: ".$_POST['localization']);
	header("Location: list_files.php#".$file);
	exit;
}
include("header.php");
?>
<pre>
<?php echo file_get_contents($file); ?>
<?php echo file_get_contents($file.".localization"); ?>
</pre>
<form method="POST">
<table>
<thead>
<tr>
    <th colspan="4" class="text-center">Provence</th>
    <th colspan="4" class="text-center">Laffitte</th>
</tr>
</thead>
<tbody>
<tr>
    <td>&nbsp;</td>
	<td><input type="submit" name="localization" value="p | N | 6"/></td>
    <td><input type="submit" name="localization" value="p | W | 6"/></td>
    <td><input type="submit" name="localization" value="p | S | 6"/></td>
    <td><input type="submit" name="localization" value="l | E | 6"/></td>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>
<tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="localization" value="p | N | 5"/></td>
    <td><input type="submit" name="localization" value="p | W | 5"/></td>
    <td><input type="submit" name="localization" value="p | S | 5"/></td>
    <td><input type="submit" name="localization" value="l | E | 5"/></td>
    <td><input type="submit" name="localization" value="l | N | 5"/></td>
    <td><input type="submit" name="localization" value="l | W | 5"/></td>
    <td><input type="submit" name="localization" value="l | S | 5"/></td>
</tr>
<tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="localization" value="p | N | 4"/></td>
    <td><input type="submit" name="localization" value="p | W | 4"/></td>
    <td><input type="submit" name="localization" value="p | S | 4"/></td>
    <td><input type="submit" name="localization" value="l | E | 4"/></td>
    <td><input type="submit" name="localization" value="l | N | 4"/></td>
    <td><input type="submit" name="localization" value="l | W | 4"/></td>
    <td><input type="submit" name="localization" value="l | S | 4"/></td>
</tr>
<tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="localization" value="p | N | 3"/></td>
    <td><input type="submit" name="localization" value="p | W | 3"/></td>
    <td><input type="submit" name="localization" value="p | S | 3"/></td>
    <td><input type="submit" name="localization" value="l | E | 3"/></td>
    <td><input type="submit" name="localization" value="l | N | 3"/></td>
    <td><input type="submit" name="localization" value="l | W | 3"/></td>
    <td><input type="submit" name="localization" value="l | S | 3"/></td>
</tr>
<tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="localization" value="p | N | 2"/></td>
    <td><input type="submit" name="localization" value="p | W | 2"/></td>
    <td><input type="submit" name="localization" value="p | S | 2"/></td>
    <td><input type="submit" name="localization" value="l | E | 2"/></td>
    <td><input type="submit" name="localization" value="l | N | 2"/></td>
    <td><input type="submit" name="localization" value="l | W | 2"/></td>
    <td><input type="submit" name="localization" value="l | S | 2"/></td>
</tr>
<tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="localization" value="p | N | 1"/></td>
    <td><input type="submit" name="localization" value="p | W | 1"/></td>
    <td><input type="submit" name="localization" value="p | S | 1"/></td>
    <td><input type="submit" name="localization" value="l | E | 1"/></td>
    <td><input type="submit" name="localization" value="l | N | 1"/></td>
    <td><input type="submit" name="localization" value="l | W | 1"/></td>
    <td><input type="submit" name="localization" value="l | S | 1"/></td>
</tr>
<tr>
    <td><input type="submit" name="localization" value="p | E | 0"/></td>
    <td><input type="submit" name="localization" value="p | N | 0"/></td>
    <td><input type="submit" name="localization" value="p | W | 0"/></td>
    <td><input type="submit" name="localization" value="p | S | 0"/></td>
    <td><input type="submit" name="localization" value="l | E | 0"/></td>
    <td><input type="submit" name="localization" value="l | N | 0"/></td>
    <td><input type="submit" name="localization" value="l | W | 0"/></td>
    <td><input type="submit" name="localization" value="l | S | 0"/></td>
</tr>
<tr>
    <td><input type="submit" name="localization" value="p | E | -1"/></td>
    <td><input type="submit" name="localization" value="p | N | -1"/></td>
    <td><input type="submit" name="localization" value="p | W | -1"/></td>
    <td><input type="submit" name="localization" value="p | S | -1"/></td>
    <td><input type="submit" name="localization" value="l | E | -1"/></td>
    <td><input type="submit" name="localization" value="l | N | -1"/></td>
    <td><input type="submit" name="localization" value="l | W | -1"/></td>
    <td><input type="submit" name="localization" value="l | S | -1"/></td>
</tr>
<tr>
    <td><input type="submit" name="localization" value="p | E | -2"/></td>
    <td><input type="submit" name="localization" value="p | N | -2"/></td>
    <td><input type="submit" name="localization" value="p | W | -2"/></td>
    <td><input type="submit" name="localization" value="p | S | -2"/></td>
    <td><input type="submit" name="localization" value="l | E | -2"/></td>
    <td><input type="submit" name="localization" value="l | N | -2"/></td>
    <td><input type="submit" name="localization" value="l | W | -2"/></td>
    <td><input type="submit" name="localization" value="l | S | -2"/></td>
</tr>
</tbody>
</table>
</form>
<a href="list_files.php" class="btn btn-default">Retour</a>
<?php include("footer.php");
