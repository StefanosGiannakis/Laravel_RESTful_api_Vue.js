<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\Http\Resources\User as UserResource;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(20);

        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Checking if user's email exists and updates it
        // if not it creates a new record
        
        $user = User::firstOrCreate(
            ['email' => $request->email],
            [
                'name' => $request->name,
                'subject' => $request->subject,
                'body'=>$request->body
            ]
        );
        
        $user->email = $request->email;
        $user->name = $request->name;
        $user->subject = $request->subject;
        $user->body = $request->body;

        $user->save();
        
       
        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($par)
    {
        $user = User::where('email','=',$par)
        ->orwhere('name','LIKE','%'.$par.'%')
        ->orwhere('subject','LIKE','%'.$par.'%')
        ->orwhere('body','LIKE','%'.$par.'%')
        ->get()->toArray();
        
        return $user;
    }

    
}
