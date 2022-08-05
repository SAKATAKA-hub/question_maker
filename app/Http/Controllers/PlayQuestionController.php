<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        # ユーザーの問題集情報の取得
        $question_groups = \App\Models\QuestionGroup::
        orderBy('published_at','desc')->where('published_at', '<>', null)
        ->paginate(3);

        # ページの表示
        return view('PlayQuestion.questions_list', compact('question_groups'));
    }


    /**
     * 検索結果一覧の表示(questions_search_list)
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
    */
    public function questions_search_list( Request $request )
    {
        # キーワード
        $keywords = str_replace( '　',' ',$request->seach_keywords );

        # ユーザーの問題集情報の取得
        $question_groups = \App\Models\QuestionGroup::search( $keywords )
        ->orderBy('published_at','desc')->where('published_at', '<>', null)
        ->paginate(3);

        # ページの表示
        return view('PlayQuestion.questions_list', compact('question_groups', 'keywords'));

    }

    # 自分で作成した問題集一覧ページの表示(my_list)
    # 他者が作成した問題集一覧ページの表示(others_list)
    # 問題集の一覧表示・キーワード検索(seached_list)

    /**
     * 問題情報の取得(get_questions_api)
     * @param \Illuminate\Http\Request $request
     * @return JSON
    */
    public function get_questions_api( \Illuminate\Http\Request $request )
    {
        // 問題集情報
        $question_group = \App\Models\QuestionGroup::find( $request->question_group_id );
        // 問題情報
        $questions = $question_group->questions;

        for ($i=0; $i < $questions->count(); $i++) {
            $question = $questions[ $i ];

            // 画像パス
            $questions[ $i ][ 'image' ] = $question->image ? asset('storage/'.$question->image_puth) : null;


            // 解答選択肢（または正解テキスト）をランダムで取得
            // $questions[ $i ][ 'question_options' ] = $question->question_options;
            $questions[ $i ][ 'option_answer_texts' ] = $question->option_answer_texts;
        }


        return response()->json([
            'question_group' => $question_group,
            'questions' => $question_group->questions,
            'time_limit' => '00:01:30',
        ]);
    }




    /**
     * 問題の採点(scoring)
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
    */
    public function scoring( \Illuminate\Http\Request $request )
    {

        // 問題集情報
        $question_group = \App\Models\QuestionGroup::find( $request->question_group_id );
        // 問題情報
        $questions = $question_group->questions;


        # 解答グループのDB保存（ログイン中）
        if( Auth::check() ){

            $answer_group = new \App\Models\AnswerGroup([
                'score'             => 0,
                'user_id'           => Auth::user()->id,
                'question_group_id' => $question_group->id,
            ]);
            // $answer_group->save();
        }


        # 解答の添削

            $correct_count = 0;  //正解数
            for ($q_num=0; $q_num < $questions->count(); $q_num++) {
                $question = $questions[ $q_num ];
                // foreach ($questions as $q_num => $question) {


                // 解答選択内容と答えが一致するかチェック
                $input_answer_text = $request['answer_'.$q_num]; //選択した答え
                switch ( $question->answer_type ) {


                    /* 解答選択肢が複数の時 */
                    case '2':
                        $question_answer_array = explode(' ',$question->answer); //テキストの答えを配列に変換
                        $is_correct = 1;
                        foreach ($input_answer_text as $value) {
                            $is_correct =
                            in_array($value, $question_answer_array) ? $is_correct : 0 ;
                            $is_correct =
                            count( $input_answer_text ) == count( $question_answer_array ) ? $is_correct : 0 ;

                        }
                        //配列から文字列へ変換
                        $input_answer_text = implode(' ',$input_answer_text);


                        // dd($is_correct );
                        // dd( $input_answer_text );
                        // dd( preg_match('/コーヒーも/',$input_answer_text) );

                        break;

                    /* それ以外の時 */
                    default:
                        $is_correct = $input_answer_text == $question->answer ? 1 : 0 ;
                        break;

                    //
                }
                $correct_count += $is_correct ? 1 : 0 ; //正解数の加算


                // 解答データ
                $input_aswer = [
                    // 選択内容
                    'text'            => $is_correct ? $question->answer : $input_answer_text,
                    // 正解か否か
                    'is_correct'      =>  $is_correct,
                    'answer_group_id' => isset( $answer_group->id ) ? $answer_group->id : null,
                    'question_id'     => $question->id,
                ];

                // 解答データをDBへ保存
                $answer = new \App\Models\Answer($input_aswer);
                // $answe->save();


                // [ 問題データに解答内容を保存 ]
                $questions[ $q_num ]->input_answer = $input_aswer;

            }//end for

        //


        # 解答の採点

            $score = round( ( $correct_count / $questions->count() )*100 );
            $score = sprintf( '%d', $score );

            // 採点データをDBへ保存
            if( isset($answer_group) ){

                $answer_group->score = $score;
                $answer_group->save();
            }


            // [ 問題集データに解答内容を保存 ]
            $question_group->score = $score;
        //



        // # ページの表示
        return view('PlayQuestion.scoring', compact('question_group', 'questions'));




        dd(
            // $score
            // $questions->count()
            // $correct_count////正解数
            $questions[2]
            // $request['answer_0']
            // isset(  $hogehoge )
            // $request->all()
            // $question_group->questions[2]->answer
        );

    }




}
