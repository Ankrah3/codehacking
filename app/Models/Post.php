<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    public function index()
    {
        return "Testing Index - If you see this, the controller is working!";
    }

    public function create()
    {
        return "Testing Create - If you see this, the controller is working!";
    }

}
