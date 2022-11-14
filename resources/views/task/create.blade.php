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
                    
                    @if($errors->any())
                        {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
                    @endif

                  <form method="post" enctype="multipart/form-data" action="{{route('taskStore')}}">
                    @csrf
                    <p><input class="form-control" style="width:100%" type="text" name="title"></p>
                    <p><textarea class="form-control" style="width:100%" rows="10" name="desc"></textarea></p>
                    <p><input class="form-control" type="file" name="upload_file"></p>
                    <p><input class="form-control" type="date" name="time_start"></p>
                    <p><input class="form-control" type="date" name="time_end"></p>
                    <input class="form-control" type="submit" name="" class="btn btn-sm btn-primary">
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
