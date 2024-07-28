<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <link rel = "stylesheet" type = "text/css" href = "{{asset('/css/style.css')}}">
        <title>アカウント一覧</title>
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
            <h2>アカウント一覧</h2>
            <div align="center">
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
            </div>
        </main>
        <footer>Copyright D.I.Works | D.I.blog is the one which provides A to Z about programming</footer>
    </body>
</html>