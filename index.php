<!DOCTYPE html>
<html lang="ja">
<head>
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="./favicon.ico">
    <link rel="apple-touch-icon" href="./apple-icon.png" sizes="180x180">
    <title>バナナ国王陛下のサイト</title>
    <script src="./script.js"></script>
    <link rel="stylesheet" href="/style.css">
    <meta name="google-site-verification" content="Jks8bHDNm2XhnrQYaJoPQHu1Y4y1M9mC899O4ROp9dk" />
    <meta name="description" content="任意団体なんでやねんの雑用、バナナ国王陛下のサイトです。匿名掲示板とかも公開してます。" />
<?php
if (isset($_GET['lang'])) {
    $lang = $_GET['lang'];
if ($lang == 'en') {
    header('Location:https://bananaking.cloudfree.jp/en');
    exit();
}
}
?>
<!– Google tag (gtag.js) –>
<script async src=”https://www.googletagmanager.com/gtag/js?id=G-YBN96MG02W”></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag(‘js’, new Date());
gtag(‘config’, ‘G-4Y4CSYB67N‘);
</script>
</head>
<body>

    <!-- ヘッダーのロードエリア -->
    <div id="loadArea" class="loadTo"></div>
    <script>
        window.addEventListener('DOMContentLoaded', function() {
            fetch('/header.html') //ロード元URL
                .then(data => data.text())
                .then(html => document.getElementById('loadArea').innerHTML = html)
                .then(() => {
                    // ロード後の処理
                });
        });
    </script>
<select id="language-select">
  <option value="jp">Japanese</option>
  <option value="en">English</option>
  <!-- 他の言語を追加 -->
</select>
<script>
document.getElementById('language-select').addEventListener('change', function() {
  var selectedLanguage = this.value;
  // 選択された言語に応じてリダイレクトまたは言語切り替えの処理を行う
  // 例: 英語を選択した場合
  if (selectedLanguage === 'en') {
    window.location.href = 'http://bananaking.cloudfree.jp?lang=en'; // 英語版のページにリダイレクト
  } else if (selectedLanguage === 'jp') {
    window.location.href = 'http://bananaking.cloudfree.jp/'; // 日本語版のページにリダイレクト
  }
});
</script>
    <!-- メインコンテンツ -->
    <main>
        <section class="hero">
            <h1>バナナ国王陛下のサイト</h1>
        </section>

        <!-- 検索フォーム -->
        <section class="search-section">
            <form method="GET" action="search.php" class="search-form">
                <input type="text" name="query" placeholder="Search..." class="search-input">
                <button type="submit" class="search-button">検索</button>
            </form>
        </section>

        <!-- サイト情報 -->
        <section class="site-info">
            <p><strong>バナナ国王陛下</strong>とは、<a title="任意団体なんでやねん" href="https://nandeyanen.ie-t.net/" target="_blank" rel="noopener">任意団体なんでやねん</a>の社員です。</p>
            <p>バナナ国王陛下のブログページみて→<a href="blog">こちら</a></p>
        </section>

        <!-- ブログへのお誘い -->
        <section class="call-to-action">
            <h2>このページCSSが終わってます、助けてください🙏 詳細は<a href="event/cssplz">こちら</a></h2>
        </section>
    </main>

    <footer>
<div class="ninja_onebutton">
<script type="text/javascript">
//<![CDATA[
(function(d){
if(typeof(window.NINJA_CO_JP_ONETAG_BUTTON_2e22a80d4bf9a471bb1e9d3a6743571c)=='undefined'){
    document.write("<sc"+"ript type='text\/javascript' src='//omt.shinobi.jp\/b\/2e22a80d4bf9a471bb1e9d3a6743571c'><\/sc"+"ript>");
}else{
    window.NINJA_CO_JP_ONETAG_BUTTON_2e22a80d4bf9a471bb1e9d3a6743571c.ONETAGButton_Load();}
})(document);
//]]>
</script><span class="ninja_onebutton_hidden" style="display:none;"></span><span style="display:none;" class="ninja_onebutton_hidden"></span>
</div>
        <p>© 2024 バナナ国王陛下のサイト. All rights reserved.</p>
    </footer>

</body>
</html>