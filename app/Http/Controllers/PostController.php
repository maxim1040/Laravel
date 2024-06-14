<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use App\Models\Like;
use Auth;

class PostController extends Controller
{

    public function __construct(){
        $this -> middleware('auth' ,['except' => ['index', 'show']]);
    }

    public function index(){
        $posts = Post::orderBy('created_at', 'desc') ->get();
        return view('posts.index', compact('posts'));
    }
    public function show($id){
        $post = Post::findOrFail($id);
        return view('posts.show', compact('post'));
    }

    public function create(){
        return view('posts.create');
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|min:3',
        'content' => 'required|min:20',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // validate image type and size
    ]);

    $post = new Post;
    $post->title = $validated['title'];
    $post->message = $validated['content'];
    $post->user_id = Auth::user()->id;

    // Handle image upload
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('public/posts');
        $post->image = str_replace('public/', '', $imagePath); // store path without 'public/'
    }

    $post->save();

    return redirect()->route('index')->with('status', 'Post added');
}

    public function edit($id){
        $post = Post::findOrFail($id);
        if ($post->user_id != Auth::user()->id && !Auth::user()->is_admin) {
            abort(403); // Abort with a 403 error if the user is not the owner or an admin
        }
    return view('posts.edit', compact('post'));
}

    public function update($id, Request $request){
        $post = Post :: findOrFail($id);
        if($post->user_id != Auth::user()->id && !Auth::user()->is_admin){
            abort(403);//als er een error is in plaats van de pagina te crashen zal het schrijven abort 403 en nadien de text dat je geschreven hebt
        }

        $validated = $request->validate([
            'title'        =>'required|min:3',// het title moet minimum 3 letters hebben 
            'content'      =>'required|min:20',// het content moet minimum 20 letters hebben
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $post -> title = $validated['title'];
        $post -> message = $validated['content'];
        if ($request->hasFile('image')) {
        // Delete the old image if it exists
        if ($post->image) {
            Storage::delete('public/posts/' . $post->image);
        }

        // Store the new image
        $imagePath = $request->file('image')->store('public/posts');
        $post->image = basename($imagePath);
    }
        $post -> save();

        return redirect() -> route('index') -> with('status', 'Post edited');
    }

    public function destroy($id){
        $post = Post::findOrFail($id);
        if(!Auth::user()->is_admin && Auth::user()->id != $post->user_id) {
        abort(403, 'Only admins or the post owner can delete this post');
        }
        $post = Post::findOrFail($id);

        $likes = Like::where('post_id', '=' , $post -> id) -> delete();

        $post -> delete();

        return redirect() -> route('index') -> with('status', 'Post deleted'); //als het post verwijderd is dan zal er post deleted geschreven zijn
    }

}
