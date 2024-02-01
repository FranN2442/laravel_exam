<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Ramsey\Uuid\Type\Integer;

class PostController extends Controller
{
    function  index() : View
    {
        return view('posts.create', [
            'posts' => Post::all(),
        ]);
    }
    function update(PostUpdateRequest $request, Post $post){

        $post->update($request->all());
        return redirect()->route('post.index');

    }

    function edit($id){

        $post = Post::find($id);

        if(Gate::allows('edit-post', $post))
        {

            return view('posts.edit',compact('post'));

        } 
        else 
        {

            abort(403);

        }

    }

    function create() : View
    {

        return view('posts.create');

    }

    function store(PostRequest $request) : RedirectResponse
    {

        if(Gate::allows('create-post')){

            Post::create([
    
                'titulo' => $request->titulo,
                'extracto' => $request->extracto,
                'contenido'=>$request->contenido,
                'acceso' => $request->acceso,
                'comentable' => $request->comentable,
                'caducable' => $request->caducable,
                'user_id' => $request->user_id
    
            ]);
    
            return redirect()->route('post.index');
        } 
        else 
        {

            abort(403);

        }

    }

    function delete($id) : RedirectResponse
    {
        $post = Post::find($id);

        if(Gate::allows('delete-post', $post))
        {

            Post::destroy($post->id);
            return redirect()->route('dashboard');

        } 
        else 
        {

            abort(403);

        }

    }

}
