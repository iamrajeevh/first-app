<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'post_title',
        'post_slug',
    ];
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    ### type 1
    // protected static function boot(){
    //     parent::boot();
    //     static::saving(function($post){
    //         $post->post_slug = Str::slug($post->post_title);
    //     });
    //     static::deleted(function($post){
    //         $post->comments()->delete();

    //     });
    // }

    ### type 2
    // protected function PostSlug():Attribute{
    //     return Attribute::make(
    //         get:fn($value)=>strtoupper($value),
    //         set:fn($value)=>[
    //             'post_slug'=>Str::slug($value),
    //             'post_title'=>$value
    //         ]
    //     );

    // }
}
