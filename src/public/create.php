<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
        <title>メモ登録ページ</title>
    </head>
    <body>
    <!-- メモの新規作成フォーム -->
    <h1>メモ登録</h1>
    <form action="store.php" method="get">
        <p>title</p>
        <input type="text" name="title" size="20" placeholder="タイトル"></input>
        <br>
        <br>
        <p>本文</p>
        <textarea name="content" style="width:300px; height:100px;" placeholder="本文"></textarea><br>
        <br>
        <input type="submit" name="create" value="送信">
    </form>
    </body>
</html>