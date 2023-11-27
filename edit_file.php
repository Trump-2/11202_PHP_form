<?php
include_once 'db.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>編輯檔案</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <h1 class="header">編輯檔案</h1>
  <!----建立你的表單及設定編碼----->

  <?php
  if (isset($_GET['err'])) {
    echo "<div style='color:red;'>{$_GET['err']}</div>";
  }


  ?>


  <form action="api/edit_file.php" method="post" enctype="multipart/form-data">

    <input type="file" name="img" id="">
    <input type="text" name="name" id="" value="">
    <input type="text" name="desc" id="" value="">
    <input type="submit" value="更新">
  </form>


  <!----建立一個連結來查看上傳後的圖檔---->
  <?php
  if (isset($_GET['img'])) {
    echo "<img src='imgs/{$_GET['img']}' style='width:250px; height:150px'>";
  }


  ?>
</body>

</html>