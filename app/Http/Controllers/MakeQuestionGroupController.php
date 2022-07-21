<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
/*
| =================================
|  問題集を作る　処理
| =================================
*/
class MakeQuestionGroupController extends Controller
{
    /**
     * 問題集の一覧表示(list)
     *
     * @return \Illuminate\View\View
    */
    public function list()
    {
        # ユーザー情報
        $user = \App\Models\User::first();

        # ユーザーの問題集情報の取得
        $question_groups = \App\Models\QuestionGroup::where('user_id',$user->id)
        ->orderBy('created_at','desc')->get();

        # ページの表示
        return view('MakeQuestionGroup.list', compact('question_groups'));
    }

    /**
     * 問題集の新規作成表示(create)
     *
     * @return \Illuminate\View\View
    */
    public function create()
    {
        return view('MakeQuestionGroup.create');
    }


    /**
     * 新規作成問題集の保存(store)
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
    */
    public function store(Request $request)
    {

        # ユーザー情報
        $user = \App\Models\User::first();


        # 画像のアップロード

            /* 基本設定 */
            $dir = 'upload/images/question_groups'; //保存先ディレクトリ
            $input_file_name = 'image';             //インプットファイルのname
            $image_path = null;

            /* アップロードする画像があるとき、画像のアップロード*/
            if( $request_file = $request->file( $input_file_name ) )
            {
                $image_path =  $request->file( $input_file_name )->store($dir);
            }//end if

        //end 画像のアップロード



        # 問題集基本情報の保存
        $question_group = new \App\Models\QuestionGroup([
            'user_id' => $user->id,
            'title' => $request->title,
            'resume' => $request->resume,
            'image' => $image_path,
            'tags' => str_replace(' ','　',$request->tags),//タグの空文字を大文字に統一
            'is_public' => $request->is_public ? 1 : 0,
        ]);
        $question_group->save();


        return redirect()->route('make_question_group.list')
        ->with('alert-success','問題集の基本情報を登録しました。');
    }


    #
    #
    # 問題集の編集表示(edit)
    # 編集問題集の保存(update)
    # 問題集の削除(delete)

}
