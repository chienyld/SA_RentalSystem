<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Models\Borrow;
use App\Models\Post;
use DB;

class SendController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void   
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$posts = Post::all();
        //return Post::where('title', 'Post Two')->get();
        //$posts = DB::select('SELECT * FROM posts');
        //$posts = Post::orderBy('title','desc')->take(1)->get();
        //$posts = Post::orderBy('title','desc')->get();

        $borrows = Borrow::orderBy('id','desc')->paginate(10);
        
        return view('/send')->with('borrows', $borrows);
    }
    public function type0(){
        $posts0 = Post::orderBy('created_at','desc')->where('type', '0')->paginate(10);
        return view('posts.index')->with('posts', $posts0);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'name' => 'required',
            'deposit' => 'required',
            'qty' => 'required'
        ]);

        $borrow=new Borrow;
        $borrow->borrow_id = $request->input('id');
        $borrow->user_id = auth()->user()->id; // get this from session or wherever it came from
        $borrow->name = $request->input('name');
        $borrow->depositamt = $request->input('deposit');
        $borrow->qty = $request->input('qty');
        $borrow->save();

        $post = Post::find($borrow->borrow_id);
        $post->inventory = $post->inventory-$borrow->qty;
        $post->save();

        return redirect('send')->with('success', 'Borrow Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $borrow = Borrow::find($id);
        return view('borrow.show')->with('borrow', $borrow);
    }
    
}
