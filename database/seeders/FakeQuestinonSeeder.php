<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FakeQuestinonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        # ユーザー情報
        $user = \App\Models\User::first();

        # 問題集の登録
        $question_group = new \App\Models\QuestionGroup([
            'user_id' => $user->id,
            'title'   => '仮登録問題',
            'resume'  => 'この問題は、作業用のテスト問題です。',
            'image'   => 'site/image/sample.jpg',
            'tags'    => '仮登録問題　テスト　hoge'
        ]);
        $question_group->save();
    }
}
