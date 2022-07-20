<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * ===============================
 *  回答グループ AnswerGroups
 * ===============================
 */
class AnswerGroup extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'score','user_id','question_group_id',
    ];

}
