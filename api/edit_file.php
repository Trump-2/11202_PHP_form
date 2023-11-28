<?php
include_once '../db.php';
if (isset($_POST['id'])) {
  $file = find('files', $_POST['id']);
} else {
  exit();
}
// echo $_POST['desc'];

// 確認檔案是否上傳成功，透過判斷暫存的路徑
// tmp_name 是完整的路徑，包含檔名
if (!empty($_FILES['img']['tmp_name'])) {
  if ($_POST['name'] != $file['name']) {
    move_uploaded_file($_FILES['img']['tmp_name'], "../imgs/" . $_POST['name']);
    $file['name'] = $_POST['name'];
  } else {
    move_uploaded_file($_FILES['img']['tmp_name'], "../imgs/" . $_POST['name']);
  }



  // 這裡在簡化檔案類型的名稱在資料表中所顯示過長的問題
  switch ($_FILES['img']['type']) {
    case "application/vnd.openxmlformats-officedocument.wordprocessingml.document":
      $type = "msword";
      break;
    case "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet":
      $type = "msexcel";
      break;
    case "application/vnd.openxmlformats-officedocument.presentationml.presentation":
      $type = "msppt";
      break;
    case "application/pdf":
      $type = 'pdf';
      break;
    case "image/webp":
    case "image/jpeg":
    case "image/png":
    case "image/gif":
      $type = $_FILES['img']['type'];
      break;
    default:
      $type = 'other';
  }

  // 這裡處理重新上傳的檔案的類型跟原檔案不一樣時的邏輯
  if ($type != $file['type']) {
    // 這裡更新資料表的 type 欄位
    $file['type'] = $type;

    // 這裡對真實檔案的副檔名進行更新
    $subname = end(explode(".", $_FILES['img']['name'])); // 這裡取得新檔案的副檔名
    $tmp = explode(".", $file['name']); // 這裡將原檔案的檔名拆成數個陣列元素
    $tmp[count($tmp) - 1] = $subname; // 這裡用新檔案的副檔名覆蓋掉原始檔案的
    $file['name'] = join(".", $tmp);
  }

  // $file = [
  //   'name' => $newFileName,
  //   'type' => $type,
  //   'size' => $_FILES['img']['size'],
  //   'desc' => $_POST['desc']
  // ];

  $file['type'] = $type;
  $file['size'] = $_FILES['img']['size'];
} else { // 這裡要處理使用者沒有上傳新的檔案，只想更改檔名的邏輯
  if ($_POST['name'] != $file['name']) {


    // 這行則要更改真實檔案的檔名，使用內建函數 rename() : 兩個參數都要是包含檔名的完整路徑
    rename("../imgs/" . $file['name'], "../imgs/" . $_POST['name']);

    // 這行只有更改資料表中的 name 欄位值；注意這行一定要在 rename 完之後
    $file['name'] = $_POST['name'];
  }
}

// 這裡判斷表單送來的 desc 和資料表中的 desc 欄位是否不同，不同代表需要更新 desc 
if ($_POST['desc'] != $file['desc']) {
  $file['desc'] = $_POST['desc'];
}

update('files', $_POST['id'], $file);
header('location:../manage.php');

// header('location:../edit_file.php?err=上傳失敗');
