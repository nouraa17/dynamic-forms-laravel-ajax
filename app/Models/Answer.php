<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'question_id', 'answer'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }
}
