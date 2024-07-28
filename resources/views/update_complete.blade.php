<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <link rel = "stylesheet" type = "text/css" href = "{{asset('/css/style.css')}}">
        <title>アカウント更新完了</title>
    </head>
    <body>
        <ul class = "header">
            <li>トップ</li>
            <li>プロフィール</li>
            <li>D.I.Blogについて</li>
            <li>登録フォーム</li>
            <li>問い合わせ</li>
            <li>その他</li>
            <li>
                <button onclick="location.href='/list'" class ="btn">アカウント一覧</button>
            </li>
        </ul>
        <h2 class = "complete_h2">アカウント更新完了画面</h2>
        @if(session('flash_message'))
            <div class = "complete_message">
                <h1>{{ session('flash_message')}}</h1>
            </div>
        @endif
        @if(session('flash_error_message'))
            <div class = "complete_error_message">
            <h1>{{ session('flash_error_message')}}</h1>
            </div>
        @endif
        <div align ="center"><button onclick="location.href='/top'" class ="btn" >TOPページへ戻る</button> </div>
        <footer>Copyright D.I.Works | D.I.blog is the one which provides A to Z about programming</footer>
    </body>
</html>