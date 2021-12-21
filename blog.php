<?php
include './config.php';
$title = $_GET['id'];
$query = "SELECT id,title,gambar,content,author,DATE(created_at) FROM posts WHERE id =$title";
$result = mysqli_query($db, $query);


?>

<?php include './templete/header.php'; ?>
<div class="container mt-5 mb-5 ">
  <div class="single-blog w-75 mx-auto ">
    <?php while ($posts = mysqli_fetch_assoc($result)) {  ?>

      <h1 class="card-title text-center"><?= $posts['title']; ?></h1>
      <p class="card-text text-center mt-4 mb-5 h5"><small class="text-muted"><i class="fa fa-user-circle-o" aria-hidden="true"></i> <?= $posts['author']; ?> |
          <i class="fa fa-calendar" aria-hidden="true"></i> <?= $posts['DATE(created_at)']; ?></small></p>
      <p class="card-text "><?= $posts['content']; ?> </p>


    <?php } ?>
  </div>
</div>
<?php include './templete/footer.php'; ?>