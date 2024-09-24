<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'question', 'type', 'is_required'];

    public function category() {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function answer() {
        return $this->hasMany(Answer::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'answers')
            ->withPivot('answer');
    }
}
