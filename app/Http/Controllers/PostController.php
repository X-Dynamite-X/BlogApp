<?php

namespace App\Http\Controllers;

use App\Models\{Post, ActionPost, Category};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $posts = Post::paginate(9);

        if ($request->ajax()) {

            $postsView = view('post.getPageValue', compact('posts'))->render();
            $pagination = $posts->links()->render();
            return response()->json(['posts' => $postsView, 'pagination' => $pagination]);
        }

        return view('Home', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('post.create', compact('categories'));
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
        $post = Post::findOrFail($post->id);
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
        $post = Post::findOrFail($post->id);
        $categories = Category::all();
        return view('post.edit', compact(['post', 'categories']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        $post = Post::findOrFail($post->id);
        // Prepare data for update
        $data = [
            'title' => $request->title,
            'content' => $request->content,
        ];

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            // if ($post->image) {
            //     Storage::disk('public')->delete($post->image);
            // }

            // Store new image
            $data['image'] = $request->file('image')->store('articles', 'public');
        }

        // Update the post
        $post->update($data);

        // Return JSON response
        return response()->json([
            'message' => 'Post updated successfully.',
            'redirect' => route('post.show', $post->title)
        ]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post = Post::findOrFail($post->id);
        $post->delete();
        return response()->json(['message' => 'Post deleted successfully.', 'redirect' => route('home')]);
    }
    public function like(Post $post, Request $request)
    {
        $userId = Auth::id();
        $isActive = $request->input('isActive');
        if ($isActive == 'true') {
            ActionPost::where('post_id', $post->id)
                ->where('user_id', $userId)
                ->where('action', 'like')
                ->delete();
            return response()->json(['message' => 'Post unliked successfully.', "likes" => $post->actions->where('action', 'like')->count(),  "dislikes" => $post->actions->where('action', 'dislike')->count()]);
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
        return response()->json(['message' => 'Post liked successfully.', "likes" => $post->actions->where('action', 'like')->count(),  "dislikes" => $post->actions->where('action', 'dislike')->count()]);
    }
    public function dislike(Post $post, Request $request)
    {
        $userId = Auth::id();
        $isActive = $request->input('isActive');
        if ($isActive == 'true') {
            ActionPost::where('post_id', $post->id)
                ->where('user_id', $userId)
                ->where('action', 'dislike')
                ->delete();
            return response()->json(['message' => 'Post undisliked successfully.', "likes" => $post->actions->where('action', 'like')->count(),  "dislikes" => $post->actions->where('action', 'dislike')->count()]);
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
        return response()->json(['message' => 'Post disliked successfully.', "likes" => $post->actions->where('action', 'like')->count(),  "dislikes" => $post->actions->where('action', 'dislike')->count()]);
    }
    public function incrementView(Post $post)
    {
        $post->increment('view');
        $post->save();
        return response()->json(['message' => 'View incremented successfully.', "post" => $post]);
    }
    public function postCatygory(Category $category, Request $request)
    {

        $posts = $category->posts()->paginate(9);
        if ($request->ajax()) {
            $postsView = view('post.getPageValue', compact('posts'))->render();
            $pagination = $posts->links()->render();
            return response()->json(['posts' => $postsView, 'pagination' => $pagination]);
        }
        return view('Home', compact('posts'));
    }
}
