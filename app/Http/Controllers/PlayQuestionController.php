<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
/*
| =================================
|  問題集を解く　処理
| =================================
*/
class PlayQuestionController extends Controller
{
    /**
     * 全ての問題集一覧ページの表示(list)
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
        return view('PlayQuestion.questions_list', compact('question_groups'));
    }


    # 自分で作成した問題集一覧ページの表示(my_list)
    # 他者が作成した問題集一覧ページの表示(others_list)
    # 問題集の一覧表示・キーワード検索(seached_list)
    # 問題を解く(play)
    # 問題の採点(scoring)

}
