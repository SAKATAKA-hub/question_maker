<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
        'text','answer_type','question_group_id',
    ];
}
