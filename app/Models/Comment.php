<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
    protected $guarded=[];
    use SoftDeletes;

    public function my_post()
    {
        return $this->belongsTo('App\Models\Post', 'post_id');
    }
    public function Auther()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

}
