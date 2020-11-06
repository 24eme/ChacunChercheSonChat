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
<tr>
    <td>&nbsp;</td>
	<td><input type="submit" name="localization" value="provence | N | 6"/><td>
    <td><input type="submit" name="localization" value="provence | W | 6"/><td>
    <td><input type="submit" name="localization" value="provence | S | 6"/><td>
    <td><input type="submit" name="localization" value="laffitte | E | 6"/><td>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>
<tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="localization" value="provence | N | 5"/><td>
    <td><input type="submit" name="localization" value="provence | W | 5"/><td>
    <td><input type="submit" name="localization" value="provence | S | 5"/><td>
    <td><input type="submit" name="localization" value="laffitte | E | 5"/><td>
    <td><input type="submit" name="localization" value="laffitte | N | 5"/><td>
    <td><input type="submit" name="localization" value="laffitte | W | 5"/><td>
    <td><input type="submit" name="localization" value="laffitte | S | 5"/><td>
</tr>
<tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="localization" value="provence | N | 4"/><td>
    <td><input type="submit" name="localization" value="provence | W | 4"/><td>
    <td><input type="submit" name="localization" value="provence | S | 4"/><td>
    <td><input type="submit" name="localization" value="laffitte | E | 4"/><td>
    <td><input type="submit" name="localization" value="laffitte | N | 4"/><td>
    <td><input type="submit" name="localization" value="laffitte | W | 4"/><td>
    <td><input type="submit" name="localization" value="laffitte | S | 4"/><td>
</tr>
<tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="localization" value="provence | N | 3"/><td>
    <td><input type="submit" name="localization" value="provence | W | 3"/><td>
    <td><input type="submit" name="localization" value="provence | S | 3"/><td>
    <td><input type="submit" name="localization" value="laffitte | E | 3"/><td>
    <td><input type="submit" name="localization" value="laffitte | N | 3"/><td>
    <td><input type="submit" name="localization" value="laffitte | W | 3"/><td>
    <td><input type="submit" name="localization" value="laffitte | S | 3"/><td>
</tr>
<tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="localization" value="provence | N | 2"/><td>
    <td><input type="submit" name="localization" value="provence | W | 2"/><td>
    <td><input type="submit" name="localization" value="provence | S | 2"/><td>
    <td><input type="submit" name="localization" value="laffitte | E | 2"/><td>
    <td><input type="submit" name="localization" value="laffitte | N | 2"/><td>
    <td><input type="submit" name="localization" value="laffitte | W | 2"/><td>
    <td><input type="submit" name="localization" value="laffitte | S | 2"/><td>
</tr>
<tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="localization" value="provence | N | 1"/><td>
    <td><input type="submit" name="localization" value="provence | W | 1"/><td>
    <td><input type="submit" name="localization" value="provence | S | 1"/><td>
    <td><input type="submit" name="localization" value="laffitte | E | 1"/><td>
    <td><input type="submit" name="localization" value="laffitte | N | 1"/><td>
    <td><input type="submit" name="localization" value="laffitte | W | 1"/><td>
    <td><input type="submit" name="localization" value="laffitte | S | 1"/><td>
</tr>
<tr>
    <td><input type="submit" name="localization" value="provence | E | 0"/><td>
    <td><input type="submit" name="localization" value="provence | N | 0"/><td>
    <td><input type="submit" name="localization" value="provence | W | 0"/><td>
    <td><input type="submit" name="localization" value="provence | S | 0"/><td>
    <td><input type="submit" name="localization" value="laffitte | E | 0"/><td>
    <td><input type="submit" name="localization" value="laffitte | N | 0"/><td>
    <td><input type="submit" name="localization" value="laffitte | W | 0"/><td>
    <td><input type="submit" name="localization" value="laffitte | S | 0"/><td>
</tr>
<tr>
    <td><input type="submit" name="localization" value="provence | E | -1"/><td>
    <td><input type="submit" name="localization" value="provence | N | -1"/><td>
    <td><input type="submit" name="localization" value="provence | W | -1"/><td>
    <td><input type="submit" name="localization" value="provence | S | -1"/><td>
    <td><input type="submit" name="localization" value="laffitte | E | -1"/><td>
    <td><input type="submit" name="localization" value="laffitte | N | -1"/><td>
    <td><input type="submit" name="localization" value="laffitte | W | -1"/><td>
    <td><input type="submit" name="localization" value="laffitte | S | -1"/><td>
</tr>
<tr>
    <td><input type="submit" name="localization" value="provence | E | -2"/><td>
    <td><input type="submit" name="localization" value="provence | N | -2"/><td>
    <td><input type="submit" name="localization" value="provence | W | -2"/><td>
    <td><input type="submit" name="localization" value="provence | S | -2"/><td>
    <td><input type="submit" name="localization" value="laffitte | E | -2"/><td>
    <td><input type="submit" name="localization" value="laffitte | N | -2"/><td>
    <td><input type="submit" name="localization" value="laffitte | W | -2"/><td>
    <td><input type="submit" name="localization" value="laffitte | S | -2"/><td>
</tr>

</table>
</form>
<a href="list_files.php" class="btn btn-default">Retour</a>
<?php include("footer.php");
