<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <link rel = "stylesheet" type = "text/css" href = "{{asset('/css/style.css')}}">
        <title>アカウント削除</title>
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
        <main>
            <h2>アカウント削除画面</h2>
            @foreach($users as $user)
            <ul class = "ul">
                <li>
                    <label class ="form_name">名前（姓）</label>
                    <p>{{$user->family_name}}</p>
                </li>
                <li>
                    <label class ="form_name">名前（名）</label>
                    <p>{{$user->last_name}}</p>
                </li>
                <li>
                    <label class ="form_name">カナ（姓）</label>
                    <p>{{$user->family_name_kana}}</p>
                </li>
                <li>
                    <label class ="form_name">カナ（名）</label>
                    <p>{{$user->last_name_kana}}</p>
                </li>
                <li>
                    <label class ="form_name">メールアドレス</label>
                    <p>{{$user->mail}}</p>
                </li>
                <li>
                    <label class ="form_name">パスワード</label>
                    <p><?php
                        //最大文字数10文字分●表示
                        for($i = 0;$i < mb_strlen($user->password);$i++){
                            if($i == 10){
                                break;
                            }else{
                                echo "●";
                            }
                        };?></p>
                </li>
                <li>
                    <label class ="form_name">性別</label>
                    <p>{{$user->gender}}</p>
                </li>
                <li>
                    <label class ="form_name">郵便番号</label>
                    <p>{{$user->postal_code}}</p>
                </li>
                <li>
                    <label class ="form_name">住所（都道府県）</label>
                    <p>{{$user->prefecture}}</p>
                </li>
                <li>
                    <label class ="form_name">都道府県（市区町村）</label>
                    <p>{{$user->address_1}}</p>
                </li>
                <li>
                    <label class ="form_name">都道府県（番地）</label>
                    <p>{{$user->address_2}}</p>
                </li>
                <li>
                    <label class ="form_name">アカウント権限</label>
                    <p>{{$user->authority}}</p>
                </li>
            </ul>
            @endforeach
            <form method = "POST" action ="/delete_confirm">
                @csrf
                <input type = "hidden" value = "{{$user->id}}" name = "id">
                <input type = "submit" class = "submit" value="確認する">
            </form>      
        </main>
        <footer>Copyright D.I.Works | D.I.blog is the one which provides A to Z about programming</footer>
    </body>
</html>