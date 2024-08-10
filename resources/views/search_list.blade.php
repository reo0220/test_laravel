<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <link rel = "stylesheet" type = "text/css" href = "{{asset('/css/style.css')}}">
        <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
        <title>アカウント一覧</title>
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
                <button onclick="location.href='/form'" class ="btn">アカウント登録</button>
            </li>
            <li>
                <button onclick="location.href='/list'" class ="btn">アカウント一覧</button>
            </li>
        </ul>
        <main>
            <h2>アカウント一覧</h2>
            <div align="center">
                <!--検索フォーム-->
                <form class = "list_form" action = "/search_list" method = "POST">
                @csrf
                    <table border = '1' cellpadding='0' cellspacing='0' width = "1000px">
                        <tr>
                            <td><label>名前(姓)</label></td>
                            <td><input class = "list_input" type = "text" name = "family_name" value = <?php echo session('family_name')?>></td>
                            <td><label>名前(名)</label></td>
                            <td><input class = "list_input" type = "text" name = "last_name" value = <?php echo session('last_name')?>></td>
                        </tr> 
                        <tr>
                            <td><label>カナ（姓）</label></td>
                            <td><input class = "list_input" type = "text" name = "family_name_kana" value = <?php echo session('family_name_kana')?>></td>
                            <td><label>カナ（名）</label></td>
                            <td><input class = "list_input" type = "text" name = "last_name_kana" value = <?php echo session('last_name_kana')?>></td>
                        </tr>   
                        <tr>
                            <td><label>メールアドレス</label></td>
                            <td><input class = "list_input" type = "text" name = "mail" maxlength = "100" value = <?php echo session('mail')?>></td>
                            <td><label>性別</label></td>
                            <td>
                                <input type = "radio" name = "gender" value = "男" onclick="radioDeselection(this, 1)" <?php 
                                                                                                                            if(session('gender') == "男"){
                                                                                                                                echo "checked";
                                                                                                                            }
                                                                                                                        ?>>男
                                <input type = "radio" name = "gender" value = "女" onclick="radioDeselection(this, 1)" <?php 
                                                                                                                            if(session('gender') == "女"){
                                                                                                                                echo "checked";
                                                                                                                            }
                                                                                                                        ?>>女
                            </td>
                        </tr>
                        <tr>
                            <td><label>アカウント権限</label></td>
                            <td>
                                <select class = "list_pull"name = "authority">
                                    <option value = ""></option>
                                    <option value = "一般" <?php 
                                                                if(session('authority') == "一般"){
                                                                    echo "selected";
                                                                }
                                                            ?>>一般</option>
                                    <option value = "管理者" <?php 
                                                                if(session('authority') == "管理者"){
                                                                    echo "selected";
                                                                }
                                                            ?>>管理者</option>
                                </select> 
                            </td>  
                            <td colspan='2'></td>
                        </tr>
                    </table>
                    <input class = "kennsaku_botton" type = "submit" value = "検索">
                </form>      
                <!--　該当するアカウントが存在する場合 -->
                @if(session('search') == "search")                                                
                <table border = '1' cellpadding='0' cellspacing='0' width='1180px'>
                    <tr>
                        <th>ID</th>
                        <th>名前(姓)</th>'
                        <th>名前(名)</th>
                        <th>カナ(姓)</th>
                        <th>カナ(名)</th>
                        <th>メールアドレス</th>
                        <th>性別</th>
                        <th>アカウント権限</th>
                        <th>削除フラグ</th>
                        <th>登録日時</th>
                        <th>更新日時</th>
                        <th colspan='2'>操作</th>
                    </tr>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->family_name }}</td>
                            <td>{{ $user->last_name }}</td>
                            <td>{{ $user->family_name_kana }}</td>
                            <td>{{ $user->last_name_kana }}</td>
                            <td>{{ $user->mail }}</td>
                            <td>
                                <?php 
                                    if($user->gender === 0){
                                        echo "男";
                                    }else{
                                        echo "女";
                                    }
                                ?>
                            </td>
                            <td>
                                <?php 
                                    if($user->authority === 0){
                                        echo "一般";
                                    }else{
                                        echo "管理者";
                                    }
                                ?>
                            </td>
                            <td>
                                <?php 
                                    if($user->delete_flag === 0){
                                        echo "有効";
                                    }else{
                                        echo "無効";
                                    }
                                ?>
                            </td>
                            <td>
                                <?php
                                    echo date("Y/m/d",  strtotime("$user->registered_time"));
                                ?>
                            </td>
                            <td>
                                <?php
                                    echo date("Y/m/d",  strtotime("$user->update_time"));
                                ?>
                            </td>
                            <td><a href = '/update?user_id={{$user->id}}' style="text-decoration:none;">更新</a></td>
                            <!--URLに削除ボタンをクリックしたアカウントのidを渡す-->
                            <td><a href = '/delete?user_id={{$user->id}}' style="text-decoration:none;">削除</a></td>
                        </tr>
                    @endforeach
                </table>
                <!--　検索の結果該当するアカウントが存在しない場合 -->
                @elseif(session('search') == "not_search")
                <h1 class = "search_error">該当するアカウントが存在しません。</h1>
                @endif
            </div>
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