<?php

namespace App\Repository;

use App\Models\Post;
use Illuminate\Http\Request;

interface PostsRepositoryInterface{


    public function getallposts();
    public function createPosts();
    public function StoreAlbum($request);
    public function editPost($post);
    public function updatepost($request,Post $post);
    public function softdelete($request,$post);
    public function forcedelete($request,$post);
    public function getshowdeleted();
    public function getrestore($request, $post);

}

