<?php
include './config.php';
$query = "SELECT id,title,gambar,content,author,DATE(created_at) FROM posts";
$result = mysqli_query($db, $query);


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./public/style.css">
  <title>Blog-site | Blogs</title>
</head>

<body>

  <?php include './templete/header.php'; ?>
  <div class="container">
    <div class="row mt-5 mb-5">
      <div class="col-md-9">
        <?php while ($posts = mysqli_fetch_assoc($result)) {  ?>
          <div class="card border-0 mb-3" style="max-width: 100%;">
            <div class="row g-0">
              <div class="col-md-5">
                <img src="./public/img/<?= $posts['gambar']; ?>" class="img-fluid rounded-start" alt="..." height="100">
              </div>
              <div class="col-7">
                <div class="card-body">
                  <h5 class="card-title"><?= $posts['title']; ?></h5>
                  <p class="card-text "><small class="text-muted"><i class="fa fa-user-circle-o" aria-hidden="true"></i> <?= $posts['author']; ?> |
                      <i class="fa fa-calendar" aria-hidden="true"></i> <?= $posts['DATE(created_at)']; ?></small></p>
                  <p class="card-text"><?= substr($posts['content'], 0, 100); ?> ...</p>
                  <a href="blog.php?id=<?= $posts['id']; ?>" class="btn btn-success">Read More</a>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>

  <?php include './templete/footer.php'; ?>
</body>

</html>