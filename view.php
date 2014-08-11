<?php
header('Content-Type: text/html; charset=utf-8');
?>
<html>
<head><title>View text from Storj</title></head>

<?php
$url = urldecode($_GET['url']);
$title = urldecode($_GET['title']);
$author = urldecode($_GET['author']);
$type = urldecode($_GET['type']);

print "<h1>" . htmlspecialchars($title) . "</h1>\n";
print "<p>" . htmlspecialchars($author) . "</p>\n";

print "<p><a href='$url'>Download raw file</a></p>";
?>

<hr />

<?php

if ($type == "pdf") {
    $gdocsembedder = "http://docs.google.com/gview?embedded=true&url=";
    print "<iframe src='" . $gdocsembedder . urlencode($url) .
        "' style='width:800px; height:600px;' frameborder='0'></iframe>";
} else {

    $text = file_get_contents($url);
    $text = nl2br(htmlspecialchars($text));

    print $text;
}

?>

<hr />


</html>

