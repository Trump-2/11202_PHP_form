<?php
// $dsn = "mysql:host=localhost;charset=utf8;dbname=member";
// $pdo = new PDO($dsn, 'root', '');
session_start();
date_default_timezone_set("Asia/Taipei");


$dsn = "mysql:host=localhost;charset=utf8;dbname=member";
$pdo = new PDO($dsn, 'root', '');


function total($table, $id)
{
  global $pdo;
  $sql = "select count(`id`) from `$table` ";

  if (is_array($id)) {
    foreach ($id as $col => $value) {
      $tmp[] = "`$col`='$value'";
    }
    $sql .= " where " . join(" && ", $tmp);
  } else if (is_numeric($id)) {
    $sql .= " where `id` = '$id'";
  } else {
    echo "錯誤:參數的資料型態必須是數字或陣列";
  }
  // echo 'find=>' . $sql;
  $row = $pdo->query($sql)->fetchColumn();
  return $row;
}



// crud 的 d
function del($table, $id)
{
  // 方法1 用 include 使用重複的程式碼
  // include "pdo.php";
  // 方法2 用 global 變數使用重複的程式碼
  // global $pdo;
  // 方法3 用 function 使用重複的程式碼
  global $pdo;

  $sql = "delete from `$table` where ";

  if (is_array($id)) {

    foreach ($id as $col => $value) {
      $tmp[] = "`$col`='$value'";
    }
    $sql .=  join(" && ", $tmp);
  } else if (is_numeric($id)) {
    $sql .= " `id` = '$id'";
  } else {
    echo "錯誤:參數的資料型態必須是數字或陣列";
  }

  // echo $sql;
  return $pdo->exec($sql);
}


// crud 的 r
function all($table = null, $where = '', $other = '')
{
  global $pdo;
  $sql = "select * from `$table` ";

  if (isset($table) && !empty($table)) {

    if (is_array($where)) {
      /**
       * ['dept'=>'2','graduate_at'=>12] =>  where `dept`='2' && `graduate_at`='12'
       * $sql="select * from `$table` where `dept`='2' && `graduate_at`='12'"
       */
      if (!empty($where)) {
        foreach ($where as $col => $value) {
          $tmp[] = "`$col`='$value'";
        }
        $sql .= " where " . join(" && ", $tmp);
      }
    } else {
      $sql .= " $where";
    }

    $sql .= $other;
    // echo 'all=>' . $sql;
    $rows = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
  } else {
    echo "錯誤:沒有指定的資料表名稱";
  }
}

//crud 的 r，針對某筆資料
function find($table, $id)
{
  global $pdo;
  $sql = "select * from `$table` ";

  if (is_array($id)) {
    foreach ($id as $col => $value) {
      $tmp[] = "`$col`='$value'";
    }
    $sql .= " where " . join(" && ", $tmp);
  } else if (is_numeric($id)) {
    $sql .= " where `id` = '$id'";
  } else {
    echo "錯誤:參數的資料型態必須是數字或陣列";
  }
  // echo 'find=>' . $sql;
  $row = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
  return $row;
}

// $cols 是 set 後面接的欄位名稱和欄位值
function update($table, $id, $cols)
{
  global $pdo;
  $sql = "update `$table` set ";

  if (!empty($cols)) {
    foreach ($cols as $col => $value) {
      $tmp[] = "`$col`='$value'";
    }
  }

  $sql .= join(',', $tmp);
  //
  $tmp = [];
  if (is_array($id)) {
    foreach ($id as $col => $value) {
      $tmp[] = "`$col`='$value'";
    }
    $sql .= " where " . join(" && ", $tmp);
  } else if (is_numeric($id)) {
    $sql .= " where `id` = '$id'";
  } else {
    echo "錯誤:參數的資料型態必須是數字或陣列";
  }
  // 測試用，程式最後上線時要記得拿掉
  // echo $sql;
  return $pdo->exec($sql);
}

function insert($table, $values)
{
  global $pdo;
  $sql = "insert into `$table` ";




  $cols = "(`" . join("`,`", array_keys($values)) . "`)";
  // 這裡 join () 中直接使用 $values，是因為 join () 會直接對陣列元素 ( 欄位值 ) 做合併
  $vals = "('" . join("','", $values) . "')";

  $sql = $sql . $cols . " values " . $vals;

  // echo $sql;
  return $pdo->exec($sql);
}

function dd($array)
{
  echo "<pre>";
  print_r($array);
  echo "</pre>";
}
