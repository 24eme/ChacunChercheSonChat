<?

$post = file_get_contents('php://input');
if ($post) {
	file_put_contents("data/triphasee_".date(DATE_ATOM).".wifi", $post);
	exit;
}
header("Location: list_files.php");
exit;
