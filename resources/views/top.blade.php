<?php
    $authority = session('authority');
    dd($authority);
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <link rel = "stylesheet" type = "text/css" href = "{{asset('/css/style.css')}}">
        <title>トップページ</title>
    </head>
    <body>
        <ul class = "header">
            <li>トップ</li>
            <li>プロフィール</li>
            <li>D.I.Blogについて</li>
            <li>登録フォーム</li>
            <li>問い合わせ</li>
            <li>その他</li>
            <?php if ($authority == '0') : ?>
                <li>
                    <button onclick="location.href='/regist'" class ="btn">アカウント登録</button>
                </li>
                <li>
                    <button onclick="location.href='/list'" class ="btn">アカウント一覧</button>
                </li>
            <?php endif; ?>
        </ul>
        <div class = "toppage">
            <h1>TOPページ</h1>
        </div>
        <footer>Copyright D.I.Works | D.I.blog is the one which provides A to Z about programming</footer>
    </body>
</html>