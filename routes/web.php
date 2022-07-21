<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers;

/*
|--------------------------------------------------------------------------
| 問題集を解く　処理　PlayQuestionController
|--------------------------------------------------------------------------
*/
    # 全ての問題集一覧の表示(list)
    # 自分で作成した問題集一覧の表示(my_list)
    # 他者が作成した問題集一覧の表示(others_list)
    # 問題集の一覧表示・キーワード検索(seached_list)
    # 問題を解く(play)
    # 問題の採点(scoring)


/*
|--------------------------------------------------------------------------
| 問題集を作る　処理　MakeQuestionGroupController
|--------------------------------------------------------------------------
*/
    # 問題集の一覧表示(list)
    Route::get('/make_question_group/list', [Controllers\MakeQuestionGroupController::class, 'list'])
    ->name('make_question_group.list');

    # 問題集の新規作成表示(create)
    Route::get('/make_question_group/create', [Controllers\MakeQuestionGroupController::class, 'create'])
    ->name('make_question_group.create');

    # 新規作成問題集の保存(store)
    Route::post('/make_question_group/store', [Controllers\MakeQuestionGroupController::class, 'store'])
    ->name('make_question_group.store');

    # 問題集の編集表示(edit)
    # 編集問題集の保存(update)
    # 問題集の削除(delete)



/*
|--------------------------------------------------------------------------
| 問題集を作る　処理　MakeQuestionController
|--------------------------------------------------------------------------
*/
    # 問題集の一覧表示(list)
    Route::get('/make_question/list', [Controllers\MakeQuestionController::class, 'list'])
    ->name('make_question.list');

    # 問題集の新規作成表示(create)
    Route::get('/make_question/create', [Controllers\MakeQuestionController::class, 'create'])
    ->name('make_question.create');

    # 新規作成問題集の保存(store)
    # 問題集の編集表示(edit)
    # 編集問題集の保存(update)
    # 問題集の削除(delete)


/*
|--------------------------------------------------------------------------
| 成績　処理　ResultsController
|--------------------------------------------------------------------------
*/
    # 成績一覧の表示(list)
    # 詳細成績の表示(detail)


/*
|--------------------------------------------------------------------------
| 各種設定　処理　SettingsController
|--------------------------------------------------------------------------
*/


/*
|--------------------------------------------------------------------------
| 認証　処理　
|--------------------------------------------------------------------------
*/





/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


# 問題一覧
Route::get('/test/', function () { return view('test.questions_list'); })
->name('questions_list');

# 問題
Route::get('/test/question/{id}/{num}', function ($id,$num) { return view( 'test.question.'.$num,compact('id','num') ); })
->name('question');



// Route::get('test/{page}', function ($page) {
//     return view('test.'.$page);
// });

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
