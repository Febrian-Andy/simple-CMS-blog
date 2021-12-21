<?php
include '../config.php';
session_start();
if (!isset($_SESSION['login'])) {
  header("Location: ../login.php");
  exit;
}





// ambil data di URL
$id = $_GET["id"];

// query data mahasiswa berdasarkan id
$post = query("SELECT * FROM posts WHERE id = $id")[0];


// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["post"])) {

  // cek apakah data berhasil diubah atau tidak
  if (ubah($_POST) > 0) {
    echo "
			<script>
				alert('data berhasil diubah!');
				document.location.href = 'index.php';
			</script>
		";
  } else {
    echo "
			<script>
				alert('data gagal diubah!');
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
  <!-- Edit Page -->
  <div class="container">
    <h1 class="mt-5 text-center">Halaman Edit Posting</h1>
    <form action="" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?= $post["id"]; ?>">
      <input type="hidden" name="gambarLama" value="<?= $post["gambar"]; ?>">
      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Title</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Judul" name="title" value="<?= $post['title']; ?>">
      </div>
      <div class="mb-3">
        <img src="../public/img/<?= $post['gambar']; ?>" width="40"> <br>
        <input type="file" class="form-control" aria-label="file example" name="gambar">
        <div class="invalid-feedback">Example invalid form file feedback</div>
      </div>
      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Author</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Author" name="author" value="<?= $post['author']; ?>">
      </div>
      <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Content</label>
        <textarea class="form-control" id="text-editor" rows="15" name="content">
          <?= $post['content']; ?>
        </textarea>
      </div>
      <div>
        <button type=" submit" class="btn btn-success" name="post">Submit</button>
      </div>
    </form>

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