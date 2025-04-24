<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'category', 'duration', 'description'];
    protected $appends = ['question_count'];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function getQuestionCountAttribute()
    {
        return $this->questions()->count();
    }

    public static function getCategories()
    {
        return self::select('category')->distinct()->pluck('category');
    }
}
