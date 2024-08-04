<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <link rel = "stylesheet" type = "text/css" href = "{{asset('/css/style.css')}}">
        <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
        <title>アカウント更新完了</title>
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