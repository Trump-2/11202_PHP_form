<?php

include_once './db.php';
if (isset($_GET['id'])) {
  $find = find('files', $_GET['id']);
} else {
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>編輯檔案</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

  <link rel="stylesheet" href="style.css">
</head>

<body>
  <h1 class="header">編輯檔案</h1>
  <!----建立你的表單及設定編碼----->
  <?php

  if (isset($_GET['err'])) {
    echo $_GET['err'];
  }

  ?>
  <div class="text-center"><a href="manage.php"></a>回列表</div>
  <form action="./api/edit_file.php" method="post" enctype="multipart/form-data">
    <table class="table">
      <div class=" col-6 mx-auto"></div>
      <tr>
        <td>媒體</td>
        <td>
          <!-- file 沒有 value attribute -->
          <img src="<?= $imgname; ?>" alt="" style="width:350px; height:250px;"><br>
          <input type="file" name="img" id="">
        </td>
      </tr>
      <tr>
        <td>檔名</td>
        <td>
          <input type="text" name="name" id="">
        </td>
      </tr>
      <tr>
        <td>說明</td>
        <td>

          <textarea name="desc" id="" style="width:350px; height:200px;">$</textarea>
        </td>
      </tr>
    </table>
    <div class=" text-center m-3">
      <input type="hidden" name="">
      <input type="submit" value="更新">
    </div>
  </form>



  <!----建立一個連結來查看上傳後的圖檔---->
  <?php

  if (isset($_GET['img'])) {
    echo "<img src='./imgs/{$_GET['img']}' style='width:250px;height:150px'>";
  }

  ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>