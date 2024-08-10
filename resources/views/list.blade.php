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
                            <td><input class = "list_input" type = "text" name = "family_name"></td>
                            <td><label>名前(名)</label></td>
                            <td><input class = "list_input" type = "text" name = "last_name"></td>
                        </tr> 
                        <tr>
                            <td><label>カナ（姓）</label></td>
                            <td><input class = "list_input" type = "text" name = "family_name_kana"></td>
                            <td><label>カナ（名）</label></td>
                            <td><input class = "list_input" type = "text" name = "last_name_kana"></td>
                        </tr>   
                        <tr>
                            <td><label>メールアドレス</label></td>
                            <td><input class = "list_input" type = "text" name = "mail" maxlength = "100"></td>
                            <td><label>性別</label></td>
                            <td>
                                <input type = "radio" name = "gender" value = "男" onclick="radioDeselection(this, 1)" checked>男
                                <input type = "radio" name = "gender" value = "女" onclick="radioDeselection(this, 1)">女
                            </td>
                        </tr>
                        <tr>
                            <td><label>アカウント権限</label></td>
                            <td>
                                <select class = "list_pull"name = "authority">
                                    <option value = ""></option>
                                    <option value = "一般" selected>一般</option>
                                    <option value = "管理者">管理者</option>
                                </select> 
                            </td>  
                            <td colspan='2'></td>
                        </tr>
                    </table>
                    <input class = "kennsaku_botton" type = "submit" value = "検索">
                </form> 
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