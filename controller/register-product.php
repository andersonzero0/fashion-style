<?php
session_start();
require "../model/connect-db.php";

if(empty($_POST['nome-p']) || empty($_POST['valor-p']) || empty($_FILES["img-product"])){
  $_SESSION['erroRegProduct'] = 123;
  die(header('location: ../view/admin/'));
}

#img upload
$target_dir = "../assets/img/uploads/";
$target_file = $target_dir . basename($_FILES["img-product"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["img-product"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

if ($_FILES["img-product"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";

} else {
  if (!move_uploaded_file($_FILES["img-product"]["tmp_name"], $target_file)) {
    echo "Sorry, there was an error uploading your file.";
  }else{
    $img_local = htmlspecialchars( basename( $_FILES["img-product"]["name"]));
  }
}

$nome_p = $_POST['nome-p'];
$valor_p = (double)$_POST['valor-p'];

$sql = "INSERT INTO produtos (nome, valor, caminhoIMG)
VALUES ('$nome_p', $valor_p, '$img_local')";

if ($conn->query($sql) === TRUE) {
    header('location: ../view/admin/');
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
?>