<?php

$post = file_get_contents('php://input');
if ($post) {
	$file = "data/triphasee_".date(DATE_ATOM).".wifi";
	file_put_contents($file, $post);
	$f = popen("bash ../prediction/wifi2localization.sh > ".$file.".prediction",'w');
	fwrite($f, file_get_contents($file));
	pclose($f);
	exit;
}
header("Location: list_files.php");
exit;
