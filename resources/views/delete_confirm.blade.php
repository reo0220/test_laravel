<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <link rel = "stylesheet" type = "text/css" href = "{{asset('/css/style.css')}}">
        <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
        <title>アカウント削除確認</title>
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
        <h2 style="margin-top: 60px;">アカウント削除確認画面</h2>
        <div class = "delete_confirm_message">
            <h1>本当に削除してよろしいですか？</h1>
        </div>
        <ul class = "ul">
            <button class = "botton_back"><a href ='delete?user_id={{$id}}' style = "text-decoration:none;">前に戻る</a></button>
            <form method = "POST" action ="/delete_complete">
                @csrf
                <input type = "hidden" value = "{{$id}}" name = "id">                  
                <input type = "submit" class = "botton_regist" value = "削除する">
            </form>    
        </ul>
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
        @endcan
    </body>
</html>