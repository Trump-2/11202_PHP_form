<?php
include_once "../db.php";

$id = $_GET['id'];

// 取得某檔案在資料表中的紀錄
$file = find('files', $_GET['id']);

// 刪除檔案在資料表中的紀錄
del('files', $id);

// 刪除在硬碟中檔案的內建函數，需要一檔案路徑字串的參數
unlink("../imgs/" . $file['name']);

header('location:../manage.php');