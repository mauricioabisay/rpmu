<?php

namespace App\Http\Controllers;

use Auth;
use App\Subject;
use App\Research;
use App\Requirement;
use App\Goal;
use App\Citation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResearchController extends Controller
{
    public function __construct() {
        $this->authorizeResource(Research::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $researches = Research::all();
        return view(
            'research.list',
            compact('researches')
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
            'research.create',
            array(
                'subjects' => Subject::all()
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
        $research = new Research;

        $research->title = $request->title;
        $research->slug = str_slug($request->title);
        $research->abstract = $request->abstract;
        $research->subject = implode(',', $request->subject);
        $research->description = '';
        $research->extra_info = '';

        $research->save();

        //Researchers
        if( is_array($request->researchers) ) {
            $len = sizeof($request->researchers);
            $ids = $request->input('researchers');
            for ( $i = 0; $i < $len; $i++ ) {
                $research->participants()->syncWithoutDetaching([
                    $ids[$i] => [
                        'role' => 'researcher',
                        'assigment' => ''
                    ]
                ]);
            }
        }

        if( is_array($request->researchers_delete) ) {
            $len = sizeof($request->researchers_delete);
            for( $i = 0; $i < $len; $i++ ) {
                $research->participants()->detach($request->researchers_delete[$i]);
            }
        }

        //Students
        if( is_array($request->participants) ) {
            $len = sizeof($request->participants);
            $ids = $request->input('participants');
            for ( $i = 0; $i < $len; $i++ ) {
                $research->participants()->syncWithoutDetaching([
                    $ids[$i] => [
                        'assigment' => ''
                    ]
                ]);
            }
        }

        if( is_array($request->participants_delete) ) {
            $len = sizeof($request->participants_delete);
            for( $i = 0; $i < $len; $i++ ) {
                $research->participants()->detach($request->participants_delete[$i]);
            }
        }

        //Leader
        $research->participants()->syncWithoutDetaching([
            Auth::user()->participant->id => [
                'role' => 'leader',
                'assigment' => ''
            ]
        ]);

        $len = sizeof($request->requirement_id);
        $ids = $request->input('requirement_id');
        $deletes = $request->input('requirement_delete');
        $titles = $request->input('requirement_title');
        $descriptions = $request->input('requirement_description');
        for( $i = 0; $i < $len; $i++ ) {
            if ( $deletes[$i] < 0 ) {
                if ( strlen($titles[$i]) > 0 ) {
                    if ( $ids[$i] >= 0 ) {
                        //Update requirement
                        $requirement = Requirement::find($ids[$i]);

                        $requirement->title = $titles[$i];
                        $requirement->description = ( strlen($descriptions[$i]) > 0 ) ? $descriptions[$i] : '';

                        $research->requirements()->save($requirement);
                    } else {
                        //Create new requirement
                        $requirement = new Requirement;

                        $requirement->title = $titles[$i];
                        $requirement->description = ( strlen($descriptions[$i]) > 0 ) ? $descriptions[$i] : '';

                        $research->requirements()->save($requirement);
                    }
                }
            } elseif ( $ids[$i] >= 0 ) {
                //Delete requirement
                Requirement::find($ids[$i])->delete();
            }
        }

        $len = sizeof($request->goal_id);
        $ids = $request->input('goal_id');
        $deletes = $request->input('goal_delete');
        $titles = $request->input('goal_title');
        $descriptions = $request->input('goal_description');
        for ( $i = 0; $i < $len; $i++ ) {
            if ( $deletes[$i] < 0 ) {
                if ( strlen($titles[$i]) > 0 ) {
                    if ( $ids[$i] >= 0 ) {
                        //Update goal
                        $goal = Goal::find($ids[$i]);

                        $goal->title = $titles[$i];
                        $goal->description = ( strlen($descriptions[$i]) > 0 ) ? $descriptions[$i] : '';

                        $research->goals()->save($goal);
                    } else {
                        //Create new goal
                        $goal = new Goal;

                        $goal->title = $titles[$i];
                        $goal->description = ( strlen($descriptions[$i]) > 0 ) ? $descriptions[$i] : '';

                        $research->goals()->save($goal);
                    }
                }
            } elseif ( $ids[$i] >= 0 ) {
                //Delete goal
                Goal::find($ids[$i])->delete();
            }
        }
        
        if ( $request->file('featured_image') ) {
            $request->file('featured_image')->storeAs('researches/'.$research->id, 'image.jpg');
        }

        if (is_array($request->file('gallery'))) {
            $gallery_file = $request->file('gallery');
            $gallery_len = sizeof($gallery_file);
            $gallery_delete = $request->input('gallery_delete');

            for ( $i = 0; $i < $gallery_len; $i++ ) {
                if ( $gallery_delete[$i] < 0 ) {
                    $gallery_file[$i]->store('researches/'.$research->id.'/gallery');
                }
            }
        }

        $len = sizeof($request->citation_id);
        $ids = $request->input('citation_id');
        $deletes = $request->input('citation_delete');
        $descriptions = $request->input('citation_description');
        $types = $request->input('citation_type');
        $links = $request->input('citation_link');
        $files = ( is_array($request->file('citation_file')) ) ? $request->file('citation_file') : array();

        for ( $i = 0; $i < $len; $i++ ) {
            if ( $deletes[$i] < 0 ) {
                if ( strlen($descriptions[$i]) > 0 ) {
                    if ( $ids[$i] >= 0 ) {
                        //Update Citation
                        $citation = Citation::find($ids[$i]);

                        $citation->description = $descriptions[$i];

                        $research->citations()->save($citation);
                    } else {
                        //Create new Citation
                        $citation = new Citation;

                        $citation->description = $descriptions[$i];

                        if ( $types[$i] === 'file' ) {
                            $files[$i]->store('researches/'.$research->id.'/files');
                            $path = 'researches/'.$research->id.'/files/'.$files[$i]->hashName();
                            $citation->link = Storage::disk('local')->url($path);
                        } else {
                            $citation->link = ( stristr($links[$i], 'http://') || (stristr($links[$i], 'https://')) ) ? $links[$i] : 'http://'.$links[$i];
                        }

                        $research->citations()->save($citation);
                    }
                }
            } elseif ( $ids[$i] >= 0 ) {
                //Delete goal
                Citation::find($ids[$i])->delete();
            }
        }

        return redirect()->action('ResearchController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Research  $research
     * @return \Illuminate\Http\Response
     */
    public function show(Research $research)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Research  $research
     * @return \Illuminate\Http\Response
     */
    public function edit(Research $research)
    {
        $leader = $research->participants()->where('role', 'leader')->first();
        $subjects = array();
        foreach (explode(',', $research->subject) as $s) {
            $subjects[] = Subject::where('slug', $s)->first();
        }
        return view(
            'research.edit', 
            compact(
                'research',
                'subjects',
                'leader'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Research  $research
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Research $research)
    {
        $research->title = $request->title;
        $research->slug = str_slug($request->title);
        $research->abstract = $request->abstract;
        $research->subject = implode(',', $request->subject);
        $research->description = '';
        $research->extra_info = '';

        $research->save();

        //Researchers
        if( is_array($request->researchers) ) {
            $len = sizeof($request->researchers);
            $ids = $request->input('researchers');
            for ( $i = 0; $i < $len; $i++ ) {
                $research->participants()->syncWithoutDetaching([
                    $ids[$i] => [
                        'role' => 'researcher',
                        'assigment' => ''
                    ]
                ]);
            }
        }

        if( is_array($request->researchers_delete) ) {
            $len = sizeof($request->researchers_delete);
            for( $i = 0; $i < $len; $i++ ) {
                $research->participants()->detach($request->researchers_delete[$i]);
            }
        }

        //Students
        if( is_array($request->participants) ) {
            $len = sizeof($request->participants);
            $ids = $request->input('participants');
            for ( $i = 0; $i < $len; $i++ ) {
                $research->participants()->syncWithoutDetaching([
                    $ids[$i] => [
                        'assigment' => ''
                    ]
                ]);
            }
        }

        if( is_array($request->participants_delete) ) {
            $len = sizeof($request->participants_delete);
            for( $i = 0; $i < $len; $i++ ) {
                $research->participants()->detach($request->participants_delete[$i]);
            }
        }

        $len = sizeof($request->requirement_id);
        $ids = $request->input('requirement_id');
        $deletes = $request->input('requirement_delete');
        $titles = $request->input('requirement_title');
        $descriptions = $request->input('requirement_description');
        for( $i = 0; $i < $len; $i++ ) {
            if ( $deletes[$i] < 0 ) {
                if ( strlen($titles[$i]) > 0 ) {
                    if ( $ids[$i] >= 0 ) {
                        //Update requirement
                        $requirement = Requirement::find($ids[$i]);

                        $requirement->title = $titles[$i];
                        $requirement->description = ( strlen($descriptions[$i]) > 0 ) ? $descriptions[$i] : '';

                        $research->requirements()->save($requirement);
                    } else {
                        //Create new requirement
                        $requirement = new Requirement;

                        $requirement->title = $titles[$i];
                        $requirement->description = ( strlen($descriptions[$i]) > 0 ) ? $descriptions[$i] : '';

                        $research->requirements()->save($requirement);
                    }
                }
            } elseif ( $ids[$i] >= 0 ) {
                //Delete requirement
                Requirement::find($ids[$i])->delete();
            }
        }

        $len = sizeof($request->goal_id);
        $ids = $request->input('goal_id');
        $deletes = $request->input('goal_delete');
        $titles = $request->input('goal_title');
        $descriptions = $request->input('goal_description');
        for ( $i = 0; $i < $len; $i++ ) {
            if ( $deletes[$i] < 0 ) {
                if ( strlen($titles[$i]) > 0 ) {
                    if ( $ids[$i] >= 0 ) {
                        //Update goal
                        $goal = Goal::find($ids[$i]);

                        $goal->title = $titles[$i];
                        $goal->description = ( strlen($descriptions[$i]) > 0 ) ? $descriptions[$i] : '';

                        $research->goals()->save($goal);
                    } else {
                        //Create new goal
                        $goal = new Goal;

                        $goal->title = $titles[$i];
                        $goal->description = ( strlen($descriptions[$i]) > 0 ) ? $descriptions[$i] : '';

                        $research->goals()->save($goal);
                    }
                }
            } elseif ( $ids[$i] >= 0 ) {
                //Delete goal
                Goal::find($ids[$i])->delete();
            }
        }

        if ( $request->file('featured_image') ) {
            $request->file('featured_image')->storeAs('researches/'.$research->id, 'image.jpg');
        }

        $gallery_delete = $request->input('gallery_delete_from_storage');

        $files = Storage::files('researches/'.$research->id.'/gallery');
        foreach ($files as $key => $file) {
            if ( $gallery_delete[$key] > 0 ) {
                Storage::delete($file);
            }
        }

        if (is_array($request->file('gallery'))) {
            $gallery_file = $request->file('gallery');
            $gallery_len = sizeof($gallery_file);
            $gallery_delete = $request->input('gallery_delete');

            for ( $i = 0; $i < $gallery_len; $i++ ) {
                if ( $gallery_delete[$i] < 0 ) {
                    $gallery_file[$i]->store('researches/'.$research->id.'/gallery');
                }
            }
        }

        $len = sizeof($request->citation_id);
        $ids = $request->input('citation_id');
        $deletes = $request->input('citation_delete');
        $descriptions = $request->input('citation_description');
        $types = $request->input('citation_type');
        $links = $request->input('citation_link');
        $files = ( is_array($request->file('citation_file')) ) ? $request->file('citation_file') : array();

        for ( $i = 0; $i < $len; $i++ ) {
            if ( $deletes[$i] < 0 ) {
                if ( strlen($descriptions[$i]) > 0 ) {
                    if ( $ids[$i] >= 0 ) {
                        //Update Citation
                        $citation = Citation::find($ids[$i]);

                        $citation->description = $descriptions[$i];

                        $research->citations()->save($citation);
                    } else {
                        //Create new Citation
                        $citation = new Citation;

                        $citation->description = $descriptions[$i];

                        if ( $types[$i] === 'file' ) {
                            $files[$i]->store('researches/'.$research->id.'/files');
                            $path = 'researches/'.$research->id.'/files/'.$files[$i]->hashName();
                            $citation->link = Storage::disk('local')->url($path);
                        } else {
                            $citation->link = ( stristr($links[$i], 'http://') || (stristr($links[$i], 'https://')) ) ? $links[$i] : 'http://'.$links[$i];
                        }

                        $research->citations()->save($citation);
                    }
                }
            } elseif ( $ids[$i] >= 0 ) {
                //Delete goal
                Citation::find($ids[$i])->delete();
            }
        }

        return redirect()->action('ResearchController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Research  $research
     * @return \Illuminate\Http\Response
     */
    public function destroy(Research $research)
    {
        $research->delete();

        return redirect()->action('ResearchController@index');
    }
}
