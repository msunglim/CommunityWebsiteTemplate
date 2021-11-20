<?php

require 'config\config.php';
require 'lib\db.php';
$conn = connectToDB($config["host"],$config["duser"],$config["dpw"], $config["dname"]);

//var_dump($result);

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Welcome To Moungsung's Galleries</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">

</head>
<body>
  <header class="jumbotron">
    <a href = "http://localhost/index.php?id&post_id&page=1"> Moungsung's private posting office</a>
  </header>


  <ul class="nav nav-pills navbar navbar-inverse">
    <li role="presentation" class="col-md-2"><a href="http://localhost/index.php?id&post_id&page=1">ALL TOPIC</a></li>
    <li role="presentation" class="col-md-2"><a href="http://localhost/index.php?id=1&post_id&page=1">FREE TOPIC</a></li>
    <li role="presentation" class="col-md-2"><a href="http://localhost/index.php?id=2&post_id&page=1">POLITICAL TOPIC</a></li>
    <li role="presentation" class="col-md-2"><a href="http://localhost/index.php?id=3&post_id&page=1">FOOD TOPIC</a></li>
  </ul>
  <?php
  if($_GET['id']!=null){
    ?>
    <button id="write" type="button" class="btn btn-info">Write</button>
    <?php
  }
  ?>
  <ul class='list-group'>

    <?php

    require 'list_post.php';
    //
    // 테이블합친거
    // $new_table_sql = " SELECT categories.id, categories.title as cat_title, categories.admin, post.title, post.author, post.created, post.description FROM categories LEFT JOIN post ON categories.id = POST.category";
    // $new_table = mysqli_query($conn, $new_table_sql);
    // while($row = mysqli_fetch_assoc($new_table)){
    //   echo $row['id'];
    //   echo $row['cat_title'];
    //   echo $row['admin'];
    //   echo $row['title'];
    //   echo $row['author'];
    //
    // }

    //when reading a post
    if($_GET['post_id']!=null){
      $postid = $_GET['post_id'];
      $postsql = "SELECT * FROM post WHERE $postid=id";
      $postresult = mysqli_query($conn, $postsql);
      $post = mysqli_fetch_assoc($postresult);
      ?>
      <div id = "showpost">
        <?php
        echo "<h2>".$post['title']."</h2>";
        echo "<span class='label label-primary'>".$post['author']." </span>";
        echo "<span class='label label-success'>".$post['created']."</span><br/><hr>";
        echo $post['description'];
        ?>
        <hr>
        <!-- delete, edit button   -->
        <div id="controlpost">

          <button type="button" name="button" id="edit" class="btn btn-warning">Edit</button>
          <button type="button" name="button" id="delete" class="btn btn-danger">Delete</button>
        </div>
      </div>
      <li id= "bar" class="list-group-item">
        <div class="row">

          <div class='col-md-8'><b>Title</b></div>
          <div class='col-md-2'><b>Author</b></div>
          <div class='col-md-2'><b>Created</b></div>

        </div>
      </li>
      <?php

    }
    else{//not reading a post
      ?>
      <li id= "bar" class="list-group-item">
        <div class="row">

          <div class='col-md-8'><b>Title</b></div>
          <div class='col-md-2'><b>Author</b></div>
          <div class='col-md-2'><b>Created</b></div>

        </div>
      </li>
      <?php
    }
    $page = 5*($_GET['page']-1);

    if($_GET['id']!=null){


      $getid = $_GET['id'];
      // $catitleSQL = "SELECT * FROM categories WHERE $getid=id";
      // $cat_result = mysqli_query($conn, $catitleSQL);
      // $catTitle = mysqli_fetch_assoc($cat_result)["title"];
      //Those are used to find the category title!
      $select_cat_postSQL = "SELECT * FROM post WHERE $getid=category ORDER BY id DESC LIMIT $page, 5";
      $cat_post_result = mysqli_query($conn, $select_cat_postSQL);
      while($row = mysqli_fetch_assoc($cat_post_result)){
        ?>
        <li class="list-group-item">
          <div class="row">
            <?php
            listpost($row,$conn);
            ?>
          </div>
        </li>
        <?php
      }
    }else{

      $sql = "SELECT * FROM post ORDER BY id DESC LIMIT $page, 5";
      $result = mysqli_query($conn, $sql);
      while($row = mysqli_fetch_assoc($result)){
        ?>
        <li class="list-group-item">
          <div class="row">
            <?php
            listpost($row,$conn);
            ?>
          </div>
        </li>
        <?php
      }
    }
    ?>
  </ul>

  <nav id= "aria_label" aria-label="Page navigation">
    <ul class="pagination">
      <li>
        <a href="#" aria-label="Previous">
          <span aria-hidden="true">&laquo;</span>
        </a>
      </li>
      <?php
      $getid = getid();
      $getpostid = getpostid();
    
      echo '<li><a href="http://localhost/index.php?id='.$getid.'&post_id='.$getpostid.'&page=1">1</a></li>
            <li><a href="http://localhost/index.php?id='.$getid.'&post_id='.$getpostid.'&page=2">2</a></li>
            <li><a href="http://localhost/index.php?id='.$getid.'&post_id='.$getpostid.'&page=3">3</a></li>
            <li><a href="http://localhost/index.php?id='.$getid.'&post_id='.$getpostid.'&page=4">4</a></li>
            <li><a href="http://localhost/index.php?id='.$getid.'&post_id='.$getpostid.'&page=5">5</a></li>'
      ?>
      <li>
        <a href="#" aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
        </a>
      </li>
    </ul>
  </nav>
  <script src="http://localhost/script.js">

  </script>
  <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
</body>
</html>
