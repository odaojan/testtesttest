<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Redirector;
use Illuminate\Http\Request;
use App\Task;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct(Redirector $redirect)
    {
        $this->middleware('auth');
        $this->middleware(function (Request $request, $next) use ($redirect) {
            if (auth()->user()->is_admin == 0) {
                $redirect->to('/')->send();
            }    
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        return view('admin.index', [
            'tasks' => Task::paginate(3),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function TaskDone(Request $request)
    {
        $task = Task::find($request->id);
        $task->done = 1;
        $task->save();

        return redirect('/admin');
    }

}
