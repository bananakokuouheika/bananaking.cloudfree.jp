<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>検索結果</title>
    <link rel="stylesheet" href="styles.css"> <!-- 別途用意するCSSファイルをリンク -->
</head>
<body>

<!-- 検索フォーム -->
<form method="GET" action="" class="search-form">
    <input type="text" name="query" placeholder="Search..." class="search-input" value="<?php echo htmlspecialchars(isset($_GET['query']) ? $_GET['query'] : ''); ?>">
    <button type="submit" class="search-button">検索</button>
</form>

<?php
// データベース接続設定
$servername = "localhost";
$username = "bananaking_sns"; // あなたのMySQLユーザー名
$password = "bananaking"; // あなたのMySQLパスワード
$dbname = "bananaking_search"; // データベース名

// 接続
$conn = new mysqli($servername, $username, $password, $dbname);

// 接続チェック
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 検索クエリの取得
$query = isset($_GET['query']) ? $_GET['query'] : '';

if (!empty($query)) {
    // SQL文の準備
    $sql = "SELECT * FROM posts WHERE title LIKE ? OR content LIKE ?";
    $stmt = $conn->prepare($sql);
    $search_term = "%" . $query . "%";
    $stmt->bind_param("ss", $search_term, $search_term);

    // SQL実行
    $stmt->execute();
    $result = $stmt->get_result();

    // 結果の表示
    if ($result->num_rows > 0) {
        echo "<h2>検索結果:</h2>";
        echo "<div class='search-results-container'>"; // 結果を包むコンテナ

        while ($row = $result->fetch_assoc()) {
            $title = htmlspecialchars($row['title']);
            $content_preview = htmlspecialchars(substr($row['content'], 0, 150)) . "...";
            $link = htmlspecialchars($row['link']); // データベースから取得したリンク

            echo "<div class='search-result-card'>"; // 各結果をカードにする
            echo "<h3><a href='$link'>$title</a></h3>"; // カスタムリンクを使用
            echo "<p>$content_preview</p>";
            echo "<a href='$link' class='read-more'>Read More</a>"; // Read Moreもカスタムリンクに
            echo "</div>";
        }

        echo "</div>"; // コンテナ終了
    } else {
        echo "<p>該当する結果が見つかりませんでした。</p>";
    }

    $stmt->close();
}

$conn->close();
?>

</body>
</html>
<style>
/* 全体のスタイル */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f9;
    margin: 0;
    padding: 20px;
}

h2 {
    font-size: 24px;
    color: #333;
    text-align: center;
    margin-bottom: 20px;
}

/* 検索フォーム */
.search-form {
    display: flex;
    justify-content: center;
    margin-bottom: 30px;
}

.search-input {
    width: 300px;
    padding: 10px;
    font-size: 16px;
    border: 2px solid #0073e6;
    border-radius: 4px;
    margin-right: 10px;
}

.search-button {
    background-color: #0073e6;
    color: #fff;
    padding: 10px 15px;
    font-size: 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.search-button:hover {
    background-color: #005bb5;
}

/* 検索結果コンテナ */
.search-results-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
}

/* 各結果のカード */
.search-result-card {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    padding: 20px;
    max-width: 300px;
    width: 100%;
    transition: transform 0.3s ease;
}

.search-result-card:hover {
    transform: translateY(-5px);
}

.search-result-card h3 {
    font-size: 20px;
    color: #0073e6;
    margin-bottom: 10px;
}

.search-result-card p {
    color: #555;
    line-height: 1.6;
}

.search-result-card .read-more {
    display: inline-block;
    margin-top: 10px;
    padding: 10px 15px;
    background-color: #0073e6;
    color: #fff;
    text-decoration: none;
    border-radius: 4px;
    font-weight: bold;
    transition: background-color 0.3s ease;
}

.search-result-card .read-more:hover {
    background-color: #005bb5;
}
</style>