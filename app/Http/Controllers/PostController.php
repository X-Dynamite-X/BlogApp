<?php

namespace App\Http\Controllers;

use App\Models\{Post, ActionPost,Category};
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Can;

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
        //
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

    public function like(Post $post)
    {
        $userId = auth()->id();

        // حذف التفاعل السابق إن وُجد (dislike فقط)
        ActionPost::where('post_id', $post->id)
            ->where('user_id', $userId)
            ->where('action', 'dislike')
            ->delete();



        // تحديث أو إنشاء "like" بدون حذف المشاهدات
        ActionPost::updateOrCreate(
            [
                'post_id' => $post->id,
                'user_id' => $userId,
                'action' => 'like',
            ],

        );

        return response()->json(['message' => 'Post liked successfully.']);
    }


    public function dislike(Post $post)
    {
        $userId = auth()->id();

        ActionPost::where('post_id', $post->id)
            ->where('user_id', $userId)
            ->where('action', 'like')
            ->delete();

        // إنشاء أو تحديث dislike بدون التأثير على view
        ActionPost::updateOrCreate(
            [
                'post_id' => $post->id,
                'user_id' => $userId,
                'action' => 'dislike',
            ],

        );

        return response()->json(['message' => 'Post disliked successfully.']);
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


