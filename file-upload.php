<?php
$saveDir = './';
$savePath = $saveDir . $_FILES['upload_file']['name'];

if (move_uploaded_file($_FILES['upload_file']['tmp_name'], $savePath)) {
    // 成功時
} else {
    // 失敗時
}

// アップロードページに戻る
header('Location: /upload');
exit;
?>