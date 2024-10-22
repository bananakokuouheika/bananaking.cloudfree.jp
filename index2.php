<!DOCTYPE html>
<html lang="ja">
<head>
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel=”icon" href="./favicon.ico">
    <link rel="apple-touch-icon" href="./apple-icon.png" sizes="180x180">
    <title>バナナ国王陛下</title>
    <script src="./script.js"></script>
    <link rel="stylesheet" href="style.css">
    <meta name="google-site-verification" content="Jks8bHDNm2XhnrQYaJoPQHu1Y4y1M9mC899O4ROp9dk" />
    <meta name="description" content="任意団体なんでやねんの雑用、バナナ国王陛下のサイトです。匿名掲示板とかも公開してます。" />
    <script>
// ユーザーの設定言語を取得する関数
function getUserLanguage() {
return sessionStorage.getItem('userLanguage') || navigator.language.substr(0, 2);
}

// 初回訪問時にセッションに言語情報を保存する関数
function saveLanguageToSession() {
if (!sessionStorage.getItem('userLanguage')) {
const language = getLanguageFromPath();
sessionStorage.setItem('userLanguage', language);
console.log(`Saved user language: ${language}`);
} else {
console.log(`User language already set: ${getUserLanguage()}`);
}
}

// URLパスから言語を推定する関数
function getLanguageFromPath() {
const path = window.location.pathname;
if (path.startsWith('/jp/')) return 'jp';
if (path.startsWith('/ch/')) return 'zh';
return 'en';
}

// 初回訪問時に適切なページへリダイレクトする関数
function redirectOnFirstVisit() {
saveLanguageToSession();

const language = getUserLanguage();
const path = window.location.pathname;

const isJapanesePath = path.startsWith('/jp/');
const isChinesePath = path.startsWith('/ch/');

const shouldRedirectToJapanese = language === 'jp' && !isJapanesePath;
const shouldRedirectToChinese = language === 'zh' && !isChinesePath;
const shouldRedirectToEnglish = language === 'en' && (isJapanesePath || isChinesePath);

if (shouldRedirectToJapanese) {
window.location.href = '/jp/';
} else if (shouldRedirectToChinese) {
window.location.href = '/ch/';
} else if (shouldRedirectToEnglish) {
window.location.href = '/';
}
}

// 初回訪問時の言語判定とリダイレクトを実行する
redirectOnFirstVisit();
</script>
</head>
<div id="loadArea" class="loadTo"></div>
<script>
    window.addEventListener('DOMContentLoaded', function(){
        fetch('/header.html') //ロード元URL
        .then(data => data.text())
        .then(html => document.getElementById('loadArea').innerHTML = html) //ロード先ID指定
        .then(() => {
                //ロード後の処理を記述                 
            });
    });
</script>
<body>
<h1>バナナ国王陛下のサイト</h1>
<form method="GET" action="search.php" class="search-form">
    <input type="text" name="query" placeholder="Search..." class="search-input">
    <button type="submit" class="search-button">検索</button>
</form>
<p><strong>バナナ国王陛下</strong>とは、<a title="任意団体なんでやねん" href="https://nandeyanen.ie-t.net/" target="_blank" rel="noopener">任意団体なんでやねん</a>の社員です。<a title="Talkit" href="https://nandeyanen.ie-t.net/talkit" target="_blank" rel="noopener">Talkit</a>や<a title="Pagespedia" href="pagespedia.f5.si" target="_blank" rel="noopener">Pagespedia</a>によくいます。</p>
<p>バナナ国王陛下のブログページみて→<a href="blog">こちら</a></p><br>
<h2>このページCSSが終わってます誰かサイトのCSS考えてください🙏 詳細は<a href="event/cssplz">こちら</a></h2>
<h3>これまで忍者ツールズのアクセス解析使ってたけど、シンフリーサーバーに元々アクセス解析の機能備わってたからいらなくね？って思ったので消しました</h3>
<p>いええええええい</p>
<p>パラオつおい</p>
<p>いええええええい</p>
<p>パラオつおい</p>
<p>いええええええい</p>
<p>パラオつおい</p>
</div>
</body>
</html>