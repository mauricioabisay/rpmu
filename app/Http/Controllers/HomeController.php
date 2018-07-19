<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\User;
use App\Research;
use App\Subject;
use App\Faculty;
use App\Degree;
use App\Participant;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Get all researches in faculty and created order, both in ascending order
    */
    public function home() {
        $researches = Research::allResearchesByFaculty()->paginate(env('RESULTS_PER_PAGE'));
        return view('public.home', compact('researches'));
    }

    /**
     * Get research by slug or all researches
    */
    public function research($research = false) {
        if($research) {
            //Slug provided, so get the research
            $research = Research::where('slug', '=', $research)->first();
            $subjects = array();
            foreach (explode(',', $research->subject) as $s) {
                $subjects[] = Subject::where('slug', $s)->first();
            }
            return view('public.research', compact('research','subjects'));
        } else {
            //Slug not provided, get all researches
            $researches = Research::allResearchesByFaculty()->paginate(env('RESULTS_PER_PAGE'));
            return view('public.home', compact('researches'));       
        }
    }

    /**
     * Get researcher profile or all researchers 
    */
    public function researcher($researcher = false) {
        if($researcher) {
            $researcher = Participant::where('slug', $researcher)->first();
            return view('public.researcher', compact('researcher'));
        } else {
            $participants = Participant::all();
            return view('public.researcher-list', compact('participants'));
        }
    }

    public function faculty($faculty = false) {
        if($faculty) {
            $researches = Faculty::researches($faculty)->paginate(env('RESULTS_PER_PAGE'));
            $faculty = Faculty::where('slug', $faculty)->first();
            return view('public.faculty', compact('faculty','researches'));
        } else {
            $faculties = Faculty::all();
            return view('public.faculty-list', compact('faculties'));
        }
    }

    public function degree($degree) {
        if($degree) {
            $researches = Degree::researches($degree)->paginate(env('RESULTS_PER_PAGE'));
            $degree = Degree::where('slug', $degree)->first();
            return view('public.degree', compact('degree', 'researches'));
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ( $user = Auth::user() ) {
            switch ($user->role) {
                case 'admin': {
                    $researches_by_status = Research::byStatus();

                    $researches_by_status_data = array();
                    foreach ($researches_by_status as $r) {
                        $researches_by_status_data[] = $r->counter;
                    }

                    $researches_by_faculty_created = Research::statusByFaculty('created');

                    $researches_by_faculty_started = Research::statusByFaculty('started');

                    $researches_by_faculty_completed = Research::statusByFaculty('completed');

                    $faculties = Faculty::orderBy('slug', 'asc')->get();
                    
                    $researches_by_faculty_labels = array();
                    $researches_by_faculty_created_data = array();
                    $researches_by_faculty_started_data = array();
                    $researches_by_faculty_completed_data = array();
                    
                    foreach ($faculties as $faculty) {
                        $researches_by_faculty_labels[] = $faculty->title;

                        $aux = 0;
                        foreach ($researches_by_faculty_created as $r) {
                            if($faculty->slug === $r->faculty_slug) {
                                $aux = $r->counter;
                                break;
                            } else {
                                $aux = 0;
                            }
                        }
                        $researches_by_faculty_created_data[] = $aux;

                        $aux = 0;
                        foreach ($researches_by_faculty_started as $r) {
                            if($faculty->slug === $r->faculty_slug) {
                                $aux = $r->counter;
                                break;
                            } else {
                                $aux = 0;
                            }   
                        }
                        $researches_by_faculty_started_data[] = $aux;

                        $aux = 0;
                        foreach ($researches_by_faculty_completed as $r) {
                            if($faculty->slug === $r->faculty_slug) {
                                $aux = $r->counter;
                                break;
                            } else {
                                $aux = 0;
                            }   
                        }
                        $researches_by_faculty_completed_data[] = $aux;
                    }


                    $researches_by_faculty = array(
                        'labels' => json_encode($researches_by_faculty_labels),
                        'created' => json_encode($researches_by_faculty_created_data),
                        'started' => json_encode($researches_by_faculty_started_data),
                        'completed' => json_encode($researches_by_faculty_completed_data)
                    );

                    $researchers_performance = Research::researchers_performance();

                    $researchers_performance_data = array(0, 0);
                    foreach ($researchers_performance as $r) {
                        if ( $r->counter === 0 ) {
                            $researchers_performance_data[0]++;
                        } else {
                            $researchers_performance_data[1]++;
                        }
                    }
                    
                    return view(
                        'dashboard.admin', 
                        array(
                            'researches_by_status_data' => json_encode($researches_by_status_data),
                            'researches_by_faculty' => $researches_by_faculty,
                            'researchers_performance_data' => json_encode($researchers_performance_data)
                        )
                    );
                }
                case 'director': {
                    return view('dashboard.director');
                }
                case 'professor': {
                    return view('dashboard.professor');
                }
            }
            return view('dashboard');
        } else {
            return view('login');
        }
    }

    public function login(Request $request) 
    {
        $client = new \Google_Client( [ 'client_id' => env('G_CLIENT_ID') ] );
        //Get user data from token
        $payload = $client->verifyIdToken($request->token);
        
        if ( $payload ) {
            //Token is valid, user data obtained 
            $user = User::where('email', $payload['email'])->first();
            if ( $user ) {
                Auth::login($user);
                return redirect('admin');
            } else {
                //User has not been registered
                $request->session()->flash('msg.type', 'warning');
                $request->session()->flash('msg.text', 'Lo sentimos tus datos de usuario no tienen permiso de acceso, comunícate con el administrador');
            }
        } else {
            //Token error
            $request->session()->flash('msg.type', 'warning');
            $request->session()->flash('msg.text', 'No se han podido validar tus credenciales de acceso, por favor intenta otra vez. Si el error persiste comunícate con el administrador');
        }
        return view('login');
    }

    public function logout() {
        Auth::logout();
        return redirect('/');
    }
}
