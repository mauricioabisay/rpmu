<?php

namespace App\Http\Controllers;

use App\Degree;
use App\Faculty;
use Illuminate\Http\Request;

class DegreeController extends Controller
{
    public function __construct() {
        $this->authorizeResource(Degree::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if( ! auth()->user() ) {
            return redirect('admin');
        }
        $degrees = Degree::all();

        return view(
            'degree.list', 
            array(
                'degrees' => $degrees, 
                'faculties' => Faculty::all()
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
            'degree.create',
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
        $degree = new Degree;

        $degree->title = $request->title;
        $degree->slug = str_slug( $request->title );
        $degree->faculty_slug = $request->faculty_slug;

        $degree->save();

        return redirect()->action('DegreeController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Degree  $degree
     * @return \Illuminate\Http\Response
     */
    public function show(Degree $degree)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Degree  $degree
     * @return \Illuminate\Http\Response
     */
    public function edit(Degree $degree)
    {
        return view(
            'degree.edit', 
            array(
                'degree' => $degree,
                'faculties' => Faculty::all()
            )
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Degree  $degree
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Degree $degree)
    {
        $degree->title = $request->title;
        $degree->faculty_slug = $request->faculty_slug;

        $degree->save();

        return redirect()->action('DegreeController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Degree  $degree
     * @return \Illuminate\Http\Response
     */
    public function destroy(Degree $degree)
    {
        $degree->delete();

        return redirect()->action('DegreeController@index');
    }
}
