<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Participant;
use App\Faculty;

class UserController extends Controller
{
    public function __construct() {
        $this->authorizeResource(User::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view(
            'users.list',
            array(
                'users' => $users
            )
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(
            'users.create',
            array(
                'faculties' => Faculty::all()
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $user = new User;

            $user->email = $request->email;
            $user->faculty_slug = $request->faculty_slug;

            $user->save();

            $participant = new Participant;

            $participant->id = $request->id;
            $participant->name = $request->name;
            $participant->slug = str_slug($request->name);
            $participant->bio = $request->bio;
            $participant->link = $request->link;

            $user->participant()->save($participant);

            return redirect()->action('UserController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view(
            'users.edit',
            array(
                'user' => $user, 
                'faculties' => Faculty::all()
            )
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->email = $request->email;
        $user->faculty_slug = $request->faculty_slug;

        $user->save();

        $participant = $user->participant ?: new Participant;

        $participant->id = $request->id;
        $participant->name = $request->name;
        $participant->slug = str_slug($request->name);
        $participant->bio = $request->bio;
        $participant->link = $request->link;

        $user->participant()->save($participant);
        return redirect()->action('UserController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->participant->delete();
        $user->delete();

        return redirect()->action('UserController@index');
    }
}
