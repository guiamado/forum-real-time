<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function($question){
            $question->slug = \str_slug($question->title);
        });

    }
    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected $fillable = ['tittle', 'slug', 'body', 'category_id', 'user_id'];
    // protected $guarded = []; // pega qualquer campo

    protected $with = ['replies'];

    public function user() 
    {
        return $this->belongsTo(\App\User::class);
    }

    public function replies() 
    {
        return $this->hasMany(Reply::class)->latest();
    }

    public function category() 
    {
        return $this->belongsTo(Category::class);
    }
    public function getPathAttribute() 
    {
        return "/question/$this->slug";
    }
}
