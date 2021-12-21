<?php
include '../config.php';
session_start();
if (!isset($_SESSION['login'])) {
  header("Location: ../login.php");
  exit;
}



$query = "SELECT id,title,content,author,DATE(created_at) FROM posts";
$result = mysqli_query($db, $query);

$CRUD = "SELECT id,title,content,author,DATE(created_at) FROM posts";
$crudresult = mysqli_query($db, $query);

if (isset($_POST['post'])) {
  if (tambah($_POST) > 0) {
    echo "
			<script>
				alert('data berhasil ditambahkan!');
				document.location.href = 'index.php';
			</script>
		";
  } else {
    echo "
			<script>
				alert('data gagal ditambahkan!');
				document.location.href = 'index.php';
			</script>
		";
  }
}

?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="../public/style.css">
  <title>Blog-site | Admin</title>
</head>

<body>
  <div class="container-fluid">
    <div class="d-flex align-items-start">
      <div class="nav nav-admin w-25 shadow border-end flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        <h1 class="display-2 mt-2">BLOG-SITE</h1>
        <button class="nav-link active mb-2" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true"> <i class="fa fa-list-alt" aria-hidden="true"></i> Daftar Post</button>
        <button class="nav-link mb-2" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false"><i class="fa fa-upload" aria-hidden="true"></i> Tambah Post</button>
        <button class="nav-link mb-2" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Update/Delete</button>
        <button class="nav-link mb-2" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</button>
      </div>
      <div class="tab-content mt-4 w-100" id="v-pills-tabContent">
        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
          <table class="table ">
            <thead class="table-dark ">
              <tr>
                <th>No</th>
                <th>Title</th>
                <th>Created at</th>
                <th>Author</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1; ?>
              <?php while ($posts = mysqli_fetch_assoc($result)) {  ?>
                <tr>
                  <td><?= $i; ?></td>
                  <td><?= $posts['title']; ?></td>
                  <td><?= $posts['DATE(created_at)']; ?></td>
                  <td><?= $posts['author']; ?></td>
                </tr>
                <?php $i++; ?>
              <?php } ?>
            </tbody>
          </table>
        </div>
        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
          <form action="" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Title</label>
              <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Judul" name="title">
            </div>
            <div class="mb-3">
              <input type="file" class="form-control" aria-label="file example" required name="gambar">
              <div class="invalid-feedback">Example invalid form file feedback</div>
            </div>
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Author</label>
              <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Author" name="author">
            </div>
            <div class="mb-3">
              <label for="exampleFormControlTextarea1" class="form-label">Content</label>
              <textarea class="form-control" id="text-editor" rows="15" name="content"></textarea>
            </div>
            <div>
              <button type="submit" class="btn btn-success" name="post">Submit</button>
            </div>
          </form>
        </div>
        <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
          <table class="table ">
            <thead class="table-dark ">
              <tr>
                <th>No</th>
                <th>Title</th>
                <th>Created at</th>
                <th>Author</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1; ?>
              <?php while ($CRUD = mysqli_fetch_assoc($crudresult)) {  ?>
                <tr>
                  <td><?= $i; ?></td>
                  <td><?= $CRUD['title']; ?></td>
                  <td><?= $CRUD['DATE(created_at)']; ?></td>
                  <td><?= $CRUD['author']; ?></td>
                  <td>
                    <a href="delete-post.php?id=<?= $CRUD['id']; ?>">Hapus</a>
                    <a href="edit-post.php?id=<?= $CRUD['id']; ?>">Edit</a>
                  </td>
                </tr>
                <?php $i++; ?>
              <?php } ?>
            </tbody>
          </table>
        </div>
        <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
          <h2>Apa anda yakin? <a href="logout.php">Yes</a></h2>
        </div>
      </div>
    </div>
  </div>






  <script>
    ClassicEditor
      .create(document.querySelector('#text-editor'))
      .then(editor => {
        editor.ui.view.editable.element.style.height = '250px';
      })
      .catch(error => {
        console.error(error);
      });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>

</html>