<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Repository\CommentsRepositoryInterface;
use Exception;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    protected $comment;

    public function __construct(CommentsRepositoryInterface $comment)
    {
        $this->comment = $comment;
    }


    public function index()
    {
        return $this->comment->getindex();
    }


    public function create()
    {
        return $this->comment->getcreate();
    }

    public function store(Request $request)
    {
        return $this->comment->getstore($request);
    }

    public function edit(Comment $comment)
    {
        return $this->comment->getedit($comment);
    }

    public function update(Request $request,Comment $comment)
    {
        return $this->comment->getupdate($request,$comment);
    }

    public function destroy(Comment $comment)
    {
        return $this->comment->getdestroy($comment);
    }
}
