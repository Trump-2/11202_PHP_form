<?php
// 要使用 DOMpdf ，這行一定要放到最上面
require 'vendor/autoload.php';


use Dompdf\Dompdf;
use Dompdf\Options;

include "db_export.php";

$options = new Options();
// $options->set('defaultFont', 'Courier');
$options->set('defaultFont', 'bk');
$dompdf = new Dompdf($options);


if (!empty($_POST)) {
    $rows = all("20200706", " where `投票所編號` in ('" . join("','", $_POST['select']) . "')");
    // print_r($rows);

    // $filename = date("Ymd") . rand(100000000, 999999999);
    $filename = date("Ymd") . rand(100000000, 999999999) . ".pdf";

    $imagePath = "./icon/wda.png";
    $imageData = file_get_contents($imagePath);

    $base64Image = base64_encode($imageData);

    $dataUri = 'data:image/png;base64,' . $base64Image;



    // $file = fopen("./doc/{$filename}.csv", "w+"); // w+ 是內建參數

    // 加入 utf-8 編碼的 BOM
    // fwrite($file, "\xEF\xBB\xBF");

    $html = "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Document</title>
        <style>
        table{
            border-collapse:collapse;
            font-size:12px;
        }
        td{
            border:1px solid #666;
            padding:5px;
        }

        
        tr:nth-child(odd){
            background:lightgreen;
        }

        
        tr:first-child{
            background:black;
            color:white;
            font-weight:bold;
        }
        
        </head>
    <body>
<img src='{$dataUri}' style='width:150px;height:150px'>
";



    $html .= "<table>";
    // 預設為 false
    $chk = false;
    foreach ($rows as $row) {
        // 這個判斷式要取得表單最上面的欄位名稱那列
        if (!$chk) {
            $cols = array_keys($row);
            $html .= "<tr>";
            foreach ($cols as $idx => $col) {

                $html .= "<td>";
                $html .= $col;
                $html .= "</td>";
                if ($idx == 7) {
                    $html .= "</tr>";
                    $html .= "<tr>";
                }
            }
            $html .= "</tr>";
            $chk = true;
        }
        // fwrite($file, join(',', $row) . "\r\n"); // \r\n 代表換行，適用於 windows 系統；\n 也代表換行，用於 unix、linux 系統
        $html .= "<tr>";
        foreach ($row as $key => $r) {
            $html .= "<td>";
            $html .= $r;
            $html .= "</td>";
            if ($key == '候選人3票數') {
                $html .= "</tr>";
                $html .= "<tr>";
            }
        }
        $html .= "</tr>";
    }


    $html .= "</table></body>
    </html>";


    $dompdf->loadHtml($html);

    $dompdf->setPaper('A4', 'landscape');

    $dompdf->render();


    $dompdf->stream("./doc/{$filename}", array('Attachment' => 0));

    // fclose($file);

    // download 參數:讓 href 連結到的檔案變成可下載
    echo "<a href='./doc/{$filename}' download>檔案已匯出，請點此連結下載</a>";
}
?>

<style>
table {
    border-collapse: collapse;
}

td {
    border: 1px solid #666;
    padding: 5px 12px;
}

th {
    border: 1px solid #666;
    padding: 5px 12px;
    background: #000;
    color: #fff;
}
</style>

<script src="./jquery-3.4.1.min.js"></script>
<form action="?" method="post">
    <input type="submit" value="匯出選擇的資料">
    <table>
        <tr>
            <th>勾選 <input type="checkbox" name="" id="select"></th>
            <th>投票所編</th>
            <th>投票所</th>
            <th>候選人1</th>
            <th>候選人1票數</th>
            <th>候選人2</th>
            <th>候選人2票數</th>
            <th>候選人3</th>
            <th>候選人3票數</th>
            <th>有效票數</th>
            <th>無效票數</th>
            <th>投票數</th>
            <th>已領未投票數</th>
            <th>發出票數</th>
            <th>用餘票數</th>
            <th>選舉人數</th>
            <th>投票率</th>
        </tr>


        <?php


        $rows = all('20200706');
        foreach ($rows as $row) {
            echo "<tr>";
            echo "<td>";
            echo "<input type='checkbox' name='select[]' value='{$row['投票所編號']}'>";
            echo "</td>";
            foreach ($row as $value) {
                echo "<td>";
                echo $value;
                echo "</td>";
            }
            echo "</tr>";
        }
        ?>

    </table>
</form>

<script>
$("#select").on("change", function() {
    if ($(this).prop('checked')) {
        $("input[name='select[]']").prop('checked', true);
    } else {
        $("input[name='select[]']").prop('checked', false);
    }
})
</script>