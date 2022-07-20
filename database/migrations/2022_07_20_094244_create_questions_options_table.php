<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
/**
 * =================================
 *  問題の選択肢 QuestionsOptions
 * =================================
*/
class CreateQuestionsOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions_options', function (Blueprint $table) {
            $table->id();
            $table->string('text',150   )->comment('選択肢のテキスト');
            $table->boolean('is_correct')->comment('正解か否か')->default(0);

            $table->unsignedBigInteger('question_id')->comment('問題ID');
            $table->foreign('question_id')->references('id')->on('questions') //存在しないidの登録は不可
            ->onDelete('cascade');//主テーブルに関連する従テーブルのレコードを削除

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions_options');
    }
}
