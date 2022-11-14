<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Redirector;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use Illuminate\Support\Facades\Storage;
use App\Task;

class TaskController extends Controller
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
            if (auth()->user()->is_admin == 1) {
                $redirect->to('/admin')->send();
            }    
            return $next($request);
        });
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request)
    {
        $intersectTask = Task::where('user_id', 2)
            ->where('time_start', $request->time_start)
            ->where('time_end', $request->time_end)
            ->count();
        
        if ($intersectTask > 5) {
            return redirect('/')->with('message', 'No more than 4 tasks must overlap in time.');
        }

        $task = new Task;
        $task->title = $request->title;
        $task->desc = $request->desc;
        $task->upload_file = $request->upload_file->store('files');
        $task->user_id = auth()->user()->id;
        $task->time_start = $request->time_start;
        $task->time_end = $request->time_end;
        $task->save();

        // dd($request->time_start);

        return redirect('/')->with('message', 'task saved');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('task.create');
    }

}
