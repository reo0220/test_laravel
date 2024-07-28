<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <link rel = "stylesheet" type = "text/css" href = "{{asset('/css/style.css')}}">
        <title>アカウント更新確認</title>
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
            <h2>アカウント更新確認画面</h2>
            <ul class = "ul">
                <li>
                    <label class ="form_name">名前（姓）</label>
                    <p>{{$family_name}}</p>
                </li>
                <li>
                    <label class ="form_name">名前（名）</label>
                    <p>{{$last_name}}</p>
                </li>
                <li>
                    <label class ="form_name">カナ（姓）</label>
                    <p>{{$family_name_kana}}</p>
                </li>
                <li>
                    <label class ="form_name">カナ（名）</label>
                    <p>{{$last_name_kana}}</p>
                </li>
                <li>
                    <label class ="form_name">メールアドレス</label>
                    <p>{{$mail}}</p>
                </li>
                <li>
                    <label class ="form_name">パスワード</label>
                    <p><?php
                        for($i = 0;$i < mb_strlen($password);$i++){ //文字数分●表示
                                echo "●"; 
                        };?></p>
                </li>
                <li>
                    <label class ="form_name">性別</label>
                    <p>{{$gender}}</p>
                </li>
                <li>
                    <label class ="form_name">郵便番号</label>
                    <p>{{$postal_code}}</p>
                </li>
                <li>
                    <label class ="form_name">住所（都道府県）</label>
                    <p>{{$prefecture}}</p>
                </li>
                <li>
                    <label class ="form_name">都道府県（市区町村）</label>
                    <p>{{$address_1}}</p>
                </li>
                <li>
                    <label class ="form_name">都道府県（番地）</label>
                    <p>{{$address_2}}</p>
                </li>
                <li>
                    <label class ="form_name">アカウント権限</label>
                    <p>{{$authority}}</p>
                </li>
                <button class = "botton_back"><a href ='update?user_id={{$id}}' style = "text-decoration:none;">前に戻る</a></button>
                <form method = "POST" action ="/update_complete">
                    @csrf
                    <input type = "hidden" value = "{{$family_name}}" name = "family_name">
                    <input type = "hidden" value = "{{$last_name}}" name = "last_name">
                    <input type = "hidden" value = "{{$family_name_kana}}" name = "family_name_kana">
                    <input type = "hidden" value = "{{$last_name_kana}}" name = "last_name_kana">
                    <input type = "hidden" value = "{{$mail}}" name = "mail">
                    <input type = "hidden" value = "{{$password}}" name = "password">
                    <!--男を選択した場合０、女の場合１-->
                    <input type = "hidden" value = "<?php if($gender == "男"){  
                                                                echo 0;
                                                            } else{
                                                                echo 1;
                                                            }?>" name = "gender">
                    <input type = "hidden" value = "{{$postal_code}}" name = "postal_code">
                    <input type = "hidden" value = "{{$prefecture}}" name = "prefecture">
                    <input type = "hidden" value = "{{$address_1}}" name = "address_1">
                    <input type = "hidden" value = "{{$address_2}}" name = "address_2">
                    <!--一般を選択した場合０、管理者を選択した場合１-->
                    <input type = "hidden" value = "<?php if($authority == "一般"){  
                                                                echo 0;
                                                            } else{
                                                                echo 1;
                                                            }?>" name = "authority">
                    <input type = "hidden" value = "{{$id}}" name = "id">                  
                    <input type = "submit" class = "botton_regist" value = "更新する">
                </form>    
            </ul>
        </main>
        <footer>Copyright D.I.Works | D.I.blog is the one which provides A to Z about programming</footer>
    </body>
</html>

         