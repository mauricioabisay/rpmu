<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Participant;
use App\Faculty;

class AdminController extends Controller
{
    
    public function indexUser()
    {
        $users = User::all();
        return view(
            'users.list',
            array(
                'users' => $users
            )
        );
    }

    public function createUser()
    {
        return view(
            'users.create',
            array(
                'faculties' => Faculty::all()
            )
        );
    }

    public function storeUser(Request $request)
    {
    	$user = new User;

    	$user->name = $request->name;
    	$user->email = $request->email;
        $user->password = '';

    	$user->save();

        $participant = new Participant;

        $participant->id = $request->id;
        $participant->name = $request->name;
        $participant->bio = $request->bio;
        $participant->link = $request->link;
        $participant->faculty_slug = $request->faculty_slug;
        $participant->degree_slug = '';

        $user->participant()->save($participant);

        return redirect('/users');
    }

    public function editUser(User $user)
    {
        return view(
            'users.edit',
            array(
                'user' => $user, 
                'faculties' => Faculty::all()
            )
        );
    }

    public function updateUser(Request $request, User $user)
    {
            $user->name = $request->name;
            $user->email = $request->email;

            $user->save();

            $participant = $user->participant ?: new Participant;

            $participant->id = $request->id;
            $participant->name = $request->name;
            $participant->bio = $request->bio;
            $participant->link = $request->link;
            $participant->faculty_slug = $request->faculty_slug;

            $user->participant()->save($participant);
        return redirect('/users');
    }

    public function deleteUser(User $user)
    {
        $user->participant->delete();
        $user->delete();

        return redirect('/users');
    }
}
