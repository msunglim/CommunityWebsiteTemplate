<?php

require 'config\config.php';
require 'lib\db.php';
$conn = connectToDB($config["host"],$config["duser"],$config["dpw"], $config["dname"]);
$sql = "SELECT * FROM post";
$result = mysqli_query($conn, $sql);
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
    <a href = "http://localhost/index.php?id&post_id"> Moungsung's private posting office</a>
  </header>


  <ul class="nav nav-pills navbar navbar-inverse">
    <li role="presentation" class="col-md-2"><a href="http://localhost/index.php?id&post_id">전체게시판</a></li>
    <li role="presentation" class="col-md-2"><a href="http://localhost/index.php?id=1&post_id">자유게시판</a></li>
    <li role="presentation" class="col-md-2"><a href="http://localhost/index.php?id=2&post_id">정치게시판</a></li>
    <li role="presentation" class="col-md-2"><a href="http://localhost/index.php?id=3&post_id">음식게시판</a></li>
  </ul>


  <article class="">
    <form class="" action="process.php" method="post">
      <?php
      $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

      //editing mode
      if(strpos($actual_link, "post_id")){
        $id = $_GET['post_id'];
        $sql = "SELECT * FROM post WHERE id=$id";
        $res = mysqli_query($conn, $sql);
        $result = mysqli_fetch_assoc($res);
        $title = htmlspecialchars($result['title'], ENT_QUOTES);
        $username = htmlspecialchars($result['author'], ENT_QUOTES);
        $description = $result['description'];

        echo '<div class="input-group" id="title_input">
        <span class="input-group-addon">Title</span>
        <input type="text" class="form-control" value='."'$title'".'name="title" value="">
        </div>
        <div class="input-group" id="username_input">
        <span class="input-group-addon">Username</span>
        <input type="text" class="form-control" value='."'$username'".' name="username" value="">
        </div>
        <textarea name="description" rows="15" cols="80" >'."$description".'</textarea>
        <button type="submit" name="button">Submit</button>';

      }else{//writing mode
        ?>
        <div class="input-group" id="title_input">
          <span class="input-group-addon">Title</span>
          <input type="text" class="form-control" placeholder="Title of Post"name="title" value="">
        </div>
        <div class="input-group" id="username_input">
          <span class="input-group-addon">Username</span>
          <input type="text" class="form-control" placeholder="Username"name="username" value="">
        </div>
        <textarea name="description" rows="15" cols="80" placeholder="Description"></textarea>
        <button type="submit" name="button">Submit</button>
        <?php
      }
      ?>


    </form>
  </article>



</script>
<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
</body>
</html>
