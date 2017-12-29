<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',  ['except' => ['show', 'getPosts', 'showPost']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('dashboard/posts');
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$data =  $request->all();
        $data = [
            'title' => $request['title'],
            'content' => $request['content'],
            'published' => $request['published']
        ];
        
        $data['user_id'] = 1;
        $data['url'] = 'url chingon';
        $data['shared'] = 10;
        $data['picture'] = 'url picture';
        
        //return $data; 
        
        $post = Post::create($data);
        $post->tags()->attach($request['tag_id']);
        
        return response()->json([
            'name' => $data['title'],
            'message' => 'Se guardo correctamente'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post =  Post::findOrFail($id);
        return $post;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post =  Post::findOrFail($id);
        return $post;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //$data =  $request->all();
        $data = [
            'title' => $request['title'],
            'content' => $request['content'],
            'published' => $request['published']
        ];
        
        $data['user_id'] = 1;
        $data['url'] = 'url chingon';
        $data['shared'] = 10;
        $data['picture'] = 'url picture';
        
        $post = Post::findOrFail($id);
        $post->tags()->detach($post->id);
        $post->tags()->attach($request['tag_id']);
        
        $post->update($data);
        
        return response()->json([
            'name' => $data['title'],
            'message' => 'Se actualizo correctamente'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post  = Post::findOrFail($id);
        
        Post::destroy($id);
        
        return response()->json([
            'name' => $post->title,
            'message' => 'Se elimino correctamente'
        ]);
    }
    
    public function getPosts(){
        $post = Post::select(['id', 'title', 'content', 'url', 'picture', 'published', 'shared', 'created_at']);
        
        return Datatables::of($post)
            ->addColumn('action', function($post) {
                return '<button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#postEditForm" onclick="getPost(' . $post->id . ')"><i class="icon ion-android-refresh"></i> Modificar</button>
                        <button type="button" class="btn btn-outline-danger" onclick="deletePost(' . $post->id . ')"><i class="icon ion-android-close"></i> Eliminar</button>';
            })->make(true);
    }
        
    public function showPost($id){
        return view('/post');
    }
}
