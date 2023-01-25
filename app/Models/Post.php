<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    protected $guarded=[];
    use SoftDeletes;

    public function Auther()
    {
        return $this->belongsTo('App\Models\User', 'author');
    }
}
