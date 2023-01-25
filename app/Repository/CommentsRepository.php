<?php

namespace App\Repository;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CommentsRepository implements CommentsRepositoryInterface{

    public function getindex()
    {
        $comments=Comment::all();
        return view('comments.index', compact('comments'));
    }


    public function getcreate()
    {
        $auther=User::all();
        $posts=Post::all();
        return view('comments.create', compact('auther','posts'));
    }



    public function getstore($request)
    {
        try {
            $comment = new Comment();
            $comment->post_id =$request->post_id;
            $comment->user_id =$request->user_id;
            $comment->Joining_Date = $request->Joining_Date;
            $comment->comment =$request->comment;
            $comment->save();
            session()->flash('message', 'comment Created Successfully');
            return redirect()->route('comments.index');
        }
        catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function getedit($comment)
    {
        $id_comment = Comment::find($comment->id);
        $auther=User::all();
        $posts=Post::all();
        return view('comments.edit', compact('id_comment','auther','posts'));
    }


    public function getupdate($request,$comment)
    {
        try {

            $comment = Comment::findorfail($comment->id);
            $comment->post_id =$request->post_id;
            $comment->user_id =$request->user_id;
            $comment->Joining_Date = $request->Joining_Date;
            $comment->comment =$request->comment;
            $comment->save();
            session()->flash('message', 'comment Updated Successfully');
            return redirect()->route('comments.index');

        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }



    public function getdestroy($comment)
    {
        Comment::withTrashed()->where('id',$comment->id)->first()
            ->forceDelete();
        session()->flash('error', 'comments deleted Successfully');
        return redirect()->route('comments.index');
    }





}
