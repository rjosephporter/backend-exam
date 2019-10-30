<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\CommentResource;
use App\Http\Requests\CommentRequest;
use App\Post;
use App\Comment;

class CommentController extends Controller
{
    /**
     * Create a new CommentController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api')->except(['index', 'show']);

        $this->middleware('guest:api')->only(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Post $post)
    {
        return CommentResource::collection($post->comments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CommentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Post $post, CommentRequest $request)
    {
        $comment = new Comment;
        $comment->title = $request->title;
        $comment->body = $request->body;
        $comment->parent_id = $request->parent_id;
        $comment->creator()->associate(auth()->user());

        $post->comments()->save($comment);

        return new CommentResource($comment);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comment->title = $request->title;
        $comment->body = $request->body;
        $comment->parent_id = $request->parent_id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CommentRequest  $request
     * @param  \App\Post  $post
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(CommentRequest $request, Post $post, Comment $comment)
    {
        $comment->title = $request->filled('title') ? $request->title : $comment->title;
        $comment->body = $request->filled('body') ? $request->body : $comment->body;
        $comment->parent_id = $request->filled('parent_id') ? $request->parent_id : $comment->parent_id;
        $comment->update();

        $post->comments()->save($comment);

        return new CommentResource($comment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post, Comment $comment)
    {
        $post->comments()->where('comments.id', $comment->id)->delete();

        return response()->json(['status' => 'record deleted successfully'], 200);
    }
}
