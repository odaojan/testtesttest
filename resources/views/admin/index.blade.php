@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    
                    @if (session('message'))
                        <div class="alert alert-primary">
                        {{ session('message') }}
                        </div>
                    @endif

                    <div class="container">
                        @forelse ($tasks as $task)
                        <div class="alert alert-primary">
                            <p>ID: {{ $task->id }}</p>
                            <p>TITLE: {{ $task->title }}</p>
                            <p>DESCRIPTION: {{ $task->desc }}</p>
                            <p>USER NAME: {{ $task->user->name }}</p>
                            <p>USER EMAIL: {{ $task->user->email }}</p>
                            <p>FILE LINK: {{ $task->upload_file }}</p>
                            <p>START: {{ $task->time_start }}</p>
                            <p>END: {{ $task->time_end }}</p>
                            <p>
                                <form method="post" action="{{ route('taskDone') }}"> 
                                    @csrf 
                                    <input type="hidden" name="id" value="{{$task->id}}">
                                    <input type="submit" 
                                    class="btn btn-sm 
                                    @if($task->done) btn-success @else btn-primary @endif"> 
                                </form>
                            </p>
                        </div>    
                    </div>
                        @empty
                    <p class="alert alert-warning">No tasks</p>
                    @endforelse

                    {{ $tasks->links() }}



                    @php
                        //dd($tasks)
                    @endphp

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
