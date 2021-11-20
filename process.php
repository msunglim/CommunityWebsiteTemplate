<?php
require 'config\config.php';
require 'lib\db.php';
$conn = connectToDB($config["host"],$config["duser"],$config["dpw"], $config["dname"]);

$prev= $_SERVER['HTTP_REFERER'];
$index = strpos($prev,"?id=")+4;
$index2= strpos($prev,"&type=");
$id = substr($prev, $index, ($index2-$index));
//php's subst is very weird. it's form is substr(string, startindex, nubmer of letter after startindex);

$type = substr($prev, strpos($prev, "&type=")+6, strlen($prev));


$title = addslashes($_POST['title']);
$username = addslashes($_POST['username']);

$description=addslashes($_POST['description']);

if($type==="write"){
$sql ="INSERT INTO `post`(`title`, `category`, `author`, `created`, `description`) VALUES ('{$title}', '{$id}','{$username}',now(),'{$description}')";
}else{
  $pindex = strpos($prev, "post_id=")+8;

  $post_id = substr($prev, $pindex, strlen($prev));
  $sql = "UPDATE `post` SET `title` = '{$title}', `category` =$id, `author`='{$username}', `created`=now(), `description` = '{$description}' WHERE `id`= $post_id";
  //echo $sql;
}
mysqli_query($conn, $sql);

header('Location: http://localhost/index.php?id&post_id&page=1');


 ?>
