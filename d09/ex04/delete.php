<?php
foreach ($_GET as $id => $name) {
	$file = file_get_contents('list.csv');
	$articles = explode("\n", $file);
	foreach ($articles as $article) {
		$tmp = explode(";", $article);
		if ($tmp[0] == $id && $tmp[1] == $name) {
			$line = $tmp[0] . ";" . $tmp[1] . "\n";
			$file = str_replace($line, '', $file);
			file_put_contents('list.csv', $file);
		}
	}
}
?>
