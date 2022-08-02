<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
/*
| =================================
|  認証・登録・パスワード変更
| =================================
*/
class UserAuthController extends Controller
{
    /**
     * ログイン処理(login)
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
    */
    public function login( Request $request )
    {
        # 設定（ログイン後にリダイレクトするルーティング名）
        $route_after_login = 'home';



        # [ アカウントとパスワードの照合チェック ] -------

            # エラーカウントのチェック
            $max_count = 3; //エラーの最大値
            $frozen_min = 15; //アクセス停止時間
            if(
                $user = \App\Models\User::where('email',$request->email)->first()
            ){

                //. $frozen_min分後であれば、カウントリセット
                $date_ob01 = \Carbon\Carbon::parse($user->updated_at); //最終ログイン入力時間
                $date_ob02 = \Carbon\Carbon::parse('now');
                $diff_min = $date_ob01->diffInMinutes($date_ob02); //現在時刻との時間差異
                if( $diff_min > $frozen_min ){ $user->update(['error_count' => 0]); } //カウントリセット


                //. エラーカウントの最大値を超える時、ログインフォームへリダイレクト
                if( $user->error_count >= $max_count ){
                    return back()->with('login_error','アカウントにロックがかかりました。約15分後にロックが解除されます。');
                }
            }


            # ログイン成功処理（求職者のアカウントが照合された時）
            Auth::attempt( $request->only('email','password'), $request->remember );



            if( Auth::check() )
            {
                # ユーザー情報をセッションに保存
                $request->session()->regenerate();

                # ログイン履歴の保存
                $login_record = new \App\Models\LoginRecord(['user_id' => Auth::user()->id,]);
                $login_record->save();

                # ログインエラーカウントのリセット
                $user->update(['error_count' => 0]);

                # ログイン前に訪れたページがある場合、前のページに戻る
                if(session('before_worker_url'))
                {
                    return redirect( session('before_worker_url') );
                }


                // マイページTOPへリダイレクト
                return redirect()->route( $route_after_login )
                ->with('alert-success','ログインしました。');

            }


        # [ ログイン失敗の処理 ] -------

            // エラーカウントの加算
            if( isset($user) ){$user->update(['error_count' => $user->error_count + 1]);}

            // エラーメッセージの作成
            $message = '';
            if( Auth::check() ){
                $message = 'このメールアドレスは利用できません。';//管理者アカウント
            }
            if( \App\Models\User::where('email',$request->email)->first() ){
                $message = 'パスワードが間違っています。3回入力に失敗すると、しばらくログインできなくなります。';
            }
            else{
                $message = 'このメールアドレスは登録されていません。';
            }

            // ログインフォームへ戻る
            return back()->with('login_error',$message);

        //
    }


    /**
     * ログアウト処理(logout)
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
    */
    public function logout(Request $request)
    {
        $user = Auth::user();

        Auth::logout(); //ユーザーセッションの削除

        $request->session()->invalidate(); //全セッションの削除

        $request->session()->regenerateToken(); //セッションの再作成(二重送信の防止)


        # ログアウト完了ページへリダイレクト
        return view('user_auth.completed_logout');

        # 前のページへリダイレクト
        return back()->with('alert-warning','ログアウトしました。');
    }


    /**
     *  登録済メールアドレスか確認するAPI(email_unique_api)
     *
     * @param \Illuminate\Http\Request $request
     * @return JSON
    */
    public function email_unique_api( Request $request)
    {
        $user = \App\Models\User::where( 'email', $request->email )->first();

        # JSONレスポンス
        return response()->json([
            'email_ique' => $user ? true : false,
        ]);
    }



    /**
     * ユーザー登録API(register_api)
     *
     * @param \Illuminate\Http\Request $request
     * @return JSON
    */
    public function register_api( Request $request)
    {
        # ユーザー登録
        $user = new \App\Models\User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make( $request->password ),
        ]);
        $user->save();


        # JSONレスポンス
        return response()->json([
            'message' => 'register ok!',
            // 'inputs' => $request->all(),
        ]);
    }



    /**
     * 退会処理(destroy)
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
    */
    public function destroy( Request $request)
    {

    }
}
