<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;



class userController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        //
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'dob' => ['date'],
            'job_title' => ['string'],
            'brief' => ['string'],
            'phone' => ['string'],
            'country' => ['string'],
        ]);
    }

    public function update($id, Request $request)
    {

        $user = User::where('id', $id)->update([
            'email' => $request['email'],
            'name' => $request['name'],
            'job_title' => $request['job_title'],
            'brief' => $request['brief'],
            'phone' => $request['phone'],
            'country' => $request['country'],
        ]);

        if($request['dob']){
            $user = User::where('id', $id)->update([
                'dob' => $request['dob'],
            ]);
        }

        return redirect()->back();

    }


}
