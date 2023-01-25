<?php

namespace App\Repository;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostsRepository implements PostsRepositoryInterface{

    public function getallposts(){
        $posts=Post::all();
        return view('posts.index', compact('posts'));
    }


    public function createPosts()
    {
        $auther=User::all();
        return view('posts.create', compact('auther'));
    }



    public function StoreAlbum($request)
    {
        try {
            $posts = new Post();
            $img=$request->image;
            $posts->title =$request->title;
            $posts->author =$request->user_id;
            $posts->Joining_Date = $request->Joining_Date;
            $posts->content =$request->content;
            $posts->image =$img->getClientOriginalName();
            $posts->save();
            $img->storeAs($posts->id,$img->getClientOriginalName(),$disk='images_attachments');
            session()->flash('message', 'Post Created Successfully');
            return redirect()->route('posts.index');
        }
        catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function editPost($post)
    {
        $id_post = Post::find($post->id);
        $auther=User::all();
        return view('posts.edit', compact('id_post','auther'));
    }


    public function updatepost($request,Post $post)
    {
        try {
            $posts = Post::findorfail($post->id);
            if (!empty($request->image)){
                Storage::disk('images_attachments')->deleteDirectory($post->id);
                $img=$request->image;
                $posts->title =$request->title;
                $posts->author =$request->user_id;
                $posts->Joining_Date = $request->Joining_Date;
                $posts->content =$request->content;
                $img->storeAs($post->id,$img->getClientOriginalName(),$disk='images_attachments');
                $posts->image =$img->getClientOriginalName();
                $posts->save();

                session()->flash('message', 'Post Created Successfully');
                return redirect()->route('posts.index');
                }
             else{
             $posts->title =$request->title;
             $posts->author =$request->user_id;
             $posts->Joining_Date = $request->Joining_Date;
             $posts->content =$request->content;
             $posts->image =$post->image;
             $posts->save();
             session()->flash('message', 'Post Created Successfully');
             return redirect()->route('posts.index');
             }
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }



    public function softdelete($request,$post)
    {
        $my_comment_id=Comment::where('post_id',$request->post_id)->pluck('post_id');

        if ($my_comment_id->count()==0) {
        Post::withTrashed()->where('id',$request->post_id)->first()
        ->delete();
        session()->flash('error', 'Post deleted Successfully');
        return redirect()->route('posts.index');
        }
        else
        {
            session()->flash('error','Error!!! Post not deleted Successfully please delete all comment');
            return redirect()->route('posts.index');
        }
    }



    public function forcedelete($request,$post){
        $my_comment_id=Comment::where('post_id',$request->post_id)->pluck('post_id');

        if ($my_comment_id->count()==0) {
            Storage::disk('images_attachments')->deleteDirectory($request->post_id);
            Post::withTrashed()
                ->where('id', $request->post_id)
                ->first()
                ->forceDelete();
            session()->flash('error', 'Post deleted Successfully');
            return redirect()->route('posts.index');
        }
        else
        {
            session()->flash('error','Error!!! Post not deleted Successfully please delete all comment');
            return redirect()->route('posts.index');
        }

    }


    public function getshowdeleted()
    {
        $posts=Post::onlyTrashed()->get();
        return view('posts.index_deleted',compact('posts'));
    }

    public function getrestore( $request, $post){
        Post::withTrashed()
            ->where('id',$request->post_id)
            ->first()
            ->restore();
        session()->flash('message', 'Post restored Successfully');
        return redirect()->route('posts.index');
    }




}
