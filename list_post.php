<?php

function listpost($row,$conn){
  $cat = $row['category'];
  $idsql = "SELECT id FROM categories WHERE $cat=id";
  $idresult = mysqli_query($conn, $idsql);

  $id = mysqli_fetch_assoc($idresult)['id'];
  $url = "http://localhost/index.php?id=".$id.'&post_id='.$row['id']."&page=1";

  //page should be added to here. but should it be always 1..? or its relatively closed page..
  echo "<div ><a class='col-md-8' href=".$url.">".$row['title']."</a></div>";
  echo "<div class='col-md-2'>".$row['author']."</div>";
  echo "<div class='col-md-2'>".$row['created']."</div>";
}
function getid(){

  return $_GET['id'];
}
function getpostid(){
  return $_GET['post_id'];
}
?>
