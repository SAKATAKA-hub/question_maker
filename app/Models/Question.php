<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
/**
 * ===============================
 *  問題 Questions
 * ===============================
 */
class Question extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'text','answer_type','order','image','question_group_id',
    ];




    /*
    |--------------------------------------------------------------------------
    | リレーション
    |--------------------------------------------------------------------------
    */
        # QuestionOptionテーブルとのリレーション
        public function question_options()
        {
            return $this->hasMany(QuestionOption::class);
        }

        # QuestionGroupテーブルとのリレーション
        public function question_group()
        {
            return $this->belongsTo(QuestionGroup::class);
        }


        // /**
        //  * 求職者：基本情報 $worker->info
        //  * @return \App\Models\WorkerInfo
        // */
        // public function getInfoAttribute(){
        //     return \App\Models\WorkerInfo::where('worker_id',$this->id)->first();
        // }

    /*
    |--------------------------------------------------------------------------
    | アクセサー
    |--------------------------------------------------------------------------
    |
    |
    */
        /**
         * 画像パス（画像無し対応） $question->image_puth
         * @return String
        */
        public function getImagePuthAttribute(){

            //画像無し時の画像パス
            $no_image = 'site/image/no_image.png';

            return Storage::exists( $this->image ) ? $this->image : $no_image;
        }

    //

}
