<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['category', 'subcategory'])->latest()->paginate(9);
        return view('posts.index', [
            'title' => 'List Posts',
            'posts' => $posts,
        ]);
    }

    public function create()
    {
        $categories = Category::all();
        return view('posts.create',[
            'title' => 'Create Post',
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
        ]);

        // Validate that subcategory belongs to category
        $subcategory = Subcategory::find($request->subcategory_id);
        if ($subcategory->category_id != $request->category_id) {
            return back()->withInput()->with('error', 'The selected subcategory does not belong to the selected category.');
        }

        Post::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
        ]);

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    public function show(Post $post)
    {
        return view('posts.show', [
            'title' => 'Details Post',
            'post' => $post,
        ]);
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        $subcategories = Subcategory::where('category_id', $post->category_id)->get();
        return view('posts.edit', [
            'title' => 'Edit Post',
            'post' => $post,
            'categories' => $categories,
            'subcategories' => $subcategories,
        ]);
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
        ]);

        // Validate that subcategory belongs to category
        $subcategory = Subcategory::find($request->subcategory_id);
        if ($subcategory->category_id != $request->category_id) {
            return back()->withInput()->with('error', 'The selected subcategory does not belong to the selected category.');
        }

        $post->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
        ]);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}
