<?php
include_once 'db.php';
if (isset($_GET['id'])) {
  $file = find('files', $_GET['id']);
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">

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

  <div class="text-center"><a href="manage.php">回檔案管理頁</a></div>
  <form action="api/edit_file.php" method="post" enctype="multipart/form-data">
    <div class="container col-6">

      <table class="table">
        <tr>
          <?php
          switch ($file['type']) {
            case "image/webp":
            case "image/jpeg":
            case "image/png":
            case "image/gif":
              $imgname = "./imgs/" . $file['name'];
              break;
            case "msword":
              $imgname = "./icon/wordicon.png";
              break;
            case "msexcel":
              $imgname = "./icon/excelicon.png";
              break;
            case "msppt":
              $imgname = "./icon/ppticon.png";
              break;
            case "pdf":
              $imgname = "./icon/pdficon.png";
              break;
            default:
              $imgname = "./icon/othericon.png";
          }
          ?>
          <td>媒體</td>
          <img src="<?= $imgname; ?>" alt="" style="width:200px; 200px;">
          <td><input type=" file" name="img"></td> <!-- file 屬性的 input 沒有 value 這個屬性 -->
        </tr>
        <tr>
          <td>檔名</td>
          <td><input type="text" name="name" value="<?= $file['name']; ?>"></td>
        </tr>
        <tr>
          <td>說明</td>
          <td><textarea name="desc" style="width:300px; height:200px;"><?= $file['desc']; ?></textarea></td>
        </tr>
      </table>
      <div class=" text-center m-3">
        <input type="hidden" name="id" value="<?= $file['id']; ?>">
        <input type="submit" value="更新">
      </div>
  </form>
  </div>


  <!----建立一個連結來查看上傳後的圖檔---->
  <?php
  if (isset($_GET['img'])) {
    echo "<img src='imgs/{$_GET['img']}' style='width:250px; height:150px'>";
  }


  ?>
  <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
  </script>

</body>

</html>