<?php

namespace App\Http\Controllers;

use App\Degree;
use App\Participant;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    public function __construct() {
        $this->authorizeResource(Participant::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $participants = Participant::all();

        return view('participant.list', compact('participants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $degrees = Degree::all();
        return view('participant.create', compact('degrees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $participant = new Participant;

        $participant->id = $request->id;
        $participant->name = $request->name;
        $participant->slug = str_slug($request->name);
        $participant->bio = $request->bio;
        $participant->link = $request->link;
        $participant->degree_slug = $request->degree_slug;

        $participant->save();

        return redirect()->action('ParticipantController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function show(Participant $participant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function edit(Participant $participant)
    {
        return view(
            'participant.edit', 
            array(
                'participant' => $participant,
                'degrees' => Degree::all()
            )
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Participant $participant)
    {
        $participant->id = $request->id;
        $participant->name = $request->name;
        $participant->slug = str_slug($request->name);
        $participant->bio = $request->bio;
        $participant->link = $request->link;
        $participant->degree_slug = $request->degree_slug;

        $participant->save();

        return redirect()->action('ParticipantController@index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Participant $participant)
    {
        $participant->delete();
        return redirect()->action('ParticipantController@index');
    }
}
