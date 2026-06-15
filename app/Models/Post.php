<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //

    protected $fillable = [

        'category_id',
        'photo_id',
        'title',
        'body'

    ];

    public function user()
    {

        return $this->belongsTo(User::class);

    }


    public function photo()
    {

        return $this->belongsTo(Photo::class);

    }

    public function category()
    {

        return $this->belongsTo(Category::class);

    }


}
