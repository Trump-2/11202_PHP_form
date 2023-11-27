<?php

/**
 * 1.建立資料庫及資料表來儲存檔案資訊
 * 2.建立上傳表單頁面
 * 3.取得檔案資訊並寫入資料表
 * 4.製作檔案管理功能頁面
 */

include_once "db.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>檔案管理功能</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <h1 class="header">檔案管理練習</h1>
  <!----建立上傳檔案表單及相關的檔案資訊存入資料表機制----->

  <h3><a href="upload.php">上傳檔案</a></h3>



  <!----透過資料表來顯示檔案的資訊，並可對檔案執行更新或刪除的工作----->
  <?php
  $files = all('files');
  // dd($files);
  ?>
  <div class="col-8 m-auto text-center">

    <table class="table table-primary">
      <tr>
        <td>id</td>
        <td>檔名</td>
        <td>類型</td>
        <td>大小</td>
        <td>描述</td>
        <td>上傳時間</td>
        <td>操作</td>
      </tr>
      <?php
      // 這裡用 foreach 來將每筆取得的資料陣列放入 $file 中，進而取得該筆資料的每個欄位值；
      // 再進一步對檔案的類型作判斷，並將指定的對應的路徑 + 檔名存入變數中，之後再將該變數放到 img tag 的 src 中，即可在頁面上顯示對應的 icon
      foreach ($files as $file) {
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
      <tr>
        <td>
          <?= $file['id']; ?>
        </td>
        <!-- 下面這一行的 $file['name'] 跟 imgs 後面的 2023112316302713652.jpg 一樣，所以把它放到 imgs 的後面  -->
        <td><img style="width:150px;height:120px;" src="<?= $imgname ?>" alt=""></td>
        <td>
          <?= $file['type']; ?>
        </td>
        <td>
          <?= $file['size']; ?>
        </td>
        <td>
          <?= $file['desc']; ?>
        </td>
        <td>
          <?= $file['create_at']; ?>
        </td>
        <td>
          <button class="btn btn-primary"
            onclick="location.href='./api/edit_file.php?id=<?= $file['id'] ?>'">編輯</button>
          <button class="btn btn-danger" onclick="location.href='./api/del_file.php?id=<?= $file['id'] ?>'">刪除</button>
        </td>
      </tr>

      <?php
      }
      ?>
    </table>
  </div>


  <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
  </script>
</body>
</body>

</html>