<?php
echo $_POST['desc'];
// 確認檔案是否上傳成功，透過判斷暫存的路徑
// tmp_name 是完整的路徑，包含檔名
if (!empty($_FILES['img']['tmp_name'])) {
  // echo $_FILES['img']['tmp_name'];
  // echo "<br>";
  // echo $_FILES['img']['name'];
  // echo "<br>";
  // echo $_FILES['img']['type'];
  // echo "<br>";
  // echo $_FILES['img']['size'];

  // 這裡第二個參數最好的做法是要修改檔案的原名稱，因為可能產生檔名衝突，但這邊為了方便讓新檔名跟原檔名一樣
  // move_uploaded_file($_FILES['img']['tmp_name'], "../imgs/" . $_FILES['img']['name']);

  // 這裡產生新的檔名；透過原檔名取得副檔名再搭配日期跟亂數產生新檔名
  $tmp = explode('.', $_FILES['img']['name']);
  // 取得陣列最後一個元素
  $subname = end($tmp);
  $newFileName = date("YmdHis") . rand(10000, 99999) . "." . $subname;
  move_uploaded_file($_FILES['img']['tmp_name'], "../imgs/" . $newFileName);

  header('location:../manage.php');
} else {
  header('location:../upload.php?err=上傳失敗');
}
