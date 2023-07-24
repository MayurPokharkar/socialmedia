<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;

class profileController extends Controller
{
    public function show($id) {
        $profile = Profile::find($id);
        $user = User::findOrFail($id);
        $posts = Post::get();
        $comment = Comment::get();
        $myComment = Comment::where('user_id', $user->id)->get();
        $myPosts = Post::where('user_id', $user->id)->get();
        return view('profiles.show', compact('profile', 'user', 'posts', 'comment', 'myComment', 'myPosts'));
    }

    public function logout() {
        Auth::logout();
        return redirect('/login');
    }

    public function edit($id , User $user) {
        $user = User::find($id);
        return view('profiles/profile-edit', compact('user'));
    }

    public function authorize($ability, $arguments = [])
    {
        return Auth::check();
    }

    public function update(Request $request, $id)
    {
        
    }

    public function destroy($id)
    {   
        $user = User::where('id', $id);
        $user->destroy();
        return redirect()->route('logout');
    }


}