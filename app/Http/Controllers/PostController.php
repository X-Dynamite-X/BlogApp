<?php

namespace App\Http\Controllers;

use App\Models\{Post, ActionPost,Category};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::paginate(9);

        return view('Home', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        if (Auth::check() && !Auth::user()->views->contains('post_id', $post->id)) {
            $post->views()->updateOrCreate(['user_id' => Auth::id()])->incrementView();
        }

        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }

    public function like(Post $post , Request $request)
    {
        $userId = Auth::id();

        $isActive = $request->input('isActive');
        if($isActive == 'true'){
            ActionPost::where('post_id', $post->id)
            ->where('user_id', $userId)
            ->where('action', 'like')
            ->delete();
            return response()->json(['message' => 'Post unliked successfully.', "likes"=>$post->actions->where('action', 'like')->count() ,  "dislikes"=>$post->actions->where('action', 'dislike')->count()]);
        }


        ActionPost::where('post_id', $post->id)
            ->where('user_id', $userId)
            ->where('action', 'dislike')
            ->delete();



        ActionPost::updateOrCreate(
            [
                'post_id' => $post->id,
                'user_id' => $userId,
                'action' => 'like',
            ],

        );

        return response()->json(['message' => 'Post liked successfully.', "likes"=>$post->actions->where('action', 'like')->count() ,  "dislikes"=>$post->actions->where('action', 'dislike')->count()]);
    }


    public function dislike(Post $post , Request $request)
    {
        $userId = Auth::id();
        $isActive = $request->input('isActive');
        if($isActive == 'true'){
            ActionPost::where('post_id', $post->id)
            ->where('user_id', $userId)
            ->where('action', 'dislike')
            ->delete();
            return response()->json(['message' => 'Post undisliked successfully.', "likes"=>$post->actions->where('action', 'like')->count() ,  "dislikes"=>$post->actions->where('action', 'dislike')->count()]);
        }

        ActionPost::where('post_id', $post->id)
            ->where('user_id', $userId)
            ->where('action', 'like')
            ->delete();

        ActionPost::updateOrCreate(
            [
                'post_id' => $post->id,
                'user_id' => $userId,
                'action' => 'dislike',
            ],

        );

        return response()->json(['message' => 'Post disliked successfully.', "likes"=>$post->actions->where('action', 'like')->count() ,  "dislikes"=>$post->actions->where('action', 'dislike')->count()]);
    }


    public function incrementView(Post $post)
    {
        $post->increment('view');
        $post->save();

        return response()->json(['message' => 'View incremented successfully.',"post"=>$post]);
    }

    public function postCatygory($name)
    {
        $category = Category::where('name', $name)->firstOrFail();
        $posts = Post::where('category_id', $category->id)->paginate(9);
        return view('Home', compact('posts'));
    }
}
