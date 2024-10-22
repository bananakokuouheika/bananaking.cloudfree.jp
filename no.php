<!DOCTYPE html>
<html lang="ja">
 <head>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/push.js/0.0.11/push.min.js"></script>
  <meta charset="UTF-8">
   <title>ブラウザでプッシュ通知を実装</title>
 </head>
 <body>
<script type="text/javascript">window.DocsBotAI=window.DocsBotAI||{},DocsBotAI.init=function(e){return new Promise((t,r)=>{var n=document.createElement("script");n.type="text/javascript",n.async=!0,n.src="https://widget.docsbot.ai/chat.js";let o=document.getElementsByTagName("script")[0];o.parentNode.insertBefore(n,o),n.addEventListener("load",()=>{let n;Promise.all([new Promise((t,r)=>{window.DocsBotAI.mount(Object.assign({}, e)).then(t).catch(r)}),(n=function e(t){return new Promise(e=>{if(document.querySelector(t))return e(document.querySelector(t));let r=new MutationObserver(n=>{if(document.querySelector(t))return e(document.querySelector(t)),r.disconnect()});r.observe(document.body,{childList:!0,subtree:!0})})})("#docsbotai-root"),]).then(()=>t()).catch(r)}),n.addEventListener("error",e=>{r(e.message)})})};</script>
<script type="text/javascript">
  DocsBotAI.init({id: "ZRUeaArTQaMuHKn201Y5/i643rvfC0L4dhSAOaxdL"});
</script>
  <center>
   <h1 style="margin-top: 300px">ブラウザでプッシュ通知を実装しよう</h1>
  </center>
  <center>
   <input type="button" id="push" onclick="return push()" value="クリックするとプッシュ通知が送られます">
  </center>

<script>
 function push(){
  Push.create("更新情報", 
   {
    body: "ブログの更新をお知らせします!",
    icon: 'casley_logo.png',
    timeout: 8000,
    onClick: function () {
    window.focus(); 
    this.close();
    }
  })
}
</script>
 </body>
</html>