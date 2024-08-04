<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <link rel = "stylesheet" type = "text/css" href = "{{asset('/css/style.css')}}">
        <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
        <title>エラー</title>
    </head>
    @can('general-higher')
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
</html>