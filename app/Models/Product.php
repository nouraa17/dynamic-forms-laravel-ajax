<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'name', 'description', 'price'];

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
    public function answer()
    {
        return $this->hasMany(Answer::class);
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'answers')
            ->withPivot('answer');
    }
}
