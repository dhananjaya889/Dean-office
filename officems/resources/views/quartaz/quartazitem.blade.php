@extends('layouts.admin')

@section('title', 'Adding Items to Quarters')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">Add Quarter's Items</div>
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
                <form action="{{ route('quartazitem.store') }}" method="POST">
                
                    @csrf
                    <input type="hidden" name="quartaz" value="{{$id}}">
                    <div class="mb-3">
                        <label class="form-label"> Items</label>
                        <select name="item_id" id="" class="form-control">
                            <option value="">--- Select items ---</option>
                            @foreach ($items as $i)
                                <option value="{{$i->id}}">{{$i->item_id}} - {{$i->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success w-100">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection