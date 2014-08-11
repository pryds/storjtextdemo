<?php

/*
  Create a file called dbvars.pgp with the following lines.
  Adjust values as fit for your DB.

<?php
$mysql_host = 'localhost';
$mysql_user = 'username';
$mysql_password = 'password';
$mysql_db = 'database';
?>

*/

header('Content-Type: text/html; charset=utf-8');
?>
<html>
<head><title>Public domain literature on Storj</title></head>

<h1>Public domain literature on Storj</h1>

<table border="1">
<tr>
 <th>Title</th>
 <th>Author</th>
 <th>Category</th>
</tr>

<?php
include 'dbvars.php';
$link = mysql_connect($mysql_host, $mysql_user, $mysql_password);
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db($mysql_db, $link) or die('Could not select database.');

$query = "SELECT * FROM pd_main ORDER BY title, author LIMIT 0,100;";
$result = mysql_query($query);

if ($result) {
    while ($row = mysql_fetch_array($result)) {
        print "<tr>\n";
        print " <td>" . $row['title'] . "</td>\n";
        print " <td>" . $row['author'] . "</td>\n";
        print " <td>" . $row['category'] . "</td>\n";
        print " <td><a href='view.php" .
            "?url=" . urlencode($row['url']) .
            "&title=" . urlencode($row['title']) .
            "&author=" . urlencode($row['author']) .
            "&type=" . urlencode($row['type']) .
            "'>view</a></td>\n";
        print "</tr>\n";
    }
}

mysql_free_result($result);
mysql_close($link);
?>

</table>

<h2>View arbitrary file</h2>

<form name="input" action="view.php" method="get">
Storj URL:
<input type="text" name="url">
<select name="type">
 <option value="txt" selected="true">txt</option>
 <option value="pdf">pdf</option>
</select>
<input type="hidden" name="title" value="Arbitrary file">
<input type="submit" value="View">
</form>

</html>

