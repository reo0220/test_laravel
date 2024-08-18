<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <link rel = "stylesheet" type = "text/css" href = "{{asset('/css/style.css')}}">
        <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
        <title>アカウント登録画面</title>
        <script>
            //チェックボックスボタン
            var remove = 0;
            function radioDeselection(already, numeric) {
                if(remove == numeric) {
                    already.checked = false;
                    remove = 0;
                }else{
                    remove = numeric;
                }
            }
        </script>
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
            <h2>アカウント登録</h2>
            <form method="POST" action="/confirm">
                @csrf
                <ul class = "ul">
                    <li>
                        <label class = "form_name" id = "formname_1">名前（姓）</label>
                        <input type="text" name="family_name" pattern="[\u4E00-\u9FFF\u3040-\u309Fー]{0,10}" title="10文字以内の漢字・ひらがなで入力" value="{{ isset($family_name) ? $family_name : old("family_name") }}">                                                                                                                 
                        <!-- バリデーションエラー（空欄）-->
                        @if ($errors->any())
                            @error('family_name')
                                <div class="validate_message">{{ $message }}</div>
                            @enderror
                        @endif
                    </li>
                    <li> 
                        <label class ="form_name">名前（名）</label>
                        <input type="text" name="last_name" pattern="[\u4E00-\u9FFF\u3040-\u309Fー]{0,10}" title="10文字以内の漢字・ひらがなで入力" value="{{ isset($last_name) ? $last_name : old("last_name") }}">
                        @if ($errors->any())
                            @error('last_name')
                                <div class="validate_message">{{ $message }}</div>
                            @enderror
                        @endif
                    </li>
                    <li>
                        <label class="form_name">カナ（姓）</label>
                        <input type="text" name="family_name_kana" pattern="[\u30A1-\u30F6]{0,10}" title="10文字以内のカタカナで入力" value="{{ isset($family_name_kana) ? $family_name_kana : old("family_name_kana") }}">
                        @if ($errors->any())
                            @error('family_name_kana')
                                <div class="validate_message">{{ $message }}</div>
                            @enderror
                        @endif
                    </li>
                    <li> 
                        <label class="form_name">カナ（名）</label>
                        <input type="text" name="last_name_kana" pattern="[\u30A1-\u30F6]{0,10}" title="10文字以内のカタカナで入力" value="{{ isset($last_name_kana) ? $last_name_kana : old("last_name_kana") }}">
                        @if ($errors->any())
                            @error('last_name_kana')
                                <div class="validate_message">{{ $message }}</div>
                            @enderror
                        @endif
                    </li>
                    <li>
                        <label class="form_name">メールアドレス</label>
                        <input type="email" name="mail" maxlength = "100" value="{{ isset($mail) ? $mail : old("mail") }}">
                        @if ($errors->any())
                            @error('mail')
                                <div class="validate_message">{{ $message }}</div>
                            @enderror
                        @endif
                    </li>
                    <li>
                        <label class="form_name">パスワード</label></label>
                        <input type="text" name="password" pattern = "[0-9a-zA-Z]{0,10}" title="半角英数字のみ入力">
                        @if ($errors->any())
                            @error('password')
                                <div class="validate_message">{{ $message }}</div>
                            @enderror
                        @endif
                    </li>
                    <li>
                        <label class="form_name">性別</label>
                        <input type="radio" name="gender" value ="男" onclick="radioDeselection(this, 1)" <?php
                                                                                                             if(isset($gender) && $gender == "男"){
                                                                                                                echo "checked";
                                                                                                             }elseif(old("gender") == "男"){
                                                                                                                 echo "checked";
                                                                                                             }elseif(empty($gender) && empty(old("gender"))){
                                                                                                                echo "checked";
                                                                                                             }
                                                                                                           ?>>男
                        <input type="radio" name="gender" value ="女" onclick="radioDeselection(this, 1)" <?php
                                                                                                             if(isset($gender) && $gender == "女"){
                                                                                                                echo "checked";
                                                                                                             }elseif(old("gender") == "女"){
                                                                                                                 echo "checked";
                                                                                                             }
                                                                                                           ?>>女
                        @if ($errors->any())
                            @error('gender')
                                <div class="validate_message">{{ $message }}</div>
                            @enderror
                        @endif
                    </li> 
                    <li>  
                        <label class="form_name">郵便番号</label>
                        <input type="text" name="postal_code" pattern = "[0-9]{0,7}" title = "7文字以内の半角数字で入力" value="{{ isset($postal_code) ? $postal_code : old("postal_code") }}">
                        @if ($errors->any())
                            @error('postal_code')
                                <div class="validate_message">{{ $message }}</div>
                            @enderror
                        @endif
                    </li>
                    <li>
                        <label class = "form_name">住所（都道府県）</label>
                        <select class = "form_item" name="prefecture">
                            <option value=""></option>
                            <option value="北海道" <?php
                                                    if(isset($prefecture) && $prefecture == "北海道"){
                                                        echo "selected";
                                                    }elseif(old("prefecture") == "北海道"){
                                                        echo "selected";
                                                    }
                                                   ?>>北海道</option>
                            <option value="東京都" <?php
                                                    if(isset($prefecture) && $prefecture == "東京都"){
                                                        echo "selected";
                                                    }elseif(old("prefecture") == "東京都"){
                                                        echo "selected";
                                                    }
                                                   ?>>東京都</option>
                            <option value="神奈川県" <?php
                                                    if(isset($prefecture) && $prefecture == "神奈川県"){
                                                        echo "selected";
                                                    }elseif(old("prefecture") == "神奈川県"){
                                                        echo "selected";
                                                    }
                                                   ?>>神奈川県</option>
                            <option value="静岡県" <?php
                                                    if(isset($prefecture) && $prefecture == "静岡県"){
                                                        echo "selected";
                                                    }elseif(old("prefecture") == "静岡県"){
                                                        echo "selected";
                                                    }
                                                   ?>>静岡県</option>
                            <option value="愛知県" <?php
                                                    if(isset($prefecture) && $prefecture == "愛知県"){
                                                        echo "selected";
                                                    }elseif(old("prefecture") == "愛知県"){
                                                        echo "selected";
                                                    }
                                                   ?>>愛知県</option>
                            <option value="大阪府" <?php
                                                    if(isset($prefecture) && $prefecture == "大阪府"){
                                                        echo "selected";
                                                    }elseif(old("prefecture") == "大阪府"){
                                                        echo "selected";
                                                    }
                                                   ?>>大阪府</option>
                            <option value="香川県" <?php
                                                    if(isset($prefecture) && $prefecture == "香川県"){
                                                        echo "selected";
                                                    }elseif(old("prefecture") == "香川県"){
                                                        echo "selected";
                                                    }
                                                   ?>>香川県</option>
                            <option value="福岡県" <?php
                                                    if(isset($prefecture) && $prefecture == "福岡県"){
                                                        echo "selected";
                                                    }elseif(old("prefecture") == "福岡県"){
                                                        echo "selected";
                                                    }
                                                   ?></option>
                            <option value="沖縄県" <?php
                                                    if(isset($prefecture) && $prefecture == "沖縄県"){
                                                        echo "selected";
                                                    }elseif(old("prefecture") == "沖縄県"){
                                                        echo "selected";
                                                    }
                                                   ?>>沖縄県</option>
                        </select>
                        @if ($errors->any())
                            @error('prefecture')
                                <div class="validate_message">{{ $message }}</div>
                            @enderror
                        @endif
                    </li>
                    <li>
                        <label class="form_name">都道府県（市区町村）</label>
                        <input type="text" name="address_1" pattern = "[\u30A1-\u30F6\u4E00-\u9FFF\u3040-\u309Fー0-9０-９\s-ー]{0,10}" value="{{ isset($address_1) ? $address_1 : old("address_1") }}">
                        @if ($errors->any())
                            @error('address_1')
                                <div class="validate_message">{{ $message }}</div>
                            @enderror
                        @endif
                    </li>
                    <li>
                        <label class="form_name">都道府県（番地）</label>
                        <input type="text" name="address_2" pattern = "[\u30A1-\u30F6\u4E00-\u9FFF\u3040-\u309Fー0-9０-９\s-ー]{0,10}" value="{{ isset($address_2) ? $address_2 : old("address_2") }}">
                        @if ($errors->any())
                            @error('address_2')
                                <div class="validate_message">{{ $message }}</div>
                            @enderror
                        @endif
                    </li>
                    <li>
                        <label class="form_name">アカウント権限</label>
                        <select name="authority">
                            <option value="一般" <?php
                                                    if(isset($authority) && $authority == "一般"){
                                                        echo "selected";
                                                    }elseif(old("authority") == "一般"){
                                                        echo "selected";
                                                    }
                                                ?>>一般</option>  
                            <option value="管理者" <?php
                                                    if(isset($authority) && $authority == "管理者"){
                                                        echo "selected";
                                                    }elseif(old("authority") == "管理者"){
                                                        echo "selected";
                                                    }
                                                  ?>>管理者</option>
                        </select>
                    </li>
                    <li><input type = "submit" class = "submit" value="確認する"></li>
                </ul>
            </form>
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