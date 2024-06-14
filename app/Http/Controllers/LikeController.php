<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Post;
use Auth;

class LikeController extends Controller
{

    public function __construct(){
        $this -> middleware('auth');
    }

    public function like($postId, Request $request){

        $post = Post::findOrFail($postId);
        if($post -> user_id == Auth::user() -> id){
            abort(403, 'Cannot like own post'); //error als je je eigon post wil liken 
        }
        $like = Like::where('post_id', '=', $postId) -> where('user_id', '=', Auth::user() ->id) -> first();

        if($like != NULL){
            abort(403, 'Cannot like a post more than once');//error als je een post meer dan 1 keer wil liken
        }

        $like = new Like;
        $like -> user_id = Auth::user() -> id;
        $like -> post_id = $postId;
        $like -> save();

        return redirect() -> route('index') -> with('status', 'Post Liked');//als je een post geliket hebt dan zal er verschijnen Post Liked 
    }
}