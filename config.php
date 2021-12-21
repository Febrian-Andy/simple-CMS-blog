<?php
$db = mysqli_connect('localhost', 'root', '', 'blog');

if (!$db) {
  echo "Eror";
}

function query($query)
{
  global $db;
  $result = mysqli_query($db, $query);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}

function signup($data)
{
  global $db;

  $username = strtolower(stripslashes($data['username']));
  $password = mysqli_real_escape_string($db, $data['password']);
  $password2 = mysqli_real_escape_string($db, $data['password2']);


  // Cek Keunikan Username
  $result = mysqli_query($db, "SELECT username FROM users WHERE username = '$username'");
  if (mysqli_fetch_assoc($result)) {
    echo "<script>
             alert('Username sudah ada');
         </script>   ";

    return false;
  }



  //  cek confirm passwrd
  if ($password !== $password2) {
    echo "<script>
         alert('Password tidak sesuai');
     </script>   ";

    return false;
  }

  // Enkripsi password
  $password = password_hash($password, PASSWORD_DEFAULT);
  mysqli_query($db, "INSERT INTO users (username,password)  VALUES ('$username','$password')");
  return (mysqli_affected_rows($db));
}


function hapus($id)
{
  global $db;
  mysqli_query($db, "DELETE FROM posts WHERE id = $id");
  return mysqli_affected_rows($db);
}
function tambah($data)
{
  global $db;

  $title = htmlspecialchars($_POST['title']);
  $author = htmlspecialchars($_POST['author']);
  $content = $_POST['content'];

  // upload gambar
  $gambar = upload();
  if (!$gambar) {
    return false;
  }

  $query = "INSERT INTO posts (title,gambar,author,content) VALUES( '$title','$gambar','$author', '$content')";
  mysqli_query($db, $query);

  return mysqli_affected_rows($db);
}

function upload()
{

  $namaFile = $_FILES['gambar']['name'];
  $ukuranFile = $_FILES['gambar']['size'];
  $error = $_FILES['gambar']['error'];
  $tmpName = $_FILES['gambar']['tmp_name'];

  // cek apakah tidak ada gambar yang diupload
  if ($error === 4) {
    echo "<script>
				alert('pilih gambar terlebih dahulu!');
			  </script>";
    return false;
  }

  // cek apakah yang diupload adalah gambar
  $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
  $ekstensiGambar = explode('.', $namaFile);
  $ekstensiGambar = strtolower(end($ekstensiGambar));
  if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
    echo "<script>
				alert('yang anda upload bukan gambar!');
			  </script>";
    return false;
  }

  // cek jika ukurannya terlalu besar
  if ($ukuranFile > 3000000) {
    echo "<script>
				alert('ukuran gambar terlalu besar!');
			  </script>";
    return false;
  }

  // lolos pengecekan, gambar siap diupload
  // generate nama gambar baru
  $namaFileBaru = uniqid();
  $namaFileBaru .= '.';
  $namaFileBaru .= $ekstensiGambar;



  move_uploaded_file($tmpName, '../public/img/' . $namaFileBaru);
  return $namaFileBaru;
}

function ubah($data)
{
  global $db;

  $id = $data["id"];
  $title = htmlspecialchars($data["title"]);
  $author = htmlspecialchars($data["author"]);
  $content = $data["content"];
  $gambarLama = htmlspecialchars($data["gambarLama"]);

  // cek apakah user pilih gambar baru atau tidak
  if ($_FILES['gambar']['error'] === 4) {
    $gambar = $gambarLama;
  } else {
    $gambar = upload();
  }


  $query = "UPDATE posts SET
				title = '$title',
				author = '$author',
				content = '$content',
				gambar = '$gambar'
			  WHERE id = $id
			";

  mysqli_query($db, $query);

  return mysqli_affected_rows($db);
}
