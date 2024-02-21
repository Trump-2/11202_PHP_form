<?php

include_once "../db.php";

$id = $_GET['id'];
$file = find('files', $id)['name'];

del('files', $id);

// 刪除資料夾中的檔案 ( 刪除硬碟內的檔案 ) 函數
unlink('../imgs/' . $file);

header("location:../manage.php");