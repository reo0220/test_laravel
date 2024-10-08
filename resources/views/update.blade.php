<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <link rel = "stylesheet" type = "text/css" href = "{{asset('/css/style.css')}}">
        <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
        <title>アカウント更新</title>
    </head>
    <body>
        @can('admin')
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
            <h2>アカウント更新画面</h2>
            @foreach($users as $user)
                <form method="POST" action="/update_confirm">
                    @csrf
                    <ul class = "ul">
                        <li>
                            <label class = "form_name" id = "formname_1">名前（姓）</label>
                            <input type="text" name="family_name" pattern="[\u4E00-\u9FFF\u3040-\u309Fー]{0,10}" title="10文字以内の漢字・ひらがなで入力" value= <?php
                                                                                                                                                                if(isset($family_name)){
                                                                                                                                                                    echo $family_name;
                                                                                                                                                                }elseif(old("family_name") != NULL){
                                                                                                                                                                    echo old("family_name");
                                                                                                                                                                }elseif(old("family_name") == NULL){
                                                                                                                                                                    echo "";
                                                                                                                                                                }else{
                                                                                                                                                                    echo $user->family_name;
                                                                                                                                                                }
                                                                                                                                                            ?>>
                                                                                                                                                                
                            @if ($errors->any())
                            @error('family_name')
                                <div class="validate_message">{{ $message }}</div>
                            @enderror
                            @endif
                        </li>
                        <li> 
                            <label class ="form_name">名前（名）</label>
                            <input type="text" name="last_name" pattern="[\u4E00-\u9FFF\u3040-\u309Fー]{0,10}" title="10文字以内の漢字・ひらがなで入力" value= <?php
                                                                                                                                                                if(isset($last_name)){
                                                                                                                                                                    echo $last_name;
                                                                                                                                                                }elseif(old("last_name") != NULL){
                                                                                                                                                                    echo old("last_name");
                                                                                                                                                                }else{
                                                                                                                                                                    echo $user->last_name;
                                                                                                                                                                }
                                                                                                                                                            ?>>
                            @if ($errors->any())
                            @error('last_name')
                                <div class="validate_message">{{ $message }}</div>
                            @enderror
                            @endif
                        </li>
                        <li>
                            <label class="form_name">カナ（姓）</label>
                            <input type="text" name="family_name_kana" pattern="[\u30A1-\u30F6]{0,10}" title="10文字以内のカタカナで入力" value= <?php
                                                                                                                                                if(isset($family_name_kana)){
                                                                                                                                                    echo $family_name_kana;
                                                                                                                                                }elseif(old("family_name_kana") != NULL){
                                                                                                                                                    echo old("family_name_kana");
                                                                                                                                                }else{
                                                                                                                                                    echo $user->family_name_kana;
                                                                                                                                                }
                                                                                                                                            ?>>
                            @if ($errors->any())
                            @error('family_name_kana')
                                <div class="validate_message">{{ $message }}</div>
                            @enderror
                            @endif
                        </li>
                        <li> 
                            <label class="form_name">カナ（名）</label>
                            <input type="text" name="last_name_kana" pattern="[\u30A1-\u30F6]{0,10}" title="10文字以内のカタカナで入力" value= <?php
                                                                                                                                                if(isset($last_name_kana)){
                                                                                                                                                    echo $last_name_kana;
                                                                                                                                                }elseif(old("last_name_kana") != NULL){
                                                                                                                                                    echo old("last_name_kana");
                                                                                                                                                }else{
                                                                                                                                                    echo $user->last_name_kana;
                                                                                                                                                }
                                                                                                                                            ?>>
                            @if ($errors->any())
                            @error('last_name_kana')
                                <div class="validate_message">{{ $message }}</div>
                            @enderror
                            @endif
                        </li>
                        <li>
                            <label class="form_name">メールアドレス</label>
                            <input type="text" name="mail" maxlength = "100" value= <?php
                                                                                        if(isset($mail)){
                                                                                            echo $mail;
                                                                                        }elseif(old("mail") != NULL){
                                                                                            echo old("mail");
                                                                                        }else{
                                                                                            echo $user->mail;
                                                                                        }
                                                                                    ?>>
                            @if ($errors->any())
                            @error('mail')
                                <div class="validate_message">{{ $message }}</div>
                            @enderror
                            @endif
                        </li>
                        <li>
                            <label class="form_name">パスワード</label></label>
                            <input type="password" name="password" value=<?php
                                                                            for($i = 0;$i < mb_strlen($user->password);$i++){
                                                                                if($i == 10){
                                                                                    break;
                                                                                }else{
                                                                                    echo "●";
                                                                                }
                                                                            };
                                                                        ?>>
                        </li>
                        <li>
                            <label class="form_name">性別</label>
                            <input type="radio" name="gender" value ="男" <?php
                                                                            if($user->gender === 0){
                                                                                echo "checked='checked'";
                                                                            }?>>男
                            <input type="radio" name="gender" value ="女" <?php
                                                                            if($user->gender === 1){
                                                                                echo "checked='checked'";
                                                                            }?>>女
                        </li> 
                        <li>  
                            <label class="form_name">郵便番号</label>
                            <input type="text" name="postal_code" value="{{ $user->postal_code }}">
                        </li>
                        <li>
                            <label class = "form_name">住所（都道府県）</label>
                            <select class = "form_item" name="prefecture">
                                <option value="北海道" <?php
                                                        if($user->prefecture === "北海道"){
                                                            echo "selected";
                                                        }?>>北海道</option>
                                <option value="東京都" <?php
                                                        if($user->prefecture === "東京都"){
                                                            echo "selected";
                                                        }?>>東京都</option>
                                <option value="神奈川県" <?php
                                                        if($user->prefecture === "神奈川県"){
                                                            echo "selected";
                                                        }?>>神奈川県</option>
                                <option value="静岡県" <?php
                                                        if($user->prefecture === "静岡県"){
                                                            echo "selected";
                                                        }?>>静岡県</option>
                                <option value="愛知県" <?php
                                                        if($user->prefecture === "愛知県"){
                                                            echo "selected";
                                                        }?>>愛知県</option>
                                <option value="大阪府" <?php
                                                        if($user->prefecture === "大阪府"){
                                                            echo "selected";
                                                        }?>>大阪府</option>
                                <option value="香川県" <?php
                                                        if($user->prefecture === "香川県"){
                                                            echo "selected";
                                                        }?>>香川県</option>
                                <option value="福岡県" <?php
                                                        if($user->prefecture === "福岡県"){
                                                            echo "selected";
                                                        }?>>福岡県</option>
                                <option value="沖縄県" <?php
                                                        if($user->prefecture === "沖縄県"){
                                                            echo "selected";
                                                        }?>>沖縄県</option>
                            </select>
                        </li>
                        <li>
                            <label class="form_name">都道府県（市区町村）</label>
                            <input type="text" name="address_1" value="{{ $user->address_1 }}">
                        </li>
                        <li>
                            <label class="form_name">都道府県（番地）</label>
                            <input type="text" name="address_2" value="{{ $user->address_2 }}">
                        </li>
                        <li>
                            <label class="form_name">アカウント権限</label>
                            <select name="authority">
                                <option value="一般" <?php
                                                        if($user->authority === 0){
                                                            echo "selected";
                                                        }?>>一般</option>  
                                <option value="管理者" <?php
                                                        if($user->authority === 1){
                                                            echo "selected";
                                                        }?>>管理者</option>
                            </select>
                        </li>
                        <li><input type="hidden" name="id" value="{{$user->id}}"></li>
                        <li><input type = "submit" class = "submit" value="確認する"></li>
                    </ul>
                </form>
            @endforeach
        </main>
        <footer>Copyright D.I.Works | D.I.blog is the one which provides A to Z about programming</footer>
        @elsecan('general-higher')
        <!--ログインユーザーが「一般」の時のエラー-->
        <script>
            window.onload = function(){
                Swal.fire({
                    title: '権限がないためエラーが発生しました。',
                    type : 'warning',
                    bottons:true,
                    grow : 'fullscreen',
                    confirmButtonText:"トップページへ",
                    allowOutsideClick:false
                }).then((result) =>{
                    if(result.value){
                            window.location.href ="./top";
                        }
                });
            }   
        </script>
        @else
        <!--ログインしていない時のエラー-->
        <script>
            window.onload = function(){
                Swal.fire({
                    title: 'ログインしてください。',
                    type : 'warning',
                    bottons:true,
                    grow : 'fullscreen',
                    confirmButtonText:"ログインページへ",
                    allowOutsideClick:false
                }).then((result) =>{
                    if(result.value){
                            window.location.href ="./login";
                        }
                });
            }   
        </script>
        @endcan                                         
    </body>
</html>