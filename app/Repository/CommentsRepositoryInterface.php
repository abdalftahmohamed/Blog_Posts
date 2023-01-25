<?php

namespace App\Repository;

use App\Models\Post;
use Illuminate\Http\Request;

interface CommentsRepositoryInterface{

    public function getindex();
    public function getcreate();
    public function getstore($request);
    public function getedit($comment);
    public function getupdate($request,$comment);
    public function getdestroy($comment);

}

