<?php
// データベース接続設定
$host = 'localhost';
$dbname = 'bananaking_chat';
$username = 'bananaking_sns'; // 自分の設定に合わせて変更
$password = 'bananaking';
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('データベース接続エラー: ' . $e->getMessage());
}

// メッセージの送信処理
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['message'])) {
    $user = $_POST['user'];
    $message = $_POST['message'];

    // メッセージをデータベースに保存
    $stmt = $pdo->prepare("INSERT INTO messages (user, message) VALUES (?, ?)");
    $stmt->execute([$user, $message]);

    // ページをリロードしないようにリダイレクト
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// メッセージを取得して表示
$messages = $pdo->query("SELECT * FROM messages ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>チャット</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .chat-box { width: 100%; margin: 0 auto; border: 1px solid #ddd; padding: 20px; }
        .message { margin-bottom: 10px; padding: 10px; border-bottom: 1px solid #ddd; }
        .message strong { color: #333; }
        .message p { margin: 5px 0 0; color: #555; }
        .form { margin-top: 20px; }
        .form input[type="text"], .form input[type="submit"] { padding: 10px; }
        .form input[type="text"] { width: 80%; }
        .textarea {
            width: 80%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            resize: vertical;
            word-wrap: break-word; /* 単語の途中で改行 */
            white-space: pre-wrap; /* 改行や空白も維持しつつ折り返し */
        }
    </style>
</head>
<body>
<div id="loadArea" class="loadTo"></div>
<script>
    window.addEventListener('DOMContentLoaded', function(){
        fetch('/header.html')
        .then(data => data.text())
        .then(html => document.getElementById('loadArea').innerHTML = html);
    });
</script>
<div class="chat-box">
    <h1>チャットルーム</h1>

    <!-- メッセージ送信用フォーム -->
    <div class="form">
        <form method="POST" action="">
            <input type="text" name="user" placeholder="名前を入力" required>
            <textarea class="textarea" name="message" placeholder="メッセージを入力" required rows="4" cols="30"></textarea>
            <input type="submit" value="送信">
        </form>
    </div>

    <!-- メッセージを表示 -->
    <div class="messages">
        <?php foreach ($messages as $msg): ?>
            <div class="message">
                <strong><?= htmlspecialchars($msg['user']) ?>:</strong>
                <p><?= htmlspecialchars($msg['message']) ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- admax -->
<script src="https://adm.shinobi.jp/s/ffbe5a84f8e4111f02a25db0bcb95044"></script>
<!-- admax -->
</body>
</html>