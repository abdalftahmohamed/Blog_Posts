<?php

namespace App\Repository;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\File;


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



    public function Storeposts($request)
    {
        try {
            $fileextension=$request->file('image')->getClientOriginalExtension();
            $path='app/images_attachments';
            $filename=$path.'/'.time().'.'.$fileextension;
            $request->image->move($path,$filename);

            $posts = new Post();
            $posts->title =$request->title;
            $posts->author =$request->user_id;
            $posts->Joining_Date = $request->Joining_Date;
            $posts->content =$request->content;
            $posts->image=$filename;
            $posts->save();
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
                File::delete($posts->image);
                $fileextension=$request->file('image')->getClientOriginalExtension();
                $path='app/images_attachments';
                $filename=$path.'/'.time().'.'.$fileextension;
                $request->image->move($path,$filename);

                $posts->title =$request->title;
                $posts->author =$request->user_id;
                $posts->Joining_Date = $request->Joining_Date;
                $posts->content =$request->content;

                $posts->image =$filename;
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
//            session()->flash('error','Error!!! Post not deleted Successfully please delete all comment');
//            return redirect()->route('posts.index');
            return abort(404);
        }
    }



    public function forcedelete($request,$post){
        $my_comment_id=Comment::where('post_id',$request->post_id)->pluck('post_id');
        $posts = Post::findorfail($request->post_id);
        if ($my_comment_id->count()==0) {
            File::delete($posts->image);
            Post::withTrashed()
                ->where('id', $request->post_id)
                ->first()
                ->forceDelete();
            session()->flash('error', 'Post deleted Successfully');
            return redirect()->route('posts.index');
        }
        else
        {
            return abort(404);
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
