<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
/**
 * ===============================
 *  問題グループ QuestionGroup
 * ===============================
 */
class QuestionGroup extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'title','resume','image','tags','published_at','user_id',
    ];




    /*
    |--------------------------------------------------------------------------
    | リレーション
    |--------------------------------------------------------------------------
    */
    # Questionテーブルとのリレーション ※カラムoderの番号順
    public function questions()
    {
        return $this->hasMany(Question::class,'question_group_id')->orderBy('order','asc');
    }




    /*
    |--------------------------------------------------------------------------
    | アクセサー
    |--------------------------------------------------------------------------
    |
    |
    */
        /**
         * 画像パス（画像無し対応） $question_group->image_puth
         * @return String
        */
        public function getImagePuthAttribute(){

            //画像無し時の画像パス
            $no_image = 'site/image/no_image.png';

            return Storage::exists( $this->image ) ? $this->image : $no_image;
        }

        /**
         * 全体の最大更新日時 $question_group->max_updated_at
         * @return String
        */
        public function getMaxUpdatedAtAttribute(){

            $updates_array = [];

            //1 基本情報の更新日
            $update_question_group_at = $this->updated_at;
            $updates_array[] = \Carbon\Carbon::parse( $update_question_group_at )->format('Y-m-d H:i:s');

            //2 問題の最大更新日時
            $update_questions_at =  $this->questions->max('updated_at');
            $updates_array[] = \Carbon\Carbon::parse( $update_questions_at )->format('Y-m-d H:i:s');

            //3 各問題の解答選択肢の最大更新日時
            foreach ($this->questions as $question)
            {
                $update_options_at = $question->question_options->max('updated_at');
                $updates_array[] = \Carbon\Carbon::parse( $update_options_at )->format('Y-m-d H:i:s');
            }

            return max( $updates_array );
        }

    //
}
