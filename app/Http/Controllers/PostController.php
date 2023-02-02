<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Repository\PostsRepositoryInterface;
use Illuminate\Http\Request;

class PostController extends Controller
{

    protected $posts;

    public function __construct(PostsRepositoryInterface $posts)
    {
        $this->posts = $posts;
    }

    public function index()
    {
        return $this->posts->getallposts();
    }


    public function create()
    {
        return $this->posts->createPosts();
    }

    public function store(StorePostRequest $request)
    {
        return $this->posts->Storeposts($request);
    }

    public function edit(Post $post)
    {
        return $this->posts->editPost($post);
    }

    public function update(Request $request, Post $post)
    {
        return $this->posts->updatepost($request,$post);
    }


    public function destroy(Request $request,Post $post)
    {
        return $this->posts->softdelete($request,$post);
    }


    public function forcedelete(Request $request,Post $post)
    {
        return $this->posts->forcedelete($request,$post);
    }


    public function showdeleted()
    {
        return $this->posts->getshowdeleted();
    }

    public function restore(Request $request,Post $post){
        return $this->posts->getrestore($request, $post);
    }
}
