<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * ===============================
 *  問題の選択肢 QuestionsOptions
 * ===============================
 */
class QuestionsOption extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'text','is_correct','question_id'
    ];
}
