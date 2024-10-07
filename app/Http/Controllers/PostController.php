<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Post::where('posts.status', '<>', 0)
            ->get()
            ->map(function ($post) {
                $post->created_at = Carbon::parse($post->created_at)->format('d F Y');
                $post->updated_at = Carbon::parse($post->updated_at)->format('d F Y');
                // $post->image_name = Storage::url($post->image_name);
                $post->image_name = config('app.url') . Storage::url($post->image_name);
                return $post;
            });

        $data->makeHidden(['deleted_at',  'status']);
        return response()->json($data);
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
}
