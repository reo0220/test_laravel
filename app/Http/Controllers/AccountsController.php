<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//Userモデルをuseする
use App\Models\Account;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class AccountsController extends Controller
{

    //ログインしていない時のエラー
    public function login_error()
    {
        return view('login_error');
    }

    public function regist()
    {
        return view('regist');
    }

    public function regist_back(Request $request)
    {
        $family_name = $request->input('family_name');
        $last_name = $request->input('last_name');
        $family_name_kana = $request->input('family_name_kana');
        $last_name_kana = $request->input('last_name_kana');
        $mail = $request->input('mail');
        $password = $request->input('password');
        $gender = $request->input('gender');
        $postal_code = $request->input('postal_code');
        $prefecture = $request->input('prefecture');
        $address_1 = $request->input('address_1');
        $address_2 = $request->input('address_2');
        $authority = $request->input('authority');

        return view('regist', [
            'family_name' => $family_name,
            'last_name' => $last_name,
            'family_name_kana' => $family_name_kana,
            'last_name_kana' => $last_name_kana,
            'mail' => $mail,
            'password' => $password,
            'gender' => $gender,
            'postal_code' => $postal_code,
            'prefecture' => $prefecture,
            'address_1' => $address_1,
            'address_2' => $address_2,
            'authority' => $authority,
        ]);
    }

    public function regist_post(Request $request)
    {   
        //アカウント登録画面の空欄チェック
        $validated = $request->validate([
            'family_name' => ['required'],
            'last_name' => ['required'],
            'family_name_kana' => ['required'],
            'last_name_kana' => ['required'],
            'mail' => ['required'],
            'password' => ['required'],
            'gender' => ['required'],
            'prefecture' => ['required'],
            'postal_code' => ['required'],
            'address_1' => ['required'],
            'address_2' => ['required'],
        ]);
    
        //regist.bladeからPOSTされたデータを取得
        $family_name = $request->input('family_name');
        $last_name = $request->input('last_name');
        $family_name_kana = $request->input('family_name_kana');
        $last_name_kana = $request->input('last_name_kana');
        $mail = $request->input('mail');
        $password = $request->input('password');
        $gender = $request->input('gender');
        $postal_code = $request->input('postal_code');
        $prefecture = $request->input('prefecture');
        $address_1 = $request->input('address_1');
        $address_2 = $request->input('address_2');
        $authority = $request->input('authority');

        return view('regist_confirm', [
            'family_name' => $family_name,
            'last_name' => $last_name,
            'family_name_kana' => $family_name_kana,
            'last_name_kana' => $last_name_kana,
            'mail' => $mail,
            'password' => $password,
            'gender' => $gender,
            'postal_code' => $postal_code,
            'prefecture' => $prefecture,
            'address_1' => $address_1,
            'address_2' => $address_2,
            'authority' => $authority,
        ]);
    }

    //storeメソッドでフォームで送信された情報をどのテーブル・カラムに登録するか割り当てる
    public function store(Request $request){
        $result = Account::create([
            'family_name' => $request->family_name,
            'last_name' => $request->last_name,
            'family_name_kana' => $request->family_name_kana,
            'last_name_kana' => $request->last_name_kana,
            'mail' => $request->mail,
            'password' => Hash::make($request->password),
            'gender' => $request->gender,
            'postal_code' => $request->postal_code,
            'prefecture' => $request->prefecture,
            'address_1' => $request->address_1,
            'address_2' => $request->address_2,
            'authority' => $request->authority,
            'delete_flag' => $request->delete_flag
        ]);

        if(!empty($result)){
            session()->flash('flash_message','登録完了しました');
        }else{
            session()->flash('flash_error_message','エラーが発生したためアカウント登録できません。');
        }

        $result_user = User::create([
            'name' => $request->last_name,
            'email' => $request->mail,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        return view('regist_complete');
    }

    //トップ画面
    public function top()
    {
        return view('top');
    }

    //アカウント一覧
    public function index()
    {
        return view('list');
    }

    //アカウント検索
    public function search(Request $request)
    {
        /* テーブルから全てのレコードを取得する */
        $accounts = Account::query();

        $family_name = $request->input('family_name');
        $last_name = $request->input('last_name');
        $family_name_kana = $request->input('family_name_kana');
        $last_name_kana = $request->input('last_name_kana');
        $mail = $request->input('mail');
        $gender = $request->input('gender');
        $authority = $request->input('authority');

        /* セッションにデータを保存する */
        session([
            'family_name' => $family_name,
            'last_name' => $last_name,
            'family_name_kana' => $family_name_kana,
            'last_name_kana' => $last_name_kana,
            'mail' => $mail,
            'gender' => $gender,
            'authority' => $authority,
        ]);

        if(empty($family_name) && empty($last_name) && empty($family_name_kana) && empty($last_name_kana) && empty($mail) && empty($gender) && empty($authority))
        {
            $users = Account::orderBy('id', 'desc')->get();
            return view('search_list',compact('users'));
        }
        elseif(!empty($family_name) || !empty($last_name) || !empty($family_name_kana) || !empty($last_name_kana) || !empty($mail) || !empty($gender) || !empty($authority))
        {
            if(!empty($family_name))
            {
                $family_name_split = mb_convert_kana($family_name, 's');
                $family_name_split2 = preg_split('/[\s]+/', $family_name_split);
                foreach ($family_name_split2 as $family_name_value) 
                {
                    $accounts->Where('family_name', 'LIKE', "%{$family_name_value}%");
                }
            }

            if(!empty($last_name))
            {
                $last_name_split = mb_convert_kana($last_name, 's');
                $last_name_split2 = preg_split('/[\s]+/', $last_name_split);
                foreach ($last_name_split2 as $last_name_value)
                {
                    $accounts->Where('last_name', 'LIKE', "%{$last_name_value}%");
                }
            }

            if(!empty($family_name_kana))
            {
                $family_name_kana_split = mb_convert_kana($family_name_kana, 's');
                $family_name_kana_split2 = preg_split('/[\s]+/', $family_name_kana_split);
                foreach ($family_name_kana_split2 as $family_name_kana_value) 
                {
                    $accounts->Where('family_name_kana', 'LIKE', "%{$family_name_kana_value}%");
                }
            }

            if(!empty($last_name_kana))
            {
                $last_name_kana_split = mb_convert_kana($last_name_kana, 's');
                $last_name_kana_split2 = preg_split('/[\s]+/', $last_name_kana_split);
                foreach ($last_name_kana_split2 as $last_name_kana_value) 
                {
                    $accounts->Where('last_name_kana', 'LIKE', "%{$last_name_kana_value}%");
                }
            }

            if(!empty($mail))
            {
                $mail_split = mb_convert_kana($mail, 's');
                $mail_split2 = preg_split('/[\s]+/', $mail_split);
                foreach ($mail_split2 as $mail_value) 
                {
                    $accounts->Where('mail', 'LIKE', "%{$mail_value}%");
                }
            }

            if(!empty($gender))
            {
                if($gender == "男")
                {
                    $gender_search = 0; 
                }

                if($gender == "女")
                {
                    $gender_search = 1; 
                }
                $accounts->Where('gender', '=', $gender_search);
            }

            if(!empty($authority))
            {
                if($authority == "一般")
                {
                    $authority_search = 0; 
                }

                if($authority == "管理者")
                {
                    $authority_search = 1; 
                }
                $accounts->Where('authority', '=', $authority_search);
            }

            $users = $accounts->get();
            $count = $accounts->count();

            if($count > 0)
            {
                session(['search' => 'search']);
            }else
            {
                session(['search' => 'not_search']);
            }

            return view('search_list',compact('users'));

            
        }


    }


    //アカウント削除
    public function account_deletion()
    {
        //URLのパラメータを取得
        $user_id = $_GET["user_id"];
        //取得したidのアカウントのデータを取得
        $users = Account::where('id',$user_id)->get();
        return view('delete',compact('users'));
    }

    //アカウント削除確認
    public function delete_confirm(Request $request)
    {
        $id = $request->input('id');
        return view('delete_confirm',[
            'id' => $id
        ]);
    }

   //アカウント削除完了
    public function delete_complete(Request $request)
    {
        $id = $request->input('id');

        //削除ぼたんをクリックしたidのアカウントの削除フラグを「1」に変更
        $result = Account::where('id', '=', $id)->update([
            'delete_flag' => '1',
        ]);

        if(!empty($result)){
            session()->flash('flash_message','削除完了しました');
        }else{
            session()->flash('flash_error_message','エラーが発生したためアカウント削除できません。');
        }

        return view('delete_complete');
    }

    //アカウント更新
    public function account_update()
    {
        $user_id = $_GET["user_id"];
        $users = Account::where('id',$user_id)->get();
        return view('update',compact('users'));
    }     
    
    public function update_confirm(Request $request)
    {
        $id = $request->input('id');
        $family_name = $request->input('family_name');
        $last_name = $request->input('last_name');
        $family_name_kana = $request->input('family_name_kana');
        $last_name_kana = $request->input('last_name_kana');
        $mail = $request->input('mail');
        $password = $request->input('password');
        $gender = $request->input('gender');
        $postal_code = $request->input('postal_code');
        $prefecture = $request->input('prefecture');
        $address_1 = $request->input('address_1');
        $address_2 = $request->input('address_2');
        $authority = $request->input('authority');

        return view('update_confirm', [
            'id' => $id,
            'family_name' => $family_name,
            'last_name' => $last_name,
            'family_name_kana' => $family_name_kana,
            'last_name_kana' => $last_name_kana,
            'mail' => $mail,
            'password' => $password,
            'gender' => $gender,
            'postal_code' => $postal_code,
            'prefecture' => $prefecture,
            'address_1' => $address_1,
            'address_2' => $address_2,
            'authority' => $authority,
        ]);
    }

    //アカウント更新完了
    public function update_complete(Request $request)
    {
        $id = $request->input('id');
        $family_name = $request->input('family_name');
        $last_name = $request->input('last_name');
        $family_name_kana = $request->input('family_name_kana');
        $last_name_kana = $request->input('last_name_kana');
        $mail = $request->input('mail');
        $password = $request->input('password');
        $gender = $request->input('gender');
        $postal_code = $request->input('postal_code');
        $prefecture = $request->input('prefecture');
        $address_1 = $request->input('address_1');
        $address_2 = $request->input('address_2');
        $authority = $request->input('authority');

        $result = Account::where('id', '=', $id)->update([
            'family_name' => $family_name,
            'last_name' => $last_name,
            'family_name_kana' => $family_name_kana,
            'last_name_kana' => $last_name_kana,
            'mail' => $mail,
            'password' => Hash::make($password),
            'gender' => $gender,
            'postal_code' => $postal_code,
            'prefecture' => $prefecture,
            'address_1' => $address_1,
            'address_2' => $address_2,
            'authority' => $authority,
        ]);

        if(!empty($result)){
            session()->flash('flash_message','更新完了しました');
        }else{
            session()->flash('flash_error_message','エラーが発生したためアカウント更新できません。');
        }

        return view('update_complete');
    }

        
    
}