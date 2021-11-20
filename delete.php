<?php

require 'config\config.php';
require 'lib\db.php';
$conn = connectToDB($config["host"],$config["duser"],$config["dpw"], $config["dname"]);
$postid= $_GET['post_id'];
$deletesql = "DELETE FROM post WHERE id=$postid";
echo $deletesql;
mysqli_query($conn, $deletesql);

header('Location: http://localhost/index.php?id&post_id&page=1');


 ?>
