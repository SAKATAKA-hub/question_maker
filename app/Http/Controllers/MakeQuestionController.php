<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
/*
| =================================
|  問題を作る　処理
| =================================
*/
class MakeQuestionController extends Controller
{

    /**
     * 問題の新規作成ページの表示(create)
     * @param \App\Models\QuestionGroup $question_group //問題集グループ
     * @return \Illuminate\View\View
    */
    public function create(\App\Models\QuestionGroup $question_group)
    {
        return view('MakeQuestion.edit', compact('question_group') );
    }


    /**
     * 新規作成問題の保存(store)
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\QuestionGroup $question_group //問題集グループ
     * @return \Illuminate\View\View
    */
    public function store(Request $request, \App\Models\QuestionGroup $question_group)
    {

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


        # 問題情報の保存
        $question = new \App\Models\Question([
            'question_group_id' => $question_group->id,
            'text' => $request->text,
            'answer_type' => $request->answer_type,
            'order' => $request->order,
            'image' => $image_path,
        ]);
        $question->save();


        # 問題の回答選択肢情報の保存
        for ($i=0; $i < count( $request->answer_texts ); $i++)
        {
            $question_option = new \App\Models\QuestionOption([
                'question_id' => $question->id,
                'text'        => $request->answer_texts[ $i ],
                'is_answer'   => $request->answer_booleans[ $i ],
            ]);
            $question_option->save();
        }




        # 問題順の入替え
        // ~




        # 問題集の編集ヶ所選択ページへリダイレクト
        return redirect()->route('make_question_group.select_edit', $question_group)
        ->with('alert-success','問題集の基本情報を登録しました。');
    }


    # 問題の編集ページの表示(edit)
    # 編集問題の保存(update)
    # 問題の削除(delete)




}
