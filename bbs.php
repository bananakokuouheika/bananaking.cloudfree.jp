<?php
    /* class */
    class myBBS{
        private $dbName = "bananaking_bbs";
        private $host   = "localhost";
        private $user   = "bananaking_sns";
        private $pass   = "bananaking";
        private $db;
        private $dbData;

        function __construct(){
            // DBへアクセス
            $this->db = new PDO('mysql:dbname='.$this->dbName.';host='.$this->host, $this->user, $this->pass);
            // エラー時の処理
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        function __destruct(){
            $this->db = null;
        }

        function dataInsert($subName, $subCont){
            // 日付取得
            $inputDate = new DateTime();
            $inputDate = $inputDate->format('Y-m-d H:i:s');

            // テーブルへ値をインサート
            $sql = "INSERT INTO bbs_data (date, name, data) VALUES ('".$inputDate."','".$subName."','".$subCont."')";
            // SQL実行
            $this->db->query($sql);
        }

        function dataSelect(){
            // テーブルから値を取得(参照)
            $sql = "SELECT * FROM bbs_data ORDER BY date DESC";
            // SQL実行
            $res = $this->db->query($sql);

            // 実行結果がある場合は真
            if($res){
                // テーブル件数
                if($res->rowCount() > 0){
                    foreach($res->fetchAll() as $row){
                        echo '<div class="post-card">';
                        echo '<div class="post-title">投稿者: '.$row['name'].'</div>';
                        echo '<div class="post-date">日時: '.$row['date'].'</div>';
                        echo '<div class="post-content">'.$row['data'].'</div>';
                        echo '<input type="submit" name="record" value="del'.$row['no'].'"/>';
                        echo '</div>';
                    }
                } else {
                    echo "投稿はありません。";
                }
            }
        }

        // テーブルデータ削除
        function dataDelete($recordNo){
            // テーブルの値を削除
            $sql = "Delete from bbs_data WHERE no =".$recordNo;
            // SQL実行
            $res = $this->db->query($sql);
        }

        // テーブルデータ削除
        function allDelete(){
            // テーブルの値を削除
            $sql = "truncate table bbs_data";
            // SQL実行
            $res = $this->db->query($sql);
        }
    }

    try {
        // データクラス生成
        $myBBS = new myBBS();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            // 両データが入力されている場合
            if(isset($_POST["addText"]) != ""){
                $subName = $_POST["use_name"];
                $subCont = $_POST["contents"];
                if($subName != "" && $subCont != ""){
                    // データを挿入
                    $myBBS->dataInsert($subName, $subCont);
                }
            }elseif(isset($_POST["delText"]) != ""){
                // 全削除
                $myBBS->allDelete();
            }elseif(isset($_POST["record"]) != ""){
                // 特定の投稿を削除
                $myBBS->dataDelete(trim($_POST["record"], "del"));
            }

            // リダイレクトしてPOSTデータをクリア
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        }
?>

<!DOCTYPE html>
<html lang="ja">
 <head>
  <title>バナナ国王陛下の掲示板サイト</title>
  <style>
    /* 投稿をカード風に */
    .post-card {
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 16px;
        margin: 16px 0;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        background-color: #f9f9f9;
    }

    /* 投稿のタイトル */
    .post-title {
        font-size: 18px;
        font-weight: bold;
        color: #333;
    }

    /* 投稿の日付 */
    .post-date {
        font-size: 14px;
        color: #999;
    }

    /* 投稿の本文 */
    .post-content {
        font-size: 16px;
        color: #555;
        margin-top: 8px;
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
<div class="tokumei">
    <h1>掲示板サイト</h1>
</div>
    <form action="" method="post">
        <h2>名前</h2><input type="text" name="use_name"><br>
        <h2>本文</h2><textarea name="contents" rows="10" cols="40"></textarea><br>
        <input type="submit" name="addText" value="投稿する"/>
        <h2>投稿一覧</h2>
<link rel="stylesheet" href="style.css">
<?php
        // 投稿表示
        $myBBS->dataSelect();
?>
    </form>
 </body>
</html>

<?php
    $myBBS = null;
    } catch(PDOException $e) {
        print($e->getMessage());
        die();
    }
?>