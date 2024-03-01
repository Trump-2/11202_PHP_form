<?php
include "db_export.php";


if (!empty($_POST)) {
    echo "您希望匯出";
    print_r($_POST['select']);
    echo "這些資料";
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

<form action="?" method="post">
    <input type="submit" value="匯出">
    <table>
        <tr>
            <th>勾選</th>
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