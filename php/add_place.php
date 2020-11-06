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
	<td><input type="submit" name="localization" value="provence | 6"/><td>
	<td>&nbsp;</td>
</tr>
<tr>
        <td><input type="submit" name="localization" value="provence | 5"/><td>
        <td><input type="submit" name="localization" value="laffitte | 5"/><td>
</tr>
<tr>
        <td><input type="submit" name="localization" value="provence | 4"/><td>
        <td><input type="submit" name="localization" value="laffitte | 4"/><td>
</tr>
<tr>
        <td><input type="submit" name="localization" value="provence | 3"/><td>
        <td><input type="submit" name="localization" value="laffitte | 3"/><td>
</tr>
<tr>
        <td><input type="submit" name="localization" value="provence | 2"/><td>
        <td><input type="submit" name="localization" value="laffitte | 2"/><td>
</tr>
<tr>
        <td><input type="submit" name="localization" value="provence | 1"/><td>
        <td><input type="submit" name="localization" value="laffitte | 1"/><td>
</tr>
<tr>
        <td><input type="submit" name="localization" value="provence | 0"/><td>
        <td><input type="submit" name="localization" value="laffitte | 0"/><td>
</tr>
<tr>
        <td><input type="submit" name="localization" value="provence | -1"/><td>
        <td><input type="submit" name="localization" value="laffitte | -1"/><td>
</tr>
<tr>
        <td><input type="submit" name="localization" value="provence | -2"/><td>
        <td><input type="submit" name="localization" value="laffitte | -2"/><td>
</tr>

</table>
</form>
<a href="list_files.php" class="btn btn-default">Retour</a>
<?php include("footer.php");
