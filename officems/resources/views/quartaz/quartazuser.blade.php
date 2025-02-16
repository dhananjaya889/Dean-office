@extends('layouts.admin')

@section('title', 'Add Lectures')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">Add Lectures</div>
            <div class="card-body">
               
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('quartazuser.store') }}" method="POST">
                
                    @csrf
                    <input type="hidden" name="quartaz_id" value="{{$id}}">
                    <div class="mb-3">
                        <label class="form-label"> Lecture</label>
                        <select name="user_id" id="" class="form-control">
                            <option value="">--- Select Lecture ---</option>
                            @foreach ($user as $i)
                                <option value="{{$i->id}}">{{$i->name}} - {{$i->email}}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success w-100">Add Lecture</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection