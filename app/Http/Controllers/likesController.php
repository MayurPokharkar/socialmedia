<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Likes;
use Illuminate\Http\Request;
use App\Models\Notification;


class likesController extends Controller
{
    public function index($id)
    {
        $user = User::findOrFail($id);
        $myLikes = Likes::where('user_id', $user->id)->get();
        return view('profiles.show', compact('myLikes'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input['user_id'] = auth()->user()->id;
        Likes::create($input);
        $input['type'] = "like";
        $input['body'] = "";
        Notification::create($input);

        return redirect()->back();
    }


}
