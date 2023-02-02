<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    protected $fillable=['title','author','Joining_Date','content','image'];
    use SoftDeletes;


    public function Auther()
    {
        return $this->belongsTo('App\Models\User', 'author');
    }
}
