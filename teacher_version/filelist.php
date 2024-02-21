<h2>資料夾 imgs 的內容</h2>

<style>
ul {
    list-style-type: none;
    display: flex;
    width: 1000px;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    transform: scale(1);
}

li:hover {
    transition: all 0.5s ease;
    transform: scale(1.1);

}
</style>
<?php
$dir = "./imgs";
$files = scandir($dir);
$filestr = 'beauty';

echo "<ul>";
if (!empty($files)) {
    foreach ($files as $idx => $file) {
        if (str_contains($file, 'thumb') && is_file($dir . "/" . $file)) {

            // 取得副檔名
            $ext = explode(".", $file)[1];
            $filename = "thumb_" . $filestr . sprintf("%04d", $idx + 1) . "." . $ext;
            rename($dir . "/" . $file, $dir . "/" . $filename);
            echo "<li>";
            echo "<img src = '$dir/$filename'>";
            echo "</li>";
        }
    }
}

echo "</ul>";

?>